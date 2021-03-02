<?php

namespace CodeGenerator\Generator\Commands\Share;

use CodeGenerator\Generator\Blade;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;

class GenerateApiContextCommandHelper
{
    public static function handle($model_name, $action_name, $template_path = null, $template_name = null): BaseGenerateApiDto
    {
        $context = new BaseGenerateApiDto();

        $context->model_name = $model_name;
        $context->action_name = $action_name;
        $context->model_name_kebab = $context->getModelNameKebab();
        $context->action_name_kebab = $context->getActionNameKebab();
        $context->template_name = $template_path;
        $context->template_name = $template_name;
        $context->fillable = CheckCRUDActionNameHelper::getFillables($context->model_name);

        return $context;
    }
}