<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseUserTable extends Migration {

	public function up()
	{
		Schema::create('course_user', function(Blueprint $table) {
			$table->unsignedBigInteger('course_id');
			$table->unsignedBigInteger('user_id');
      $table->string('status')->default('0');


			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});
	}
 
	public function down()
	{
		Schema::drop('course_user');
	}
}