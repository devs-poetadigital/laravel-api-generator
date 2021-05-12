<?php

namespace App\Dependencies\ResponseBuilder;

use Symfony\Component\HttpFoundation\Response as HttpResponse;

use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use MarcinOrlowski\ResponseBuilder\Validator;
use MarcinOrlowski\ResponseBuilder\BaseApiCodes;

class AppResponseBuilder extends ResponseBuilder
{
    public static function asResponse($success = true, int $api_code = null, $message = null, $data = null): self
    {
        $response = new self($success, $api_code ?? BaseApiCodes::OK());
        $response->withHttpCode(200);
        $response->withData(AppResponseBuilder::converData($data));
        $response->withMessage($message);

        return $response;
    }

    public static function successResponse($message, $data = null)
    {
        $response = AppResponseBuilder::asResponse(true, null, $message, $data);
        return $response->buildCustomResponse();
    }

    public static function errorResponse($message, $data = null, $api_code = 0)
    {
        $response = AppResponseBuilder::asResponse(false, $api_code, $message, $data);
        return $response->buildCustomResponse();
    }

    public static function unauthenticatedResponse($message, $data = null, $api_code = 0)
    {
        $response = AppResponseBuilder::asResponse(false, $api_code, $message, $data);
        $response->withHttpCode(HttpResponse::HTTP_UNAUTHORIZED);

        return $response->buildCustomResponse();
    }

    private static function converData($data)
    {
        if(is_null($data))
        {
            return $data;
        }

        if ($data instanceof \Spatie\DataTransferObject\DataTransferObject
            || $data instanceof \Spatie\DataTransferObject\FlexibleDataTransferObject
            || $data instanceof \Spatie\DataTransferObject\DataTransferObjectCollection)
        {
            $result = $data->toArray();
            if($result == []) {
                return null;
            }

            return $result;
        }

        return $data;
    }

    public function buildCustomResponse(): HttpResponse
    {
        $api_code = $this->api_code;
        Validator::assertIsInt('api_code', $api_code);

        $msg_or_api_code = $this->message ?? $api_code;
        $http_headers = $this->http_headers ?? [];

        if(is_null($this->message)) {
            $this->message = $this->getMessageForApiCode($this->success, $this->api_code, $this->placeholders);
        }

        if ($this->success) {
            $api_code = $api_code ?? BaseApiCodes::OK();
            $http_code = $this->http_code ?? ResponseBuilder::DEFAULT_HTTP_CODE_OK;

            Validator::assertOkHttpCode($http_code);

            $result = $this->make($this->success, $api_code, $msg_or_api_code, $this->data, $http_code,
            $this->placeholders, $http_headers, $this->json_opts);
        } else {
            $http_code = $this->http_code ?? ResponseBuilder::DEFAULT_HTTP_CODE_ERROR;

            $result = $this->make(false, $api_code, $msg_or_api_code, $this->data, $http_code, $this->placeholders,
                $this->http_headers, $this->json_opts, $this->debug_data);
        }

        return $result;
    }
}
