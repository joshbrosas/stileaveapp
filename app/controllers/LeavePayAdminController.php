<?php

class LeavePayAdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /leavepayadmin
	 *
	 * @return Response
	 */
	public function index()
	{
		$empty = '';
		$profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		$getleave =LeaveWPay::with('user')->where('status', $empty)->orderBy('created_at', 'desc')->get();
        return View::make('admindashboard.leavepay')
            ->with('admin', $profile)
			->with('getleave', $getleave)
            ->with('title', 'STI | Leave Panel with pay');
	}

	public function status_options($id){
	  LeaveWPay::with('user')->where('leave_id', $id)->update(
		 array('status' => Input::get('status'))

		);

		$approve = LeaveWPay::with('user')->where('leave_id', $id)->first();

		$adminlog = new AdminLogWP();
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
		$userlog->type_of_leave = 'Leave with pay';
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
        $approve->type_of_leave = 'Leave with pay';
		$approve->message = Input::get('message');
		$approve->status = Input::get('status');
		$approve->save();


		return Redirect::route('leavepay');
	}


}