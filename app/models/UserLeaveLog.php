<?php

class UserLeaveLog extends \Eloquent {
	protected $table		=	'tbl_userleave_log';
	protected $primaryKey 	=	'employee_id';


	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');

	}

}