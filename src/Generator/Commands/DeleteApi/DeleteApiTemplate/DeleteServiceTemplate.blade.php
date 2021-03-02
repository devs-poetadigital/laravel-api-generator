namespace App\Services\{{ $model_name }}Service;

use Illuminate\Http\Request;

use App\Dto;
use App\Models\{{ $model_name }};
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}ResponseDto;
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}RequestDto;

class {{ $action_name }}{{ $model_name }}Service
{
    public function handle(Request $request) : ?{{ $action_name }}{{ $model_name }}ResponseDto
    {
        $requestDto = {{ $action_name }}{{ $model_name }}RequestDto::fromRequest($request);

        $entity = {{ $model_name }}::where('id', $requestDto->id)->first();
        if(!is_null($entity)) {
            $entity->delete();
        }

        return null;
    }
}