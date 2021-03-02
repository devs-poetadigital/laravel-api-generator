namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use \Spatie\DataTransferObject\DataTransferObjectCollection;

use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $action_name }}{{ $model_name }}ResponseDto extends FlexibleDataTransferObject
{
    public ?int $total;
    public ?{{ $action_name }}{{ $model_name }}ResponseCollection $data;

    public static function fromSearchResult(SearchResultDto $searchResult = null): ?self
    {
        $result = new self();
        $result->total = $searchResult->total;
        $result->data = {{ $action_name }}{{ $model_name }}ResponseCollection::create($searchResult->data);

        return $result;
    }
}

class {{ $action_name }}{{ $model_name }}ResponseItem extends {{ $model_name }}Dto
{

}

class {{ $action_name }}{{ $model_name }}ResponseCollection extends DataTransferObjectCollection
{
    public function current(): {{ $action_name }}{{ $model_name }}ResponseItem
    {
        return parent::current();
    }

    public static function create($data = null): ?{{ $action_name }}{{ $model_name }}ResponseCollection
    {
        if(is_null($data)) return null;

        $items = [];
        foreach($data as $srcItem) {
            $destItem = (array) $srcItem;
            array_push($items, $destItem);
        }

        return new static({{ $action_name }}{{ $model_name }}ResponseItem::arrayOf($items));
    }
}

/**
 * @OA\Schema(
 *     schema="{{ $action_name }}{{ $model_name }}ApiResponse",
 *     type="object",
 *     title="{{ $action_name }}{{ $model_name }}ApiResponse",
 *     properties={
 *         @OA\Property(property="success", type="string"),
 *         @OA\Property(property="code", type="integer"),
 *         @OA\Property(property="locale", type="string"),
 *         @OA\Property(property="message", type="string"),
 *         @OA\Property(property="data", type="object", ref="#/components/schemas/{{ $model_name }}Dto"),
 *     }
 * )
 */