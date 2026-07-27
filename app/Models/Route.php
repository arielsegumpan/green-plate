<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'organization_id',
    'delivery_id',
    'routing_engine',
    'total_distance',
    'estimated_time',
    'actual_distance',
    'actual_time',
    'polyline',
])]
class Route extends Model
{
    protected function casts(): array
    {
        return [
            'total_distance' => 'decimal:2',
            'estimated_time' => 'integer',
            'polyline' => 'array',
        ];
    }

    /**
     * The tenant that owns this route.
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    /**
     * The delivery associated with this route.
     */
    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class, 'delivery_id', 'id');
    }

    /**
     * Route waypoints (pickup/drop-off sequence).
     */
    public function waypoints(): HasMany
    {
        return $this->hasMany(RouteWaypoint::class, 'route_id', 'id');
    }
}
