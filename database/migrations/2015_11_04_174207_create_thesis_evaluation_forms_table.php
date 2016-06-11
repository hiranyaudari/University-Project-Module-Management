<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesisEvaluationFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thesis_evaluation_forms', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('independentScientificThinking');
            $table->integer('scientificKnowHow');
            $table->integer('logic');
            $table->integer('presentation');
            $table->integer('workProcess');
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
		Schema::drop('thesis_evaluation_forms');
	}

}
