<?php

namespace App\Models;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['organization_id', 'delivery_id', 'food_saved_kg', 'co2_saved_kg', 'meals_served', 'fuel_saved_liters', 'distance_travelled_km', 'food_waste_diverted_kg', 'trees_equivalent', 'carbon_score',])]
class SustainabilityLog extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'meals_served' => 'integer',
            'food_saved_kg' => 'float',
            'co2_saved_kg' => 'float',
            'fuel_saved_liters' => 'float',
        ];
    }

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }
}
