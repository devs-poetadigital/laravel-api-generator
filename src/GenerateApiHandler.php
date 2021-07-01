<?php

namespace CodeGenerator;

use Illuminate\Support\Facades\Schema;
use CodeGenerator\Console\Commands\GenerateApiCommand;

interface IGenerateApiHandler {
    function handle();
}

class GenerateApiHandler implements IGenerateApiHandler
{
    public IGenerateApiHandler $nextFlow;
    protected $pathModelDto = 'app/Dto/ModelDto/';
    protected $pathApiDto = 'app/Dto/ApiDto/';
    protected $pathServices = 'app/Services/';
    protected $pathApiController = 'app/Http/Controllers/Api/';
    protected $pathApiRoute = 'routes/Api/';
    protected $cachPath = __DIR__.'/Cache';
    protected $command;
    protected GenerateModel $model;
    public $supportActions = ['Create', 'Update', 'Get', 'Search', 'Delete', 'Custom'];

    public function handle(){
        if(!is_null($this->nextFlow))
        {
            $this->nextFlow->handle();
        }
    }

    public function __construct(GenerateApiCommand $command, GenerateModel $model, IGenerateApiHandler $next = null){
        $this->model = $model;
        $this->command = $command;
        $this->nextFlow = $next;
        createFileIfNeed($this->cachPath);
    }

    protected function exportFile($content, $filePath) {
        correctPath($filePath);
        filePutContents($filePath, '<?php'.PHP_EOL);
        filePutContents($filePath,  $content, FILE_APPEND);
        $this->command->info("$filePath created successfully!");
    }
}
