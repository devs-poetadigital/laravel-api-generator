<?php

namespace CodeGenerator;

use Illuminate\Support\ServiceProvider;
use CodeGenerator\Console\Commands\GenerateDtoCommand;
use CodeGenerator\Console\Commands\GenerateRouteCommand;
use CodeGenerator\Console\Commands\GenerateCRUDApiCommand;
use CodeGenerator\Console\Commands\RemoveCRUDApiCommand;
use CodeGenerator\Console\Commands\GenerateServiceCommand;
use CodeGenerator\Console\Commands\GenerateControllerCommand;
use CodeGenerator\Console\Commands\RefreshClassCommand;

class CodeGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    protected function registerCommands(): void
    {
        $this->app->bind('command.api:crud', GenerateCRUDApiCommand::class);
        $this->app->bind('command.api:remove', RemoveCRUDApiCommand::class);
        $this->app->bind('command.api:make', GenerateControllerCommand::class);
        $this->app->bind('command.api:dto', GenerateDtoCommand::class);
        $this->app->bind('command.api:service', GenerateServiceCommand::class);
        $this->app->bind('command.api:route', GenerateRouteCommand::class);
        $this->app->bind('command.api:swagger', RefreshClassCommand::class);

        $this->commands([
            'command.api:crud',
            'command.api:remove',
            'command.api:make',
            'command.api:dto',
            'command.api:service',
            'command.api:route',
            'command.api:swagger'
        ]);
    }
}