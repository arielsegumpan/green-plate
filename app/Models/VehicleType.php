<?php

namespace App\Models;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tenant_id', 'type_name', 'type_desc'])]
class VehicleType extends Model
{
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function vehicles() : HasMany
    {
        return $this->hasMany(Vehicle::class, 'vehicle_type_id', 'id');
    }
}
