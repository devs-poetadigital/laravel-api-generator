<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateDtoHandler;
use CodeGenerator\GenerateRouteHandler;
use CodeGenerator\GenerateServiceHandler;
use CodeGenerator\GenerateControllerHandler;


class GenerateCRUDApiCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:cruds {model_name?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $models = $this->getModels();
        $actions = array_diff($this->supportActions, array("Custom"));
        foreach ($models as $model)
        {
            foreach ($actions as $action)
            {
                (new GenerateDtoHandler($this, $action))->handle();
                (new GenerateServiceHandler($this, $action))->handle();
                (new GenerateControllerHandler($this, $action))->handle();
                (new GenerateRouteHandler($this, $action))->handle();
            }
        }
        parent::handle();
    }
}
