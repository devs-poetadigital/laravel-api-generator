<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateModel;
use CodeGenerator\GenerateServiceHandler;

class GenerateServiceCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:service {model_name} {action_name} {--query}';

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
        $this->getModels();
        $model = $this->generateModel($this->modelName, $this->getAction());
        (new GenerateServiceHandler($this,$model))->handle();
        parent::handle();
    }
}
