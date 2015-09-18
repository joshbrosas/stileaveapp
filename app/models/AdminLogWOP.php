<?php

class AdminLogWOP extends \Eloquent {
	protected $table = 'tbl_admin_woplog';
	protected $primaryKey = 'employee_id';

	public function user(){

		return $this->belongsTo('UserDetails', 'employee_id');
	}
}