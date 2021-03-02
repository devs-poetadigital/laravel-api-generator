<?php

namespace CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\GenerateApiControllerCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;

class GenerateCreateApiControllerCommand extends Command
{
    protected $signature = 'crud:api-controller-create {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Create';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, $action_name.'ControllerTemplate');
        GenerateApiControllerCommandHelper::handle($context);
    }
}