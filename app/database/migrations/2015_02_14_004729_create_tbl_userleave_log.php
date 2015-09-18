<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUserleaveLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_userleave_log', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('employee_id');
            $table->mediumText('leave_id');
            $table->string('type_of_leave');
            $table->string('days_of_leave');
            $table->string('wdays_of_leave');
            $table->string('date_from');
            $table->string('time_from');
            $table->string('date_to');
            $table->string('time_to');
            $table->string('company');
            $table->string('address');
            $table->mediumText('reason');
            $table->string('status');
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
		Schema::drop('tbl_userleave_log');
	}

}
