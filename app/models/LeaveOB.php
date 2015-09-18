<?php

class LeaveOB extends \Eloquent {
	protected $primaryKey = 'employee_id';
    protected $table = 'tbl_user_leave_ob';


    public static function validate($input){
        $rules = array(
            'date_from' => 'required',
            'date_to'	=> 'required',
            'totalleave' => 'required',
            'reason'	=> 'required',
            'company'   => 'required',
            'address'   =>  'required'
        );

        return Validator::make($input, $rules);
    }

    public function user(){
        return $this->belongsTo('UserDetails', 'employee_id');
    }
}