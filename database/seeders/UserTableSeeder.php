<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create Admin
        $user = User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        //get all permissions
        $admin_permissions = Permission::all();

        //get role admin
        $admin_role = Role::find(1);

        //assign permission to role
        $admin_role->syncPermissions($admin_permissions);

        //assign role to user
        $user->assignRole($admin_role);


        // create Cashier
        $user = User::create([
            'name'      => 'Chasier',
            'email'     => 'cashier@gmail.com',
            'password'  => bcrypt('password'),
        ]);


        //get all permissions
        $cashier_permissions = Permission::where('name', 'transactions.index')->get();

        //get role cashier
        $role_cashier = Role::find(2);

        //assign permission to role
        $role_cashier->syncPermissions($cashier_permissions);

        //assign role to user
        $user->assignRole($role_cashier);
    }
        
    
}
