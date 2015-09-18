<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array( 'as' => 'index','uses' =>'indexController@index' ));

Route::get('logout',    'indexController@logout');

Route::group(array('before' => 'admin'),function(){

    Route::get('c_user',                array('as'  =>  'create_user',      'uses' =>   'AdminController@create_user' ));
    Route::get('administrator',         array('as'  =>  'administrator',    'uses' =>   'AdminController@index' ));
    Route::get('viewusers',             array('as'  =>  'view_users',       'uses' =>   'AdminController@show' ));
    Route::get('getallusers',           array('as'  =>  'alluser',          'uses' =>   'AdminController@getallusers'));
    Route::get('d_home',                array('as'  =>  'home',             'uses' =>   'AdminController@d_home' ));
    Route::get('q_announce',            array('as'  =>  'announce',         'uses' =>   'AdminController@get_announce'));
    Route::get('ct_admin',              array('as'  =>  'create_admin',     'uses' =>   'AdminController@create_admin'));
    Route::get('e_user/{id}',           array('as'  =>  'edit_user',        'uses' =>   'AdminController@edituser'));
    Route::get('u_leave/{id}',          array('as'  =>  'update_leave',    'uses' =>   'AdminController@update_leave' ));
    Route::get('d_user/{id}',           array('as'  =>  'delete_user',      'uses' =>   'AdminController@deleteuser'));
    Route::get('v_post/{id}',           array('as'  =>  'viewpost',         'uses' =>   'AdminController@viewpost'));
    Route::get('leaveadminpay',         array('as'  =>  'leavepay',         'uses' =>   'LeavePayAdminController@index'));
    Route::get('leaveapprove',          array('as'  =>  'approve',          'uses' =>   'LeaveWPlog@index'));
    Route::get('leaveadminwopay',       array('as'  =>  'leavewopay',       'uses' =>   'LeaveWOPayAdminController@index'));
    Route::get('wo_approve',            array('as'  =>  'wo_approve',       'uses' =>   'LeaveWOPlog@index'));;
    Route::get('deleteannounce/{id}',   array('as'  =>  'delete_announce',  'uses' =>   'AdminController@destroy'));
    Route::get('deletepayleave/{id}',   array('as'  =>  'delete_leavepay',  'uses' =>   'LeaveWPLog@destroy'));

    Route::get('woapprove/{id}',        array('uses'  =>  'LeaveWOPlog@destroy_approve'));

    Route::get('leaveob_admin',         array('as'    =>  'leaveob_admin',    'uses'  =>  'OBController@show'));
    Route::get('recent',                array('as'    =>  'recent_ob',    'uses'  =>  'OBController@recent_ob'));
    Route::get('recent_atw',            array('as'    =>  'recent_atw',    'uses'  =>  'ATWController@recent_awt'));
    Route::get('d_oblogs/{id}',         array('as'    =>  'del_logs',    'uses'  =>  'OBController@destroy'));

    Route::get('leaveatw_admin',         array('as'    =>  'leaveatw_admin',    'uses'  =>  'ATWController@show'));
    Route::get('admin_policies',           ['as'   => 'admin_policies',        'uses'   => 'PoliciesController@index']);
    Route::get('download_admin/{id}',      array('as'  =>  'get_download',    'uses'  =>  'PoliciesController@store'));
});


Route::group(array('before' => 'csrf'),function(){
    Route::post('r_user',                   array('as'      => 'userlogin',     'uses' => 'AdminController@create'));
    Route::post('r_admin',                  array('as'      => 'adminlogin',    'uses' => 'AdminController@crt_admin'));
    Route::post('s_announce',               array('as'      => 'post_announce', 'uses' => 'AdminController@post_announce'));
    Route::post('d_user/{id}',              array('as'      => 'delete_user',   'uses' => 'AdminController@post_delete'));
    Route::put('u_upload/{id}',             array('uses'    => 'AdminController@post_adminimageupload'));
    Route::put('imageupload/{id}',          array('uses'    => 'AdminController@post_imageupload'));
    Route::put('u_user/{id}',               array('uses'    => 'AdminController@update_user'));
    Route::post('approval/{id}',            array('uses'    => 'LeavePayAdminController@status_options'));
    Route::post('wo_approval/{id}',         array('uses'    => 'LeaveWOPayAdminController@save_options'));
    Route::post('updateleave/{id}',         array('uses'    => 'AdminController@post_leave'));
    Route::post('approval_ob/{id}',         array('uses'    => 'OBController@store'));
    Route::post('approval_awt/{id}',        array('uses'    => 'ATWController@store'));
    Route::post('post_admin_comment',       ['as'   => 'post_admin_comment',    'uses'   => 'CommentController@create_admin']);
    Route::post('upload_pdf',                ['as'   => 'upload_pdf',    'uses'   => 'PoliciesController@create']);
});

Route::group(array('before' => 'auth'), function() {

    Route::get('dashboard',             array('as' => 'dash',               'uses' =>   'indexController@dashboard'));
    Route::get('leavepay',              array('as' => 'leave_w_pay',        'uses' =>   'LeavePayController@index'));
    Route::get('leavewopay',            array('as' => 'leave_wo_pay',        'uses' =>   'LeaveWOPayController@index'));
    Route::get('leavelog/{id}',         array('as' => 'leavelog',           'uses' =>   'LeavePayController@show'));
    Route::get('leavelogw/{id}',        array('as' => 'leavelogW',           'uses' =>   'LeaveWOPayController@show'));
    Route::get('notification_box',      array('as' => 'notification',       'uses' =>   'NotificationController@index'));
    Route::get('v_announce/{id}',       array('as' => 'vannounce',          'uses' =>   'indexController@show_announce'));
    Route::get('d_notification/{id}',   array('as' => 'del_notify',         'uses' =>   'NotificationController@destroy'));
    Route::get('d_ob/{id}',             array('as' => 'del_ob',             'uses' =>   'NotificationController@destroy_ob'));
    Route::get('deleteleave/{id}',      array('as' => 'deleteleave',        'uses' =>   'LeavePayController@destroy' ));
    Route::get('deleteleavew/{id}',     array('as' => 'deleteleave',       'uses' =>   'LeaveWOPayController@destroy' ));

    Route::get('applyob',               array('as'  => 'applyob',          'uses' =>   'OBController@index'));
    Route::get('leave_oblog/{id}',      array('as'  =>  'leave_ob_log',    'uses'  =>  'OBController@ob_log'));
    Route::get('delete_ob/{id}',        array('as'  =>  'delete_ob_log',    'uses'  =>  'OBController@destroy_ob'));

    Route::get('delete_atw/{id}',       array('as'  =>  'delete_atw_log',   'uses'  =>  'ATWController@destroy'));
    Route::get('applyatw',              array('as'  =>  'applyatw',         'uses'  =>  'ATWController@index'));
    Route::get('leave_atwlog/{id}',     array('as'  =>  'leave_awt_log',    'uses'  =>  'ATWController@atw_log'));

    Route::get('policies',              array('as'  =>  'policies',    'uses'  =>  'PoliciesController@show'));
    Route::get('download/{id}',         array('as'  =>  'get_download',    'uses'  =>  'PoliciesController@store'));



});

Route::group(array('before' => 'csrf'), function(){


    Route::post('post_comment',     ['as'   => 'post_comment', 'uses'   => 'CommentController@create']);
    Route::post('login',            array('as' => 'userlogin',      'uses' =>   'indexController@login'));
    Route::put('wpleave/{id}',      array('as' => 'leave_w_pay',    'uses' =>   'LeavePayController@edit'));
    Route::put('wopleave/{id}',     array('as' => 'leave_w_pay',    'uses' =>   'LeaveWOPayController@edit'));
    Route::post('obleave',          array('as' => 'ob_leave',       'uses' =>   'OBController@create'));
    Route::post('awtleave',         array('as' => 'awt_leave',       'uses' =>   'ATWController@create'));


});



