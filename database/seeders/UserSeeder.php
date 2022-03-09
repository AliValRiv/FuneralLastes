<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Alí Valenzuela",
            'email' => "adan.valenzuela@alciscorp.com",
            'mobile' => '6251272842',
            'company_id' => 1,
            'admin' => true,
            'priv' => 'ad',
            'password' => Hash::make('615243'),
        ]);

        DB::table('users')->insert([
            'name' => "Jorge Zamarrón",
            'email' => "zamarrong@gmail.com",
            'mobile' => '6251011694',
            'company_id' => 1,
            'admin' => true,
            'priv' => 'ad',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'name' => "Luis Rodríguez",
            'email' => "luis.rodriguez@alciscorp.com",
            'mobile' => '5530281270',
            'company_id' => 1,
            'admin' => true,
            'priv' => 'ad',
            'password' => Hash::make('12345678'),
        ]);
    }
}
