<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

trait MultiTenancy {

    protected static function bootMultiTenancy()
    {
        if (auth()->check()) {
            $events = ['creating','updating'];

            foreach ($events as $event) {
                static::$event(function ($model) {
                    if (class_basename($model) !== 'Tenant') {
                        if ( is_null(auth()->user()->tenant_id) == false ) {
                            $model->tenant_id = auth()->user()->tenant_id;
                        }
                    }
                });
            }

            if (auth()->user()->role_id != 1) {
                static::addGlobalScope('tenant_id', function (Builder $builder) {
                    if (class_basename($builder->getModel()) !== 'Tenant') {
                        if ( is_null(auth()->user()->tenant_id) == false ) {
                            $builder->where('tenant_id', auth()->user()->tenant_id);
                        }
                    } else {
                        if ( is_null(auth()->user()->tenant_id) == false ) {
                            $builder->where('id', auth()->user()->id);
                        }
                    }
                });
            }
        }
    }

}
