<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\FoodCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class FoodCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:FoodCategory');
    }

    public function view(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('View:FoodCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:FoodCategory');
    }

    public function update(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('Update:FoodCategory');
    }

    public function delete(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('Delete:FoodCategory');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:FoodCategory');
    }

    public function restore(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('Restore:FoodCategory');
    }

    public function forceDelete(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('ForceDelete:FoodCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:FoodCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:FoodCategory');
    }

    public function replicate(AuthUser $authUser, FoodCategory $foodCategory): bool
    {
        return $authUser->can('Replicate:FoodCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:FoodCategory');
    }

}