<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAdminAwtLog extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_admin_awt_log', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('employee_id');
            $table->string('leave_id');
            $table->string('days_of_leave');
            $table->string('wdays_of_leave');
            $table->string('date_from');
            $table->string('time_from');
            $table->string('date_to');
            $table->string('time_to');
            $table->mediumText('reason');
            $table->string('status');
            $table->string('message');
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
		Schema::drop('tbl_admin_awt_log');
	}

}
