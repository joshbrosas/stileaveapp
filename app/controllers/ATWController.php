<?php

class ATWController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /atw
	 *
	 * @return Response
	 */
	public function index()
	{
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        $profile = UserDetails::where('employee_id', '=', Auth::user()->employee_id)->first();
        $rleave = LeaveAWT::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        return View::make('dashboard.apply_otw')
            ->with('countleave', $leavecount)
            ->with('profile', $profile)
            ->with('rleave', $rleave)
            ->with('title', 'STI | Apply (ATW)');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /atw/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $validate = LeaveAWT::validate(Input::all());
        if($validate->passes()){
            if(Input::get('totalleaves') <=0.0 or Input::get('totalleaves') === 'NaN'){
                $message = 'Please select correct date!';
                return Redirect::to('applyatw')->with('error_message', $message);
            }else
                $lastrow = LeaveAWT::orderBy('created_at', 'desc')->first();
            $data = new LeaveAWT();
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
            $data->reason           = Input::get('reason');
            $data->save();
            return Redirect::to('applyatw')
                ->with('message', 'Your Application for Authorization to Work (ATW) is successfully send.Please Check Your Notification box to see if your leave  has  been approved.');
        }else{
            return Redirect::to('applyatw')->withErrors($validate);
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /atw
	 *
	 * @return Response
	 */
	public function store($id)
	{
		//
        LeaveAWT::with('user')->where('leave_id', $id)->update(
            array('status' => Input::get('status')));

        $approve = LeaveAWT::with('user')->where('leave_id', $id)->first();

        $adminlog = new AdminLogAWT();
        $adminlog->employee_id = Input::get('employee_id');
        $adminlog->leave_id = Input::get('leave_id');
        $adminlog->days_of_leave = $approve->days_of_leave;
        $adminlog->wdays_of_leave = $approve->wdays_of_leave;
        $adminlog->date_from = $approve->date_from;
        $adminlog->time_from = $approve->time_from;
        $adminlog->date_to = $approve->date_to;
        $adminlog->time_to = $approve->time_to;
        $adminlog->reason = $approve->reason;
        $adminlog->message = Input::get('message');
        $adminlog->status = Input::get('status');
        $adminlog->save();

        $userlog = new UserLeaveLog();
        $userlog->employee_id = Input::get('employee_id');
        $userlog->leave_id = Input::get('leave_id');
        $userlog->type_of_leave = 'Application for Authority to Work (ATW)';
        $userlog->days_of_leave = $approve->days_of_leave;
        $userlog->wdays_of_leave = $approve->wdays_of_leave;
        $userlog->date_from = $approve->date_from;
        $userlog->time_from = $approve->time_from;
        $userlog->company = '';
        $userlog->address = '';
        $userlog->date_to = $approve->date_to;
        $userlog->time_to = $approve->time_to;
        $userlog->reason = $approve->reason;
        $userlog->status = Input::get('status');
        $userlog->save();

        $approve = new Approval();
        $approve->employee_id = Auth::user()->employee_id;
        $approve->leave_id = Input::get('leave_id');
        $approve->type_of_leave = 'Application for Authority to Work (ATW)';
        $approve->message = Input::get('message');
        $approve->status = Input::get('status');
        $approve->save();

        return Redirect::route('leaveatw_admin');
	}

	/**
	 * Display the specified resource.
	 * GET /atw/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $getleave = LeaveAWT::with('user')->where('status', '')->get();

        return View::make('admindashboard.leaveatw')
            ->with('admin', $profile)
            ->with('getleave', $getleave)
            ->with('title', 'STI | Authorization to Work (ATW)');
	}

    public function recent_awt()
    {

        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $getleave =AdminLogAWT::with('user')->where('status' ,'!=', '')->orderBy('created_at', 'desc')->get();
        return View::make('admindashboard.recentawt_logs')
            ->with('admin', $profile)
            ->with('getleave', $getleave)
            ->with('title', 'STI | ATW Logs');
    }

    public function atw_log($id)
    {
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
        $leaveob = LeaveAWT::where('leave_id', $id)->first();
        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $rleave = LeaveAWT::where('employee_id', Auth::user()->employee_id)->orderBy('created_at', 'desc')->get();
        return View::make('dashboard.leave_awtlog')
            ->with('profile', $profile)
            ->with('countleave', $leavecount)
            ->with('getleave', $leaveob)
            ->with('rleave', $rleave)
            ->with('title', 'STI | ATW Log');
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /atw/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /atw/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /atw/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        LeaveAWT::where('leave_id', $id)->delete();
        return Redirect::route('dash');
	}

}