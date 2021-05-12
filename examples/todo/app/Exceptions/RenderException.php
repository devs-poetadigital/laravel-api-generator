<?php

namespace App\Exceptions;

use Exception;

use App\Dependencies\ResponseBuilder\AppResponseBuilder;

class RenderException extends Exception
{
    public $code;

    public $data;

    public $appMessage;

    public function __construct($message, $code=201, $data=null)
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
        $this->appMessage = $message;
    }

    public function getAppMessage() {
        return $this->appMessage;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return AppResponseBuilder::errorResponse($this->getAppMessage(), $this->data, $this->code);
    }
}
