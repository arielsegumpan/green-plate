<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['organization_id', 'donation_id', 'food_category_id', 'food_name', 'food_imgs', 'food_desc', 'quantity', 'unit', 'temperature_required', 'estimated_meals', 'prepared_at', 'expires_at'])]
class DonationItem extends Model
{
    use SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'food_imgs' => 'array',
        ];
    }

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function donation() : BelongsTo
    {
        return $this->belongsTo(Donation::class, 'donation_id', 'id');
    }


    public function foodCategory() : BelongsTo
    {
        return $this->belongsTo(FoodCategory::class, 'food_category_id', 'id');
    }
}
