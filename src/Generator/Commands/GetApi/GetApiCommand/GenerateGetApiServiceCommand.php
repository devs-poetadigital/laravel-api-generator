<?php

namespace CodeGenerator\Generator\Commands\GetApi\GetApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiServiceCommandHelper;

class GenerateGetApiServiceCommand extends Command
{
    protected $signature = 'crud:api-service-get {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Get';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        $context->fillable = resolve('App\Models\\'.$context->model_name)->getFillable();

        GenerateApiServiceCommandHelper::handle($context);
    }
}