namespace App\Http\Controllers\Api\{{ $model_name }};

use App\Dependencies\ResponseBuilder\AppFormRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\{{ $model_name }}Service\{{ $action_name }}{{ $model_name }}Service;

class {{ $action_name }}{{ $model_name }}Controller extends ApiController
{
    public {{ $action_name }}{{ $model_name }}Service $service;

    public function __construct({{ $action_name }}{{ $model_name }}Service $service)
    {
        $this->service = $service;
    }

    public function __invoke({{ $action_name }}{{ $model_name }}FormRequest $request)
    {
        $res = $this->service->handle($request);

        return  $this->successResponse($res);
    }
}

class {{ $action_name }}{{ $model_name }}FormRequest extends AppFormRequest
{
    public function rules()
    {
        $rules = [];
        return $rules;
    }
}

/**
* @OA\Post(
*     path="/api/{{ strtolower($model_name_kebab) }}/{{ strtolower($action_name_kebab) }}",
*     summary="{{ $action_name }} {{ $model_name }}",
*     operationId="{{ strtolower($action_name_kebab) }}/{{ strtolower($model_name_kebab) }}",
*     tags={"---------- {{ $model_name }} ----------"},
*     security=@{{"bearerAuth": {}}},
*     @OA\RequestBody(
*         required=true,
*         description="{{ $action_name }} {{ $model_name }} object",
*         @OA\JsonContent(ref="#/components/schemas/{{ $action_name }}{{ $model_name }}ApiRequest"),
*     ),
*     @OA\Response(
*         response=200,
*         description="{{ $action_name }} {{ $model_name }} response",
*         @OA\JsonContent(ref="#/components/schemas/{{ $action_name }}{{ $model_name }}ApiResponse"),
*     )
* )
*
*/