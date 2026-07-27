<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'organization_id',
    'route_id',
    'location_id',
    'sequence',
    'type',
])]
class RouteWaypoint extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    
    /**
     * Route that owns this waypoint.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Pickup or drop-off location.
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
