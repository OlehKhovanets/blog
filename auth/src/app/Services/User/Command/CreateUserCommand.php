<?php

namespace App\Services\User\Command;

use Illuminate\Http\Request;

class CreateUserCommand
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getEmail() : string
    {
        return $this->request->get('email');
    }

    public function getPassword() : string
    {
        return $this->request->get('password');
    }

    public function getName() : string
    {
        return $this->request->get('name');
    }

    public function getUserId() : string
    {
        return $this->request->get('user_id');
    }
}
