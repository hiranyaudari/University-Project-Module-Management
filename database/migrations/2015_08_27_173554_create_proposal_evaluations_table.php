<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProposalEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proposal_evaluations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('student_id');
            $table->string('project_id');
            $table->integer('panelmember_id');
            $table->string('status');
            $table->integer('feedback');
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
		Schema::drop('proposal_evaluations');
	}

}
