<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdoptaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('adopta', function(Blueprint $table)
		{
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->integer('id_usuario_2')->index('id_usuario_2');
			$table->timestamps();
			$table->primary(['id_mascota','id_usuario','id_usuario_2']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('adopta');
	}

}
