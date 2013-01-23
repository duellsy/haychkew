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
		Schema::dropIfExists('settings');
		Schema::create('settings', function($table)
		{
			$table->increments('id');
			$table->string('var');
			$table->string('value');

			$table->unique('var');

			$table->timestamps();
		});

		// Initial installation settings
		$settings = array(
			array(
				'var'	=> 'site_name',
				'value'	=> 'HaychKew',
				'created_at'	=> new DateTime(),
				'updated_at'	=> new DateTime()
			),
			array(
				'var'	=> 'pocket_consumer_key',
				'value'	=> '',
				'created_at'	=> new DateTime(),
				'updated_at'	=> new DateTime()
			),
			array(
				'var'	=> 'pocket_access_token',
				'value'	=> '',
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
