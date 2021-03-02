<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Blade;
use CodeGenerator\Generator\Commands\Share\BaseGenerateApiDto;
use CodeGenerator\Generator\Commands\Share\CheckCRUDActionNameHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiDTOCommandHelper;

class GenerateApiDtoCommand extends Command
{
    protected $signature = 'crud:api-dto {model_name} {action_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = $this->argument('action_name');
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name);
        if(CheckCRUDActionNameHelper::handle($action_name)) {
            GenerateApiDTOCommandHelper::handle($context);
            return;
        }

        $this->generate($context);
    }

    public function generate(BaseGenerateApiDto $context)
    {
        $templatePath = '\CodeGenerator\Generator\Commands\Templates';
        $blade = new Blade(getcwd().$templatePath, getcwd().'\CodeGenerator\Generator\Cache');
        
        $content = $blade->make("ApiRequestDtoTemplate", $context->toArray())->render();
        exportFile($content, getcwd().'\app\Dto\ApiDto\\'.$context->action_name.$context->model_name.'RequestDto.php');

        $content = $blade->make("ApiResponseDtoTemplate", $context->toArray())->render();
        exportFile($content, getcwd().'\app\Dto\ApiDto\\'.$context->action_name.$context->model_name.'ResponseDto.php');
    }
}