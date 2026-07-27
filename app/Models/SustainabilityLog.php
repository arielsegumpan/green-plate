<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['tenant_id', 'delivery_id', 'food_saved_kg', 'co2_saved_kg', 'meals_served', 'fuel_saved_liters'])]
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
}
