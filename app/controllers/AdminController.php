<?php

class AdminController extends \BaseController {

	public $restful = true;

	/**
	 * Display a listing of the resource.
	 * GET /admin
	 *
	 * @return Response
	 */
	public function index()
	{
		$countlwpay = LeaveWPay::where('status', '')->count();
		$countlwOpay = LeaveWOPay::where('status', '')->count();
        $countob = LeaveOB::where('status', '')->count();
        $countawt = LeaveAWT::where('status', '')->count();
		$useradmin = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		return View::make('admindashboard.administrator')
		->with('title', 'STI | Dashboard')
		->with('admin', $useradmin)
		->with('countlw', $countlwpay)
        ->with('countob', $countob)
        ->with('countawt', $countawt)
		->with('countlwo', $countlwOpay);
	}

	public function create_user(){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
		return View::make('admindashboard.create_user')
			->with('title', 'STI | Create Users')
			->with('admin', $useradmin);

	}

	public function d_home(){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
        $announce = Announcements::with('user')->orderBy('created_at', 'desc')->get();
			return View::make('admindashboard.home')
				->with('profile', $useradmin)
                ->with('announce', $announce)
				->with('title', 'STI | Home');
	}

	public function get_announce(){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
		return View::make('admindashboard.c_announce')
			->with('admin', $useradmin)
			->with('title', 'STI | Announce');
	}

	public function create_admin(){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
		return View::make('admindashboard.create_admin')
			->with('admin', $useradmin)
			->with('title', 'STI | Create Admin');
	}

	public function show()
	{
		//
		$useradmin = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
		$table = Datatable::table()
			->addColumn('EmployeeID', 'Fullname', 'Department','Email','Action')
			->setUrl(route('alluser'))
			->noScript();
		return View::make('admindashboard.viewusers')
			->with('table', $table)
			->with('admin', $useradmin)
			->with('title', 'All Users');

	}

	public function edituser($id){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
		$q_a = UserLogin::where('employee_id', $id)->first();
		$q_c = UserDetails::where('employee_id', $id)->first();
		return View::make('admindashboard.e_user')
			->with('title', 'STI | Edit User')
			->with('admin', $useradmin)
			->with('user', $q_c)
			->with('userlogin', $q_a);
	}

	public function deleteuser($id){

		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
		$profile = UserDetails::where('employee_id', $id)->first();
		return View::make('admindashboard.d_user')
			->with('admin', $useradmin)
			->with('profile', $profile)
			->with('title', 'STI | Delete User');


	}
	public function viewpost($id){
		$useradmin = UserDetails::where('id', Auth::user()->id)->first();
        $post_comment = AnnouncementComments::where('post_id',$id)->orderBy('created_at', 'desc')->get();
		$announce = Announcements::with('user')->where('post_id', $id)->first();
		return View::make('admindashboard.v_announce')
			->with('admin', $useradmin)
			->with('post', $announce)
            ->with('post_comment', $post_comment)
			->with('title', 'View Announcement');
	}

	public function create()
	{
		$validate = UserLogin::validate(Input::all());
		$validatedetails = UserDetails::validate(Input::all());
		if($validate->passes() and $validatedetails->passes()){

		$defaultimg = 'default.png';

	        $userlogin = new UserLogin();
	        $userlogin->employee_id = Input::get('employeeid');
            $userlogin->username = Input::get('username');
			$userlogin->password = Hash::make(Input::get('password'));
			$userlogin->save();

			$userleave = new LeaveCounter();
			$userleave->employee_id = Input::get('employeeid');
			$userleave->remaining_leave = 10;
			$userleave->remaining_leave_wopay = 10;
			$userleave->save();

			$userdetails = new UserDetails();
			$userdetails->employee_id = Input::get('employeeid');
			$userdetails->firstname = Input::get('firstname');
			$userdetails->surname = Input::get('surname');
			$userdetails->profile_mage = 'img/'.$defaultimg;
			$userdetails->surname = Input::get('surname');
			$userdetails->e_status =  Input::get('status');
			$userdetails->department = Input::get('department');
			$userdetails->email = Input::get('email');
			$userdetails->save();

			return Redirect::route('create_user')->with('message', 'Registered Successfully!');
		}
		else{
			$validation = array_merge_recursive($validate->messages()->toArray(), $validatedetails->messages()->toArray());
			return Redirect::route('create_user')->withErrors($validation)->withInput();
		}
	}

	public function crt_admin(){

		$validate = UserLogin::validate(Input::all());
		$validatedetails = UserDetails::validate(Input::all());

		if($validate->passes() and $validatedetails->passes()){

			$defaultimg = 'default.png';

            $userleave = new LeaveCounter();
            $userleave->employee_id = Input::get('employeeid');
            $userleave->remaining_leave = 10;
            $userleave->remaining_leave_wopay = 10;
            $userleave->save();

			$userlogin = new UserLogin();
			$userlogin->employee_id = Input::get('employeeid');
			$userlogin->username = Input::get('username');
			$userlogin->password = Hash::make(Input::get('password'));
			$userlogin->role = 'Administrator';
			$userlogin->save();

			$userdetails = new UserDetails();
			$userdetails->employee_id = Input::get('employeeid');
			$userdetails->firstname = Input::get('firstname');
			$userdetails->surname = Input::get('surname');
			$userdetails->profile_mage =  'img/' . $defaultimg;
			$userdetails->e_status = 'Administrator';
			$userdetails->department = Input::get('department');
			$userdetails->email = Input::get('email');
			$userdetails->save();

			return Redirect::route('create_admin')->with('message', 'Registered Successfully!');
		}
		else{
			$validation = array_merge_recursive($validate->messages()->toArray(), $validatedetails->messages()->toArray());
			return Redirect::route('create_admin')->withErrors($validation)->withInput();
		}
	}

    public function update_user($id)
    {
        $validate = UserDetails::validate_required(Input::all());

        if($validate->passes()){
            $u_login = UserLogin::where('employee_id', $id)->first();
            $u_login->username = Input::get('username');
            $u_login->employee_id = Input::get('employeeid');
            $u_login->save();

            $u_details = UserDetails::where('employee_id', $id)->first();
            $u_details->employee_id = Input::get('employeeid');
            $u_details->firstname = Input::get('firstname');
            $u_details->surname = Input::get('surname');
            $u_details->department = Input::get('department');
            $u_details->email = Input::get('email');
            $u_details->save();

            return Redirect::to('e_user/'.$u_details->employee_id)->with('message', ucfirst($u_details->firstname).' '.ucfirst($u_details->surname));
        }else{

            return Redirect::to('e_user/'.$id)->withErrors($validate)->withInput();
        }

    }

	public function post_announce(){
        $validate = Announcements::validate(Input::all());

        if($validate->passes()){
            $lastrow = AnnouncementComments::orderBy('created_at', 'desc')->first();
            $announce = new Announcements();
            $announce->employee_id = Auth::user()->employee_id;
            if($lastrow == null){
                $announce->post_id = mt_rand();
            }else{
                $announce->post_id = mt_rand().($lastrow->id);
            }
            $announce->subject = Input::get('subject');
            $announce->announce = Input::get('announce');
            $image = Input::file('image');
            if($image == ''){
                $announce->image = '';
            }else{
                $filename = time() . '.' . $image->getClientOriginalName();
                $path = public_path('img_announce/' . $filename);
                Image::make($image->getRealPath())->save($path);
                $announce->image = 'img_announce/' . $filename;
            }
            $announce->save();
            return Redirect::route('announce')
                ->with('message', 'Announcement posted successfully!');
        }else{

            return Redirect::route('announce')
                ->withErrors($validate)
                ->withInput();
        }

	}

	public function post_imageupload($id){

		$validate = UserDetails::validate_image(Input::all());

		if($validate->passes()){
			$user = UserDetails::where('employee_id', $id)->first();
			$image = Input::file('images');
			$filename = time() . '.' . $image->getClientOriginalName();
			$path = public_path('images/' . $filename);
			Image::make($image->getRealPath())->fit(150,150)->save($path);
			$user->profile_mage = 'images/' . $filename;
			$user->save();
			return Redirect::to('dashboard');
		}else{
			return Redirect::to('dashboard')->withErrors($validate);
		}

	}

    public function post_adminimageupload($id){

        $validate = UserDetails::validate_image(Input::all());
        if($validate->passes()){
			$user = UserDetails::where('employee_id', $id)->first();
            $image = Input::file('images');
            $filename = time() . '.' . $image->getClientOriginalName();
            $path = public_path('images/' . $filename);
            Image::make($image->getRealPath())->fit(150,150)->save($path);
            $user->profile_mage = 'images/' . $filename;
            $user->save();
            return Redirect::route('administrator');
        }else{
            return Redirect::route('administrator')->withErrors($validate);
        }
    }



	public function getallusers(){


		return Datatable::collection(UserDetails::all(array('id','employee_id','firstname','surname','department','email')))
			->searchColumns(array('employee_id', 'firstname', 'surname'))

            ->addColumn('employee_id', function($model){
                return $model->employee_id;
            })
			->addColumn('firstname', function($model){
				return ucfirst($model->surname) .', '.ucfirst($model->firstname);
			})
			->addColumn('department', function($model){
				return $model->department;
			})
			->addColumn('email', function($model){
				return $model->email;
			})
			->addColumn('action', function($model){
				return
					"<a href='e_user/".$model->employee_id."'class='btn btn-sm btn-success'><i class='fa fa-edit'></i></a>
					<a href='u_leave/".$model->employee_id."'class='btn btn-sm btn-info'><i class='fa fa-refresh'></i></a>
					<a href='d_user/".$model->employee_id."'class='btn btn-sm btn-danger'><i class='fa fa-trash'></i></a>";
			})
            ->make();
	}



	public function post_delete($id){

		$d_login = UserLogin::where('employee_id', $id)->first();
		$d_login->delete();

        $userlog = UserLeaveLog::where('employee_id',$id)->delete();
        LeaveWPay::where('employee_id',$id)->delete();
        LeaveWOPay::where('employee_id',$id)->delete();
        LeaveCounter::where('employee_id',$id)->delete();
        LeaveAWT::where('employee_id',$id)->delete();
        LeaveOB::where('employee_id',$id)->delete();
        AdminLogWP::where('employee_id',$id)->delete();
        AdminLogWOP::where('employee_id',$id)->delete();
        AdminLogOB::where('employee_id', $id)->delete();
        AdminLogAWT::where('employee_id', $id)->delete();
        AnnouncementComments::where('employee_id', $id)->delete();
        Approval::where('employee_id', $id)->delete();
		$d_user = UserDetails::where('employee_id', $id)->first();
		$d_user->delete();

		return Redirect::route('view_users');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /admin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $delete = Announcements::where('post_id', $id)->delete();
        return Redirect::route('home');
	}

    public function update_leave($id){

        $profile = UserDetails::where('employee_id', Auth::user()->employee_id)->first();
        $leavecount = LeaveCounter::where('employee_id',$id)->first();
       return View::make('admindashboard.updateleave')
           ->with('profile',$profile)
           ->with('leavecount', $leavecount)
           ->with('title', 'STI | Update Leave Count');
    }

    public function post_leave($id){
        $validate = LeaveCounter::validate(Input::all());
        if($validate->passes()){
            $updateleave = LeaveCounter::where('employee_id', $id)->first();
            $updateleave->remaining_leave       = Input::get('withpay');
            $updateleave->remaining_leave_wopay = Input::get('withoutpay');
            $updateleave->save();

            return Redirect::to('u_leave/'.$id)
                ->with('message', 'The number of leave has been successfully updated!');
        }else{
            return Redirect::to('u_leave/'.$id)
                ->withErrors($validate);
        }


    }

}