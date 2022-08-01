## Domain Subdomain

# Directory Structure

General directory structure of a generic package, you’ll notice how it looks quite different from a standard Laravel project.

```bash
    - src
    - tests
    CHANGELOG.md
    README.md
    LICENSE
    composer.json
```

# Composer.json

Let's start by creating a `composer.json` file in the root of your package directory, having a minimal configuration (as shown below).
An example composer.json is highlighted below.

```json
{
    "name": "jmrashed/domainsubdomain",
    "description": "This package will manage domain and  subdomain. You can add, edit, delete, and view domain and subdomain.",
    "keywords": ["package", "laravel"],
    "type": "library",
    "license": "MIT",
    "authors": [
        {
            "name": "Md Rasheduzzaman",
            "email": "jmrashed@gmail.com",
            "homepage": "",
            "role": "Developer"
        }
    ],
    "require": {
        "php": ">=7.4",
        "laravel/framework": "^8.0",
        "illuminate/support": "^8.0"
    },
    "autoload": {
        "psr-4": {
            "Jmrashed\\DomainSubdomain\\": "src"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Jmrashed\\DomainSubdomai\\Tests\\": "tests"
        }
    },
    "extra": {
        "laravel": {
            "providers": [
                "Jmrashed\\DomainSubdomain\\DomainSubdomainServiceProvider"
            ],
            "aliases": {
                "Calculator": "Jmrashed\\DomainSubdomain\\Facades\\Calculator"
            }
        }
    },
    "require-dev": {
        "phpunit/phpunit": "^9.5",
        "orchestra/testbench": "6.0"
    }
}
```

## Installation command

`composer require jmrashed/domainsubdomain`

# Orchestra Testbench

To use these components in our package, we'll require the Orchestra Testbench. Note that each version of the Laravel framework has a corresponding version of Orchestra Testbench. In this section, I'll assume we're developing a package for Laravel 8.0, which is the latest version at the moment of writing this section.
`composer require --dev "orchestra/testbench=^6.0"`

# Service Providers

Every service provider extends the `Illuminate\Support\ServiceProvider` and implements a `register()` and a `boot()` method.

Since we've pulled in Orchestra Testbench, we can extend the `Illuminate\Support\ServiceProvider` and create our service provider in the `src/` directory

# Autoloading

To automatically register it with a Laravel project using Laravel's package auto-discovery we add our service provider to the "extra"> "laravel"> "providers" key in our package's composer.json:

```php{
    ..., // other keys
    "autoload": { ... },
    "extra": {
        "laravel": {
            "providers": [
                "Jmrashed\\DomainSubdomain\\DomainSubdomainServiceProvider"
            ]
        }
    }
```

Important: this feature is available starting from Laravel 5.5. With version 5.4 or below, you must register your service providers manually in the providers section of the `config/app.php` configuration file in your laravel project.

```php

    <?php
    'providers' => [
        // Other Service Providers
        Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider::class,
    ],
```

# Installing PHPUnit

There are many options to test behavior in PHP. However, we'll stay close to Laravel's defaults, which uses the excellent tool PHPUnit.

Install PHPUnit as a dev-dependency in our package:
`composer require --dev phpunit/phpunit`

# Directory Structure

To accommodate Feature and Unit tests, create a tests/ directory with a Unit and Feature subdirectory and a base TestCase.php file. The structure looks as follows:

```json
    tests/
    ├── Feature
    │   └── ExampleTest.php
    ├── Unit
    │   └── ExampleTest.php
    └── TestCase.php
```

Before we can run the PHPUnit test suite, we first need to map our testing namespace to the appropriate folder in the composer.json file under an "autoload-dev" (psr-4) key:

```json
    "autoload-dev": {
        "psr-4": {
            "Jmrashed\\DomainSubdomain\\Tests\\": "tests/"
        }
    }
```

Finally, re-render the autoload file by running `composer dump-autoload`.

# Creating a Facade

Let’s assume that we provide a Calculator class as part of our package and want to make this class available as a facade. we’ll create the facade in a new src/Facades folder.
Finally, we register the binding in the service container in our service provider:

```php
    namespace Jmrashed\DomainSubdomain;

    public function register()
    {
        $this->app->bind('calculator', function($app) {
            return new Calculator();
        });
    }
```

The end user can now use the Calculator facade after importing it from the appropriate namespace: use `Jmrashed\DomainSubdomain\Facades\Calculator`;. However, Laravel allows us to register an alias that can register a facade in the root namespace. We can define our alias under an “alias” key below the “providers” in the composer.json file:

```json
    "extra": {
        "laravel": {
            "providers": [
                "Jmrashed\\DomainSubdomain\\DomainSubdomainServiceProvider"
            ],
            "aliases": {
                "Calculator": "Jmrashed\\DomainSubdomain\\Facades\\Calculator"
            }
        }
    }
```

Important: this feature is available starting from Laravel 5.5. With version 5.4 or below, you must register your facades manually in the aliases section of the config/app.php configuration file.

You can also load an alias from a Service Provider (or anywhere else) by using the AliasLoader singleton class:

```php
    use Illuminate\Foundation\AliasLoader;
    $loader = \Illuminate\Foundation\AliasLoader::getInstance();
    $loader->alias('Calculator', 'Jmrashed\\DomainSubdomain\\Facades\\Calculator');
```

Our facade now no longer requires an import and can be used in projects from the root namespace:

```php
    Calculator::add(1, 2);

    // Usage of the example Calculator facade
    Calculator::add(5)->subtract(3)->getResult(); // 2

```

# Artisan Commands

we want to provide an easy artisan command for our end user to publish the config file, via: `php artisan domainsubdomain:install`

# Registering a Command in the Service Provider

We need to present this package functionality to the end-user, thus registering it in the package's service provider.

```php
    namespace Jmrashed\DomainSubdomain;

    use Illuminate\Support\ServiceProvider;
    use Jmrashed\DomainSubdomain\Commands\InstallCommand;

    class DomainSubdomainServiceProvider extends ServiceProvider
    {
        public function register()
        {
            $this->app->bind('calculator', function($app) {
                return new Calculator();
            });
        }

        public function boot()
        {
            if ($this->app->runningInConsole()) {
                $this->commands([
                    InstallCommand::class,
                ]);
            }
        }
    }
```

The config file can now be exported using the command listed below, creating a `domainsubdomain.php` file in the `/config` directory of the Laravel project using this package

# publishing a Config File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="config"`

# Publishing a Migration File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="migrations"`

# Publishing a View File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="views"`

# Publishing a Translation File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="translations"`

# Publishing a Public File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="public"`

# Publishing a Resource File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="resources"`

# Publishing a Route File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="routes"`

# Publishing a Seed File

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="seeds"`

# Publishing a assets

`php artisan vendor:publish --provider="Jmrashed\DomainSubdomain\DomainSubdomainServiceProvider" --tag="assets"`
