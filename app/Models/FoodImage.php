<?php

namespace App\Models;

use App\Models\DonationItem;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['tenant_id', 'donation_item_id', 'img_path', 'img_alt' ])]
class FoodImage extends Model
{
    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function donationItem() : BelongsTo
    {
        return $this->belongsTo(DonationItem::class, 'donation_item_id', 'id');
    }
}
