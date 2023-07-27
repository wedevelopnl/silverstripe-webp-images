<?php

declare(strict_types=1);

namespace WeDevelop\WebpImages\Flysystem;

use League\Flysystem\PathPrefixer;

trait AssetAdapterTrait
{
    public function delete($path): void
    {
        $location = new PathPrefixer('');
        $location = $location->prefixPath($path);

        @unlink($location . '.webp');

        parent::delete($path);
    }
}
