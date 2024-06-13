<?php

namespace app\Validators;

use yii\validators\Validator;

class ArrayValidator extends Validator
{
    public function validateAttribute($model, $attribute): void
    {

        if (!is_array($model->$attribute)) {
            $this->addError($model, $attribute, "$attribute must be an array");
        }
    }
}