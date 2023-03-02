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
        $url = $url . '.webp';
        $filename = PUBLIC_PATH . $url;

        if (file_exists($filename)) {
            return $url;
        }

        switch ($mimeType) {
            case 'image/png':
                $image = imagecreatefrompng($originalFilename);
                imagepalettetotruecolor($image);
                imagealphablending($image, true);
                imagesavealpha($image, true);
                break;
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($originalFilename);
                break;
        }

        imagewebp($image, $filename, $this->quality);
        imagedestroy($image);

        return $url;
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
