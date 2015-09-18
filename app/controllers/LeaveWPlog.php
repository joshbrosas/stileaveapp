<?php

class LeaveWPlog extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /leavewplog
	 *
	 * @return Response
	 */
	public function index()
	{
		$profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		$getleave = AdminLogWP::with('user')->where('status', '!=', '')->orderBy('created_at', 'desc')->get();
		return View::make('admindashboard.wplog.approvelog')
			->with('admin', $profile)
			->with('getleave', $getleave)
			->with('title', 'STI | (With pay) Logs');
	}

	public function destroy($id)
	{
        AdminLogWP::where('leave_id', $id)->delete();
        return Redirect::route('approve');
	}

}