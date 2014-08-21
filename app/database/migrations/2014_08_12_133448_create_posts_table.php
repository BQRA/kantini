<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 18);
			$table->string('gender', 6);
			$table->text('dedikod', 500);
			$table->string('type', 11);
			$table->string('event_name', 50)->nullable();
			$table->timestamp('event_date')->nullable();
			$table->string('event_address')->nullable();
			$table->text('event_map')->nullable();
			$table->string('event_auth')->nullable();
			$table->string('event_auth_contact')->nullable();
			$table->integer('event_price')->nullable();
			$table->string('event_photo')->nullable();
			$table->string('links')->nullable();

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
		Schema::drop('posts');
	}

}
