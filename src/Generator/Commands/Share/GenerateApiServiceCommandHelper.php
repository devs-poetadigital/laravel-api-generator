<?php

namespace CodeGenerator\Generator\Commands\Share;

use CodeGenerator\Generator\Blade;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;

class GenerateApiServiceCommandHelper
{
    public static function handle(BaseGenerateApiDto $context)
    {
        $path = getcwd().'\app\Services\\'.$context->model_name.'Service';
        createPath($path);

        if(is_null($context->template_path)) {
            $context->template_path = '\CodeGenerator\Generator\Commands\\'.$context->action_name.'Api\\'.$context->action_name.'ApiTemplate';
        }

        if(is_null($context->template_name)) {
            $context->template_name = $context->action_name.'ServiceTemplate';
        }

        $blade = new Blade(getcwd().$context->template_path, getcwd().'\CodeGenerator\Generator\Cache');
        $content = $blade->make($context->template_name, $context->toArray())->render();
        exportFile($content, $path.'\\'.$context->action_name.$context->model_name.'Service.php');
    }
}