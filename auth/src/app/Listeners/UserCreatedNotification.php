<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\User;
use Bschmitt\Amqp\Facades\Amqp;

class UserCreatedNotification
{
    public const QUEUE_NAME = 'MS:Auth:User.Created';

    protected $user;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        Amqp::publish('', $event->user->toJson() , ['queue' => self::QUEUE_NAME]);
    }
}
