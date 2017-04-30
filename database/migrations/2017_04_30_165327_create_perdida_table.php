<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePerdidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perdida', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->text('descripcion', 65535)->nullable();
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
		Schema::drop('perdida');
	}

}
