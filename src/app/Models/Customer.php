<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MultiTenancy;

class Customer extends Model
{
    use MultiTenancy;

    protected $fillable = [
        'tenant_id', 'name', 'document_number', 'zipcode', 'address', 'complement', 'district', 'city', 'state', 'cellular', 'email', 'status'
    ];

    protected $hidden = [
         'uuid', 'created_at', 'updated_at'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
}
