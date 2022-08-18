<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin ver todo
        //usuario solo visualizacion la lista de usuarios
        $admin = Role::create(['name' => 'admin']);
        $usuario = Role::create(['name' => 'usuario']);
        $permission = Permission::create(['name' => 'user.index'])->syncRoles([$admin,$usuario]);
        $permission = Permission::create(['name' => 'user.create'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'user.edit'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'user.update'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'user.show'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'user.store'])->syncRoles([$admin]);
        $permission = Permission::create(['name' => 'user.destroy'])->syncRoles([$admin]);






       $admin=Role::create(["name"=>'admin']);
       $usuario=Role::create(["name"=>'usuario']);
       Permission::create(["name"=>'user'])->syncRoles([$admin,$usuario]);
       Permission::create(["name"=>'profile.edit'])->syncRoles([$admin,$usuario]);
       Permission::create(["name"=>'profile.update'])->syncRoles([$admin,$usuario]);
       Permission::create(["name"=>'profile.password'])->syncRoles([$admin]);







       



    }
}
