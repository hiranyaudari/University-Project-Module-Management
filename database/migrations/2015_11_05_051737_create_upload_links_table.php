<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadLinksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('upload_links', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('category');
            $table->string('docType');
            $table->string('linkName');
            $table->string('description');
            $table->dateTime('deadline');
            $table->string('status');
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
		Schema::drop('upload_links');
	}

}
