namespace App\Dto\ApiDto;
use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $action_name }}{{ $model_name }}ResponseItem extends {{ $model_name }}Dto
{

}


/**
 * @OA\Schema(
 *     schema="SearchUserResponseItem",
 *     type="object",
 *     title="SearchUserResponseItem",
 *     properties = {
 *         @OA\Property(property="id", type="string"),
@foreach ($fillable as $field)
 *         @OA\Property(property="{{ $field }}", type="string"),
@endforeach
 *         @OA\Property(property="created_at", type="string"),
 *         @OA\Property(property="updated_at", type="string")
 *     }
 * )
 */
