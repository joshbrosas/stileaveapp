<?php

class AdminLogAWT extends \Eloquent {
    protected $primaryKey = 'employee_id';
    protected $table = 'tbl_admin_awt_log';
    public function user(){

        return $this->belongsTo('UserDetails', 'employee_id');
    }
}