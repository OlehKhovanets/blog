<?php

namespace App\Services\Job\Handler;

use App\Contracts\Repositories\Job\JobRepository;
use App\Repositories\Job\JobRepositoryEloquent;
use App\Services\EventNames;
use App\Services\Job\Command\CreateJobCommand;

class CreateJobHandler
{
    protected JobRepository $repository;

    public function __construct()
    {
        $this->repository = new JobRepositoryEloquent();
    }

    public function handle(CreateJobCommand $command)
    {
        $this->repository->create([
            'email' => $command->getEmail(),
            'eventName' => EventNames::USER_CREATED,
            'name' => $command->getName(),
            'user_id' => $command->getUserId()
        ]);
    }
}
