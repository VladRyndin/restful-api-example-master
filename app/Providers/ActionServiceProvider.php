<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Traits\Providers\ServiceProviderTrait;

class ActionServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        $actions = config('actions_providers.users_actions');

        foreach ($actions as $contract => $implementation) {
            $this->app->bind($contract, fn() => $this->makeAction($implementation));
        }
    }
}
