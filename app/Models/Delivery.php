<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'tenant_id',
    'match_id',
    'driver_id',
    'distance',
    'duration',
    'status',
    'assigned_at',
    'picked_up_at',
    'completed_at',
])]
class Delivery extends Model
{
    protected function casts(): array
    {
        return [
            'distance' => 'decimal:2',
            'assigned_at' => 'datetime',
            'picked_up_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    /**
     * The tenant that owns this delivery.
     */
    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    /**
     * The matched donation request.
     */
    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchRequest::class, 'match_id');
    }

    /**
     * The assigned volunteer/driver.
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Route generated for this delivery.
     */
    public function route(): HasOne
    {
        return $this->hasOne(Route::class, 'delivery_id', 'id');
    }

    /**
     * Sustainability analytics for this delivery.
     */
    public function sustainabilityLog(): HasOne
    {
        return $this->hasOne(SustainabilityLog::class, 'delivery_id', 'id');
    }

    /**
     * Delivery status history.
     */
    public function statusLogs(): HasMany
    {
        return $this->hasMany(DeliveryStatusLog::class, 'delivery_id', 'id');
    }
}
