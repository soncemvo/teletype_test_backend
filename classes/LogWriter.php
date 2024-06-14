<?php

namespace app\classes;

interface LogWriter
{
    public function write(string $text): void;
}