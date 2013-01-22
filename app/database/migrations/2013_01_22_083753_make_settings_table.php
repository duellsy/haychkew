<?php

use Illuminate\Database\Migrations\Migration;

class MakeSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::create('settings', function($table)
		{
			$table->increments('id');
			$table->string('key');
			$table->string('value');

			$table->unique('key');

			$table->timestamps();
		});

		// Initial installation settings
		$settings = array(
			array(
				'key'	=> 'site_name',
				'value'	=> 'HaychKew',
				'created_at'	=> new DateTime(),
				'updated_at'	=> new DateTime()
			),
		);

		foreach($settings as $setting) {
			DB::table('settings')->insert($setting);
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('settings');
	}

}
