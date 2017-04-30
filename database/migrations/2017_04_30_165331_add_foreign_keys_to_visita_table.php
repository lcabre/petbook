<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVisitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('visita', function(Blueprint $table)
		{
			$table->foreign('id_post', 'visita_ibfk_1')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visita', function(Blueprint $table)
		{
			$table->dropForeign('visita_ibfk_1');
		});
	}

}
