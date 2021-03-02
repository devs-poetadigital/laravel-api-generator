<?php

namespace CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiDTOCommandHelper;

class GenerateDeleteApiDtoCommand extends Command
{
    protected $signature = 'crud:api-dto-delete {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Delete';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        GenerateApiDTOCommandHelper::handle($context);
    }
}