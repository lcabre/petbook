<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAdoptaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('adopta', function(Blueprint $table)
		{
			$table->foreign('id_mascota', 'adopta_ibfk_1')->references('id')->on('mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_usuario_2', 'adopta_ibfk_2')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('adopta', function(Blueprint $table)
		{
			$table->dropForeign('adopta_ibfk_1');
			$table->dropForeign('adopta_ibfk_2');
		});
	}

}
