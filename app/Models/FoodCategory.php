<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['tenant_id', 'name', 'co2_factor', 'meal_ratio'])]
class FoodCategory extends Model
{
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function donationItems() : HasMany
    {
        return $this->hasMany(DonationItem::class, 'food_category_id', 'id');
    }
}
