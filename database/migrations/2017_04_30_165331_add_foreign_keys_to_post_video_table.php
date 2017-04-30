<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostVideoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('post_video', function(Blueprint $table)
		{
			$table->foreign('id_post', 'post_video_ibfk_1')->references('id')->on('post')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_video', 'post_video_ibfk_2')->references('id')->on('video')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_video', function(Blueprint $table)
		{
			$table->dropForeign('post_video_ibfk_1');
			$table->dropForeign('post_video_ibfk_2');
		});
	}

}
