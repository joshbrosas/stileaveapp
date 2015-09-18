<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAnnounce extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_announce', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_id');
			$table->string('post_id');
            $table->string('subject');
			$table->mediumText('announce');
            $table->string('image');
			$table->rememberToken();
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
		Schema::drop('tbl_announce');
	}

}
