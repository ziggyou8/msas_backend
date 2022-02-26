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
          "adminStructure"  =>   [
              "name" => "Admin_structure",
              "libelle" => "Admin structure",
             ],
          "PointFocal"  => [
                "name" => "Point_focal",
                "libelle" => "Point Focal",
             ],
         ];
      
         foreach ($roles as $role) {
              Role::create(["name" => $role["name"], "libelle" => $role["libelle"]]);
         }
    }
}
