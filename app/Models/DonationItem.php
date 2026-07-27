<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['tenant_id', 'donation_id', 'food_category_id', 'food_name', 'food_desc', 'quantity', 'unit', 'expires_at'])]
class DonationItem extends Model
{
    use SoftDeletes;

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function donation() : BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }

    public function foodCategory() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'food_category_id', 'id');
    }

    public function foodImages() : HasMany
    {
        return $this->hasMany(FoodImage::class, 'donation_item_id', 'id');
    }
}
