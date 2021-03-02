<?php

namespace CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand;

use Illuminate\Console\Command;

use CodeGenerator\Generator\Commands\Share\GenerateApiContextCommandHelper;
use CodeGenerator\Generator\Commands\Share\GenerateApiDTOCommandHelper;

class GenerateSearchApiDtoCommand extends Command
{
    protected $signature = 'crud:api-dto-search {model_name}';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $action_name = 'Search';
        $context = GenerateApiContextCommandHelper::handle($this->argument('model_name'), $action_name, null);
        GenerateApiDTOCommandHelper::handle($context);
    }
}