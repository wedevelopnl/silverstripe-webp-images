<?php

declare(strict_types=1);

namespace WeDevelop\WebpImages\Flysystem;

trait AssetAdapterTrait
{
    public function delete($path): bool
    {
        $location = $this->applyPathPrefix($path);

        @unlink($location . '.webp');

        return parent::delete($path);
    }
}
