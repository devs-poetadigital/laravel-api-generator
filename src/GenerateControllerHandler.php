<?php

namespace CodeGenerator;

class GenerateControllerHandler extends GenerateApiHandler
{
    private $templatePath = __DIR__.'/../resources/Templates/Controllers';

    public function handle()
    {
        $this->generateControllerCode($this->model);
        parent::handle();
    }

    public function remove(){
        $controllerName = $this->model->action_name.$this->model->model_name.'Controller';
        $filePath = $this->getPath().$controllerName.'.php';
        if(fileExists($filePath)){
            unlink($filePath);
        }
    }

    protected function generateControllerCode(GenerateModel $model){
        $override = true;
        $controllerName = $model->action_name.$model->model_name.'Controller';
        if(fileExists($this->getPath().$controllerName.'.php')){
            $override = $this->command->confirm("$controllerName has existed! Do you wish to override?");
        }
        if($override)
        {
            createFileIfNeed($this->getPath());
            $blade = new Blade($this->templatePath, $this->cachPath);
            $templateView = "ControllerTemplate";
            $content = $blade->make($templateView, $model->toArray())->render();
            $this->exportFile($content,$this->getPath().$controllerName.'.php');
            $this->model->shouldOverride = true;
        }
        $apiController = "ApiController";
        if(!fileExists($this->pathApiController.$apiController.'.php'))
        {
            $content = $blade->make($apiController, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiController.$apiController.'.php');
        }
    }

    private function getPath(){
        return $this->pathApiController.$this->model->model_name.'/';
    }
}
