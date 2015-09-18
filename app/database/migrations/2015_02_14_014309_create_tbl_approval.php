<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblApproval extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_approval', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_id');
			$table->string('leave_id');
            $table->string('type_of_leave');
			$table->string('status');
			$table->mediumText('message');
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
		Schema::drop('tbl_approval');
	}

}
