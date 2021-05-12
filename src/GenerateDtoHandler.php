<?php

namespace CodeGenerator;

class GenerateDtoHandler extends GenerateApiHandler
{
    private $templatePath = __DIR__.'/../resources/Templates/ModelDtos';
    
    public function handle()
    {
        $model = new GenerateModel();
        $model->model_name = $this->modelName;
        $model->action_name = $this->actionName;
        $model->fillable = $this->getFillables();
        $this->generateModelCode($model);
        if(!is_null($this->actionName))
        {
            $this->generateApiCode($model);
        }
    }

    protected function generateModelCode(GenerateModel $model){
        $dtoName = $this->modelName.'Dto';
        createFileIfNeed($this->pathModelDto);
        $blade = new Blade($this->templatePath, $this->cachPath);
        $content = $blade->make("ModelDtoTemplate", $model->toArray())->render();
        $this->exportFile($content,$this->pathModelDto.$dtoName.'.php');
    }

    protected function generateApiCode(GenerateModel $model){
        createFileIfNeed($this->pathApiDto);
        $blade = new Blade($this->templatePath, $this->cachPath);
        $requestTemplate = "ApiRequestDtoTemplate";
        $responseTemplate = "ApiResponseDtoTemplate";
        $action = $model->action_name;
        foreach ($this->command->supportActions as $actionName)
        {
            if(str_contains($model->action_name, $actionName))
            {
                $action = $actionName;
                break;
            }
        }
        if($action == 'Search')
        {
            $requestTemplate = "SearchRequestDtoTemplate";
            $responseTemplate = "SearchResponseDtoTemplate";

            $searchResultTemplate = "SearchResultDtoTemplate";
            $content = $blade->make($searchResultTemplate, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiDto.'SearchResultDto.php');

            $searchCriteriaTemplate = "SearchCriteriaDtoTemplate";
            $content = $blade->make($searchCriteriaTemplate, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiDto.'SearchCriteriaDto.php');
        }
        $override = true;
        
        $requestDtoName = $model->action_name.$model->model_name.'Request'.'Dto';
        if(fileExists($this->pathApiDto.$requestDtoName.'.php')){
            $override = $this->command->confirm("$requestDtoName has existed! Do you wish to override?");
        }
        if($override)
        {
            $content = $blade->make($requestTemplate, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiDto.$requestDtoName.'.php');
        }

        $responseDtoName = $model->action_name.$model->model_name.'Response'.'Dto';
        if(fileExists($this->pathApiDto.$responseDtoName.'.php')){
            $override = $this->command->confirm("$responseDtoName has existed! Do you wish to override?");
        }
        if($override)
        {
            $content = $blade->make($responseTemplate, $model->toArray())->render();
            $this->exportFile($content,$this->pathApiDto.$responseDtoName.'.php');
        }
        if($action == 'Search')
        {
            $override = true;
            $responseItemName = $model->action_name.$model->model_name.'Response'.'Item';
            if(fileExists($this->pathApiDto.$responseItemName.'.php')){
                $override = $this->command->confirm("$responseItemName has existed! Do you wish to override?");
            }
            if($override)
            {
                $content = $blade->make("SearchResponseItemTemplate", $model->toArray())->render();
                $this->exportFile($content,$this->pathApiDto.$responseItemName.'.php');
            }
            $override = true;
            $responseCollectionName = $model->action_name.$model->model_name.'Response'.'Collection';
            if(fileExists($this->pathApiDto.$responseCollectionName.'.php')){
                $override = $this->command->confirm("$responseCollectionName has existed! Do you wish to override?");
            }
            if($override)
            {
                $content = $blade->make("SearchResponseCollectionTemplate", $model->toArray())->render();
                $this->exportFile($content,$this->pathApiDto.$responseCollectionName.'.php');
            }
        }
    }
}
