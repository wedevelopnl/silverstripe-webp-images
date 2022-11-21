# SilverStripe Webp Images
This SilverStripe module generates webp images from resized jpeg and png images.

## Requirements
* SilverStripe ^4.0
* GD with webp support

## Installation
```sh
composer require wedevelop/silverstripe-webp-images
```

Next, you'll need to run a `dev/build` (or at least `flush`) to allow access to files with the `.webp` extension from the `.htaccess` in your `assets` directory.

## Configuration
```yml
SilverStripe\Core\Injector\Injector:
  WeDevelop\WebpImages\WebpGenerator:
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
