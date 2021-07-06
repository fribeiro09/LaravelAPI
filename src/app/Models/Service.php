<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenancy;

class Service extends Model
{
    use MultiTenancy;

    protected $fillable = [
        'tenant_id', 'name', 'price', 'status'
    ];

    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'service_id', 'id');
    }
}
