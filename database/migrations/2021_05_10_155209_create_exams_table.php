<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('course_id');
            $table->string('date');
            $table->string('time');
            $table->string('duration');
            $table->string('code')->nullable();
            $table->string('title');

            $table->integer('numofquestions')->default(10);
            $table->integer('totalmark')->default(100);
            $table->integer('status')->default(0);
// 0 - not avaliable
// 1 - stand by
// 2 - ready
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
        Schema::dropIfExists('exams');
    }
}
