<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //$this->registerPolicies();

        // Only allow admins
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });

        // Only allow managers
        Gate::define('isStudent', function ($user) {
            return $user->role === 'student';
        });

        Gate::define('isTutor', function ($user) {
            return $user->role === 'tutor';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
