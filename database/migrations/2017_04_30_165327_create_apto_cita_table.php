<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAptoCitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('apto_cita', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->smallInteger('id_raza')->nullable()->index('id_raza');
			$table->integer('tamanio')->nullable();
			$table->integer('radio_km')->nullable();
			$table->timestamps();
			$table->index(['id_mascota','id_usuario'], 'id_mascota');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('apto_cita');
	}

}
