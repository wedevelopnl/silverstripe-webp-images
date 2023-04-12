<?php

namespace TheWebmen\WebpImages\Asset;

use SilverStripe\Core\Extension;
use TheWebmen\WebpImages\WebpGenerator;

class ImageExtension extends Extension
{
    public function EnableWebP()
    {
        WebpGenerator::singleton()->setEnabledForNextGenerate(true);

        return $this->getOwner();
    }

    public function DisableWebP()
    {
        WebpGenerator::singleton()->setEnabledForNextGenerate(false);

        return $this->getOwner();
    }
}
