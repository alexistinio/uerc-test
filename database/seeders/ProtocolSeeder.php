<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProtocolSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('protocols')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'terminate_attachment' => null,
                'approval' => 'On-going Review',
                'college' => 'UERC',
                'title' => 'MarkIT: An Online Community Website for Business Marketing Surveys',
                'protocol_code' => '2023-03-ACC-01',
                'date_of_receipt' => date("Y-m-d"),
                'status_of_submission' => "Initial Submission",
                'type_of_review' => 'ER',
                'p_researcher' => 'John Doe',
                'c_researcher' => 'John Doe',
                'email' => 'tinioalexis@gmail.com',
                'phone_number' => '9398969415',

            
                'primary_reviewer' => 'Clark Kent',
                'other_reviewers' => 'Bruce Wayne',
                'research_type' => 'Biomedical Studies',
                'status_of_protocol' => 'OR - On-going review',
                'funding' => 'R - Researcher-funded',
                'or_number' => '10000',
                'or_receipt' => null,
                'doc1' => null,
                'reviewers_report' => 'report.docx',
                'protocol_attachments' => 'protocol.docx',
                'progress_report' => null,
                'final_manuscript' => null,
                'ammendment_form' => null,
                'final_report_form' => null,

                'first_decision' => null,
                'first_decision_access' => null,
                'final_decision' => 'NA',
                'final_decision_access' => null,
              
            ],
        ]);
    }
}
