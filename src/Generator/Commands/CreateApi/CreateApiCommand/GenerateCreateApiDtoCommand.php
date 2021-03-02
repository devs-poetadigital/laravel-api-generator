<?php

namespace CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiDTOCommandHelper;

class GenerateCreateApiDtoCommand extends Command
{
    protected $signature = 'crud:api-dto-create {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Create';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        GenerateApiDTOCommandHelper::handle($context);
    }
}