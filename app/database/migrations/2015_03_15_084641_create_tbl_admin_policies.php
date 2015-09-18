<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTblAdminPolicies extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tbl_admin_policies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('employee_id');
            $table->string('download_id');
            $table->string('subject');
            $table->string('pdffile');
            $table->string('extension');
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
		Schema::drop('tbl_admin_policies');
	}

}
