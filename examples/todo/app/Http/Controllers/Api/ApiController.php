<?php
namespace App\Http\Controllers\Api;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Dependencies\ResponseBuilder\AppResponseBuilder;
/**
 * @OA\Info(title="Code generator", version="0.1")
 */
/**
 * Class ApiController
 * @package  App\Http\Controllers
 */
abstract class ApiController extends Controller {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param  $token
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    protected function respondWithToken($token)
    {
        return ResponseBuilder::success([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }

    /**
     * @param  null $data
     * @param  null $message
     * @return  \Symfony\Component\HttpFoundation\Response
     */
    public function successResponse($data = null, $message = null)
    {
        return AppResponseBuilder::successResponse($message, $data);
    }

    /**
     * @param  string $message
     * @param  int $code
     * @return  mixed
     */
    public function errorResponse($message = 'Something went wrong, !!', $data = null, $code = 201)
    {
        return AppResponseBuilder::errorResponse($message, $data, $code);
    }

    public function exceptionResponse($ex, $data = null, $code = 201)
    {
        if ($ex instanceof \App\Exceptions\RenderException) {
            return AppResponseBuilder::errorResponse($ex->getMessage(), $data, $code);
        }

        return AppResponseBuilder::errorResponse('Something went wrong, !!', $data, $code);
    }
}
