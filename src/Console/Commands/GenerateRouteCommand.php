<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\GenerateRouteHandler;

class GenerateRouteCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:route {model_name} {action_name}';

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
        (new GenerateRouteHandler($this))->handle();
        parent::handle();
    }
}
