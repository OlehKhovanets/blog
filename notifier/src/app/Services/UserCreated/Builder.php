<?php

namespace App\Services\UserCreated;

use App\Services\CqrsRouter;
use App\Services\Job\Command\CreateJobCommand;

class Builder
{
    use CqrsRouter;

    public object $payload;

    public function __construct(object $payload)
    {
        $this->payload = $payload;
    }

    public function build()
    {
        $this->handle(new CreateJobCommand($this->payload));
    }
}
