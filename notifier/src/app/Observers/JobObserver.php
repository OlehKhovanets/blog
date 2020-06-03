<?php

namespace App\Observers;

use App\Models\Job;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class JobObserver
{
    /**
     * Handle the job "created" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function created(Job $job)
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json'
        ])
            ->post(sprintf('%s/api/mail/send', env('MICROSERVICE_MAILER', "http://nginx_mailer")), [
                'email' => $job->email
            ]);

        if(isset(\GuzzleHttp\json_decode($response->body())->code)) {
            if(\GuzzleHttp\json_decode($response->body())->code !== 200) {
                Log::info($response->body());
                die();
            }
        }
    }

    /**
     * Handle the job "updated" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function updated(Job $job)
    {
        //
    }

    /**
     * Handle the job "deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function deleted(Job $job)
    {
        //
    }

    /**
     * Handle the job "restored" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function restored(Job $job)
    {
        //
    }

    /**
     * Handle the job "force deleted" event.
     *
     * @param  \App\Models\Job  $job
     * @return void
     */
    public function forceDeleted(Job $job)
    {
        //
    }
}
