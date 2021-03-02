namespace App\Dto\ApiDto;

use Spatie\DataTransferObject\FlexibleDataTransferObject;
use \Spatie\DataTransferObject\DataTransferObjectCollection;


class {{ $action_name }}{{ $model_name }}ResponseDto extends FlexibleDataTransferObject
{
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
 *         @OA\Property(property="data", type="object"),
 *     }
 * )
 */