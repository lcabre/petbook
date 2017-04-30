<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cita', function(Blueprint $table)
		{
			$table->foreign('id_mascota', 'cita_ibfk_1')->references('id')->on('mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_mascota_2', 'cita_ibfk_2')->references('id')->on('mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cita', function(Blueprint $table)
		{
			$table->dropForeign('cita_ibfk_1');
			$table->dropForeign('cita_ibfk_2');
		});
	}

}
