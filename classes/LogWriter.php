<?php

namespace app\classes;

interface LogWriter
{
    public function write($path, $text): void;
}