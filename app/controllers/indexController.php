<?php


class indexController extends BaseController{

public function index(){

      return View::make('index.index')
          ->with('title', 'STI Leave App');

}

 public function dashboard(){

            $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
            $announce = Announcements::with('user')->orderBy('created_at', 'desc')->get();
            $profile = UserDetails::where('employee_id','=', Auth::user()->employee_id)->first();
            $recentleave = LeaveWPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
            $recentwleave = LeaveWOPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
            $obleave = LeaveOB::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
            $awtleave = LeaveAWT::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
            return View::make('dashboard.dashboard')
            ->with('announce', $announce)
            ->with('profile', $profile)
            ->with('countleave', $leavecount)
            ->with('rleave',$recentleave)
            ->with('obleave',$obleave)
            ->with('awtleave',$awtleave)
            ->with('sleave',$recentwleave)
            ->with('title', 'STI | Dashboard');
 }


 public function administrator(){

     return View::make('admindashboard.administrator')
            ->with('title', 'STI | Dashboard');
    }

public function login(){

   $tbllogin = array(
       'username'   => Input::get('txt_username'),
       'password'   => Input::get('txt_password'),

   );

    if(Auth::attempt($tbllogin)){
        if(Auth::user()->role === 'Administrator'){
            return Redirect::route('administrator');
        }else{
            return Redirect::route('dash');
        }
    }
    else{
        Session::flash('message', 'Invalid Username/Password');
        return Redirect::route('index');
    }

}
    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return Redirect::route('index');
        }else{
            return Redirect::route('index');
        }
    }

    public function show_announce($id){

        $post_comment = AnnouncementComments::where('post_id',$id)->orderBy('created_at', 'desc')->get();
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        $announce = Announcements::with('user')->where('post_id', $id)->orderBy('created_at', 'desc')->first();
        $profile = UserDetails::where('employee_id','=', Auth::user()->employee_id)->first();
        $recentleave = LeaveWPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        $recentwleave = LeaveWOPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        return View::make('dashboard.announcement')
            ->with('post', $announce)
            ->with('post_comment', $post_comment)
            ->with('profile', $profile)
            ->with('countleave', $leavecount)
            ->with('rleave',$recentleave)
            ->with('sleave',$recentwleave)
            ->with('title', 'STI | Show Announcement');
    }

}