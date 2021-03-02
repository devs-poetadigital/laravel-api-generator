<?php

namespace CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\GenerateApiRouteCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;

class GenerateDeleteApiRouteCommand extends Command
{
    protected $signature = 'crud:api-route-delete {model_name}';

    public BaseGenerateApiDto $context;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Delete';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);

        GenerateApiRouteCommandHelper::handle($context);
    }
}