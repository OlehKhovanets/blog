<?php

namespace App\Services\Job\Command;

class CreateJobCommand
{
    protected object $payload;

    public function __construct(object $payload)
    {
        $this->payload = $payload;
    }

    public function getEmail()
    {
        return $this->payload->email;
    }

    public function getName()
    {
        return $this->payload->name;
    }

    public function getUserId()
    {
        return $this->payload->user_id;
    }
}
