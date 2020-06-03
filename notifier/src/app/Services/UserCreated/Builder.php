<?php

namespace App\Services\UserCreated;

use App\Models\Job;

class Builder
{
    public const EVENT_NAME = 'MS:Auth:User.Created';

    protected array $payload;

    protected PayloadObject $payloadObject;

    public function __construct(array $payload)
    {
        $this->payloadObject = new PayloadObject($payload);
    }



    public function build()
    {
        Job::query()->create([
            'email' => $this->payloadObject->getEmail(),
            'eventName' => self::EVENT_NAME,
            'name' => $this->payloadObject->getName(),
            'user_id' => $this->payloadObject->getUserId()
            ]);
    }
}
