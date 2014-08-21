<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUpTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('up', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('rater');
			$table->integer('post_id');
			$table->string('ip_address');
			$table->string('type');

			$table->softdeletes();
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
		Schema::drop('up');
	}

}
