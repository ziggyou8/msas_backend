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
            'admin',
            'editeur',
            'voir-list'
         ];
      
         foreach ($roles as $role) {
              Role::create(['name' => $role]);
         }
    }
}
