<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenancy;

class Order extends Model
{
    use MultiTenancy;

    protected $fillable = [
        'tenant_id', 'customer_id', 'date', 'status', 'type', 'observation'
    ];

    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'order_id', 'id');
    }
}
