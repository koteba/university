<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration {

	public function up()
	{
		Schema::create('marks', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->unsignedBigInteger('user_id');
			$table->unsignedBigInteger('course_id');
			$table->integer('mark');
			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


		});
	}

	public function down()
	{
		Schema::drop('marks');
	}
}