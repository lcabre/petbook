<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMascotaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mascota', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_usuario')->index('id_usuario');
			$table->smallInteger('id_raza')->index('id_raza');
			$table->char('sexo', 1)->nullable();
			$table->smallInteger('edad')->nullable();
			$table->string('nombre', 100)->nullable();
			$table->text('otras_caracteristicas', 65535)->nullable();
			$table->boolean('apto_adopcion')->nullable();
			$table->timestamps();
			$table->primary(['id','id_usuario']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mascota');
	}

}
