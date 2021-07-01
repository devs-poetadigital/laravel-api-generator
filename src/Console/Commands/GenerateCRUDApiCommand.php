<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateModel;
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
    protected $signature = 'api:crud {model_name?} {action_name?} {--o|only=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eg: api:cruds User --o|only=cru (use only option for limit action to generate code)';

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
        $modelNames = $this->getModels();
        
        $actions = $this->supportActions;
        $action = $this->getAction();
        $listInputAction = $this->getInputActions();

        if(count($listInputAction) <= 0 || is_null($action))
        {
            $actions = array_diff($actions, array("Custom"));
        }
        else
        {
            if(!is_null($action))
            {
                $listInputAction[] = $action;
            }
            $actions = $listInputAction;
        }
        foreach ($modelNames as $modelName)
        {
            $model = $this->generateModel($modelName,$action);
            foreach ($actions as $action)
            {
                $model->action_name = $action;
                $model->action_name_kebab = $model->getActionNameKebab();
                $serviceHandler = new GenerateServiceHandler($this, $model);
                $dtoHandler = new GenerateDtoHandler($this, $model, $serviceHandler);
                $rootHandle = new GenerateRouteHandler($this, $model, $dtoHandler);
                $controllerHandler = new GenerateControllerHandler($this, $model, $rootHandle);
                $controllerHandler->handle();
            }
        }
        parent::handle();
    }

    private function getInputActions(){
        $strActions = strtolower($this->option('only'));
        $listInputAction = [];
        
        if(str_contains($strActions,'c'))
        {
            $listInputAction[] = 'Create';
        }
        if(str_contains($strActions,'u'))
        {
            $listInputAction[] = 'Update';
        }
        if(str_contains($strActions,'r'))
        {
            $listInputAction[] = 'Get';
        }
        if(str_contains($strActions,'d'))
        {
            $listInputAction[] = 'Delete';
        }
        if(str_contains($strActions,'s'))
        {
            $listInputAction[] = 'Search';
        }
        $actionName = $this->getAction();
        if(!empty($actionName))
        {
            $listInputAction[] = $actionName;
        }
        return $listInputAction;
    }
}
