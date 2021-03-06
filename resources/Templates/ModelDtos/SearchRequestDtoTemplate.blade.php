namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

class {{ $action_name }}{{ $model_name }}RequestDto extends SearchCriteriaDto
{
@foreach ($fillable as $field)
    public ${{ $field['name'] }};
@endforeach

    public static function fromRequest(Request $request): self
    {
        $result = new self($request->all());

        return $result;
    }
}

/**
 * @OA\Schema(
 *     schema="{{ $action_name }}{{ $model_name }}ApiRequest",
 *     type="object",
 *     title="{{ $action_name }}{{ $model_name }}ApiRequest",
 *     properties = {
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
 *     }
 * )
 */