<?php

namespace CodeGenerator\Generator\Commands\Share;

class CheckCRUDActionNameHelper
{
    public static function handle($action_name)
    {
        $crud = self::getCRUDActionNames();
        return in_array($action_name, $crud);
    }

    public static function getCRUDActionNames()
    {
        return array("Create", "Update", "Delete", "Search", "Get");
    }

    public static function getFillables($modelName)
    {
        try
        {
            return resolve('App\Models\\'.$modelName)->getFillable();
        } catch (\Exception $ex) {
            return [];
        }
    }
}