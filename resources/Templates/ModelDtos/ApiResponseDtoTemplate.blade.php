namespace App\Dto\ApiDto;

use App\Dto\ModelDto\{{ $model_name }}Dto;
use App\Models\{{ $model_name }};

class {{ $action_name }}{{ $model_name }}ResponseDto extends {{ $model_name }}Dto
{
    public static function fromEntity({{ $model_name }} $entity = null): ?self
    {
        if(is_null($entity)) return null;

        $result = new self($entity->attributesToArray());

        return $result;
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
 *         @OA\Property(
 *              property="data", 
 *              type="object", 
 *              properties = {
 *                  @OA\Property(property="id", type="string"),
@foreach ($fillable as $field)
 *                  @OA\Property(property="{{ $field }}", type="string"),
@endforeach
 *                  @OA\Property(property="created_at", type="string"),
 *                  @OA\Property(property="updated_at", type="string")
 *              }
 *         ),
 *     }
 * )
 */