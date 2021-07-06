<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenancy;

class OrderService extends Model
{
    use MultiTenancy;

    protected $fillable = [
        'tenant_id', 'order_id', 'service_id', 'quantity', 'price', 'status'
    ];

    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
