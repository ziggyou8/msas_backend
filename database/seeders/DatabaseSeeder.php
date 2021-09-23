<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application"s database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CollectiviteTableSeeder::class);
        $this->command->info("Collectivite table seeded!");

        $this->call(CreateAdminUserSeeder::class);
        $this->command->info("AdminUser table seeded!");

        $this->call(CreateRoleSeeder::class);
        $this->command->info("Rôle table seeded!");

        $this->call(PermissionTableSeeder::class);
        $this->command->info("Permission table seeded!");

    }
}
