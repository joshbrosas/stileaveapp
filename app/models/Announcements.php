<?php

class Announcements extends \Eloquent {
	protected $table = 'tbl_announce';
    protected $primaryKey = 'employee_id';

    public static function  validate($input){

        $rules = array(

            'subject'   => 'required',
            'announce'  => 'required_without_all:image',
            'image'     => 'required_without_all:announce'
        );

        $messages = array(
            'required_without_all' => 'The Announce field is required.'


        );
        return Validator::make($input, $rules, $messages);


}

    public function user(){

        return $this->belongsTo('UserDetails', 'employee_id');
    }

}