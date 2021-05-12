<?php

namespace CodeGenerator;
use ReflectionClass;

class RefreshClassHander extends GenerateApiHandler
{
    private $filePath;
    public function handle()
    {
        $dir = "app/Dto/"; 
        correctPath($dir);
        $filePaths = rglob($dir.'*.php');
        foreach($filePaths as $path)
        {
            if(str_contains($path, $this->modelName))
            {
                $this->filePath = $path;
                $this->refreshClass($this->detectClass());
                return;
            }
        }
        $this->command->info("invalid class name!");
    }

    protected function refreshClass(string $className){
        $class = new ReflectionClass($className);
        $properties = $class->getProperties();
        $content = fileGetContents($this->filePath);
        $strProperties = "";
        $separaterTop = "properties = {\n";
        $separaterBottom = "}\n";
        $swaggerContents = explode($separaterTop,$content);
        $strBottoms = explode($separaterBottom,$swaggerContents[1]);
        array_shift($strBottoms);
        foreach($properties as $property){
            $propertyType = $property->getType();
            $propertyName = $property->getName();
            if(in_array($propertyName,["data","ignoreMissing","exceptKeys","onlyKeys"]))
            {
                continue;
            }
            if(!is_null($propertyType))
            {
                $propertyClassName = pathinfo(str_replace("\\","/",$propertyType->getName()),PATHINFO_FILENAME);
                $strProperties = $strProperties." *                  @OA\Property(property=\"{$propertyName}\", type=\"object\", ref=\"#/components/schemas/{$propertyClassName}\"),\n";
            }
            else
            {
                $strProperties = $strProperties." *                  @OA\Property(property=\"{$propertyName}\", type=\"string\"),\n";
            }
        }
        $strProperties = $strProperties." *              }\n".join("}\n",$strBottoms);
        
        $swaggerContents[1] = $strProperties;
        $content = join($separaterTop,$swaggerContents);
        filePutContents($this->filePath, $content); 
    }

    private function detectClass(){
        $pathInfos = pathinfo($this->filePath);
        $parentClass = $pathInfos['filename'];
        $className = str_replace("/","\\", ucfirst($pathInfos['dirname']."/".$parentClass));
        
        $content = fileGetContents($this->filePath);
        $classResponseItem = str_replace("Dto","Item", $parentClass);
        
        if(str_contains($content,$classResponseItem))
        {
            $className = str_replace("/","\\", ucfirst($pathInfos['dirname']."/".$classResponseItem));
        }
        return $className;
    }
}
