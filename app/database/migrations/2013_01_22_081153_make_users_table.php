<?php

use Illuminate\Database\Migrations\Migration;

class MakeUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
		{
			$table->increments('id');
			$table->string('username');
			$table->string('email')->nullable();
			$table->string('password');
			$table->timestamps();
		});

		$user = new User();
		$user->username = 'admin';
		$user->password = Hash::make('0000');
		$user->save();

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
