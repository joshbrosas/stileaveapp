<?php

class Approval extends \Eloquent {
	protected $table = 'tbl_approval';
	protected $primaryKey 	=	'employee_id';

	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');

	}

	public static function getSender($leaveid){
		return static::with('user')->where('leave_id', $leaveid)->get();
	}
}