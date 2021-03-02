<?php

namespace CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiServiceCommandHelper;

class GenerateUpdateApiServiceCommand extends Command
{
    protected $signature = 'crud:api-service-update {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Update';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        $context->fillable = resolve('App\Models\\'.$context->model_name)->getFillable();

        GenerateApiServiceCommandHelper::handle($context);
    }
}