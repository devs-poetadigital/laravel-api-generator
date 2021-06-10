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
        $models = $this->getModels();
        
        $actions = $this->supportActions;
        $action = $this->getAction();
        if(!is_null($action))
        {
            $actions = [$action];
        }
        else
        {
            $listInputAction = $this->getInputActions();
            if(count($listInputAction) > 0)
            {
                $actions = $listInputAction;
            }
            $actions = array_diff($actions, array("Custom"));
        }
        foreach ($models as $model)
        {
            $this->modelName = $model;
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
