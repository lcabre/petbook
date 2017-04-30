<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_user')->index('id_user');
			$table->string('nombre', 100);
			$table->string('domicilio', 100)->nullable();
			$table->string('telefono', 25)->nullable();
			$table->string('geoposicion', 100)->nullable();
			$table->char('sexo', 1)->nullable();
			$table->dateTime('fecha_nacimiento')->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuario');
	}

}
