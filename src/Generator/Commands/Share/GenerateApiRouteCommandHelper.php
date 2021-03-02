<?php

namespace CodeGenerator\Generator\Commands\Share;

use Illuminate\Support\Str;

use CodeGenerator\Generator\Blade;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;

class GenerateApiRouteCommandHelper
{
    public static function handle(BaseGenerateApiDto $context)
    {
        $model_name = $context->model_name;
        $action_name = $context->action_name;

        if(is_null($context->template_path)) {
            $context->template_path = '\CodeGenerator\Generator\Commands\\'.$action_name.'Api'.'\\'.$action_name.'ApiTemplate';
        }

        if(is_null($context->template_name)) {
            $context->template_name = $context->action_name.'RouteTemplate';
        }

        $blade = new Blade(getcwd().$context->template_path, getcwd().'\CodeGenerator\Generator\Cache');
        $apiRoutePath = getcwd().'\routes\api.php';
        $includeStr = '@include("Api/'.$context->model_name.'.php");';
        if(strpos(file_get_contents($apiRoutePath), $includeStr) == false) {
            file_put_contents($apiRoutePath, str_replace('use Illuminate\Support\Facades\Route;', 'use Illuminate\Support\Facades\Route;'.PHP_EOL.$includeStr, file_get_contents($apiRoutePath)));
        }

        $path = getcwd().'\routes\Api\\'.$model_name.'.php';
        if (!file_exists($path) || strpos(file_get_contents($path), '//use') == false) {
            $content = $blade->make($context->template_name, $context->toArray())->render();
            exportFile($content, $path);
        }

        $apiPath = $context->getModelNameKebab().'/'.$context->getActionNameKebab();
        $useStr = 'use App\Http\Controllers\Api\\'.$model_name.'\\'.$action_name.$model_name.'Controller;';
        $routeStr = "Route::match(array('GET', 'POST'), '$apiPath', ['uses' => ".$action_name.$model_name."Controller::class])->middleware(['jwt.verify']);";

        if(strpos(file_get_contents($path), $useStr) == false) {
            file_put_contents($path, str_replace('//use', '//use'.PHP_EOL.$useStr, file_get_contents($path)));
        }

        if( strpos(file_get_contents($path), $routeStr) == false) {
            file_put_contents($path, str_replace('//route', '//route'.PHP_EOL.$routeStr, file_get_contents($path)));
        }
    }
}