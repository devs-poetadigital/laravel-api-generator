namespace App\Dto\ModelDto;

use Illuminate\Http\Request;

use Spatie\DataTransferObject\FlexibleDataTransferObject;

use App\Models\{{ $model_name }};

class {{ $model_name }}Dto extends FlexibleDataTransferObject
{
    public int $id;
@foreach ($fillable as $field)
    public {{ $field['type'] }} ${{ $field['name'] }};
@endforeach
    
    public $created_at;
    public $updated_at;
}

/**
 * @OA\Schema(
 *     schema="{{ $model_name }}Dto",
 *     type="object",
 *     title="{{ $model_name }}Dto",
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