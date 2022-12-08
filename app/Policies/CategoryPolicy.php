<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\admin;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user, Category $category)
    {
        return $user->hasPermissionTo('Read-VolunteerCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Category $category)
    {
        return $user->hasPermissionTo('Read-VolunteerCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-VolunteerCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Category $category)
    {
        return $user->hasPermissionTo('Update-VolunteerCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Category $category)
    {
        return $user->hasPermissionTo('Delete-VolunteerCategory')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Category $category)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\admin  $admin
     * @param  \App\Models\Institution  $institution
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Category $category)
    {
        //
    }
}
