<?php

namespace Code;

class Log
{
    public function log(string $message): string
    {
        return "Logando no sistema.: {$message}";
    }
}