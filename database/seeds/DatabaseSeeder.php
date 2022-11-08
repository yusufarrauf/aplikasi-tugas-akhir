<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([[
            'name' => 'ADMINISTRATOR',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'user_type' => 'Admin'
        ],[
            'name' => 'Krani A',
            'username' => 'krani',
            'password' => Hash::make('krani'),
            'user_type' => 'Krani'
        ]]);
        DB::table('data_kendaraans')->insert([
            'nopol' => 'B 1234 FEH',
            'jenis' => '20 FEET',
        ]);
        DB::table('data_kranis')->insert([
            'user_id' => 2,
            'nama' => 'Krani A',
            'handphone' => '081234567890',
            'region' => 'Cilegon',
        ]);
        DB::table('data_supirs')->insert([
            'nama' => 'Supir A',
            'alamat' => 'Jakarta',
            'handphone' => '081234567890',
            'tanggal_lahir' => '2022-01-01',
            'nopol_kendaraan' => 'B 1234 FEH',
        ]);
    }
}
