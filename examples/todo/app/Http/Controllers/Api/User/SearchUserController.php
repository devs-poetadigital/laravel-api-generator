<?php
namespace App\Http\Controllers\Api\User;

use App\Dependencies\ResponseBuilder\AppFormRequest;
use App\Http\Controllers\Api\ApiController;
use App\Services\UserService\SearchUserService;

class SearchUserController extends ApiController
{
    public SearchUserService $service;

    public function __construct(SearchUserService $service)
    {
        $this->service = $service;
    }

    public function __invoke(SearchUserFormRequest $request)
    {
        $res = $this->service->handle($request);

        return  $this->successResponse($res);
    }
}

class SearchUserFormRequest extends AppFormRequest
{
    public function rules()
    {
        $rules = [];
        return $rules;
    }
}

/**
* @OA\Post(
*     path="/api/user/search",
*     summary="Search User",
*     operationId="search/user",
*     tags={"---------- User ----------"},
*     security={{"bearerAuth": {}}},
*     @OA\RequestBody(
*         required=true,
*         description="Search User object",
*         @OA\JsonContent(ref="#/components/schemas/SearchUserApiRequest"),
*     ),
*     @OA\Response(
*         response=200,
*         description="Search User response",
*         @OA\JsonContent(ref="#/components/schemas/SearchUserApiResponse"),
*     )
* )
*
*/