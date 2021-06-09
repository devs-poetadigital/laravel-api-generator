namespace App\Dto\ApiDto;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\FlexibleDataTransferObject;

class {{ $action_name }}{{ $model_name }}RequestDto extends FlexibleDataTransferObject
{
    public $current_user;

    @if (str_contains($action_name, 'Create'))
        @foreach ($fillable as $field)
public ${{ $field }};
        @endforeach
    @elseif (str_contains($action_name, 'Delete'))
public $id;
    @else
public $id;
        @foreach ($fillable as $field)
public ${{ $field }};
        @endforeach
    @endif

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