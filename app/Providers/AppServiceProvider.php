<?php

namespace App\Providers;

use App\Services\ShopifyService;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //TODO: Do we use Client::class, new Foo, Foo::class
        $this->app->singleton(ShopifyService::class, function () {
            return new ShopifyService(new Client([
                'headers' => ['Content-Type' => 'application/json']
            ]));
        });
    }

    /**
     * Bootstrap any application services.
       *
     * @return void
     */
    public function boot()
    {

    }
}
