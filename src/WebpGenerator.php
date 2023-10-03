<?php

declare(strict_types=1);

namespace WeDevelop\WebpImages;

use SilverStripe\Core\Injector\Injectable;

final class WebpGenerator
{
    use Injectable;

    private ?bool $enabledForNextGenerate = null;

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

        $image = match($mimeType) {
            'image/png' => imagecreatefrompng($originalFilename),
            'image/jpeg', 'image/jpg' => imagecreatefromjpeg($originalFilename),
        };

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
        if (is_bool($this->getEnabledForNextGenerate())) {
            $state = $this->getEnabledForNextGenerate();

            $this->enabledForNextGenerate = null;

            return $state;
        }

        return $this->enabled;
    }

    public function setEnabledForNextGenerate(bool $enabled): void
    {
        $this->enabledForNextGenerate = $enabled;
    }

    public function getEnabledForNextGenerate(): ?bool
    {
        return $this->enabledForNextGenerate;
    }
}
