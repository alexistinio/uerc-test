<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->string('approval')->default('On-going Review');
            $table->string('college');
            $table->string('prev_status')->nullable();
            $table->string('status')->default('This protocol is being reviewed. Please wait for the assignment of the Type of Review by the UERC. In the meantime, you may now send the Acknowledgement Form to the reviewer/s');
            $table->string('terminate_note')->nullable();
            $table->string('terminate_attachment')->nullable();
            $table->string('title');
            $table->string('protocol_code');
            $table->date('date_of_receipt');
            $table->string('status_of_submission');
            $table->string('type_of_review')->nullable();
            $table->string('p_researcher');
            $table->string('c_researcher')->nullable();
            $table->string('email');
            $table->string('phone_number');
  

            $table->string('primary_reviewer')->nullable();
            $table->string('other_reviewers')->nullable();
            $table->string('research_type');
            $table->string('status_of_protocol')->nullable();
            $table->string('funding');
            $table->string('or_number');
            $table->string('or_receipt');
            $table->string('doc1');
            $table->string('reviewers_report')->nullable();
            $table->longText('protocol_attachments')->nullable();
            $table->string('progress_report');
            $table->string('final_manuscript')->nullable();
            $table->string('ammendment_form')->nullable();
            $table->string('ammendment_form2')->nullable();
            $table->string('ammendment_form2_access')->nullable();
            $table->string('final_report_form')->nullable();
            
           
            $table->string('first_decision')->nullable();
            $table->date('first_decision_access')->nullable();
            $table->string('final_decision')->nullable();
            $table->string('final_decision_access')->nullable();
          

            $table->string('doc1_2')->nullable();
            $table->string('or_receipt2')->nullable();
            $table->string('reviewers_report2')->nullable();
            $table->string('progress_report2')->nullable();
            $table->string('final_manuscript2')->nullable();
            $table->string('final_report_form2')->nullable();


            $table->string('doc1_2_access')->nullable();
            $table->string('or_receipt2_access')->nullable();
            $table->string('progress_report2_access')->nullable();
            $table->string('reviewers_report2_access')->nullable();
            $table->string('final_manuscript2_access')->nullable();
            $table->string('final_report_form2_access')->nullable();
            

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocols');
    }
};
