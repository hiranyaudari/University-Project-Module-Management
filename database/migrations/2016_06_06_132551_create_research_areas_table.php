<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResearchAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('research_areas', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('research_area');
                        $table->string('researcher_i');
                        $table->string('researcher_ii');
                        $table->string('description');
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
		Schema::drop('research_areas');
	}

}
