<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
     User::create([
        'name'=>'lolita',
        'email'=>'admin123@admin.com',
        'password'=>Hash::make('123')
     ])->assignRole('administrador');




        User::create([
            'name'=>'adminsitrador',
            'email'=>'administrador@gmail.com',
            'password'=>Hash::make('123'),
        ])->assignRole('admin');
        User::create([
            'name'=>'usuario',
            'email'=>'usuario@gmail.com',
            'password'=>Hash::make('123'),
        ])->assignRole('usuario');

    }
}
