<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblLeavecounter extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_leave_counter', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_id');
			$table->string('remaining_leave');
			$table->string('remaining_leave_wopay');
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
		Schema::drop('tbl_leave_counter');
	}

}
