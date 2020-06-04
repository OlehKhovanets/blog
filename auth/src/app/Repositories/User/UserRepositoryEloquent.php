<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository;
use App\Contracts\Repositories\User\UserRepository;
use App\User;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    public function __construct()
    {
        $this->model = new User;
    }
}
