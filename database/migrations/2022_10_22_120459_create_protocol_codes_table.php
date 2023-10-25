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
        Schema::create('protocol_codes', function (Blueprint $table) {
            $table->id();
            $table->string('year');
            $table->string('category_codes');
            $table->string('program_codes');
            $table->string('sequence_codes');
            $table->string('protocol_code');
     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocol_codes');
    }
};
