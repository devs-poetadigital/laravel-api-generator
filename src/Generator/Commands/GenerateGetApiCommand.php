<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;

class GenerateGetApiCommand extends Command
{
    protected $signature = 'api:get {model_name} {action_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $cachePath = getcwd().'\CodeGenerator\Generator\Cache';
        deleteAllFiles($cachePath);
        
        $modelName = $this->argument('model_name');
        $actionName = $this->argument('action_name');

        $isCRUDActionNames = CheckCRUDActionNameHelper::handle($actionName);
        if($isCRUDActionNames) {
            return;
        }
        
        Artisan::call('crud:api-dto '.$modelName.' '.$actionName);
        Artisan::call('crud:api-service '.$modelName.' '.$actionName);
        Artisan::call('crud:api-controller '.$modelName.' '.$actionName);
        Artisan::call('crud:api-route '.$modelName.' '.$actionName);

        $cachePath = getcwd().'\CodeGenerator\Generator\Cache';
        deleteAllFiles($cachePath);
    }
}