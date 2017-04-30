<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRazaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('raza', function(Blueprint $table)
		{
			$table->smallInteger('id', true);
			$table->integer('id_tipo_mascota')->index('id_tipo_mascota');
			$table->string('nombre', 100);
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
		Schema::drop('raza');
	}

}
