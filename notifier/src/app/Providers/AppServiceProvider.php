<?php

namespace App\Providers;

use App\Contracts\Repositories\Job\JobRepository;
use App\Models\Job;
use App\Observers\JobObserver;
use App\Repositories\User\JobRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(JobRepository::class, JobRepositoryEloquent::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Job::observe(JobObserver::class);
    }
}
