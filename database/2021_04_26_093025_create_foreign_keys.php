<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration {

	public function up()
	{
	
		Schema::table('departments', function(Blueprint $table) {
			$table->foreign('collage_id')->references('id')->on('collages')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->foreign('department_id')->references('id')->on('departments')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('courses')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('course_user', function(Blueprint $table) {
			$table->foreign('course_id')->references('id')->on('courses')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
		Schema::table('course_user', function(Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users')
						->onDelete('cascade')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_department_id_foreign');
		});
		Schema::table('departments', function(Blueprint $table) {
			$table->dropForeign('departments_collage_id_foreign');
		});
		Schema::table('courses', function(Blueprint $table) {
			$table->dropForeign('courses_department_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_user_id_foreign');
		});
		Schema::table('marks', function(Blueprint $table) {
			$table->dropForeign('marks_course_id_foreign');
		});
		Schema::table('course_user', function(Blueprint $table) {
			$table->dropForeign('course_user_course_id_foreign');
		});
		Schema::table('course_user', function(Blueprint $table) {
			$table->dropForeign('course_user_user_id_foreign');
		});
	}
}