<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
           
        //     //Cusomter
        //     [
        //     'first_name' => 'test',
        //     'last_name' => 'customer',
        //     'gender' => 'male',
        //     'company_name' =>'test Company',
        //     'country_id' => -1,
        //     'province_id' => -1,
        //     'postcode' =>'0007852',
        //     'phone' => '45212547',
        //     'city' => 'test City',
        //     'street_address' => 'test Address',
        //     'email' => 'test@test.com',
        //     'role' => 'landlord',
        //     'password' => Hash::create('asdf'),
        //     'status' => 1
        // ],
    
        // ]);

        \App\Models\User::factory(50)->create();
    }
}
