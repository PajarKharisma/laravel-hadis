<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBukhariTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bukhari', function(Blueprint $table)
		{
			$table->float('Kode', 10, 0)->primary();
			$table->float('NoHdt', 10, 0)->nullable();
			$table->text('Isi_Arab')->nullable();
			$table->text('Isi_Indonesia')->nullable();
			$table->string('Kategori')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bukhari');
	}

}
