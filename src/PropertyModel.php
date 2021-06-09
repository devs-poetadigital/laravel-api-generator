<?php

namespace CodeGenerator;

use Illuminate\Support\Str;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class PropertyModel extends FlexibleDataTransferObject
{
    public $name;
    public $type = 'string';
}