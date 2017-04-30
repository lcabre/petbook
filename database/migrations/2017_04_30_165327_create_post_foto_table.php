<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostFotoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_foto', function(Blueprint $table)
		{
			$table->integer('id_post');
			$table->integer('id_foto')->index('id_foto');
			$table->timestamps();
			$table->primary(['id_post','id_foto']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post_foto');
	}

}
