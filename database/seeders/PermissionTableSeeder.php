<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            "voir PTF",
            "Suprimer PTF",
            "Modifier PTF",
            
            "voir ONG",
            "Suprimer ONG",
            "Modifier ONG",

            "voir CT",
            "Suprimer CT",
            "Modifier CT",
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(["name" => $permission]);
         }
    }
}
