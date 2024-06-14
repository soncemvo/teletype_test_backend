<?php

namespace app\classes;

use Yii;

class FileLogWriter implements LogWriter
{
    /**
     * Path for logs
     * @var string
     */
    private string $path;

    /**
     * Filename to write log
     * @var string
     */
    private string $filename;

    /**
     * Construct new LogWriter Instance
     * @param string $filename filename to write log
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->path = Yii::getAlias('@app/runtime/logs/');
    }

    /**
     * Writing client message to file
     * @param string $text text to write
     * @return void
     */
    public function write(string $text): void
    {
        file_put_contents($this->path.$this->filename, $text, FILE_APPEND);
    }
}
