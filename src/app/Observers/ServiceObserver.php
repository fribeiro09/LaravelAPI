<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Str;

class ServiceObserver
{
    /**
     * Handle the service "creating" event.
     *
     * @param  \App\Models\Service  $service
     * @return void
     */
    public function creating(Service $service)
    {
        $service->uuid = Str::uuid();
    }
}
