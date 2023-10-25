<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BoardMemberSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('board_members')->insert([
            [
                'id' => 1,
                'title' => 'Dr.',
                'firstname' => 'Joseph',
                'initial' => 'G',
                'lastname' => 'Balaoing',
                'position' => 'Chairperson',
                'email' => "joseph.balaoing@adamson.edu.ph",
                
            ],
            [
                'id' => 2,
                'title' => 'Fr.',
                'firstname' => 'Aldrin',
                'initial' => 'R',
                'lastname' => 'Suan',
                'position' => 'Member',
                'email' => 'aldrin.suan@adamson.edu.ph',
              
            ],
            [
                'id' => 3,
                'title' => 'Atty.',
                'firstname' => 'Jan Nelin',
                'initial' => '',
                'lastname' => 'Navallasca',
                'position' => 'Member',
                'email' => 'jannelin.navallasca@adamson.edu.ph',
         
            ],
            [
                'id' => 4,
                'title' => 'Atty.',
                'firstname' => 'Rey',
                'initial' => 'S',
                'lastname' => 'Rabago',
                'position' => 'Member',
                'email' => 'rey.rabago@adamson.edu.ph',
      
            ],
            [
                'id' => 5,
                'title' => 'Dr.',
                'firstname' => 'Amy',
                'initial' => 'C',
                'lastname' => 'Daraway',
                'position' => 'Member',
                'email' => 'amy.daraway@adamson.edu.ph',
              
            ],
            [
                'id' => 6,
                'title' => 'Dr.',
                'firstname' => 'Neliza',
                'initial' => '',
                'lastname' => 'Cayaban',
                'position' => 'Member',
                'email' => 'neliza.cayaban@adamson.edu.ph',
            
            ],
            [
                'id' => 7,
                'title' => 'Dr.',
                'firstname' => 'Maria Shiela',
                'initial' => '',
                'lastname' => 'Bautista',
                'position' => 'Member',
                'email' => 'maria.sheila.bautista@adamson.edu.ph',
         
            ],
            [
                'id' => 8,
                'title' => 'Dr.',
                'firstname' => 'Hazel Anne',
                'initial' => 'L',
                'lastname' => 'Bautista',
                'position' => 'Member',
                'email' => 'hazelanne.lamadrid@adamson.edu.ph',
          
            ],
            [
                'id' => 9,
                'title' => 'Mr.',
                'firstname' => 'Mark Lawrence',
                'initial' => 'Q',
                'lastname' => 'Gale',
                'position' => 'Member',
                'email' => 'mark.lawrence.gale@adamson.edu.ph',
               
            ],
            [
                'id' => 10,
                'title' => 'Mr.',
                'firstname' => 'Rudolph Aldrin',
                'initial' => '',
                'lastname' => 'Guirit',
                'position' => 'Member',
                'email' => 'rudolf.aldrin.guirit@adamson.edu.ph',
               
            ],
            [
                'id' => 11,
                'title' => 'Ms.',
                'firstname' => 'Imelda',
                'initial' => '',
                'lastname' => 'Lozano',
                'position' => 'Secretary',
                'email' => 'imelda.lozano@adamson.edu.ph',
          
            ],
            [
                'id' => 12,
                'title' => 'Mr.',
                'firstname' => 'Zaldy',
                'initial' => '',
                'lastname' => 'Collado',
                'position' => 'Non-Affiliate Member',
                'email' => 'zaldy.collado@adamson.edu.ph',
         
            ],
            [
                'id' => 13,
                'title' => 'Mr.',
                'firstname' => 'Lindberg',
                'initial' => 'R',
                'lastname' => 'Gilera',
                'position' => 'External Lay Member',
                'email' => 'lindberggilera@gmail.com',
            
            ],
          
        ]);
    }
}
