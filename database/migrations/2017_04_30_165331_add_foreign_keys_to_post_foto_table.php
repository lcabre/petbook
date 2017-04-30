<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostFotoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_foto', function(Blueprint $table)
		{
			$table->foreign('id_post', 'post_foto_ibfk_1')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_foto', 'post_foto_ibfk_2')->references('id')->on('foto')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_foto', function(Blueprint $table)
		{
			$table->dropForeign('post_foto_ibfk_1');
			$table->dropForeign('post_foto_ibfk_2');
		});
	}

}
