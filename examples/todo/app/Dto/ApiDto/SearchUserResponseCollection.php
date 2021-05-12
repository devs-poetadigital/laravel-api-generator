<?php
namespace App\Dto\ApiDto;
use \Spatie\DataTransferObject\DataTransferObjectCollection;

class SearchUserResponseCollection extends DataTransferObjectCollection
{
    public function current(): SearchUserResponseItem
    {
        return parent::current();
    }

    public static function create($data = null): ?SearchUserResponseCollection
    {
        if(is_null($data)) return null;

        $items = [];
        foreach($data as $srcItem) {
            $destItem = (array) $srcItem;
            array_push($items, $destItem);
        }

        return new static(SearchUserResponseItem::arrayOf($items));
    }
}