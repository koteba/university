<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->string('join')->nullable();
            $table->string('title');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->date('date');
            $table->time('time');
            $table->timestamps();
$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
