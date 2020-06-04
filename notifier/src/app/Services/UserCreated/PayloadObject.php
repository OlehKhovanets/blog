<?php

namespace App\Services\UserCreated;

class PayloadObject
{
    public object $payload;

    public function __construct(object $payload)
    {
        $this->payload = $payload;
    }

    public function getId()
    {
        return $this->payload->id;
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
