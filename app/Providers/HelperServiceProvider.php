<?php

namespace App\Providers;

use App\Traits\Providers\ServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;
    /**
     * Register services.
     */
    public function register(): void
    {
        $helpers = config('helpers.user_helpers', []);

        foreach ($helpers as $contract => $implementation) {
            $this->app->bind($contract, fn() => $this->makeAction($implementation));
        }
    }
}
