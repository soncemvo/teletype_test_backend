<?php

namespace app\controllers;

use app\classes\MessageLogger;
use app\models\WebhookForm;
use app\models\WebhookPayloadForm;
use Exception;
use Yii;
use yii\httpclient\Client;
use yii\web\Controller;

class WebhookController extends Controller
{
    public function beforeAction($action)
    {

        $this->enableCsrfValidation = false;

        return parent::beforeAction($action);
    }

    public function actionTeletype()
    {

        $logger = new MessageLogger();
        $webhook = new WebhookForm();
        $message = new WebhookPayloadForm();

        $webhook->attributes = Yii::$app->request->post();
        if(!$webhook->validate())
        {
            Yii::$app->response->content = json_encode($webhook->getErrors());
            Yii::$app->response->setStatusCode(400)->send();
            return false;
        }


        $payload = json_decode($webhook->payload, true);
        $message->attributes =$payload['message'];

        if(!$message->validate())
        {
            Yii::$app->response->content = json_encode($webhook->getErrors());
            Yii::$app->response->setStatusCode(400)->send();
            return false;
        }


        if($message->isItClient) {
            if(str_contains($message->text,"ping?"))
            {
                $client = new Client();
                try {
                    $response = $client->createRequest()
                        ->setMethod('POST')
                        ->setUrl('https://api.teletype.app/public/api/v1/message/send')
                        ->setHeaders(['X-Auth-Token' => 'CwUKI0LAzbW6_uFUsSfh5h1QayTauLJPqEY6aiJrWIw1mIGD5R38PAx2ZhCUOKWQ'])
                        ->setData(['dialogId' => $message->dialogId, 'text' => 'pong!'])
                        ->send();

                    if (!$response->isOk) {
                        Yii::error("Sending message failed with $response->statusCode code. Reason: ". $response->getContent());
                    }
                }
                catch (Exception $e)
                {
                    Yii::error("Sending http request with exception: " . $e->getMessage());
                }

            }

            $logger->writeClientLog($message);
        }
        else {
            $logger->writeOperatorLog($message);
        }

        Yii::$app->response->setStatusCode(200)->send();

        return true;
    }


}