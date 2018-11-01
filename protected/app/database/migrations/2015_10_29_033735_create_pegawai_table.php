<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pegawai', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('skpd_id')->unsigned();
			$table->string('pegawai',100);
			$table->string('email',100);
			$table->string('telepon',50);
			$table->string('nip',50);
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
		Schema::drop('pegawai');
	}

}
