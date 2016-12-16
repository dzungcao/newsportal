<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ModelObserver;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*\App\Models\Question::observe(new ModelObserver());
        \App\Models\Challenge::observe(new ModelObserver());
        \App\Models\Attachment::observe(new ModelObserver());*/
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
