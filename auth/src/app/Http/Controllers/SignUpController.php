<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Http\Requests\SingUpRequest;
use App\Services\User\Command\CreateUserCommand;
use App\User;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function signUp(SingUpRequest $request)
    {
        $request->request->set('user_id', Str::uuid()->toString());

        if (User::query()->where('email', $request->get('email'))->first()) {
            abort(422, 'exception.emailExist');
        }

        $this->handle(new CreateUserCommand($request));

        $user = User::query()->where('user_id', $request->get('user_id'))->get();
        event(new UserCreated($user));
    }
}
