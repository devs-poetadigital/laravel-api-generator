<?php
namespace App\Http\Controllers\Api\User;

use App\Dependencies\ResponseBuilder\AppFormRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\UserService\GetAllUserService;

class GetAllUserController extends ApiController
{
    public GetAllUserService $service;

    public function __construct(GetAllUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(GetAllUserFormRequest $request)
    {
        $res = $this->service->handle($request);

        return  $this->successResponse($res);
    }
}

class GetAllUserFormRequest extends AppFormRequest
{
    public function rules()
    {
        $rules = [];
        return $rules;
    }
}

/**
* @OA\Post(
*     path="/api/user/getall",
*     summary="GetAll User",
*     operationId="getall/user",
*     tags={"---------- User ----------"},
*     security={{"bearerAuth": {}}},
*     @OA\RequestBody(
*         required=true,
*         description="GetAll User object",
*         @OA\JsonContent(ref="#/components/schemas/GetAllUserApiRequest"),
*     ),
*     @OA\Response(
*         response=200,
*         description="GetAll User response",
*         @OA\JsonContent(ref="#/components/schemas/GetAllUserApiResponse"),
*     )
* )
*
*/