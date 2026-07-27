<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Donation;
use App\Models\Location;
use App\Models\RecipientRequest;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['tenant_id', 'location_id', 'category_id', 'org_name','org_logo', 'type', 'contact_number', 'email', 'org_desc'])]
class Organization extends Model
{
    use SoftDeletes;
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tenant() : BelongsTo
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'id');
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'organization_members'
        );
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'organization_id', 'id');
    }

    public function recipientRequests(): HasMany
    {
        return $this->hasMany(RecipientRequest::class, 'organization_id', 'id');
    }
}
