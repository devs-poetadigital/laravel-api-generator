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
 *                  @OA\Property(property="id", type="integer"),
@foreach ($fillable as $field)
@switch($field['type'])
@case('int')
 *                  @OA\Property(property="{{ $field['name'] }}", type="integer"),
@break

@case('float')
@case('double')
 *                  @OA\Property(property="{{ $field['name'] }}", type="number"),
@break

@default
 *                  @OA\Property(property="{{ $field['name'] }}", type="string"),
@endswitch
@endforeach
 *                  @OA\Property(property="created_at", type="number"),
 *                  @OA\Property(property="updated_at", type="number")
 *              }
 *         ),
 *     }
 * )
 */