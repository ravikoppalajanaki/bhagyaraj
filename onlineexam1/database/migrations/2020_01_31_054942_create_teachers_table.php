<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100); 
            $table->string('designation', 150); 
            $table->string('email', 100);
            $table->string('gender', 20);
            $table->string('address');
            $table->string('phone_number', 20);
            $table->date('date_of_birth');
            $table->date('joining_date');
            $table->string('photo');
            $table->string('password');
            $table->string('username');
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
        Schema::dropIfExists('teachers');
    }
}
