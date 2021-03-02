<?php

namespace CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\GenerateApiControllerCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;

class GenerateUpdateApiControllerCommand extends Command
{
    protected $signature = 'crud:api-controller-update {model_name}';
    public BaseGenerateApiDto $context;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Update';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, $action_name.'ControllerTemplate');
        GenerateApiControllerCommandHelper::handle($context);
    }
}