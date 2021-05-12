<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use App\ApiCode;

use App\Dependencies\ResponseBuilder\AppResponseBuilder;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->renderable(function (\Illuminate\Database\QueryException $ex, $request) {
            if(!empty($ex->errorInfo) && count($ex->errorInfo) > 2 && $ex->errorInfo[0] == '23000' && $ex->errorInfo[1] == 1451) {
                return AppResponseBuilder::errorResponse(null, null, ApiCode::CAN_NOT_DELETE_UPDATE_PARENT_ROW);
            }
            return AppResponseBuilder::errorResponse($ex->getMessage(), null, ApiCode::SOMETHING_WENT_WRONG);
        });

        $this->renderable(function (NotFoundHttpException $ex, $request) {
            return AppResponseBuilder::errorResponse(null, null, ApiCode::NOT_FOUND_HTTP_EXCEPTION);
        });

        $this->renderable(function (\Exception $ex, $request) {
            return AppResponseBuilder::errorResponse($ex->getMessage(), null, ApiCode::SOMETHING_WENT_WRONG);
        });
    }
}
