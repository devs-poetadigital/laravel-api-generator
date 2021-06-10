namespace App\Dto\ApiDto;
use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $action_name }}{{ $model_name }}ResponseItem extends {{ $model_name }}Dto
{

}


/**
 * @OA\Schema(
 *     schema="{{ $action_name }}{{ $model_name }}ResponseItem",
 *     type="object",
 *     title="{{ $action_name }}{{ $model_name }}ResponseItem",
 *     properties = {
 *         @OA\Property(property="id", type="integer"),
@foreach ($fillable as $field)
@switch($field['type'])
@case('int')
 *         @OA\Property(property="{{ $field['name'] }}", type="integer"),
@break

@case('float')
@case('double')
 *         @OA\Property(property="{{ $field['name'] }}", type="number"),
@break

@default
 *         @OA\Property(property="{{ $field['name'] }}", type="string"),
@endswitch
@endforeach
 *         @OA\Property(property="created_at", type="number"),
 *         @OA\Property(property="updated_at", type="number")
 *     }
 * )
 */
