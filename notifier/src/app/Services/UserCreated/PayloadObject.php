<?php

namespace App\Services\UserCreated;

class PayloadObject
{
    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function getId()
    {
        return $this->payload[0]->id;
    }

    public function getEmail()
    {
        return $this->payload[0]->email;
    }

    public function getName()
    {
        return $this->payload[0]->name;
    }

    public function getUserId()
    {
        return $this->payload[0]->user_id;
    }
}
