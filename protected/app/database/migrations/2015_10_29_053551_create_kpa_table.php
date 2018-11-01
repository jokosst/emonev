<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kpa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pegawai_id')->unsigned();
			$table->timestamps();

			$table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kpa');
	}

}
