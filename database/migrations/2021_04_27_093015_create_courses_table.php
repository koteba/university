<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration {

	public function up()
	{
		Schema::create('courses', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
			$table->integer('year');
			$table->unsignedBigInteger('department_id');
			$table->longText('description')->nullable();

			$table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('courses');
	}
}