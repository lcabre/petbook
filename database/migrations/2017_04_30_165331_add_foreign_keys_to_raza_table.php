<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRazaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('raza', function(Blueprint $table)
		{
			$table->foreign('id_tipo_mascota', 'raza_ibfk_1')->references('id')->on('tipo_mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('raza', function(Blueprint $table)
		{
			$table->dropForeign('raza_ibfk_1');
		});
	}

}
