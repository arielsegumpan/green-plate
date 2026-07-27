<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['organization_id', 'cat_name', 'cat_desc'])]
class Category extends Model
{
    public function organization() : BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
    public function organizations() : HasMany
    {
        return $this->hasMany(Organization::class, 'category_id', 'id');
    }
}
