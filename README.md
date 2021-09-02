# SilverStripe Webp Images
This SilverStripe module generates webp images from resized jpeg and png images.

## Requirements
* SilverStripe ^4.0
* GD with webp support

## Installation
```sh
composer require webmen/silverstripe-webp-images
```

## Configuration
```yml
SilverStripe\Core\Injector\Injector:
  TheWebmen\WebpImages\Assets\WebpGenerator:
    properties:
      enabled: true
      quality: 80
```
To disable generating webp images in code
```php
WebpGenerator::singleton()->setEnabled(false)
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
