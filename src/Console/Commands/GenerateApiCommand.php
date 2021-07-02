<?php

namespace CodeGenerator\Console\Commands;

use Illuminate\Console\Command;
use CodeGenerator\GenerateModel;
use CodeGenerator\PropertyModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class GenerateApiCommand extends Command
{
    public $modelName;
    public $supportActions = ['Create', 'Update', 'Get', 'Search', 'Delete', 'Custom'];

    public function handle(){
        clearCache();
        Artisan::call('l5-swagger:generate ');
    }

    public function getModels()
    {
        $this->modelName = ucfirst($this->argument('model_name'));
        $dir = "app/Models/"; 
        correctPath($dir);
        $filePaths = glob($dir.'*.php');
        foreach($filePaths as $filePath)
        {
            $files[] = basename($filePath, ".php");
        }
        if(!empty($this->modelName))
        {
            if (!in_array($this->modelName, $files)) {
                $models = implode('|',$files);
                $this->modelName = $this->anticipate("Wrong model name! What is your model? ($models)", $files);
            }
            $files = [$this->modelName];
        }
        return $files;
    }

    public function getAction(){
        if ($this->hasArgument('action_name')){
            $action = $this->argument('action_name');
            if (!is_null($action))
            {
                $actions = explode('-',$action);
                if (count($actions) > 0)
                {
                    foreach ($actions as &$childAction)
                    {
                        $childAction = ucfirst($childAction);
                    }
                }
                $action = implode('',$actions);
            }
            return $action;
        }
        return null;
    }

    protected function getFillables($class){
        $table = $class->getTable();
        $fillables = $class->getFillable();
        $models = [];
        foreach($fillables as $field){
            $columnType = Schema::getColumnType($table,$field);
            $model = new PropertyModel();
            switch ($columnType){
                case 'bigint':
                case 'integer':
                case 'boolean':
                case 'datetime':
                    $model->type = 'int';
                    break;
                case 'decimal':
                    $model->type = 'float';
                    break;
                default:
                    $model->type = 'string';
                    break;
            }
            $model->name = $field;
            $models[] = $model;
        }
        return $models;
    }

    function generateModel($modelName, $action){
        $className = 'App\Models\\'.$modelName;
        $class = resolve($className);
        $model = new GenerateModel();
        $model->model_name = $modelName;
        $model->table_name = $class->getTable();
        $model->action_name = $action;
        $model->action_name_kebab = $model->getActionNameKebab();
        $model->model_name_kebab = $model->getModelNameKebab();
        $model->fillable = $this->getFillables($class);
        return $model;
    }
}
