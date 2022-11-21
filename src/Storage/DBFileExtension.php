<?php

declare(strict_types=1);

namespace WeDevelop\WebpImages\Storage;

use SilverStripe\Assets\Storage\AssetStore;
use SilverStripe\Assets\Storage\DBFile;
use SilverStripe\Core\Extension;
use WeDevelop\WebpImages\WebpGenerator;

/**
 * @property DBFile $owner;
 */
class DBFileExtension extends Extension
{
    public function updateURL(&$url): void
    {
        if (!$this->owner->getIsImage() || $this->owner->getVisibility() !== AssetStore::VISIBILITY_PUBLIC) {
            return;
        }

        $url = WebpGenerator::singleton()->generate($url , $this->owner->getMimeType());
    }
}
