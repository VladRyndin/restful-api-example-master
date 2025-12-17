<?php

namespace App\Providers;

use App\Traits\Providers\ServiceProviderTrait;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

    /**
     * @return void
     */
    public function register(): void
    {
        $facades = config('facades.facade');

        foreach ($facades as $facade => $class) {
            $this->bindSupport($facade, $class);
        }
    }
}
