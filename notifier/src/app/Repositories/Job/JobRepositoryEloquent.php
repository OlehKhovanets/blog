<?php

namespace App\Repositories\Job;

use App\Contracts\Repositories\Job\JobRepository;
use App\Models\Job;
use App\Repositories\BaseRepository;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class JobRepositoryEloquent extends BaseRepository implements JobRepository
{
    public function __construct()
    {
        $this->model = new Job;
    }
}
