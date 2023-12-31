<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
$table->text('question');
$table->text('answer1');
$table->text('answer2');
$table->text('answer3')->nullable();
$table->text('answer4')->nullable();
$table->text('note')->nullable();
$table->integer('mark')->nullable();
$table->unsignedBigInteger('course_id');
$table->unsignedBigInteger('user_id');
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

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
        Schema::dropIfExists('questions');
    }
}
