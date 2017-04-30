<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPerdidaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('perdida', function(Blueprint $table)
		{
			$table->foreign('id_mascota', 'perdida_ibfk_1')->references('id')->on('mascota')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('perdida', function(Blueprint $table)
		{
			$table->dropForeign('perdida_ibfk_1');
		});
	}

}
