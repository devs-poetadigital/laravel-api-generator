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
        "devs-poetadigital/laravel-api-generator": "0.1.6"
    }
composer install 
or 
composer require devs-poetadigital/laravel-api-generator
```

## Generate code CRUD api with api:crud

After cloning this repository locally, execute the following commands to create a CRUD for model:

``` bash
php artisan api:crud {{ model_name }} {{ action_name }} --only={{ your_action }}
```
*model_name* : the model which you want to generate code

*action_name(optional)*: your custom action you want to generate eg: CreateWithAdminRole

*your_action*: it are belong in c(Create), r(Read), u(Update), d(Delete), s(Search)


eg: php artisan api:cruds Post GetAll --only=cu


Now, you are ready to develop!

## Remove code with api:remove

After cloning this repository locally, execute the following commands to create a CRUD for model:

``` bash
php artisan api:remove {{ model_name }} {{ action_name }} --only={{ your_action }}
```
*model_name* : the model which you want to generate code

*action_name*: your custom action you want to generate eg: CreateWithAdminRole

*your_action*: it are belong in c(Create), r(Read), u(Update), d(Delete), s(Search)


eg: php artisan api:remove Post GetAll --only=cu


Now, you are ready to develop!

## Refresh Swagger for Model Dto 

``` bash
php artisan api:swagger {{ class_name_dto }} 
```
*class_name_dto* : the class you want to refresh


eg: php artisan api:swagger CreatePostResponseDto

## Regenerate Model Dto 

``` bash
php artisan api:dto {{ model_name }} {{ action_name }}
```
*model_name* : the model which you want to generate code

*action_name(optional)*: your custom action you want to generate eg: CreateWithAdminRole


eg: php artisan api:dto User Create

## Create a service api by model name and action name

After cloning this repository locally, execute the following commands to create a servive api for model:

``` bash
php artisan api:service {{ model_name }} {{ action_name }} {{ --query }}
```
*model_name* : the model which you want to generate code

*action_name(optional)*: your custom action you want to generate eg: CreateWithAdminRole

*--query*: it support generate code with sql command

eg: php artisan api:make Post search --query

## Copyright and License

The devs-poetadigital/laravel-api-generator library is free and unencumbered software released into the
public domain. Please see [MIT](MIT) for more information.

## About us
https://poetadigital.com/

