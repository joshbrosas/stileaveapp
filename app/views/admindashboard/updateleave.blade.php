@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3"  id="prof">
         <div class="panel panel-default" id="profile">
           {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
             <div id="pnelprofilepic">
                {{ HTML::image($profile->profile_mage, 'profilepic', array('id' => 'profile-pic'))  }}
              </div>
                 <div class="panel-body caption" id="pnelcaption">
                     <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                        <h5><strong>Administrator</strong></h5>
                 </div>
         </div>
            <div class="list-group">
                <a class="list-group-item active">HR</a>
                <a href="{{ URL::route('view_users') }}" class="list-group-item"><span class="glyphicon glyphicon-chevron-left"></span> Go back</a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Control Panel</a>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> School Policies</a>
                <a href="#" class="list-group-item"><span class="glyphicon glyphicon-info-sign"></span> Policies</a>
            </div>
        </div>

        <div class="col-xs-6" id="stat">
        <div class="panel panel-body">
        <h3><b>Update number of leave</b></h3>
        <hr>

 @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{{ Session::get('message') }}</strong>
        </div>
  @endif
        {{ Form::open(array('url' => 'updateleave/'.$leavecount->employee_id, 'class' => 'form-horizontal', 'method' => 'post')) }}

                    <div class="form-group">
                        <label class="col-sm-6 control-label">Remaining leave <b>( with Pay)</b>:</label>
                        <div class="col-sm-4">
                          <input type="text" name="withpay" value="{{ $leavecount->remaining_leave }}" class="form-control">
                          <div class="has-error">@if ($errors->has('withpay'))<p class="label label-danger labelerror">{{ $errors->first('withpay') }}</p>  @endif</div>
                        </div>
                    </div>

                  <div class="form-group">
                    <label class="col-sm-6 control-label">Remaining leave <b>( without Pay)</b>:</label>
                    <div class="col-sm-4">
                      <input type="text" name="withoutpay" value="{{ $leavecount->remaining_leave_wopay }}" class="form-control">
                      <div class="has-error">@if ($errors->has('withoutpay'))<p class="label label-danger labelerror">{{ $errors->first('withoutpay') }}</p>  @endif</div>
                    </div>
                  </div>

<hr>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-10">
                      <button type="submit" class="btn btn-default" id="btn_pdse"><i class="fa fa-save"></i> Update </button>
                    </div>
                  </div>
              {{ Form::close() }}

        </div>


        </div>

        <div class="col-xs-3">
            <div class="list-group">
                <a class="list-group-item active">Mission and Vision</a>
                <div class="panel panel-body">
                    <span><strong>Mission</strong></span>
                    <p style="font-size: 12px">We are an institution committed to provide knowledge through the development and delivery of superior learning systems.
                        <br><br>
                        We strive to provide optimum value to all our stakeholders – our students, our faculty members, our employees, our partners, our shareholders, and our community.
                        <br><br>
                        We will pursue this mission with utmost integrity, dedication, transparency, and creativity.</p>
                    <span><strong>Vision</strong></span>
                    <p style="font-size: 12px">To be the leader in innovative and relevant education that nurtures individuals to become competent and responsible members of society. </p>
                </div>
            </div>
        </div>

    </div>
</div>


@include('index.footer')

