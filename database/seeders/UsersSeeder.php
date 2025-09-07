<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('model_has_roles')->delete();
        DB::table('roles')->delete();
        User::truncate();

        $roles = [
            'page manager',
            'job vacancy manager',
            'super admin',
            'developer'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name'=> 'web',]);
        }

        $users = [
            [
                'name' => 'Admin Postingan',
                'email' => 'admin_postingan@jiipe.com',
                'password' => Hash::make("pass12345"),
            ],
            [
                'name' => 'Admin Loker',
                'email' => 'admin_loker@jiipe.com',
                'password' => Hash::make("pass12345"),
            ],
            [
                'name' => 'Admin Jiipe',
                'email' => 'Info@jiipe.com',
                'password' => Hash::make("pass12345"),
            ],
            [
                'name' => 'Irvan Muhammad S',
                'email' => 'irvansindy7@gmail.com',
                'password' => Hash::make("joykowi132"),
            ]
        ];

        for ($i=0; $i < count($users); $i++) { 
            $create_user = User::create($users[$i]);
            $create_user->assignRole($roles[$i]);
        }
    }
}
