<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Country;
use App\Models\State;
use App\Models\School;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Roles
        $SuperAdminRole =  Role::create(['name' => 'Super Admin', 'display_name' => 'Super Admin']);
        // Role::create(['name' => 'Admin']);
        // Role::create(['name' => 'School Admin']);
        // Role::create(['name' => 'Counsellor']);
        // Role::create(['name' => 'Student']);
        // Role::create(['name' => 'Developer']);

        $permissionGroups = [
            'User Management' => [
                'user-list'      => 'User List',
                'user-create'    => 'User Create',
                'user-edit'      => 'User Edit',
                'user-delete'    => 'User Delete',
            ],

            'Country Management' => [
                'country-list'      => 'Country List',
                'country-create'    => 'Country Create',
                'country-edit'      => 'Country Edit',
                'country-delete'    => 'Country Delete',
            ],

            'State Management' => [
                'state-list'      => 'State List',
                'state-create'    => 'State Create',
                'state-edit'      => 'State Edit',
                'state-delete'    => 'State Delete',
            ],

            'Role Management' => [
                'role-list'      => 'Role List',
                'role-create'    => 'Role Create',
                'role-edit'      => 'Role Edit',
                'role-delete'    => 'Role Delete',
            ],

            'Permission Management' => [
                'permission-list'      => 'Permission List',
                'permission-create'    => 'Permission Create',
                'permission-edit'      => 'Permission Edit',
                'permission-delete'    => 'Permission Delete',
            ],

            'School Management' => [
                'school-list'      => 'School List',
                'school-create'    => 'School Create',
                'school-edit'      => 'School Edit',
                'school-delete'    => 'School Delete',
            ],

            'Class Management' => [
                'class-list'      => 'Class List',
                'class-create'    => 'Class Create',
                'class-edit'      => 'Class Edit',
                'class-delete'    => 'Class Delete',
            ],

            'Subject Management' => [
                'subject-list'      => 'Subject List',
                'subject-create'    => 'Subject Create',
                'subject-edit'      => 'Subject Edit',
                'subject-delete'    => 'Subject Delete',
            ],

        ];

        foreach ($permissionGroups as $permissionGroup => $permissions) {
            $group = PermissionGroup::create(['name' => $permissionGroup]);
            foreach ($permissions as $permission => $displayName) {
                $permission = Permission::create([
                    'name' => $permission,
                    'display_name' => $displayName,
                    'group_id' => $group->id
                ]);
            }
        }



        $permission = Permission::pluck('id')->toArray();

        // Sample Users
        $superAdmin = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadmin@example.com',
            'password' => bcrypt('password'),
        ]);
        $superAdmin->assignRole('Super Admin');



        $SuperAdminRole->syncPermissions($permission);
    }
}
