<?php

use Illuminate\Database\Migrations\Migration;

class MakeBookmarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('bookmarks', function($table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('group_id');
			$table->string('title');
			$table->text('description')->nullable();
			$table->string('url');
			$table->integer('order')->nullable()->default(999);
			$table->timestamps();
		});

		$bookmarks = array(
			array(
				'title'		=> 'Google',
				'group_id'	=> 1,
				'url'		=> 'http://www.google.com',
				'order'		=> 1,
				'user_id'	=> 1
			),
			array(
				'title'		=> 'HaychKew Github',
				'group_id'	=> 3,
				'url'		=> 'https://github.com/duellsy/haychkew',
				'order'		=> 2,
				'user_id'	=> 1
			),
		);

		foreach($bookmarks as $bookmark) {
			$bm = new Bookmark($bookmark);
			$bm->save();
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookmarks');
	}

}
