<?php

namespace CodeGenerator;

use Exception;
use ReflectionClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
        $this->modelName = $command->modelName;
        $this->actionName = $command->getAction();
        if(!is_null($action))
        {
            $this->actionName = $action;
        }
        createFileIfNeed($this->cachPath);
    }

    protected function getFillables(){
        $className = 'App\Models\\'.$this->modelName;
        $class = resolve($className);
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

    protected function exportFile($content, $filePath) {
        correctPath($filePath);
        filePutContents($filePath, '<?php'.PHP_EOL);
        filePutContents($filePath,  $content, FILE_APPEND);
        $this->command->info("$filePath created successfully!");
    }
}
