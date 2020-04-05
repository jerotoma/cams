<?php
namespace App\Helpers;

use Illuminate\Validation\Validator;

class ValidatorUtility {

    public static function processValidatorErrorMessages(Validator $validator) {
        $errorMessages = array();
        foreach ($validator->getMessageBag()->toArray() as $key => $value) {
            foreach ($value as $childKey => $childValue) {
                $errorMessages[] =   $childValue;
            }
        }
        return $errorMessages;
    }
}
