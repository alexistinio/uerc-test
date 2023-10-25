<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResearcherSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('researchers')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'title' => 'Mr.',
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => "johndoe@gmail.com",
                'phone_number' => '09398969415',
                'colleges' => 'COS',
                'courses' => 'Biology',
            ],
            [
                'id' => 2,
                'user_id' => 1,
                'title' => 'Mr.',
                'firstname' => 'Conor',
                'lastname' => 'Mcgregor',
                'email' => "conor@example.com",
                'phone_number' => '09398969415',
                'colleges' => 'COS',
                'courses' => 'Biology',
            ],
            [
                'id' => 3,
                'user_id' => 1,
                'title' => 'Mr.',
                'firstname' => 'Khabib',
                'lastname' => 'Nurmagomedov',
                'email' => "khabib@example.com",
                'phone_number' => '09398969415',
                'colleges' => 'COS',
                'courses' => 'Biology',
            ],
            [
                'id' => 4,
                'user_id' => 2,
                'title' => 'Mr.',
                'firstname' => 'Floyd',
                'lastname' => 'Mayweather',
                'email' => "floyd@example.com",
                'phone_number' => '09398969415',
                'colleges' => 'COS',
                'courses' => 'Biology',
            ],
            [
                'id' => 5,
                'user_id' => 2,
                'title' => 'Mr.',
                'firstname' => 'Manny',
                'lastname' => 'Pacquiao',
                'email' => "manny@example.com",
                'phone_number' => '09398969415',
                'colleges' => 'COS',
                'courses' => 'Biology',
            ],
        ]);
    }
}
