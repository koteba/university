<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollagesTable extends Migration {

	public function up()
	{
		Schema::create('collages', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
		});
	}

	public function down()
	{
		Schema::drop('collages');
	}
}