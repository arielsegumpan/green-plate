<?php

namespace App\Models;

use App\Enums\DonationStatusEnums;
use App\Models\DonationItem;
use App\Models\MatchRequest;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable(['organization_id', 'name', 'pickup_location', 'reference_no', 'available_from', 'expires_at', 'status'])]
class Donation extends Model
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'pickup_location' => 'array',
            'status' => DonationStatusEnums::class,
        ];
    }

    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
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
