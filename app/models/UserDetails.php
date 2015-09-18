<?php

class UserDetails extends \Eloquent {
	protected $table		=	'tbl_users_details';
	protected $primaryKey 	=	'employee_id';

	public static function validate($input){

		$rules = array(
			'employeeid'	=> 'required|unique:tbl_users_details,employee_id',
			'firstname'		=> 'required|Alphanum',
			'surname'		=> 'required|Alphanum',
			'email'			=> 'required|email|unique:tbl_users_details,email'

		);

		return Validator::make($input, $rules);
	}

	public static function validate_image($input){

		$rules = array(
			'images'	=> 'required|mimes:jpeg,bmp,png'
		);

		$messages = array(
			'required' => 'image required.',
		);

		return Validator::make($input, $rules, $messages);
	}

    public static function validate_required($input){
        $rules = array(

            'firstname'		=> 'required|Alphanum',
            'surname'		=> 'required|Alphanum',


        );

        return Validator::make($input, $rules);
    }






}