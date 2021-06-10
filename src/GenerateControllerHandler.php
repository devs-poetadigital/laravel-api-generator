<?php

namespace CodeGenerator;

class GenerateControllerHandler extends GenerateApiHandler
{
    private $templatePath = __DIR__.'/../resources/Templates/Controllers';

    public function handle()
    {
        $model = new GenerateModel();
        $model->model_name = $this->modelName;
        $model->action_name = $this->actionName;
        $model->action_name_kebab = $model->getActionNameKebab();
        $model->fillable = $this->getFillables();
        $this->generateControllerCode($model);
    }

    protected function generateControllerCode(GenerateModel $model){
        $override = true;
        $controllerName = $model->action_name.$this->modelName.'Controller';
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
        }
        $apiController = "ApiController";
        if(!fileExists($this->pathApiController.$apiController.'.php'))
        {
            $content = $blade->make($apiController, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiController.$apiController.'.php');
        }
    }

    private function getPath(){
        return $this->pathApiController.$this->modelName.'/';
    }
}
