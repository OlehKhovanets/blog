<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendEmailRequest;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        Mail::send([], [], function ($message) use ($request) {
            $message->to($request->get('email'))
                ->subject('blabla')
                ->setBody('Hi, welcome user!');
        });
        return ['message' => 'mail sent'];
    }
}
