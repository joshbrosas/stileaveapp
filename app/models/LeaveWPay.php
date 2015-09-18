<?php

class LeaveWPay extends \Eloquent {
	protected $table = 'tbl_user_w_leave';
	protected $primaryKey = 'employee_id';



	public static function validate($input){

		$rules = array(
			'date_from' => 'required',
			'date_to'	=> 'required',
			'totalleave' => 'required',
			'reason'	=> 'required'

		);
		return Validator::make($input, $rules);

	}

	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');
	}
}