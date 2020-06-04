<?php

namespace App\Http\Controllers;

use App\Http\Requests\SingInRequest;
use App\Traits\Responsible;
use App\User;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    use Responsible;

    public function signIn(SingInRequest $request)
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            abort(401);
        }
        $user = User::all()->where('email', $request->email)->first();

        //trait Responsible
        return $this->response(200, '', [
            'users' => [
                'access_token' => $user->createToken('authToken')->plainTextToken,
                'token_type' => 'Bearer'
            ]
        ]);
    }
}
