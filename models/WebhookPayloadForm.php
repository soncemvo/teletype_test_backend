<?php

namespace app\models;

use app\Validators\ArrayValidator;
use yii\base\Model;

class WebhookPayloadForm extends Model
{
    public $id;

    public $dialogId;

    public $text;

    public $attachments;

    public $operator;

    public $client;

    public $channel;

    public $status;

    public $type;

    public $createdAt;

    public $isItClient;

    public function rules()
    {
        return [
            [['id', 'dialogId', 'text', 'channel','status','type','createdAt','isItClient'], 'required'],

             ['attachments', ArrayValidator::class],
             ['operator',  ArrayValidator::class, 'skipOnEmpty' => true],
             ['client', ArrayValidator::class, 'skipOnEmpty' => true],
             ['channel', ArrayValidator::class],
             ['createdAt', ArrayValidator::class]

        ];
    }

}