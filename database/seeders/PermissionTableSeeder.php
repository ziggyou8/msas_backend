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
            "Ajouter structure",
            "Voir list structure",
            "Suprimer structure",
            "Modifier structure",

            "Ajouter investissement",
            "Modifier investissement",
            "Voir list investissement",
            "Valider investissement",
            "Rejetter investissement",

            "Ajouter utilisateur",
            "Ajouter point focal",
            "Modifier utilisateur",
            "Voir list utilisateur",
            "Suprimer utilisateur",
            "Activer utilisateur",

             "Modifier role",

            
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(["name" => $permission]);
         }
    }
}
