<?php
namespace App\Dto\ApiDto;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

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
 *         @OA\Property(property="data", type="object", ref="#/components/schemas/SearchUserResponseItem"),
 *     }
 * )
 */