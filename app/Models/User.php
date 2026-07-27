<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Delivery;
use App\Models\Organization;
use App\Models\Tenant;
use App\Models\Vehicle;
use Database\Factories\UserFactory;
use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'avatar', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(
            Organization::class,
            'organization_members'
        );
    }

    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class);
    }


    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'driver_id');
    }

    public function getTenant(Panel $panel): Collection
    {
        return $this->tenant;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->shops()->whereKey($tenant)->exists();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        return match ($panelId) {
            'dashboard' => $this->hasRole('super_admin'),
            'myshop' => $this->hasAnyRole(['shop_owner', 'super_admin']),
            'mechanic' => $this->hasAnyRole(['mechanic', 'super_admin']),
            'auth' => true,
            default => false,
        };
    }

    public function usersPanel(): string
    {
        $role = $this->getRoleNames()->first();

        return match ($role) {
            'super_admin'   => Filament::getPanel('dashboard')->getUrl(),
            'shop_owner'    => $this->getClientPanelUrl(),
            'mechanic'      => Filament::getPanel('mechanic')->getUrl(),
            'guest'         => route('home'),
            default         => route('filament.auth.auth.login'),
        };
    }


    protected function getClientPanelUrl(): string
    {
        $tenants = $this->shops;

        // if($tenants === null){
        //     return route('filament.myshop.tenant.registration');
        // }

        if ($tenants->isEmpty()) {
            return route('filament.auth.auth.login');
        }

        // If only one netShop, redirect directly
        if ($tenants->count() === 1) {
            $panel = Filament::getPanel('myshop');
            return $panel->getUrl($tenants->first());
        }

        // If multiple tenants, you could:
        // 1. Redirect to the first one
        // 2. Redirect to a tenant selection page
        // 3. Use the last accessed tenant (stored in session)

        $panel = Filament::getPanel('myshop');
        return $panel->getUrl($tenants->first());
    }

}
