<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$now = date('Y-m-d H:i:s');

		UserLogin::create(array(

			'employee_id' => 'STI-A010-01',
			'username' => 'STIADMIN',
			'password' => '$2y$10$y/987UvbGY.oZgkWU3lRLOBaKkH3DWLi0MhPocdyMe4xFdtRKWz42',
			'role' => 'Administrator',
			'remember_token' => 'z8Pb7Dufvmf7ReEfFjqwtWHFHkmrDJ7M1grYj85Vif5txDOIPjSAkuI0k31D',
			'created_at' => $now,
			'updated_at' => $now,


		));


		UserDetails::create(array(

			'employee_id' => 'STI-A010-01',
			'firstname' => 'admin',
			'surname' => 'administrator',
			'profile_mage' => 'img/default.png',
			'e_status' => 'Regular',
			'department' => 'None',
			'email' => 'AdminAdministrator@gmail.com',
			'remember_token' => NULL,
			'created_at' => $now,
			'updated_at' => $now,


		));

		LeaveCounter::create(array(

			'employee_id' => 'STI-A010-01',
			'remaining_leave' => 10,
			'remaining_leave_wopay' => 10,
			'created_at' => $now,
			'updated_at' => $now,


		));


$this->command->info('successfully seeded');

	}

}
