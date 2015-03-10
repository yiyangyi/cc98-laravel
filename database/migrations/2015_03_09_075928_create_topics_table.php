<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title')->index();
			$table->text('body');
			$table->text('body_orginal');
			$table->text('excerpt')->nullable();
			$table->integer('user_id')->index();
			$table->integer('node_id')->index();
			$table->boolean('excellent')->default(false)->index();
			$table->boolean('blocked')->default(false)->index();
			$table->integer('reply_count')->default(0)->index();
			$table->integer('view_count')->default(0)->index();
			$table->integer('favorite_count')->default(0)->index();
			$table->integer('vote_count')->default(0)->index();
			$table->integer('last_reply_user_id')->default(0)->index();
			$table->integer('order')->default(0)->index();
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
		Schema::drop('topics');
	}

}
