<?php

class PoliciesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /policies
	 *
	 * @return Response
	 */
	public function index()
	{
		//
        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $policies = AdminPolicies::orderBy('created_at', 'desc')->get();
        return View::make('admindashboard.policies')
            ->with('admin', $profile)
            ->with('policies', $policies)
            ->with('title', 'STI | Policies');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /policies/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//

       $validate = AdminPolicies::validate(Input::all());

        if($validate->passes()){
            $destinationPath = storage_path('download_files/');
            $filename = Input::file('file');
            $title = Input::get('title');
            $ext = $filename->guessExtension();
            $filename->move($destinationPath, $title.'.'.$ext);

            $lastrow = AdminPolicies::orderBy('created_at', 'desc')->first();
            $policies = New AdminPolicies();
            $policies->employee_id = Auth::user()->employee_id;
            if($lastrow == null){
                $policies->download_id = mt_rand();
            }else{
                $policies->download_id = mt_rand().($lastrow->id);
            }
            $policies->subject = Input::get('title');
            $policies->pdffile = $title.'.'.$ext;
            $policies->extension = $ext;
            $policies->save();

            return Redirect::route('admin_policies')
                ->with('message', 'Form Uploaded successfully!');
        }else{
            return Redirect::route('admin_policies')->withErrors($validate);
        }



	}

	/**
	 * Store a newly created resource in storage.
	 * POST /policies
	 *
	 * @return Response
	 */
	public function store($id)
	{
		//
        $download = AdminPolicies::where('download_id', $id)->first();
        $destinationPath = storage_path('download_files/'.$download->pdffile);
        return Response::download($destinationPath);

	}

	/**
	 * Display the specified resource.
	 * GET /policies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $leavecount = LeaveCounter::where('employee_id', Auth::user()->employee_id)->first();
		$profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $policies = AdminPolicies::orderBy('created_at', 'desc')->get();
        return View::make('dashboard.policies')
            ->with('profile', $profile)
            ->with('policies', $policies)
            ->with('countleave', $leavecount)
            ->with('title', 'STI | School Policies');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /policies/{id}/edit
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
	 * PUT /policies/{id}
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
	 * DELETE /policies/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}