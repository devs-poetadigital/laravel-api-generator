<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiServiceCommandHelper;

class GenerateApiServiceCommand extends Command
{
    protected $signature = 'crud:api-service {model_name} {action_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = $this->argument('action_name');
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name);
        
        if(!CheckCRUDActionNameHelper::handle($action_name)) {
            $context->template_path = '\CodeGenerator\Generator\Commands\Templates';
            $context->template_name = 'ServiceTemplate';
        }

        GenerateApiServiceCommandHelper::handle($context);
    }
}