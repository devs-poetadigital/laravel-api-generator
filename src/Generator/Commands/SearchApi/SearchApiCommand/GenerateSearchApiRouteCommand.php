<?php

namespace CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiRouteCommandHelper;

class GenerateSearchApiRouteCommand extends Command
{
    protected $signature = 'crud:api-route-search {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Search';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);

        GenerateApiRouteCommandHelper::handle($context);
    }
}