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
            "SPS Admin",
            "EPS Admin",
            "PTF Admin",
            "ONG Admin",
            "RSE Admin",
         ];
      
         foreach ($roles as $role) {
              Role::create(["name" => $role]);
         }
    }
}
