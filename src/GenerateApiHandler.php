<?php

namespace CodeGenerator;

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
    protected $command;
    protected GenerateModel $model;
    public $supportActions = ['Create', 'Update', 'Get', 'Search', 'Delete', 'Custom'];

    public function __construct(GenerateApiCommand $command, GenerateModel $model ){
        $this->model = $model;
        $this->command = $command;
        createFileIfNeed($this->cachPath);
    }

    protected function exportFile($content, $filePath) {
        correctPath($filePath);
        filePutContents($filePath, '<?php'.PHP_EOL);
        filePutContents($filePath,  $content, FILE_APPEND);
        $this->command->info("$filePath created successfully!");
    }
}
