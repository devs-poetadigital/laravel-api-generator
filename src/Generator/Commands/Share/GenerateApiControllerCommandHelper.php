<?php

namespace CodeGenerator\Generator\Commands\Share;

use CodeGenerator\Generator\Blade;
use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;

class GenerateApiControllerCommandHelper
{
    public static function handle(BaseGenerateApiDto $context)
    {
        $viewPath = getcwd().'\CodeGenerator\Generator\Commands\\'.$context->action_name.'Api\\'.$context->action_name.'ApiTemplate';
        $blade = new Blade($viewPath, getcwd().'\CodeGenerator\Generator\Cache');

        if(is_null($context->template_name)) {
            $context->template_name = $context->action_name.'ControllerTemplate';
        }

        $content = $blade->make($context->template_name, $context->toArray())->render();

        $path = getcwd().'\app\Http\Controllers\Api\\'.$context->model_name;
        createPath($path);
        exportFile($content, $path.'\\'.$context->action_name.$context->model_name.'Controller.php');
    }
}