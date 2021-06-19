<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateModel;
use CodeGenerator\GenerateDtoHandler;
use CodeGenerator\GenerateRouteHandler;
use CodeGenerator\GenerateServiceHandler;
use CodeGenerator\GenerateControllerHandler;


class RemoveCRUDApiCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:remove {model_name} {action_name?} {--o|only=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eg: api:remove User --o|only=cru (use only option for limit action to generate code)';

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
        $action = $this->getAction();
        $listInputAction = $this->getInputActions();
        if(!is_null($action))
        {
            $listInputAction[] = $action;
        }
        $actions = $listInputAction;
        
        foreach ($modelNames as $modelName)
        {
            $model = $this->generateModel($modelName,$action);
            foreach ($actions as $action)
            {
                $model->action_name = $action;
                $model->action_name_kebab = $model->getActionNameKebab();
                (new GenerateRouteHandler($this, $model))->remove();
                (new GenerateControllerHandler($this, $model))->remove();
                (new GenerateServiceHandler($this, $model))->remove();
                (new GenerateDtoHandler($this, $model))->remove();
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
