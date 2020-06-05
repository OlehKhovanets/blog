<?php

namespace App\Services;

trait CqrsRouter
{
    public function handle($command)
    {
        $commandName = (new \ReflectionClass($command))->getName();
        $handlerNameBuilder = sprintf('%s%s', "\\", str_replace('Command', 'Handler', $commandName));

        (new $handlerNameBuilder())->handle($command);
    }
}
