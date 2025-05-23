<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'VERIFY_USERS',
                'description' => 'Permission to verify users',
            ],
            [
                'name' => 'ASSIGN_PERMISSIONS',
                'description' => 'Permission to assign permissions to users',
            ],
            [
                'name' => 'ADMIN_PERMISSIONS',
                'description' => 'Permission to manage admin panel',
            ]
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']], // Condiciones para buscar
                [
                    'description' => $permission['description'],
                    'updated_at' => Carbon::now(),
                    'created_at' => Carbon::now(), // Opcional; Laravel lo ignora si ya existe
                ]
            );
        }
    }
}
