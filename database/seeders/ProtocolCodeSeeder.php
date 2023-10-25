<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProtocolCodeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('protocol_codes')->insert([
            [
                'id' => 1,
                'year' => '2023',
                'category_codes' => '03',
                'program_codes' => 'COS',
                'sequence_codes' => '01',
                'protocol_code' => '2023-03-COS-01',
            ],

        ]);
    }
}
