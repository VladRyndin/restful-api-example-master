<?php

namespace App\Providers;

use App\Support\ApiPaginatorSupport;
use App\Support\ApiResponseSupport;
use App\Support\AppTelegramNotificationsSupport;
use App\Support\CacheSupport;
use App\Support\HttpRequestSupport;
use App\Support\LocalizationSupport;
use App\Support\SliceUrlSupport;
use App\Support\SliceTextSupport;
use App\Support\ZipSupport;
use App\Support\ExcelSupport;
use App\Support\NodeProcessesSupport;
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
