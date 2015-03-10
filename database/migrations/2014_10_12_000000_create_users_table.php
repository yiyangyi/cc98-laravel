<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->string('name');
			$table->string('email')->unique()->nullable();
			$table->string('password', 60);
			$table->string('avatar')->nullable();
			$table->boolean('blocked')->default(false)->index();
			$table->integer('topic_count')->default(0)->index();
			$table->integer('reply_count')->default(0)->index();
			$table->string('city')->nullable();
			$table->string('website')->nullable();
			$table->string('signature')->nullable();
			$table->string('introduction')->nullable();
			$table->rememberToken();
			$table->softDeletes();
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
