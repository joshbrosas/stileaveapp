<?php

class AnnouncementComments extends \Eloquent {
	protected $table = 'tbl_announce_comment';
    protected $id = 'employee_id';
    protected $fillable = array('post_id', 'employee_id', 'post_comment');


    public static function validate($input){
        $rules = ['comment' => 'required'];

        return Validator::make($input, $rules);
    }
    public function user(){

        return $this->belongsTo('UserDetails', 'employee_id');
    }

    public static function CountReply($id){
        return static::where('post_id',$id)->count();

    }
    public static function getComment($id){
        return static::where('post_id',$id)->orderBy('created_at', 'desc')->get();
    }
}