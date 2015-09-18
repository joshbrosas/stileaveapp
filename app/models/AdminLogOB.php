<?php

class AdminLogOB extends \Eloquent {
	protected $primaryKey = 'employee_id';
    protected $table = 'tbl_adminob_log';
    public function user(){

        return $this->belongsTo('UserDetails', 'employee_id');
    }
}