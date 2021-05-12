<?php

namespace App\Dependencies\ResponseBuilder;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AppFormRequest extends FormRequest {
    public function failedValidation(Validator $validator) {
        $messages = $validator->errors()->messages();
        $message = null;
        if(!is_null($messages)) {
            foreach ($messages as $name => $value) {
                $message = $value[0];
            break;
            }
        }

        throw new \App\Exceptions\RenderException($message, \App\ApiCode::REQUEST_VALIDATION_ERROR, $messages); 
   }
}