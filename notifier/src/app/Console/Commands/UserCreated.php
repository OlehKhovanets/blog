<?php

namespace App\Console\Commands;

use App\Services\UserCreated\Builder;
use Illuminate\Console\Command;
use Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Support\Facades\Log;

class UserCreated extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:created';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User created command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
            Amqp::consume('MS:Auth:User.Created', function ($message, $resolver) {
                $payload = json_decode($message->body);
                (new Builder($payload))->build();

                $resolver->acknowledge($message);
                $resolver->stopWhenProcessed();

            });
    }
}
