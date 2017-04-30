<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostVideoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_video', function(Blueprint $table)
		{
			$table->integer('id_post');
			$table->bigInteger('id_video')->index('id_video');
			$table->timestamps();
			$table->primary(['id_post','id_video']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_video');
	}

}
