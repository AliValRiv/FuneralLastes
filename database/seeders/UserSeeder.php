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
            'password' => Hash::make('615243'),
        ]);

        DB::table('users')->insert([
            'name' => "Jorge Zamarrón",
            'email' => "zamarrong@gmail.com",
            'mobile' => '6251011694',
            'company_id' => 1,
            'admin' => true,
            'password' => Hash::make('123456'),
        ]);
    }
}
