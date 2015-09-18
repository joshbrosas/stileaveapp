<?php

class OBController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /ob
	 *
	 * @return Response
	 */
	public function index()
	{
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        $recentleave = LeaveWPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        $profile = UserDetails::where('employee_id', '=', Auth::user()->employee_id)->first();
        $rleave = LeaveOB::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        return View::make('dashboard.apply_ob')
            ->with('countleave', $leavecount)
            ->with('profile', $profile)
            ->with('rleave', $rleave)
            ->with('title', 'STI | Apply (OB)');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /ob/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$validate = LeaveOB::validate(Input::all());
        if($validate->passes()){
            if(Input::get('totalleaves') <=0.0 or Input::get('totalleaves') === 'NaN'){
                $message = 'Please select correct date!';
                return Redirect::to('applyob')->with('error_message', $message);
            }else
            $lastrow = LeaveOB::orderBy('created_at', 'desc')->first();
            $data = new LeaveOB();
            $data->employee_id = Auth::user()->employee_id;
            if($lastrow == null){
                $data->leave_id = Str::random(8);
            }else{
                $data->leave_id = Str::random(8).($lastrow->id);
            }
            $data->days_of_leave    = Input::get('totalleaves');
            $data->wdays_of_leave   = Input::get('totalleave');
            $data->date_from        = Input::get('date_from');
            $data->time_from        = Input::get('time_from');
            $data->date_to          = Input::get('date_to');
            $data->time_to          = Input::get('time_to');
            $data->company          = Input::get('company');
            $data->address          = Input::get('address');
            $data->reason           = Input::get('reason');
            $data->save();
            return Redirect::to('applyob')
                ->with('message', 'Your Application for Official Business (OB) is successfully send.Please Check Your Notification box to see if your leave  has  been approved.');
        }else{
            return Redirect::to('applyob')->withErrors($validate);
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /ob
	 *
	 * @return Response
	 */
	public function store($id)
	{
        LeaveOB::with('user')->where('leave_id', $id)->update(
            array('status' => Input::get('status')));

        $approve = LeaveOB::with('user')->where('leave_id', $id)->first();

        $adminlog = new AdminLogOB();
        $adminlog->employee_id = Input::get('employee_id');
        $adminlog->leave_id = Input::get('leave_id');
        $adminlog->days_of_leave = $approve->days_of_leave;
        $adminlog->wdays_of_leave = $approve->wdays_of_leave;
        $adminlog->date_from = $approve->date_from;
        $adminlog->time_from = $approve->time_from;
        $adminlog->date_to = $approve->date_to;
        $adminlog->time_to = $approve->time_to;
        $adminlog->company = Input::get('company');
        $adminlog->address = Input::get('address');
        $adminlog->reason = $approve->reason;
        $adminlog->message = Input::get('message');
        $adminlog->status = Input::get('status');
        $adminlog->save();

        $userlog = new UserLeaveLog();
        $userlog->employee_id = Input::get('employee_id');
        $userlog->leave_id = Input::get('leave_id');
        $userlog->type_of_leave = 'Application for OB';
        $userlog->days_of_leave = $approve->days_of_leave;
        $userlog->wdays_of_leave = $approve->wdays_of_leave;
        $userlog->date_from = $approve->date_from;
        $userlog->time_from = $approve->time_from;
        $userlog->date_to = $approve->date_to;
        $userlog->time_to = $approve->time_to;
        $userlog->company = Input::get('company');
        $userlog->address = Input::get('address');
        $userlog->reason = $approve->reason;
        $userlog->status = Input::get('status');
        $userlog->save();

        $approve = new Approval();
        $approve->employee_id = Auth::user()->employee_id;
        $approve->leave_id = Input::get('leave_id');
        $approve->type_of_leave = 'Application for OB';
        $approve->message = Input::get('message');
        $approve->status = Input::get('status');
        $approve->save();

        return Redirect::route('leaveob_admin');

	}

	/**
	 * Display the specified resource.
	 * GET /ob/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{

        $getleave = LeaveOB::where('status', '')->orderBy('created_at', 'desc')->get();
        $profile = UserDetails::where('employee_id', '=', Auth::user()->employee_id)->first();
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        return View::make('admindashboard.leaveob')
            ->with('admin', $profile)
            ->with('getleave', $getleave)
            ->with('countleave', $leavecount)
            ->with('title', 'STI | Official Business (OB)');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /ob/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function recent_ob()
	{
        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $getleave =AdminLogOB::with('user')->where('status' ,'!=', '')->orderBy('created_at', 'desc')->get();
		return View::make('admindashboard.recentob_logs')
            ->with('admin', $profile)
            ->with('getleave', $getleave)
            ->with('title', 'STI | OB Logs');
	}

    public function ob_log($id){
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        $leaveob = LeaveOB::where('leave_id', $id)->first();
        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $rleave = LeaveOB::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        return View::make('dashboard.leave_oblog')
            ->with('profile', $profile)
            ->with('countleave', $leavecount)
            ->with('getleave', $leaveob)
            ->with('rleave', $rleave)
            ->with('title', 'STI | OB Log');
    }

	public function destroy_ob($id)
	{
		LeaveOB::where('leave_id', $id)->delete();

        return Redirect::route('dash');
	}



}