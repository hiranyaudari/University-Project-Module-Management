<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThesisEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('thesis_evaluations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('projectId');
            $table->integer('independentScientificThinking');
            $table->integer('scientificKnowHow');
            $table->integer('logic');
            $table->integer('presentation');
            $table->integer('workProcess');
            $table->text('comment');
            $table->string('status');
            $table->string('panelMember');
            $table->date('date');
            $table->integer('formVersion');
            $table->integer('published');
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
		Schema::drop('thesis_evaluations');
	}

}
