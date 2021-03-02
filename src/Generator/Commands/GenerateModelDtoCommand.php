<?php

namespace CodeGenerator\Generator\Commands;

use Illuminate\Console\Command;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

use CodeGenerator\Generator\Blade;
use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;

class GenerateModelDtoCommand extends Command
{
    protected $signature = 'crud:model-dto {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), null);
        $context->template_name = "ModelDtoTemplate";
        $context->collection_template_name = "ModelCollectionTemplate";
        if(is_null($context->model_name) || $context->model_name == '') return;

        $blade = new Blade(getcwd().'\CodeGenerator\Generator\Commands\Templates', getcwd().'\CodeGenerator\Generator\Cache');

        $content = $blade->make($context->template_name, $context->toArray())->render();
        exportFile($content, getcwd().'\app\Dto\ModelDto\\'.$context->model_name.'Dto.php');

        $content = $blade->make($context->collection_template_name, $context->toArray())->render();
        exportFile($content, getcwd().'\app\Dto\ModelDto\\'.$context->model_name.'Collection.php');
    }
}