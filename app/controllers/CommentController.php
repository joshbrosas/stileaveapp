<?php

class CommentController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /comment
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /comment/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $validate = AnnouncementComments::validate(Input::all());
        if($validate->passes()){
            $model = new AnnouncementComments();
            $model->post_id = Input::get('postid');
            $model->employee_id = Auth::user()->employee_id;
            $model->post_comment = Input::get('comment');
            $model->save();
            return Redirect::route('vannounce', Input::get('postid'));
        }else{
            return Redirect::route('vannounce', Input::get('postid'))->withErrors($validate);
        }

	}

    public function create_admin()
    {
        $validate = AnnouncementComments::validate(Input::all());
        if($validate->passes()){
            $model = new AnnouncementComments();
            $model->post_id = Input::get('postid');
            $model->employee_id = Auth::user()->employee_id;
            $model->post_comment = Input::get('comment');
            $model->save();

            return Redirect::route('viewpost', Input::get('postid'));

        }else{
            return Redirect::route('viewpost', Input::get('postid'))->withErrors($validate);
        }

    }

	/**
	 * Store a newly created resource in storage.
	 * POST /comment
	 *
	 * @return Response
	 */
	public function store()
	{


	}

	/**
	 * Display the specified resource.
	 * GET /comment/{id}
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
	 * GET /comment/{id}/edit
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
	 * PUT /comment/{id}
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
	 * DELETE /comment/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}