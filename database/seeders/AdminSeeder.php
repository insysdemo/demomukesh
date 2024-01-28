<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $superadmin_role = Role::updateOrCreate(['name' => 'SuperAdmin']);
        $hradmin_role = Role::updateOrCreate(['name' => 'Group HR']);

        $superadmin = User::updateOrCreate([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
            'roles_id' => $superadmin_role->id,
        ], [
            'password' => bcrypt('password'),
        ]);

        $hradmin = User::updateOrCreate([
            'name' => 'Hr Admin',
            'email' => 'hradmin@gmail.com',
            'roles_id' => $hradmin_role->id,
        ], [
            'password' => bcrypt('password'),
        ]);


        $permition = Permission::updateOrCreate(['name' => 'Role access'], ['role_name' => 'Role']);
        $permition = Permission::updateOrCreate(['name' => 'Role delete'], ['role_name' => 'Role']);
        $permition = Permission::updateOrCreate(['name' => 'Role edit'], ['role_name' => 'Role']);
        $permition = Permission::updateOrCreate(['name' => 'Role create'], ['role_name' => 'Role']);


        $permition = Permission::updateOrCreate(['name' => 'Permission access'], ['role_name' => 'Permission']);
        $permition = Permission::updateOrCreate(['name' => 'Permission edit'], ['role_name' => 'Permission']);
        $permition = Permission::updateOrCreate(['name' => 'Permission delete'], ['role_name' => 'Permission']);
        $permition = Permission::updateOrCreate(['name' => 'Permission create'], ['role_name' => 'Permission']);

        $permition = Permission::updateOrCreate(['name' => 'Rolehaspermission access'], ['role_name' => 'Rolehaspermission']);
        $permition = Permission::updateOrCreate(['name' => 'Rolehaspermission edit'], ['role_name' => 'Rolehaspermission']);

        $superadmin->assignRole($superadmin_role);
        $hradmin->assignRole($hradmin_role);


        $superadmin_role->givePermissionTo(Permission::all());
    }
}
