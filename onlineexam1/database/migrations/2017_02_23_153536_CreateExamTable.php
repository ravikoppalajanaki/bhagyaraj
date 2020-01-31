<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('StudentID');
            $table->integer('SubjectID');
            $table->integer('SVID');
            $table->string('ExamData', 500);
            $table->string('TimeTaken');
            $table->integer('TotalQuestion');
            $table->integer('correctAnswer');
            $table->integer('IncorrectAnswer');
            $table->integer('UnAttemptAnswer');
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
          Schema::drop('exams');
    }
}
