<?php

namespace CodeGenerator;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class GenerateModel extends FlexibleDataTransferObject
{
    public $model_name;
    public $action_name;
    public $table_name;
    public $action_name_kebab;
    public $fillable = [];

    public function getModelNameKebab(): string {
        return Str::kebab($this->model_name);
    }

    public function getActionNameKebab() {
        return Str::kebab($this->action_name);
    }
}