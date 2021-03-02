<?php

namespace CodeGenerator\Generator\Commands\Share;

use CodeGenerator\Generator\Blade;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;

class GenerateApiDTOCommandHelper
{
    public static function handle(BaseGenerateApiDto $context)
    {
        $templatePath = '\CodeGenerator\Generator\Commands\\'.$context->action_name.'Api\\'.$context->action_name.'ApiTemplate';
        $blade = new Blade(getcwd().$templatePath, getcwd().'\CodeGenerator\Generator\Cache');
        
        $content = $blade->make($context->action_name."RequestDtoTemplate", $context->toArray())->render();
        exportFile($content, getcwd().'\app\Dto\ApiDto\\'.$context->action_name.$context->model_name.'RequestDto.php');

        $content = $blade->make($context->action_name."ResponseDtoTemplate", $context->toArray())->render();

        exportFile($content, getcwd().'\app\Dto\ApiDto\\'.$context->action_name.$context->model_name.'ResponseDto.php');
    }
}