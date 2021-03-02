<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Blade;
use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiControllerCommandHelper;

class GenerateApiControllerCommand extends Command
{
    protected $signature = 'crud:api-controller {model_name} {action_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = $this->argument('action_name');
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name);
        if(CheckCRUDActionNameHelper::handle($action_name)) {
            GenerateApiControllerCommandHelper::handle($context);
            return;
        }

        $this->generate($context);
    }

    public function generate(BaseGenerateApiDto $context)
    {
        $viewPath = getcwd().'\CodeGenerator\Generator\Commands\Templates';
        $blade = new Blade($viewPath, getcwd().'\CodeGenerator\Generator\Cache');
        $content = $blade->make('ControllerTemplate', $context->toArray())->render();

        $path = getcwd().'\app\Http\Controllers\Api\\'.$context->model_name;
        createPath($path);
        exportFile($content, $path.'\\'.$context->action_name.$context->model_name.'Controller.php');
    }
}