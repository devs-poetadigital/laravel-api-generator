# code_generator_php/code_generator

<!--
TODO: Make sure the following URLs are correct and working for your project.
      Then, remove these comments to display the badges, giving users a quick
      overview of your package.

-->

code generator

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

``` bash
"require": {
        "nmkhanhit/codegenerator": "dev-master"
    },
"repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/nmkhanhit/codegenerator"
        }
    ],
composer install
```

## Create CRUD

After cloning this repository locally, execute the following commands to create a CRUD for model:

``` bash
php artisan api:cruds {{ model_name }}
```
eg: php artisan api:cruds Post

Now, you are ready to develop!

## Create an api by model name and action name

After cloning this repository locally, execute the following commands to create an api for model:

``` bash
php artisan api:make {{ model_name }} {{ action_name }}
```
eg: php artisan api:make Post create

Now, you are ready to develop!

## Create a service api by model name and action name

After cloning this repository locally, execute the following commands to create a servive api for model:

``` bash
php artisan api:service {{ model_name }} {{ action_name }} {{ --query }}
```
eg: php artisan api:make Post create

Now, you are ready to develop!

## Copyright and License

The code_generator_php/code_generator library is free and unencumbered software released into the
public domain. Please see [UNLICENSE](UNLICENSE) for more information.

