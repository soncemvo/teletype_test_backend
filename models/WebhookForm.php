<?php

namespace app\models;

use app\Validators\ValidJsonValidator;
use yii\base\Model;

class WebhookForm extends Model
{
    public string $name;
    public mixed $payload;

    public function rules()
    {
       return [
           [['name','payload'],'required'],
           ['payload', ValidJsonValidator::class]
       ];
    }
}