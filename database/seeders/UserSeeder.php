<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->insert([

            [
                'created_at' => '2023-10-10',
                'email' => 'Uercdomain@gmail.com',
                'firstname' => 'Super',
                'id' => 1,
                'lastname' => 'Admin',
                'password' => Hash::make('Uercdomain123!!'),
                'phone_number' => '09398969415',
                'role' => 'Admin',
                'title' => 'Mr.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Member',

                'profile_image' => null,
            ],
            [
                'created_at' => '2023-01-25',
                'email' => 'admin@example.com',
                'firstname' => 'Admin',
                'id' => 2,
                'lastname' => 'Admin',
                'password' => Hash::make('cercuerc123!!'),
                'phone_number' => '09675789654',
                'role' => 'Admin',
                'title' => 'Mr.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Member',

                'profile_image' => null,
            ],
            [
                'created_at' => '2023-10-10',
                'email' => 'cerc@example.com',
                'firstname' => 'Cerc',
                'id' => 3,
                'lastname' => 'Cerc',
                'password' => Hash::make('Uercdomain123'),
                'phone_number' => '09297864837',
                'role' => 'CERC',
                'title' => 'Mr.',
                'colleges' => 'COS',
                'courses' => 'Biology',
                'position' => null,

                'profile_image' => null,

            ],
            [
                'created_at' => '2023-10-10',
                'email' => 'uerc-secretariat@adamson.edu.ph',
                'firstname' => 'UERC',
                'id' => 4,
                'lastname' => 'Secretariat',
                'password' => Hash::make('password123'),
                'phone_number' => '00000000000',
                'role' => 'Admin',
                'title' => 'Ms.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Secretary',

                'profile_image' => null,
            ],
            [
                'created_at' => '2023-10-10',
                'email' => 'imelda.lozano@adamson.edu.ph',
                'firstname' => 'Imelda',
                'id' => 5,
                'lastname' => 'Lozano',
                'password' => Hash::make('password123'),
                'phone_number' => '00000000000',
                'role' => 'Admin',
                'title' => 'Ms.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Chairperson',

                'profile_image' => null,
            ],
            
        ]);
    }
}
