<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSigueTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sigue', function(Blueprint $table)
		{
			$table->integer('id_usuario_2');
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->timestamps();
			$table->primary(['id_usuario_2','id_mascota','id_usuario']);
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
		Schema::drop('sigue');
	}

}
