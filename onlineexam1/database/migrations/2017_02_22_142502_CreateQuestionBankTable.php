<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('QuestionBank', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('SubjectID');
            $table->string('Question', 200);
            $table->string('Option1', 50);
            $table->string('Option2', 50);
            $table->string('Option3', 50);
            $table->string('Option4', 50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('QuestionBank');
    }
}
