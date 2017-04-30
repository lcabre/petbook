<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_mascota');
			$table->integer('id_usuario');
			$table->string('titulo', 100);
			$table->text('descripcion', 65535)->nullable();
			$table->timestamps();
			$table->index(['id_mascota','id_usuario'], 'id_mascota');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('post');
	}

}
