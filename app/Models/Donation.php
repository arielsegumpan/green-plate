<?php

namespace App\Models;

use App\Models\DonationItem;
use App\Models\Location;
use App\Models\MatchRequest;
use App\Models\Organization;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable(['organization_id', 'pickup_location_id', 'reference_no', 'available_from', 'expires_at', 'status'])]
class Donation extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function pickupLocation() : BelongsTo
    {
        return $this->belongsTo(Location::class, 'pickup_location_id', 'id');
    }

    public function donationItems() : HasMany
    {
        return $this->hasMany(DonationItem::class, 'donation_id', 'id');
    }

    public function matchRequests() : HasMany
    {
        return $this->hasMany(MatchRequest::class, 'donation_id', 'id');
    }
}
