<?php

use Illuminate\Database\Migrations\Migration;

class MakeGroupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('groups', function($table)
		{
			$table->increments('id');
			$table->string('name');
			$table->integer('order')->nullable()->default(999);
			$table->text('description')->nullable();
			$table->integer('user_id');

			$table->timestamps();
		});

		$groups = array(
			array(
				'name'	=> 'Misc',
				'order'	=> 1,
				'user_id'	=> 1
			),
			array(
				'name'	=> 'Daily',
				'order'	=> 2,
				'user_id'	=> 1
			),
			array(
				'name'	=> 'Work',
				'order'	=> 3,
				'user_id'	=> 1
			),
		);

		foreach($groups as $grp){
			$group = new Group($grp);
			$group->save();
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('groups');
	}

}
