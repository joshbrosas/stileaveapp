<?php

class LeaveWOPayAdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /leavewopayadmin
	 *
	 * @return Response
	 */
	public function index()
	{
		$empty = '';
		$profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		$getleave =LeaveWOPay::with('user')->where('status', $empty)->orderBy('created_at', 'desc')->get();
		return View::make('admindashboard.leave_wopay')
			->with('admin', $profile)
			->with('getleave', $getleave)
			->with('title', 'STI Leave Panel with pay');
	}

	public function save_options($id){
		LeaveWOPay::with('user')->where('leave_id', $id)->update(
			array('status' => Input::get('status'))
		);

		$approve = LeaveWOPay::with('user')->where('leave_id', $id)->first();

		$adminlog = new AdminLogWOP();
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
		$userlog->type_of_leave = 'Leave without pay';
		$userlog->days_of_leave = $approve->days_of_leave;
        $userlog->wdays_of_leave = $approve->wdays_of_leave;
        $userlog->date_from = $approve->date_from;
        $userlog->time_from = $approve->time_from;
        $userlog->date_to = $approve->date_to;
        $userlog->time_to = $approve->time_to;
        $userlog->company ='';
        $userlog->address ='';
		$userlog->reason = $approve->reason;
        $userlog->status = Input::get('status');
		$userlog->save();

		$approve = new Approval();
		$approve->employee_id = Auth::user()->employee_id;
		$approve->leave_id = Input::get('leave_id');
        $approve->type_of_leave = 'Leave without pay';
		$approve->message = Input::get('message');
		$approve->status = Input::get('status');
		$approve->save();

		return Redirect::route('leavewopay');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /leavewopayadmin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /leavewopayadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /leavewopayadmin/{id}/edit
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
	 * PUT /leavewopayadmin/{id}
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
	 * DELETE /leavewopayadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}