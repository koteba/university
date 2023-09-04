<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration {

	public function up()
	{
		Schema::create('departments', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
			$table->unsignedBigInteger('collage_id');
			$table->integer('years');
			$table->foreign('collage_id')->references('id')->on('collages')->onDelete('cascade');

		});
	}

	public function down()
	{
		Schema::drop('departments');
	}
}