<?php

namespace CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiRouteCommandHelper;

class GenerateUpdateApiRouteCommand extends Command
{
    protected $signature = 'crud:api-route-update {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Update';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);

        GenerateApiRouteCommandHelper::handle($context);
    }
}