<?php

namespace App\Models;

use App\Models\Donation;
use App\Models\Organization;
use App\Models\RouteWaypoint;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'organization_id',
    'address',
    'city',
    'province',
    'zipcode',
    'latitude',
    'longitude'
])]
class Location extends Model
{

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
        ];
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(
            Donation::class,
            'pickup_location_id'
        );
    }

    public function routeWaypoints(): HasMany
    {
        return $this->hasMany(RouteWaypoint::class, 'location_id', 'id');
    }
}
