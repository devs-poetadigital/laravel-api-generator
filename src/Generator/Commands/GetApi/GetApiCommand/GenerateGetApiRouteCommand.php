<?php

namespace CodeGenerator\Generator\Commands\GetApi\GetApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiRouteCommandHelper;

class GenerateGetApiRouteCommand extends Command
{
    protected $signature = 'crud:api-route-get {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Get';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);

        GenerateApiRouteCommandHelper::handle($context);
    }
}