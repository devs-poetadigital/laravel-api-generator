<?php

namespace CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiRouteCommandHelper;

class GenerateCreateApiRouteCommand extends Command
{
    protected $signature = 'crud:api-route-create {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Create';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);

        GenerateApiRouteCommandHelper::handle($context);
    }
}