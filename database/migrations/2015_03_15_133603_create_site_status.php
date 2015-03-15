<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteStatus extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_status', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('day')->index();
            $table->integer('topics_count')->default(0);
            $table->integer('images_count')->default(0);
            $table->integer('replies_count')->default(0);
            $table->integer('registers_count')->default(0);
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
		Schema::drop('site_status');
	}

}
