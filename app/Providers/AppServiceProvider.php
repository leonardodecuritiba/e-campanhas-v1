<?php

namespace App\Providers;

use App\Models\HumanResources\Settings\Group;
use App\Models\HumanResources\Voter;
use App\Models\HumanResources\User;
use App\Observers\HumanResources\VoterObserver;
use App\Observers\HumanResources\Settings\GroupObserver;
use App\Observers\Users\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe( UserObserver::class );
        Voter::observe( VoterObserver::class );
        Group::observe( GroupObserver::class );
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
