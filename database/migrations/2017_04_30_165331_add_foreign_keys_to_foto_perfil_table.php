<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFotoPerfilTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('foto_perfil', function(Blueprint $table)
		{
			$table->foreign('id_usuario', 'foto_perfil_ibfk_1')->references('id')->on('usuario')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('foto_perfil', function(Blueprint $table)
		{
			$table->dropForeign('foto_perfil_ibfk_1');
		});
	}

}
