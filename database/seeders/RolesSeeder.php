<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Support\UserPermissions;
use App\Models\User;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesArray       = (new UserPermissions)->getRoles();
        $permissions      = (new UserPermissions)->getPermissions();
        $checkPermissions = false;
        $roles = Role::count();
        if($roles == 0) {
            foreach($rolesArray as $role) {
                $newRole = Role::create([
                    "name"          => $role,
                    "guard_name"    => "web",
                ]);
                if($checkPermissions === false) {
                    $getPermissions = [];
                    foreach ($permissions as $permission) {
                        $getPermissions[] = Permission::firstOrCreate(['name' => $permission]);
                    }
                    $checkPermissions == true;
                    $newRole->syncPermissions($getPermissions);
                }
            }
        }
        $admin = User::where([
            "email" => "admin@admin.com"
        ])->first();
        if(is_null($admin)) {
            $admin = User::create([
                'username'          =>  $rolesArray[0],
                "email"             =>  "admin@admin.com",
                "phone"             =>  "9660123456",
                'phone_verified_at' =>  \Carbon\Carbon::now(),
                'password'          =>  \Hash::make("admin@123456"),
            ]);
        }
        $admin->assignRole($rolesArray[0]);
    }
}
