<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Permission::create(['name'=>'Create-','guard_name'=>'admin']);
        // Permission::create(['name'=>'Read-','guard_name'=>'admin']);
        // Permission::create(['name'=>'Update-','guard_name'=>'admin']);
        // Permission::create(['name'=>'Delete-','guard_name'=>'admin']);
        Permission::create(['name'=>'Create-Institution','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Institution','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Institution','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Institution','guard_name'=>'admin']);

        Permission::create(['name'=>'Create-Post','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Posts','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Post','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Post','guard_name'=>'admin']);

        Permission::create(['name'=>'Create-VolunteerCategory','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-VolunteerCategory','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-VolunteerCategory','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-VolunteerCategory','guard_name'=>'admin']);

        Permission::create(['name'=>'Create-Admin','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Admins','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Admin','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Admin','guard_name'=>'admin']);


        Permission::create(['name'=>'Create-Role','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Roles','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Roles','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Roles','guard_name'=>'admin']);


        Permission::create(['name'=>'Create-Permission','guard_name'=>'admin']);
        Permission::create(['name'=>'Read-Permissions','guard_name'=>'admin']);
        Permission::create(['name'=>'Update-Permission','guard_name'=>'admin']);
        Permission::create(['name'=>'Delete-Permission','guard_name'=>'admin']);


    }
}
