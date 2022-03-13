<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\User'    => 'App\Policies\UserPolicy',
        'App\Models\Brand'   => 'App\Policies\BrandPolicy',
        'App\Models\Store'   => 'App\Policies\StorePolicy',
        'App\Models\Journal' => 'App\Policies\JournalPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
