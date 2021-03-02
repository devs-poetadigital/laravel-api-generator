namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectCollection;

use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $action_name }}{{ $model_name }}RequestDto extends SearchCriteriaDto
{
@foreach ($fillable as $field)
    public ${{ $field }};
@endforeach

    public static function fromRequest(Request $request): self
    {
        $result = new self($request->all());

        return $result;
    }
}