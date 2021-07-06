<?php

namespace App\Observers;

use App\Models\Customer;
use Illuminate\Support\Str;

class CustomerObserver
{
    /**
     * Handle the customer "creating" event.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function creating(Customer $customer)
    {
        $customer->uuid = Str::uuid();
    }
}
