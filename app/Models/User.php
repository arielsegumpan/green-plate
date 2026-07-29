<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Delivery;
use App\Models\Organization;
use App\Models\Vehicle;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

#[Fillable(['name', 'avatar', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser, HasTenants
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

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
        return $this->belongsToMany(Organization::class, 'organization_user', 'user_id', 'organization_id');
    }

    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class);
    }

    public function organizationMember(): HasOne
    {
        return $this->hasOne(OrganizationMember::class, 'user_id', 'id');
    }


    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'driver_id');
    }

    public function getTenants(Panel $panel): Collection
    {
        return $this->organizations;
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $this->organizations()->whereKey($tenant)->exists();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        $panelId = $panel->getId();

        return match ($panelId) {
            'dashboard' => $this->hasRole('super_admin'),
            'organization' => $this->hasAnyRole(['donor', 'recipient', 'super_admin', 'both']),
            // 'driver' => $this->hasAnyRole(['driver', 'super_admin']),
            'auth' => true,
            default => false,
        };
    }

    public function usersPanel(): string
    {
        $role = $this->getRoleNames()->first();

        return match ($role) {
            'super_admin'    => Filament::getPanel('dashboard')->getUrl(),
            'donor'          => $this->getClientPanelUrl(),
            'recipient'      => $this->getClientPanelUrl(),
            'both'           => $this->getClientPanelUrl(),
            'driver'         => route('driver.page'),
            default          => route('filament.auth.auth.login'),
        };
    }


    protected function getClientPanelUrl(): string
    {
        $orgs = $this->organizations;

        if ($orgs->isEmpty()) {
            return route('filament.auth.auth.login');
        }

        // If only one org, redirect directly
        if ($orgs->count() === 1) {
            $panel = Filament::getPanel('organization');
            return $panel->getUrl($orgs->first());
        }

        // If multiple tenants, you could:
        // 1. Redirect to the first one
        // 2. Redirect to a tenant selection page
        // 3. Use the last accessed tenant (stored in session)

        $panel = Filament::getPanel('organization');
        return $panel->getUrl($orgs->first());
    }

}
