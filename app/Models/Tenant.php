<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['name', 'slug', 'email', 'phone', 'domain', 'logo', 'status', 'settings'])]
class Tenant extends Model
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
            'settings' => 'array',
        ];
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'tenant_id', 'id');
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, 'tenant_id', 'id');
    }

    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'tenant_id', 'id');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'tenant_id', 'id');
    }

    public function recipientRequests(): HasMany
    {
        return $this->hasMany(RecipientRequest::class, 'tenant_id', 'id');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'tenant_id', 'id');
    }

    public function sustainabilityLogs(): HasMany
    {
        return $this->hasMany(SustainabilityLog::class, 'tenant_id', 'id');
    }

    public function routes(): HasMany
    {
        return $this->hasMany(Route::class, 'tenant_id', 'id');
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'tenant_id', 'id');
    }

    public function foodCategories(): HasMany
    {
        return $this->hasMany(FoodCategory::class, 'tenant_id', 'id');
    }

    public function foodImages(): HasMany
    {
        return $this->hasMany(FoodImage::class, 'tenant_id', 'id');
    }

    public function vehicles() : HasMany
    {
        return $this->hasMany(Vehicle::class, 'tenant_id', 'id');
    }

    public function vehicleTypes() : HasMany
    {
        return $this->hasMany(VehicleType::class, 'tenant_id', 'id');
    }

    public function matchRequests() : HasMany
    {
        return $this->hasMany(MatchRequest::class, 'tenant_id', 'id');
    }

    public function deliveryStatusLogs() : HasMany
    {
        return $this->hasMany(DeliveryStatusLog::class, 'tenant_id', 'id');
    }

    public function organizationMembers() : HasMany
    {
        return $this->hasMany(OrganizationMember::class, 'tenant_id', 'id');
    }
}
