<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblUsersDetails extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_users_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_id');
			$table->string('firstname');
			$table->string('surname');
			$table->string('profile_mage');
			$table->string('e_status');
			$table->string('department');
			$table->string('email');
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
		Schema::drop('tbl_users_details');
	}

}
