<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExamQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('exam_question', function (Blueprint $table) {
            $table->id();
$table->unsignedBigInteger('question_id');
$table->unsignedBigInteger('exam_id');
$table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
$table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
                Schema::dropIfExists('exam_question');

    }
}
