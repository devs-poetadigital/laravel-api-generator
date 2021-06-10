namespace App\Services\{{ $model_name }}Service;

use Illuminate\Http\Request;

use App\Models\{{ $model_name }};
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}ResponseDto;
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}RequestDto;

class {{ $action_name }}{{ $model_name }}Service
{
    public function handle(Request $request) : ?{{ $action_name }}{{ $model_name }}ResponseDto
    {
        $requestDto = {{ $action_name }}{{ $model_name }}RequestDto::fromRequest($request);

        $entity = new {{ $model_name }}();
@foreach ($fillable as $field)
        if ($request->has('{{ $field['name'] }}')) {
            $entity->{{ $field['name'] }} = $requestDto->{{ $field['name'] }};
        }
@endforeach

        $entity->save();
        
        $res = {{ $action_name }}{{ $model_name }}ResponseDto::fromEntity($entity);

        return $res;
    }
}