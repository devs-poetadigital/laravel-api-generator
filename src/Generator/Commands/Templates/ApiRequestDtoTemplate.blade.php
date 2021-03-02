namespace App\Dto\ApiDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use Spatie\DataTransferObject\DataTransferObjectCollection;

class {{ $action_name }}{{ $model_name }}RequestDto extends FlexibleDataTransferObject
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
 *         @OA\Property(property="name", type="string")
 *     }
 * )
 */