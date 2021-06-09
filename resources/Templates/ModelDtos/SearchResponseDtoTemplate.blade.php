namespace App\Dto\ApiDto;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

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

/**
 * @OA\Schema(
 *     schema="{{ $action_name }}{{ $model_name }}ApiResponse",
 *     type="object",
 *     title="{{ $action_name }}{{ $model_name }}ApiResponse",
 *     properties = {
 *         @OA\Property(property="success", type="string"),
 *         @OA\Property(property="code", type="integer"),
 *         @OA\Property(property="locale", type="string"),
 *         @OA\Property(property="message", type="string"),
 *         @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/{{ $action_name }}{{ $model_name }}ResponseItem")),
 *     }
 * )
 */