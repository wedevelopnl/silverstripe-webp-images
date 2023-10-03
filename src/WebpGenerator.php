<?php

declare(strict_types=1);

namespace TheWebmen\WebpImages;

use SilverStripe\Core\Injector\Injectable;

final class WebpGenerator
{
    use Injectable;

    public bool $enabled = true;
    public int $quality = 80;

    public function generate(string $url, string $mimeType): string
    {
        if (!$this->getEnabled()) {
            return $url;
        }

        if (!in_array($mimeType, ['image/png', 'image/jpeg', 'image/jpg'], true)) {
            return $url;
        }

        if (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') === false) {
            return $url;
        }

        $originalFilename = PUBLIC_PATH . $url;
        $webpUrl = "{$url}.webp";
        $webpFilename = PUBLIC_PATH . $webpUrl;

        if (file_exists($webpFilename)) {
            return $webpUrl;
        }

        switch ($mimeType) {
            case 'image/png':
                $image = imagecreatefrompng($originalFilename);
                break;
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($originalFilename);
                break;
        }

        if ($image === false) {
            return $url;
        }

        switch ($mimeType) {
            case 'image/png':
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
        }

        $webpImage = imagewebp($image, $webpFilename, $this->quality);
        imagedestroy($image);

        return $webpImage === false ? $url : $webpUrl;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }
}
