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
        $filePaths = rglob($dir.'/*.php');
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
        if (count($swaggerContents) <= 1)
        {
            return;
        }
        $strBottoms = explode($separaterBottom,$swaggerContents[1]);
        array_shift($strBottoms);
        foreach($properties as $property){
            $propertyType = $property->getType();
            $propertyName = $property->getName();
            if(in_array($propertyName,["data","ignoreMissing","exceptKeys","onlyKeys"]))
            {
                continue;
            }

            if(!is_null($propertyType) && str_contains($propertyType->getName(),"App\Dto"))
            {
                $propertyClass = new ReflectionClass($propertyType->getName());
                if(str_contains($propertyClass->getParentClass()->getName(),"DataTransferObjectCollection"))
                {
                    $collectionClassName = $propertyClass->getMethod('current')->getReturnType()->getName();
                    $collectionClassPath = str_replace("App","app",$collectionClassName);
                    $collectionClassContent = fileGetContents($collectionClassPath.'.php');
                    if(str_contains($collectionClassContent,"@OA\Schema"))
                    {
                        $propertyClassName = pathinfo(str_replace("\\","/",$collectionClassName),PATHINFO_FILENAME);
                        $strProperties = $strProperties." *                  @OA\Property(property=\"{$propertyName}\", type=\"array\", @OA\Items(ref=\"#/components/schemas/{$propertyClassName}\")),\n";
                    }
                    else
                    {
                        $strProperties = $strProperties." *                  @OA\Property(property=\"{$propertyName}\", type=\"array\"),\n";
                    }
                }
                else
                {
                    $propertyClassName = pathinfo(str_replace("\\","/",$propertyType->getName()),PATHINFO_FILENAME);
                    $strProperties = $strProperties." *                  @OA\Property(property=\"{$propertyName}\", type=\"object\", ref=\"#/components/schemas/{$propertyClassName}\"),\n";
                }
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
