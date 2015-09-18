<?php

class AdminLogWP extends \Eloquent {
	protected $table = 'tbl_admin_wplog';
	protected $primaryKey = 'employee_id';

	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');
	}

}