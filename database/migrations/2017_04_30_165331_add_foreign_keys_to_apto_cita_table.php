<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAptoCitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('apto_cita', function(Blueprint $table)
		{
			$table->foreign('id_mascota', 'apto_cita_ibfk_1')->references('id')->on('mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_raza', 'apto_cita_ibfk_2')->references('id')->on('raza')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('apto_cita', function(Blueprint $table)
		{
			$table->dropForeign('apto_cita_ibfk_1');
			$table->dropForeign('apto_cita_ibfk_2');
		});
	}

}
