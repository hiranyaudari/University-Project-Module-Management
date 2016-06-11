<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelmembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('panelmembers', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name');
            $table->string('designation');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('speciality')->nullable();
            $table->string('type');
            $table->string('status')->nullable();
            $table->string('university')->nullable();
            $table->string('cv')->nullable();
            $table->string('username')->nullable();
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
		Schema::drop('panelmembers');
	}

}
