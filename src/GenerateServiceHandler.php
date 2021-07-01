<?php

namespace CodeGenerator;

class GenerateServiceHandler extends GenerateApiHandler
{
    private $templatePath = __DIR__.'/../resources/Templates/Services';

    public function handle()
    {
        $this->generateServiceCode($this->model);
        parent::handle();
    }

    public function remove(){
        $serviceName = $this->model->action_name.$this->model->model_name.'Service';
        $filePath = $this->getPath().$serviceName.'.php';
        if(fileExists($filePath)){
            unlink($filePath);
        }
    }

    protected function generateServiceCode(GenerateModel $model){
        $serviceName = $model->action_name.$model->model_name.'Service';
        $override = true;
        if (fileExists($this->getPath().$serviceName.'.php') && !$model->shouldOverride) {
            $override = $this->command->confirm("$serviceName has existed! Do you wish to override?", true);
        }

        $blade = new Blade($this->templatePath, $this->cachPath);
        if($override)
        {
            $action = $model->action_name;
            foreach ($this->command->supportActions as $actionName)
            {
                if(str_contains($model->action_name, $actionName))
                {
                    $action = $actionName;
                    break;
                }
            }
            createFileIfNeed($this->getPath());
            $templateView = $action."ServiceTemplate";
            if ($blade->exists($templateView))
            {
                if ($this->command->hasOption('query') && $this->command->option('query'))
                {
                    $templateView = $templateView.'Query';
                }
                $content = $blade->make($templateView, $model->toArray())->render();
            }
            else
            {
                $content = $blade->make("GetServiceTemplate", $model->toArray())->render();
            }
            $this->exportFile($content,$this->getPath().$serviceName.'.php');
        }
        
        if(str_contains($model->action_name, 'Search'))
        {
            $sharePath = $this->pathServices.'Share/';
            createFileIfNeed($sharePath);
            if(!fileExists($sharePath.'SearchService.php'))
            {
                $searchService = "SearchService";
                $content = $blade->make($searchService, $model->toArray())->render();
                $this->exportFile($content,$sharePath.'SearchService.php');
            }
        }
    }

    private function getPath(){
        return $this->pathServices.$this->model->model_name.'Service/';
    }
}
