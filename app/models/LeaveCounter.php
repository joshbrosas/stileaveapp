<?php

class LeaveCounter extends \Eloquent {
	protected $primaryKey = 'employee_id';
	protected $table = 'tbl_leave_counter';

	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');

	}

    public  static function validate($input){
        $rules = array(
            'withpay'       => 'required|numeric',
            'withoutpay'    => 'required|numeric',
        );

        return Validator::make($input, $rules);
    }

}