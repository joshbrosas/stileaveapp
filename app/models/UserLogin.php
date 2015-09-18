<?php
class UserLogin extends \Eloquent
{

	protected $table = 'tbl_users_login';
	protected $primaryKey = 'id';

	public static function validate($input)
	{

		$rules = array(
			'username' => 'required|unique:tbl_users_login',
			'password' => 'required|same:pass_confirmation',
			'pass_confirmation' => 'required',


		);

		return Validator::make($input, $rules);


	}

}