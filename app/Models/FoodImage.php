<?php

namespace App\Models;

use App\Models\DonationItem;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['organization_id', 'donation_item_id', 'img_path', 'img_alt' ])]
class FoodImage extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function donationItem() : BelongsTo
    {
        return $this->belongsTo(DonationItem::class, 'donation_item_id', 'id');
    }
}
