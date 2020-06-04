<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\User\UserRepository;
use App\Events\UserCreated;
use App\Http\Requests\SingUpRequest;
use App\Services\User\Command\CreateUserCommand;
use App\User;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signUp(SingUpRequest $request)
    {
        $request->request->set('user_id', Str::uuid()->toString());
        $this->handle(new CreateUserCommand($request));

        $user = $this->userRepository->findWhere(['user_id' => $request->get('user_id')])->first();
//        $user = User::query()->where('user_id', $request->get('user_id'))->get();
        event(new UserCreated($user));
    }
}
