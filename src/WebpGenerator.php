<?php

declare(strict_types=1);

namespace TheWebmen\WebpImages;

use SilverStripe\Core\Injector\Injectable;

final class WebpGenerator
{
    use Injectable;

    private static bool $enabled = true;
    private static int $quality = 80;

    public function generate(string $url, string $mimeType): string
    {
        if (!$this->getEnabled()) {
            return $url;
        }

        if (!in_array($mimeType, ['image/png', 'image/jpeg', 'image/jpg'], true)) {
            return $url;
        }

        if (strpos($_SERVER['HTTP_ACCEPT'], 'image/webp') !== true ) {
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
                imagesavealpha($image, true);
                break;
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($originalFilename);
                break;
        }

        imagewebp($image, $filename, self::$quality);
        imagedestroy($image);

        return $url;
    }

    public function setEnabled(bool $enabled): void
    {
        self::$enabled = $enabled;
    }

    public function getEnabled(): bool
    {
        return self::$enabled;
    }
}
