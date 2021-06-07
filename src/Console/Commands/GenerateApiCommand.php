<?php

namespace CodeGenerator\Console\Commands;

use Illuminate\Console\Command;
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
                $modelName = $this->anticipate("Wrong model name! What is your model? ($models)", $files);
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
    }
}
