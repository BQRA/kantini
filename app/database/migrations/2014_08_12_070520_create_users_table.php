<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 18);
			$table->string('email');
			$table->string('password', 60);
			$table->string('reset_password_code');
			$table->integer('active')->default(0);
			$table->string('activation_code');
			$table->string('permissions');
			$table->string('remember_token');

			$table->timestamp('last_login');
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
		Schema::drop('users');
	}

}
