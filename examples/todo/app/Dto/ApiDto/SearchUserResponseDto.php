<?php
include dirname(__FILE__)."/Dto/ModelDto/UserDto.php";
namespace App\Dto\ApiDto;
use Spatie\DataTransferObject\FlexibleDataTransferObject;
use \Spatie\DataTransferObject\DataTransferObjectCollection;
use App\Dto\ModelDto\UserDto;

class SearchUserResponseDto extends FlexibleDataTransferObject
{
    public ?int $total;
    public ?SearchUserResponseCollection $data;

    public static function fromSearchResult(SearchResultDto $searchResult = null): ?self
    {
        $result = new self();
        $result->total = $searchResult->total;
        $result->data = SearchUserResponseCollection::create($searchResult->data);

        return $result;
    }
}

class SearchUserResponseItem extends UserDto
{

}

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

/**
 * @OA\Schema(
 *     schema="SearchUserApiResponse",
 *     type="object",
 *     title="SearchUserApiResponse",
 *     properties={
 *         @OA\Property(property="success", type="string"),
 *         @OA\Property(property="code", type="integer"),
 *         @OA\Property(property="locale", type="string"),
 *         @OA\Property(property="message", type="string"),
 *         @OA\Property(
 *              property="data", 
 *              type="object", 
 *              properties = {
 *                  
 *              }
 *         ),
 *     }
 * )
 */