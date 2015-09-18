<?php

class AdminPolicies extends \Eloquent {
    protected $table = 'tbl_admin_policies';
    protected $primaryKey = 'employee_id';

    public function user(){

        return $this->belongsTo('UserDetails', 'employee_id');
    }

    public  static function validate($input)
    {
    $rules = ['title' => 'required', 'file' => 'required'];

        return Validator::make($input, $rules);
    }
}