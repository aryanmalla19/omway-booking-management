<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            RoomSeeder::class,
        ]);

        $userRoleId = Role::query()->where('name', 'user')->first();
        $adminRoleId = Role::query()->where('name', 'admin')->first();


        // ADMIN
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role_id' => $adminRoleId,
        ]);

        // TEST USER
        User::factory()->create([
            'name' => 'TEST',
            'email' => 'test@test.com',
            'role_id' => $userRoleId,
        ]);
    }
}
