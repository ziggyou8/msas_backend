<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "prenom" => "Admin", 
            "nom" => "System",
            "telephone" => "77 777 77 77",
            "email" => "admin@gmail.com",
            "password" => bcrypt("passer")
        ]);
    
        $role = Role::create(["name" => "Admin_DPRS", "libelle"=> "Admin DPRS"]);
     
        $user2 = User::create([
            "prenom" => "Admin", 
            "nom" => "EPS",
            "telephone" => "78 888 88 88",
            "email" => "admin_EPS@gmail.com",
            "password" => bcrypt("passer")
        ]);
    
        $role2 = Role::create(["name" => "Directeur_EPS", "libelle"=> "Directeur des EPS"]);
     
        $permissions = Permission::pluck("id")->all();
   
        $role->syncPermissions($permissions);
     
        $user->assignRole("Admin_DPRS");
        $user2->assignRole("Directeur_EPS");
    }
}
