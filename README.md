# silverstripe-webp-images
This SilverStripe module generates webp images from resized jpeg and png images.

## Requirements
* See `composer.json` requirements

## Installation
* `composer require wedevelopnl/silverstripe-webp-images`

Next, you'll need to run a `dev/build` (or at least `flush`) to allow access to files with the `.webp` extension from the `.htaccess` in your `assets` directory.

## License
See [License](LICENSE)

## Maintainers
* [WeDevelop](https://www.wedevelop.nl/) <developement@wedevelop.nl>

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

## Development and contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
See read our [contributing](CONTRIBUTING.md) document for more information.

### Getting started
We advise to use [Docker](https://docker.com)/[Docker compose](https://docs.docker.com/compose/) for development.\
We also included a [Makefile](https://www.gnu.org/software/make/) to simplify some commands

Our development container contains some built-in tools like `PHPCSFixer`.

#### Getting development container up
`make build` to build the Docker container and then run detached.\
If you want to only get the container up, you can simply type `make up`.

You can SSH into the container using `make sh`.

#### All make commands
You can run `make help` to get a list with all available `make` commands.
