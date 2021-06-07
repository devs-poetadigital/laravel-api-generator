namespace App\Dto\ApiDto;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class {{ $action_name }}{{ $model_name }}RequestDto extends FlexibleDataTransferObject
{
    public $current_user;

    @switch($action_name)
    @case('Create')
        @foreach ($fillable as $field)
public ${{ $field }};
        @endforeach
        @break

    @case('Delete')
public $id;
        @break

    @default
public $id;
        @foreach ($fillable as $field)
public ${{ $field }};
        @endforeach
    @endswitch

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
 *         @OA\Property(property="{{ $field }}", type="string"),
@endforeach
 *     }
 * )
 */