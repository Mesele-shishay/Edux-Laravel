<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        if (alreadyInstalled()) {
            $school_data = [
                "school_sessions" => \App\Models\SchoolSession::all(),
                "current_school_session" => \App\Models\SchoolSession::latest()
                    ->first(),
                "current_school_session_id" => \App\Models\SchoolSession::latest()
                    ->first() ? \App\Models\SchoolSession::latest()->first() : (object) ['id' => 0],
                'latest_school_session_id'  => \App\Models\SchoolSession::latest()
                    ->first() ? \App\Models\SchoolSession::latest()->first() : (object) ['id' => 0],
            ];
            foreach ($school_data as $key => $value) {
                View::share($key,$value);
            }

        }
    }
}
