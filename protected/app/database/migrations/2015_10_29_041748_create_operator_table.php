<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperatorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('operator', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pegawai_id')->unsigned();
			$table->string('username',50);
			$table->string('password',100);
			$table->string('level',50);
			$table->string('remember_token', 100)->nullable();
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
		Schema::drop('operator');
	}

}
