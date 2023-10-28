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
                'password' => Hash::make('superadmin'),
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
                'password' => Hash::make('adminadmin'),
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
                'password' => Hash::make('cerccerc'),
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
                'email' => 'sampleadmin1@gmail.com',
                'firstname' => 'Ryan',
                'id' => 4,
                'lastname' => 'Kelly',
                'password' => Hash::make('sample123'),
                'phone_number' => '00000000000',
                'role' => 'Admin',
                'title' => 'Mr.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Secretary',

                'profile_image' => null,
            ],
            [
                'created_at' => '2023-10-10',
                'email' => 'sampleadmin2@gmail.com',
                'firstname' => 'John',
                'id' => 5,
                'lastname' => 'Doe',
                'password' => Hash::make('sample123'),
                'phone_number' => '00000000000',
                'role' => 'Admin',
                'title' => 'Mr.',
                'colleges' => null,
                'courses' => null,
                'position' => 'Chairperson',

                'profile_image' => null,
            ],
            
        ]);
    }
}
