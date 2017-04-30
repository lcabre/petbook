<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cita', function(Blueprint $table)
		{
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->integer('id_mascota_2');
			$table->integer('id_usuario_2');
			$table->timestamps();
			$table->primary(['id_mascota','id_usuario','id_mascota_2','id_usuario_2']);
			$table->index(['id_mascota_2','id_usuario_2'], 'id_mascota_2');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cita');
	}

}
