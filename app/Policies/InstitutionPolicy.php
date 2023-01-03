<?php

namespace App\Policies;

use App\Models\Institution;
use App\Models\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstitutionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(admin $admin)
    {
        return $admin->hasPermissionTo('Read-Institutions')
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
    public function view(admin $admin , Institution $institution)
    {
        return $admin->hasPermissionTo('Read-Institutions')|| $admin->hasPermissionTo('Show-Institutions')
        ? $this->allow()
        : $this->deny('Don\'t have Permission',403);
    }
    // public function view_all(admin $admin , Institution $institution)
    // {
    //     return
    //     ? $this->allow()
    //     : $this->deny('Don\'t have Permission',403);
    // }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(admin $admin )
    {
        return $admin->hasPermissionTo('Create-Institution')
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
    public function update(admin $admin, Institution $institution)
    {
        return $admin->hasPermissionTo('Update-Institution')
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
    public function delete(admin $admin, Institution $institution)
    {
        return $admin->hasPermissionTo('Delete-Institution')
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
    public function restore( admin $admin, Institution $institution)
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
    public function forceDelete(admin $admin, Institution $institution)
    {
        //
    }
}
