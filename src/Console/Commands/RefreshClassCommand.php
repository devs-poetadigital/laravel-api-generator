<?php

namespace CodeGenerator\Console\Commands;

use CodeGenerator\RefreshClassHander;

class RefreshClassCommand extends GenerateApiCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:swagger {model_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh class';

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
        $this->modelName = ucfirst($this->argument('model_name'));
        (new RefreshClassHander($this))->handle();
        parent::handle();
    }
}
