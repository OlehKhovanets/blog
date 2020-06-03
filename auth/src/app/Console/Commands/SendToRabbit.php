<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bschmitt\Amqp\Facades\Amqp;
use Illuminate\Support\Facades\Log;

class SendToRabbit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rabbitmq:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
//        \Amqp::consume('queue-name', function ($message, $resolver) {
//            var_dump($message->body);
//            $resolver->acknowledge($message);
//        }, [
//            'exchange' => 'amq.fanout',
//            'exchange_type' => 'fanout',
//            'queue_force_declare' => true,
//            'queue_exclusive' => true,
//            'persistent' => true // required if you want to listen forever
//        ]);
//        while (true) {
            Amqp::consume('MS:Auth:User.Created', function ($message, $resolver) {
                $result = json_decode($message->body);
//            var_dump($message->body);
                Log::info($result->email);
                $resolver->acknowledge($message);

                $resolver->stopWhenProcessed();

            });

//            sleep(1);
//        }


    }
}
