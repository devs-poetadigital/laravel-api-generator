<?php

namespace CodeGenerator;

use ReflectionClass;
use CodeGenerator\Console\Commands\GenerateApiCommand;

class GenerateApiHandler 
{
    protected $pathModelDto = 'app/Dto/ModelDto/';
    protected $pathApiDto = 'app/Dto/ApiDto/';
    protected $pathServices = 'app/Services/';
    protected $pathApiController = 'app/Http/Controllers/Api/';
    protected $pathApiRoute = 'routes/Api/';
    protected $cachPath = __DIR__.'/Cache';
    protected $modelName;
    protected $actionName;
    protected $command;
    public $supportActions = ['Create', 'Update', 'Get', 'Search', 'Delete', 'Custom'];

    public function __construct(GenerateApiCommand $command, $action = null){
        $this->command = $command;
        $this-> modelName = $command->modelName;
        $this->actionName = $command->getAction();
        if(!is_null($action))
        {
            $this->actionName = $action;
        }
        createFileIfNeed($this->cachPath);
    }

    protected function getFillables(){
        $className = 'App\Models\\'.$this->modelName;
        $fillables = resolve($className)->getFillable();
        $class = new ReflectionClass($className);
        $properties = $class->getProperties();
        $models = [];
        foreach($fillables as $field){
            $filterProperties = array_filter($properties, function($property) use ($field){
                $propertyName = $property->getName();
                return $field == $propertyName;
            });
            $type = 'string';
            if(count($filterProperties) > 0)
            {
                $type = $filterProperties[0]->getType()->getName();
            }
            $model = new PropertyModel();
            $model->name = $field;
            $model->type = $type;
            $models[] = $model;
        }
        return $models;
    }

    protected function exportFile($content, $filePath) {
        correctPath($filePath);
        filePutContents($filePath, '<?php'.PHP_EOL);
        filePutContents($filePath,  $content, FILE_APPEND);
        $this->command->info("$filePath created successfully!");
    }
}
