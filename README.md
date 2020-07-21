# Laravel Pixel Boilerplate

A package to quickly Generator controllers, resources, requests, repositories, services and policies for namespaced folders.

#### Todo:

-   Clean up the spaghetti code.
-   Add in auto migrations
-   Add in auto model creation
-   Add in auto database factory creation

## Installation

You can install the package via composer:

```bash
composer require bytedigital123/pixel-boilerplate
```

<p align="center">
  <img src="https://thumbs.gfycat.com/FrequentBouncyDodobird-size_restricted.gif">
</p>

## Usage

Publish the config file with

```
php artisan vendor:publish --provider="Bytedigital123\Generator\GeneratorServiceProvider"
```

The config file holds the details for any models that you dont want files generated for, and the namepsaces that you would like to use. It also has a config for the default place where your models live.

When the code runs, it will run through all of your models in the folder you have told it to look, and generate all the files for each one. If some already exist, it will overwrite them. It will skip any models that you have added to the `legacyModels` config as well.

Run the code with

```
php artisan Generator:project
```

Just to be safe

```
php artisan config:clear
```

<p align="center">
  <img src="https://media1.tenor.com/images/b5e20f278452f14e56c0c0ae77cd0f9c/tenor.gif?itemid=6161308">
</p>

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email chris@byte-digital.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<p align="center">
  <img src="https://media.giphy.com/media/jUwpNzg9IcyrK/giphy.gif">
</p>
