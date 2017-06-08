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
            $table->text('cells')->nullable();
            $table->text('revealed')->nullable();
            $table->string('status')->nullable();
            $table->string('score')->default(0);
            $table->string('time')->default(0);

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
