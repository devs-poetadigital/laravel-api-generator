<?php
namespace App\Http\Controllers\Api\User;

use App\Dependencies\ResponseBuilder\AppFormRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\UserService\CreateUserService;

class CreateUserController extends ApiController
{
    public CreateUserService $service;

    public function __construct(CreateUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(CreateUserFormRequest $request)
    {
        $res = $this->service->handle($request);

        return  $this->successResponse($res);
    }
}

class CreateUserFormRequest extends AppFormRequest
{
    public function rules()
    {
        $rules = [];
        return $rules;
    }
}

/**
* @OA\Post(
*     path="/api/user/create",
*     summary="Create User",
*     operationId="create/user",
*     tags={"---------- User ----------"},
*     security={{"bearerAuth": {}}},
*     @OA\RequestBody(
*         required=true,
*         description="Create User object",
*         @OA\JsonContent(ref="#/components/schemas/CreateUserApiRequest"),
*     ),
*     @OA\Response(
*         response=200,
*         description="Create User response",
*         @OA\JsonContent(ref="#/components/schemas/CreateUserApiResponse"),
*     )
* )
*
*/