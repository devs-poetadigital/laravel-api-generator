namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectCollection;

use App\Dto\ModelDto\{{ $model_name }}Dto;

class {{ $action_name }}{{ $model_name }}RequestDto extends {{ $model_name }}Dto
{
    public $current_user;

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
 *     properties={
 *         @OA\Property(property="success", type="string"),
 *         @OA\Property(property="code", type="integer"),
 *         @OA\Property(property="locale", type="string"),
 *         @OA\Property(property="message", type="string"),
 *         @OA\Property(property="data", type="object", ref="#/components/schemas/{{ $model_name }}Dto"),
 *     }
 * )
 */