<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kegiatan', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('skpd_id')->unsigned();
			$table->integer('program_id')->unsigned();
			$table->integer('tahun_id')->unsigned();
			$table->integer('kpa_id')->unsigned();
			$table->string('kegiatan');
			$table->string('slug_kegiatan');
			$table->string('sumber_dana');
			$table->string('jenis_belanja');
			$table->decimal('blp');
			$table->decimal('blnp');
			$table->decimal('btlp');
			$table->decimal('pagu');
			$table->decimal('pagu_perubahan');
			$table->timestamps();

			$table->foreign('skpd_id')->references('id')->on('skpd')->onDelete('cascade');
			$table->foreign('program_id')->references('id')->on('program')->onDelete('cascade');
			$table->foreign('tahun_id')->references('id')->on('tahun')->onDelete('cascade');
			$table->foreign('kpa_id')->references('id')->on('kpa')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('kegiatan');
	}

}
