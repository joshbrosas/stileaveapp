<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAnnounceComment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_announce_comment', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('post_id');
            $table->string('employee_id');
            $table->mediumText('post_comment');
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
		Schema::drop('tbl_announce_comment');
	}

}
