<?php
namespace App\Dto\ApiDto;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

class SearchResultDto extends FlexibleDataTransferObject
{
    public $total;
    public $data;

    public static function emptyResult(): ? self
    {
        $result = new self(['total' => 0, 'data' => []]);

        return $result;
    }
}