<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMascotaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mascota', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'mascota_ibfk_1')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_raza', 'mascota_ibfk_2')->references('id')->on('raza')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mascota', function(Blueprint $table)
		{
			$table->dropForeign('mascota_ibfk_1');
			$table->dropForeign('mascota_ibfk_2');
		});
	}

}
