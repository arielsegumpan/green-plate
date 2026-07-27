<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['organization_id', 'type_name', 'type_desc'])]
class VehicleType extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function vehicles() : HasMany
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id', 'id');
    }
}
