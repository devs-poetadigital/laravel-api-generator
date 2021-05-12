<?php

namespace CodeGenerator;

use Illuminate\Support\ServiceProvider;
use CodeGenerator\Console\Commands\GenerateDtoCommand;
use CodeGenerator\Console\Commands\GenerateRouteCommand;
use CodeGenerator\Console\Commands\GenerateCRUDApiCommand;
use CodeGenerator\Console\Commands\GenerateServiceCommand;
use CodeGenerator\Console\Commands\GenerateCreateApiCommand;
use CodeGenerator\Console\Commands\GenerateControllerCommand;


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
        $this->app->bind('command.api:cruds', GenerateCreateApiCommand::class);
        $this->app->bind('command.api:make', GenerateControllerCommand::class);
        $this->app->bind('command.api:controller', GenerateDtoCommand::class);
        $this->app->bind('command.api:dto', GenerateRouteCommand::class);
        $this->app->bind('command.api:service', GenerateServiceCommand::class);
        $this->app->bind('command.api:route', GenerateCRUDApiCommand::class);

        $this->commands([
            'command.api:cruds',
            'command.api:make',
            'command.api:controller',
            'command.api:dto',
            'command.api:service',
            'command.api:route',
        ]);
    }
}