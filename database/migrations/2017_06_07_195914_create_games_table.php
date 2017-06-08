<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->integer('rows');
            $table->integer('cols');
            $table->integer('bombs');
            $table->text('cells');
            $table->text('revealed');
            $table->string('status');
            $table->string('score');
            $table->string('time');

            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}

}
