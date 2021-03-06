<?php

namespace CodeGenerator;

use Illuminate\Support\Str;

class GenerateRouteHandler extends GenerateApiHandler
{
    private $templatePath = __DIR__.'/../resources/Templates/Routes';
    
    public function handle()
    {
        $this->generateRouteCode($this->model);
        parent::handle();
    }

    public function remove(){
        createFileIfNeed($this->getPath());
        $blade = new Blade($this->templatePath, $this->cachPath);
        $templateView = $this->model->action_name."RouteTemplate";
        if ($blade->exists($templateView))
        {
            $content = $blade->make($this->model->action_name."RouteTemplate", $this->model->toArray())->render();
        }
        else
        {
            $content = $blade->make("GetRouteTemplate", $this->model->toArray())->render();
        }
        $path = $this->getPath().$this->model->model_name.'.php';
        $content = '<?php'.PHP_EOL.$content;
        if(fileExists($path)){
            $use = $this->getUse($content);
            $route = $this->getRoute($content);
            $content = fileGetContents($path);
            if (str_contains($content,$use))
            {
                $content = str_replace($use, "", $content);
            }
            if (str_contains($content,$route))
            {
                $content = str_replace($route, "", $content);
            }
        }
        filePutContents($path, $content); 

        $pathApiRoot = 'routes/api.php';
        if(fileExists($pathApiRoot)){
            $content = fileGetContents($pathApiRoot);
            $modelName = $this->model->model_name;
            $include = "\n@include(\"Api/$modelName.php\");";
            if (!str_contains($content,$include))
            {
                $content = $content.$include;
                filePutContents($pathApiRoot, $content); 
            }
        }
    }

    protected function generateRouteCode(GenerateModel $model){
        createFileIfNeed($this->getPath());
        $blade = new Blade($this->templatePath, $this->cachPath);
        $templateView = $model->action_name."RouteTemplate";
        if ($blade->exists($templateView))
        {
            $content = $blade->make($model->action_name."RouteTemplate", $model->toArray())->render();
        }
        else
        {
            $content = $blade->make("GetRouteTemplate", $model->toArray())->render();
        }
        $path = $this->getPath().$model->model_name.'.php';
        $content = '<?php'.PHP_EOL.$content;
        if(fileExists($path)){
            $use = $this->getUse($content);
            $route = $this->getRoute($content);
            $content = fileGetContents($path);
            if (!str_contains($content,$use))
            {
                $content = str_replace("//use", "//use".$use, $content);
            }
            if (!str_contains($content,$route))
            {
                $content = str_replace("//route", "//route".$route, $content);
            }
        }
        filePutContents($path, $content); 

        $pathApiRoot = 'routes/api.php';
        if(fileExists($pathApiRoot)){
            $content = fileGetContents($pathApiRoot);
            $modelName = $model->model_name;
            $include = "\n@include(\"Api/$modelName.php\");";
            if (!str_contains($content,$include))
            {
                $content = $content.$include;
                filePutContents($pathApiRoot, $content); 
            }
        }
    }

    private function getUse($content): string{
        $uses = explode("//use",$content);
        $routes = explode("//route",$uses[1]);
        return array_shift($routes);
    }

    private function getRoute($content): string{
        $routes = explode("//route",$content);
        return end($routes);
    }

    private function getPath(){
        return $this->pathApiRoute;
    }
}
