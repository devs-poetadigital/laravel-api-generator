<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateModel;
use CodeGenerator\GenerateDtoHandler;
use CodeGenerator\GenerateRouteHandler;
use CodeGenerator\GenerateServiceHandler;
use CodeGenerator\GenerateControllerHandler;


class GenerateCreateApiCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:make {model_name?} {action_name?}';

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
        foreach ($models as $model)
        {
            $actionInput = $this->getAction();
            $supportActions = $this->supportActions;
            if(is_null($actionInput))
            {
                $actions = $this->choice(
                    'What is your api method (Create, Update, Get, Search, Delete, Custom)?',
                    $supportActions,
                    0,
                    null,
                    true
                );
            }
            else
            {
                $actions = [$actionInput];
            }
            foreach ($actions as $action)
            {
                if($action == 'Custom')
                {
                    $action = $this->ask('What is your action (sparate by -. eg: manage-user)?');
                }
                $model = $this->generateModel($this->modelName,$action);
                (new GenerateDtoHandler($this,$model))->handle();
                (new GenerateServiceHandler($this, $model))->handle();
                (new GenerateControllerHandler($this, $model))->handle();
                (new GenerateRouteHandler($this, $model))->handle();
            }
        }
        parent::handle();
    }
}
