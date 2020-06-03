<?php

namespace App\Services;

trait CqrsRouter
{
    public function handle($command)
    {
        $commandName = (new \ReflectionClass($command))->getName();

        $handlerNameBuilder = str_replace('Command', 'Handler', $commandName);
        $handlerNameBuilder = "\\" . $handlerNameBuilder;

        (new $handlerNameBuilder($command))->handle();
    }
}
