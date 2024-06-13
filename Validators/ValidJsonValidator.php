<?php

namespace app\Validators;

use yii\validators\Validator;

class ValidJsonValidator extends Validator
{
    public function validateAttribute($model, $attribute): void
    {
        json_decode($model->$attribute);

        if (json_last_error()!==JSON_ERROR_NONE) {
            $this->addError($model, $attribute, "$attribute must be valid json");
        }
    }
}