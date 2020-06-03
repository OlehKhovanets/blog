<?php

namespace App\Services\User\Handler;

use App\User;
use Illuminate\Support\Facades\Hash;

class CreateUserHandler
{
    protected $command;

    public function __construct($command)
    {
        $this->command = $command;
    }

    public function handle()
    {
        User::query()->create([
            'email' => $this->command->getEmail(),
            'name' => $this->command->getName(),
            'password'=> Hash::make($this->command->getPassword()),
            'user_id' => $this->command->getUserId()
        ]);
    }
}
