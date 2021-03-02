<?php

namespace CodeGenerator;

use Illuminate\Support\ServiceProvider;
use CodeGenerator\Generator\Commands\GenerateApiDtoCommand;
use CodeGenerator\Generator\Commands\GenerateGetApiCommand;
use CodeGenerator\Generator\Commands\GenerateCRUDApiCommand;
use CodeGenerator\Generator\Commands\GenerateApiRouteCommand;
use CodeGenerator\Generator\Commands\GenerateModelDtoCommand;
use CodeGenerator\Generator\Commands\GenerateApiServiceCommand;
use CodeGenerator\Generator\Commands\GenerateApiControllerCommand;
use CodeGenerator\Generator\Commands\GetApi\GetApiCommand\GenerateGetApiDtoCommand;
use CodeGenerator\Generator\Commands\GetApi\GetApiCommand\GenerateGetApiRouteCommand;
use CodeGenerator\Generator\Commands\GetApi\GetApiCommand\GenerateGetApiServiceCommand;
use CodeGenerator\Generator\Commands\GetApi\GetApiCommand\GenerateGetApiControllerCommand;
use CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand\GenerateCreateApiDtoCommand;
use CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand\GenerateDeleteApiDtoCommand;
use CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand\GenerateSearchApiDtoCommand;
use CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand\GenerateUpdateApiDtoCommand;
use CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand\GenerateCreateApiRouteCommand;
use CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand\GenerateDeleteApiRouteCommand;
use CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand\GenerateSearchApiRouteCommand;
use CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand\GenerateUpdateApiRouteCommand;
use CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand\GenerateCreateApiServiceCommand;
use CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand\GenerateDeleteApiServiceCommand;
use CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand\GenerateSearchApiServiceCommand;
use CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand\GenerateUpdateApiServiceCommand;
use CodeGenerator\Generator\Commands\CreateApi\CreateApiCommand\GenerateCreateApiControllerCommand;
use CodeGenerator\Generator\Commands\DeleteApi\DeleteApiCommand\GenerateDeleteApiControllerCommand;
use CodeGenerator\Generator\Commands\SearchApi\SearchApiCommand\GenerateSearchApiControllerCommand;
use CodeGenerator\Generator\Commands\UpdateApi\UpdateApiCommand\GenerateUpdateApiControllerCommand;



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
        $this->app->bind('command.crud:model-dto', GenerateModelDtoCommand::class);
        $this->app->bind('command.api:crud', GenerateCRUDApiCommand::class);
        $this->app->bind('command.api:get', GenerateGetApiCommand::class);

        $this->app->bind('command.crud:api-dto-create', GenerateCreateApiDtoCommand::class);
        $this->app->bind('command.crud:api-service-create', GenerateCreateApiServiceCommand::class);
        $this->app->bind('command.crud:api-controller-create', GenerateCreateApiControllerCommand::class);
        $this->app->bind('command.crud:api-route-create', GenerateCreateApiRouteCommand::class);

        $this->app->bind('command.crud:api-dto-update', GenerateUpdateApiDtoCommand::class);
        $this->app->bind('command.crud:api-service-update', GenerateUpdateApiServiceCommand::class);
        $this->app->bind('command.crud:api-controller-update', GenerateUpdateApiControllerCommand::class);
        $this->app->bind('command.crud:api-route-update', GenerateUpdateApiRouteCommand::class);

        $this->app->bind('command.crud:api-dto-delete', GenerateDeleteApiDtoCommand::class);
        $this->app->bind('command.crud:api-service-delete', GenerateDeleteApiServiceCommand::class);
        $this->app->bind('command.crud:api-controller-delete', GenerateDeleteApiControllerCommand::class);
        $this->app->bind('command.crud:api-route-delete', GenerateDeleteApiRouteCommand::class);

        $this->app->bind('command.crud:api-dto-search', GenerateSearchApiDtoCommand::class);
        $this->app->bind('command.crud:api-service-search', GenerateSearchApiServiceCommand::class);
        $this->app->bind('command.crud:api-controller-search', GenerateSearchApiControllerCommand::class);
        $this->app->bind('command.crud:api-route-search', GenerateSearchApiRouteCommand::class);

        $this->app->bind('command.crud:api-dto-get', GenerateGetApiDtoCommand::class);
        $this->app->bind('command.crud:api-service-get', GenerateGetApiServiceCommand::class);
        $this->app->bind('command.crud:api-controller-get', GenerateGetApiControllerCommand::class);
        $this->app->bind('command.crud:api-route-get', GenerateGetApiRouteCommand::class);

        $this->app->bind('command.crud:api-route', GenerateApiRouteCommand::class);
        $this->app->bind('command.crud:api-controller', GenerateApiControllerCommand::class);
        $this->app->bind('command.crud:api-dto', GenerateApiDtoCommand::class);
        $this->app->bind('command.crud:api-service', GenerateApiServiceCommand::class);

        $this->commands([
            'command.crud:model-dto',
            'command.api:crud',
            'command.api:get',
            'command.crud:api-dto-get',
            'command.crud:api-service-get',
            'command.crud:api-controller-get',
            'command.crud:api-route-get',
            'command.crud:api-route',
            'command.crud:api-controller',
            'command.crud:api-dto',
            'command.crud:api-service',
            'command.crud:api-dto-search',
            'command.crud:api-service-search',
            'command.crud:api-controller-search',
            'command.crud:api-route-search',
            'command.crud:api-dto-delete',
            'command.crud:api-service-delete',
            'command.crud:api-controller-delete',
            'command.crud:api-route-delete',
            'command.crud:api-dto-update',
            'command.crud:api-service-update',
            'command.crud:api-controller-update',
            'command.crud:api-route-update',
            'command.crud:api-dto-create',
            'command.crud:api-service-create',
            'command.crud:api-controller-create',
            'command.crud:api-route-create',
        ]);
    }
}