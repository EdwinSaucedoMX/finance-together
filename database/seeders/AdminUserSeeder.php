<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('adminexample123'),
                'email_verified_at' => Carbon::now(),
            ]
        );

        $permissions = Permission::all();

        $user->permissions()->sync($permissions->pluck('id')->toArray());
    }
}
