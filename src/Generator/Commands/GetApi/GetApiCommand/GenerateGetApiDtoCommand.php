<?php

namespace CodeGenerator\Generator\Commands\GetApi\GetApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiDTOCommandHelper;

class GenerateGetApiDtoCommand extends Command
{
    protected $signature = 'crud:api-dto-get {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Get';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        GenerateApiDTOCommandHelper::handle($context);
    }
}