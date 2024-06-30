<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' =>'Admin']);
        Role::create(['name' =>'Utilizador']);
        Role::create(['name' =>'SuperAdmin']);

        //faz com que o "SuperAdmin" tenha todas as permissões
        $role = Role::findByName('SuperAdmin');
        $role->givePermissionTo('Criar');
        $role->givePermissionTo('Editar');
        $role->givePermissionTo('Eliminar');
    }
}
