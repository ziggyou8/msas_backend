<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            "PTF",
            "ONG",
            "CT"
         ];
      
         foreach ($roles as $role) {
              Role::create(["name" => $role]);
         }
    }
}
