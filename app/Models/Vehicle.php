<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tenant_id', 'user_id', 'vehicle_type_id', 'capacity_kg', 'plate_no'])]
class Vehicle extends Model
{
    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vehicleType() : BelongsTo
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id', 'id');
    }

}
