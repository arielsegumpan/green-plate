<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $roles = [
            'super_admin',
            'donor',
            'recipient',
            'both',
            'driver',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        $admin = User::updateOrCreate(
            ['email' => 'aye@gmail.com'],
            [
                'name' => 'aye',
                'password' => Hash::make('qwerty12345'),
                'email_verified_at' => now(),
            ]
        );

        $admin->syncRoles('super_admin');
    }
}
