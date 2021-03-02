namespace App\Services\{{ $model_name }}Service;

use Illuminate\Http\Request;

use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}RequestDto;
use App\Dto\ApiDto\{{ $action_name }}{{ $model_name }}ResponseDto;

class {{ $action_name }}{{ $model_name }}Service
{
    public function handle(Request $request) : ?{{ $action_name }}{{ $model_name }}ResponseDto
    {
        $requestDto = {{ $action_name }}{{ $model_name }}RequestDto::fromRequest($request);

        $entity = null;

        $res = new {{ $action_name }}{{ $model_name }}ResponseDto();

        return $res;
    }
}