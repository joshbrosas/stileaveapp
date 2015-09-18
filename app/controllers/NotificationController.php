<?php

class NotificationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /notification
	 *
	 * @return Response
	 */
	public function index()
	{
		$leavelog = UserLeaveLog::with('user')->where('employee_id', Auth::user()->employee_id)->orderBy('created_at','desc')->get();
		$leaveoblog = LeaveOB::with('user')->where('employee_id', Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
		$profile = UserDetails::where('employee_id','=', Auth::user()->employee_id)->first();
		$recentleave = LeaveWPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
		$recentwleave = LeaveWOPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        $obleave = LeaveOB::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
        $awtleave = LeaveAWT::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
		return View::make('dashboard.notification_box')
			->with('profile', $profile)
			->with('leavelog', $leavelog)
			->with('rleave',$recentleave)
			->with('sleave',$recentwleave)
            ->with('leaveob', $leaveoblog)
            ->with('leaveawt', $awtleave)
			->with('countleave', $leavecount)
            ->with('obleave',$obleave)
			->with('title', 'STI | Notification Box');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /notification/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /notification
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /notification/{id}
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
	 * GET /notification/{id}/edit
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
	 * PUT /notification/{id}
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
	 * DELETE /notification/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $delnotification = UserLeaveLog::where('leave_id', $id)->delete();

        return Redirect::route('notification');
	}

    public function destroy_ob($id)
    {
        //
        $delnotification = LeaveOBlog::where('leave_id', $id)->delete();

        return Redirect::route('notification');
    }

}