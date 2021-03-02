<?php

namespace CodeGenerator\Generator\Commands\Share;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class BaseGenerateApiDto extends FlexibleDataTransferObject
{
    public $template_path;
    public $template_name;
    public $model_name;
    public $action_name;
    public $model_name_kebab;
    public $action_name_kebab;
    public $fillable;

    public function getModelNameKebab(): string {
        return Str::kebab($this->model_name);
    }

    public function getActionNameKebab() {
        return Str::kebab($this->action_name);
    }
}