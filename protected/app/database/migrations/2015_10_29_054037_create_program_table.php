<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('program', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('skpd_id')->unsigned();
			$table->string('program',100);
			$table->string('slug_program',100);
			$table->timestamps();

			$table->foreign('skpd_id')->references('id')->on('skpd')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('program');
	}

}
