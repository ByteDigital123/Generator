# Laravel Scaffold

A package to quickly scaffold controllers, resources, requests, repositories, services and policies for namespaced folders.

## Installation

You can install the package via composer:

```bash
composer require bytedigital123/scaffold
```

## Usage

publish the files with `php artisan vendor:publish --provider="Bytedigital123\Scaffold\ScaffoldServiceProvider"`

The config file holds the details for any models that you dont want files generated for, and the namepsaces that you would like to use. It also has a config for the default place where your models live.

When the code runs, it will run through all of your models in the folder you have told it to look, and generate all the files for each one. If some already exist, it will overwrite them. It will skip any models that you have added to the `legacyModels` config as well.

run the code with `php artisan scaffold:project`.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email chris@byte-digital.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<center>

![](https://media.giphy.com/media/jUwpNzg9IcyrK/giphy.gif)

</center>
