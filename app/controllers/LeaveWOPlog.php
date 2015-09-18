<?php

class LeaveWOPlog extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /leavewoplog
	 *
	 * @return Response
	 */
	public function index()
	{
		$profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		$getleave = AdminLogWOP::with('user')->where('status', '!=', '')->orderBy('created_at', 'desc')->get();
		return View::make('admindashboard.woplog.wo_approvelog')
			->with('admin', $profile)
			->with('getleave', $getleave)
			->with('title', 'STI | (Without pay) Logs');
	}



    public function destroy_approve($id)
    {
        AdminLogWOP::where('leave_id', $id)->delete();
        return Redirect::route('wo_approve');
    }


}