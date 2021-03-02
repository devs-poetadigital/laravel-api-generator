<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;

class GenerateCRUDApiCommand extends Command
{
    protected $signature = 'api:crud {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $cachePath = getcwd().'\CodeGenerator\Generator\Cache';
        deleteAllFiles($cachePath);

        $modelName = $this->argument('model_name');

        Artisan::call('crud:model-dto '.$modelName);

        $crudActionNames = CheckCRUDActionNameHelper::getCRUDActionNames();
        foreach($crudActionNames as $actionName) {
            Artisan::call('crud:api-dto '.$modelName.' '.$actionName);
            Artisan::call('crud:api-service '.$modelName.' '.$actionName);
            Artisan::call('crud:api-controller '.$modelName.' '.$actionName);
            Artisan::call('crud:api-route '.$modelName.' '.$actionName);
        }

        $cachePath = getcwd().'\CodeGenerator\Generator\Cache';
        deleteAllFiles($cachePath);
    }
}