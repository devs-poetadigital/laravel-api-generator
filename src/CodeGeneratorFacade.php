<?php

namespace CodeGenerator;

use Illuminate\Support\Facades\Facade;

class CodeGeneratorFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return CodeGeneratorFacade::class;
    }
}

