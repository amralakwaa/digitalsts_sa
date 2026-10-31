<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Global administrative access gate
        Gate::define('access-admin', function (User $user) {
            return $user->isAdmin();
        });

        // Granular administration capability gates
        Gate::define('manage-services', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-projects', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-quotes', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-messages', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('manage-articles', function (User $user) {
            return $user->isAdmin();
        });
    }
}
