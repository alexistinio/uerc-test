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
        Schema::create('researchers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
          
            $table->string('title');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number');
            $table->string('colleges');
            $table->string('courses');
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
        Schema::dropIfExists('researchers');
    }
};
