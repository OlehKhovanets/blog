<?php

namespace App\Services\User\Handler;

use App\Contracts\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Services\User\Command\CreateUserCommand;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateUserHandler
{
    protected UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepositoryEloquent();
    }

    public function handle(CreateUserCommand $command)
    {
        $this->repository->create([
            'email' => $command->getEmail(),
            'name' => $command->getName(),
            'password'=> Hash::make($command->getPassword()),
            'user_id' => $command->getUserId()
        ]);
    }
}
