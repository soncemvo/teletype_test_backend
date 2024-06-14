<?php

namespace app\classes;

use app\models\WebhookPayloadForm;

/**
 * Class For logging Chat Messages
 */
class MessageLogger
{
    /**
     * Filename for saving client messages
     * @var string
     */
    public string $clientLogFile = "Clients.log";

    /**
     * Filename for saving operator messages
     * @var string
     */
    public string $operatorLogFile = "Operators.log";

    public LogWriter $clientLogWriter;
    public LogWriter $operatorLogWriter;

    public function __construct()
    {
        $this->clientLogWriter = new FileLogWriter($this->clientLogFile);
        $this->operatorLogWriter = new FileLogWriter($this->operatorLogFile);
    }

    /**
     * Writing client message to file
     * @param WebhookPayloadForm $payload   payload array of incoming webhook
     * @return void
     */
    public function writeClientLog(WebhookPayloadForm $payload): void
    {
        $date = date('H:i:s Y-m-d');
        $message = "[$date]  $payload->text\n";

        $this->clientLogWriter->write($message);
    }

    /**
     * Writing operator message to file
     * @param WebhookPayloadForm $payload   payload array of incoming webhook
     * @return void
     */
    public function writeOperatorLog(WebhookPayloadForm $payload ): void
    {
        $date = date('H:i:s Y-m-d');
        $message = "[$date]  $payload->text\n";

        $this->operatorLogWriter->write($message);

    }
}