<?php
namespace App\Http\Controllers\Api\User;

use App\Dependencies\ResponseBuilder\AppFormRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\UserService\UpdateUserService;

class UpdateUserController extends ApiController
{
    public UpdateUserService $service;

    public function __construct(UpdateUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(UpdateUserFormRequest $request)
    {
        $res = $this->service->handle($request);

        return  $this->successResponse($res);
    }
}

class UpdateUserFormRequest extends AppFormRequest
{
    public function rules()
    {
        $rules = [];
        return $rules;
    }
}

/**
* @OA\Post(
*     path="/api/user/update",
*     summary="Update User",
*     operationId="update/user",
*     tags={"---------- User ----------"},
*     security={{"bearerAuth": {}}},
*     @OA\RequestBody(
*         required=true,
*         description="Update User object",
*         @OA\JsonContent(ref="#/components/schemas/UpdateUserApiRequest"),
*     ),
*     @OA\Response(
*         response=200,
*         description="Update User response",
*         @OA\JsonContent(ref="#/components/schemas/UpdateUserApiResponse"),
*     )
* )
*
*/