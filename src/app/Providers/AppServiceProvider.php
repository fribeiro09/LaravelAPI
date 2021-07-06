<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderService;
use App\Models\Service;
use App\Models\Tenant;
use App\Models\User;
use App\Observers\CustomerObserver;
use App\Observers\OrderObserver;
use App\Observers\OrderServiceObserver;
use App\Observers\ServiceObserver;
use App\Observers\TenantObserver;
use App\Observers\UserObserver;
use DB;
use Log;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Tenant::observe(TenantObserver::class);
        Customer::observe(CustomerObserver::class);
        Order::observe(OrderObserver::class);
        Service::observe(ServiceObserver::class);
        OrderService::observe(OrderServiceObserver::class);

        /*
        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });
        */
    }
}
