<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropasalEvaluationDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('propasal_evaluation_details', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('proposal_id');
            $table->integer('parts');
            $table->integer('marks');
            $table->text('comment');
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
		Schema::drop('propasal_evaluation_details');
	}

}
