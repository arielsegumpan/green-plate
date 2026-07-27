<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['organization_id', 'user_id', 'vehicle_type_id', 'capacity_kg', 'plate_no'])]
class Vehicle extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
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
