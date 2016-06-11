<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('regId')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('phone');
            $table->string('courseField');
            $table->integer('attempt');
            $table->string('username')->unique();
           /// $table->rememberToken();
            $table->timestamps();

            $table->foreign('email')
                ->references('email')
                ->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('students');
	}

}
