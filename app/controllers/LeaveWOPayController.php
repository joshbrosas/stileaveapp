<?php

class LeaveWOPayController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /leavewopay
	 *
	 * @return Response
	 */
	public function index()
	{
		$leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
		$recentleave = LeaveWOPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
		$profile = UserDetails::where('employee_id', '=', Auth::user()->employee_id)->first();
		return View::make('dashboard.u_withoutpay')
			->with('profile', $profile)
			->with('rleave',$recentleave)
			->with('countleave', $leavecount)
			->with('title', 'STI | Leave without pay');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /leavewopay/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /leavewopay
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /leavewopay/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$recentleave = LeaveWOPay::with('user')->where('employee_id',Auth::user()->employee_id)->orderBy('created_at','desc')->get();
		$getleave = LeaveWOPay::with('user')->where('leave_id', $id)->first();
		$profile = UserDetails::where('employee_id', '=', Auth::user()->employee_id)->first();
		$leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
		return View::make('dashboard.leave_logw')
			->with('profile', $profile)
			->with('rleave',$recentleave)
			->with('getleave', $getleave)
			->with('countleave', $leavecount)
			->with('title', 'STI | Leave with pay');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /leavewopay/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$validate = LeaveWPay::validate(Input::all());
		if($validate->passes()){
			$count = LeaveCounter::where('employee_id', $id)->first();
			if(Input::get('totalleaves') <0 or Input::get('totalleaves') === 'NaN'){
				$message = 'Please select correct date!';
				return Redirect::to('leavewopay')->with('error_message', $message);
			}elseif(Input::get('totalleaves') <= '0.0'){
                $message = 'Date and time not allowed.Please try again.';
                return Redirect::to('leavewopay')->with('error_message', $message);
            }elseif(Input::get('totalleaves') >10){
				$message = 'You rich maximum limit of leave!';
				return Redirect::to('leavewopay')->with('error_message', $message);
			}elseif(Input::get('totalleaves') > $count->remaining_leave_wopay ){
				$message = 'Insufficient number of leave!';
				return Redirect::to('leavewopay')->with('error_message', $message);
			}
			else{

				$leavecount = LeaveCounter::where('employee_id', $id)->first();
				$leavecount->remaining_leave_wopay = $leavecount->remaining_leave_wopay - Input::get('totalleaves');
				$leavecount->save();

				$lastrow = LeaveWOPay::orderBy('created_at', 'desc')->first();

				$userdata = new LeaveWOPay();
				$userdata->employee_id = Auth::user()->employee_id;
				if($lastrow == null){
					$userdata->leave_id = Str::random(30);
				}else{
					$userdata->leave_id = Str::random(30).($lastrow->id);
				}
				$userdata->days_of_leave = Input::get('totalleaves');
                $userdata->wdays_of_leave = Input::get('totalleave');
                $userdata->date_from = Input::get('date_from');
                $userdata->time_from = Input::get('time_from');
                $userdata->date_to = Input::get('date_to');
                $userdata->time_to = Input::get('time_to');
				$userdata->reason = Input::get('reason');
				$userdata->save();
				return Redirect::to('leavewopay')
					->with('message', 'Your Application for leave is successfully send.Please Check Your Notification box to see if your leave  has  been approved.');


			}

		}else{

			return Redirect::to('leavewopay')->withErrors($validate);

		}

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /leavewopay/{id}
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
	 * DELETE /leavewopay/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        LeaveWOPay::where('leave_id', $id)->delete();
        return Redirect::route('dash');
	}

}