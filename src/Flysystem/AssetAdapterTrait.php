<?php

declare(strict_types=1);

namespace WeDevelop\WebpImages\Flysystem;

trait AssetAdapterTrait
{
    public function delete($path): void
    {
        $location = $this->applyPathPrefix($path);

        @unlink($location . '.webp');

        parent::delete($path);
    }
}
