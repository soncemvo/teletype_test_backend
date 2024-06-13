<?php

namespace app\classes;

use Yii;

class FileLogWriter implements LogWriter
{
    public function write($path, $text): void
    {
        file_put_contents($path, $text, FILE_APPEND);
    }
}
