<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenancy;

class Tenant extends Model
{
    use MultiTenancy;

    protected $fillable = [
        'name', 'document_number', 'email', 'status'
    ];

    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'tenant_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'tenant_id', 'id');
    }

    public function orderServices()
    {
        return $this->hasMany(OrderService::class, 'tenant_id', 'id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'tenant_id', 'id');
    }
}
