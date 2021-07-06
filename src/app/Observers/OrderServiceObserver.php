<?php

namespace App\Observers;

use App\Models\OrderService;
use Illuminate\Support\Str;

class OrderServiceObserver
{
    /**
     * Handle the order service "creating" event.
     *
     * @param  \App\Models\OrderService  $orderService
     * @return void
     */
    public function creating(OrderService $orderService)
    {
        $orderService->uuid = Str::uuid();
    }
}
