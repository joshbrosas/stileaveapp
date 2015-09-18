@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3">
             <div class="panel panel-default" id="profile">
                 {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                 <div id="pnelprofilepic">
                     <img src="{{ $admin->profile_mage }}" id="profile-pic">
                 </div>
                 <div class="panel-body caption" id="pnelcaption">
                     <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($admin->firstname) }} {{ ucfirst($admin->surname) }}</h4>
                     <h5><strong>Administrator</strong></h5>
                 </div>
             </div>
            <div class="list-group">
                <a class="list-group-item active">Administrative Panel</a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cogs"></i> Control Panel</a>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h3><strong><i class="fa fa-user-plus"></i> Create Users</strong></h3>
                <hr>
                <div class="col-xs-10 col-xs-offset-1">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('message') }}</strong>
                        </div>
                        @endif

                    {{ Form::open(array('url' => 'r_user', 'class' => 'form-horizontal', 'method' => 'post')) }}
                        <p class="help-block">User Account</p>
                        <hr>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Username:</label>
                            <div class="col-xs-6">
                               <span class="@if($errors->has('username')) has-error @endif">{{ Form::text('username', Input::old('username'), array('class' => 'form-control', 'placeholder' => 'Username')) }}</span>
                                <div class="has-error">@if ($errors->has('username'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('username') }}</p>  @endif</div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Password:</label>
                            <div class="col-xs-6">
                                <span class="@if($errors->has('password')) has-error @endif"><input type="password" class="form-control"  name="password" placeholder="Password"></span>
                                <div class="has-error">@if ($errors->has('password'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('password') }}</p>  @endif</div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Repeat Password:</label>
                            <div class="col-xs-6">
                               <span class="@if($errors->has('pass_confirmation')) has-error @endif"><input type="password" class="form-control" name="pass_confirmation" placeholder="Confirm Password"></span>
                                <div class="has-error">@if ($errors->has('pass_confirmation'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('pass_confirmation') }}</p>  @endif</div>
                            </div>
                        </div>

                        <hr>
                        <p class="help-block">User Details</p>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Employee ID:</label>
                            <div class="col-xs-6">
                                <span class="@if($errors->has('employeeid')) has-error @endif"><input type="text" class="form-control" value="{{ Input::old('employeeid') }}" name="employeeid" placeholder="Employee ID"></span>
                                <div class="has-error">@if ($errors->has('employeeid'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('employeeid') }}</p>  @endif</div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Firstname:</label>
                            <div class="col-xs-6">
                                <span class="@if($errors->has('firstname')) has-error @endif"><input type="text" class="form-control" value="{{ Input::old('firstname') }}" name="firstname" placeholder="Firstname"></span>
                                <div class="has-error">@if ($errors->has('firstname'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('firstname') }}</p>  @endif</div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Surname:</label>
                            <div class="col-xs-6">
                                <span class="@if($errors->has('surname')) has-error @endif"><input type="text" class="form-control" value="{{Input::old('surname')}}" name="surname" placeholder="Surname"></span>
                                <div class="has-error">@if ($errors->has('surname'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('surname') }}</p>  @endif</div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Employment Status:</label>
                            <div class="col-xs-6">
                                <select class="form-control" name="status">
                                    <option value="Regular">Regular</option>
                                    <option value="Contractual">Contractual</option>
                                    <option value="Probationary">Probationary</option>
                                    <option value="Part-time Full Load">Part-time Full Load</option>
                                </select>
                                <div class="has-error">@if ($errors->has('status'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('status') }}</p>  @endif</div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Department:</label>
                            <div class="col-xs-6">
                                <select class="form-control" name="department">
                                    <option value="Administrator">Administrator</option>
                                    <option value="Finance">Finance</option>
                                    <option value="MIS-Tech Support">MIS - Tech Support</option>
                                    <option value="FAM-Maintenance&Engineering">FAM - Maintenance&Engineering</option>
                                    <option value="Purchasing Officer">Purchasing Officer</option>
                                    <option value="FAM-Asset Custodian">FAM - Asset Custodian</option>
                                    <option value="Guidance Counselor">Guidance Counselor</option>
                                    <option value="Registrar">Registrar</option>
                                    <option value="Admission Officer">Admission Officer</option>
                                    <option value="Placement Officer">Placement Officer</option>
                                    <option value="MIS-Laboratory Facilitator">MIS - Laboratory Facilitator</option>
                                    <option value="Librarian">Librarian</option>
                                    <option value="Academics">Academics</option>
                                    <option value="HR-Student Affair">HR - Student Affair</option>
                                </select>
                                <div class="has-error">@if ($errors->has('department'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('department') }}</p>  @endif</div>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Email:</label>
                            <div class="col-xs-6">
                                <span class="@if($errors->has('email')) has-error @endif"><input type="email" class="form-control"  value="{{ Input::old('email') }}" name="email" placeholder="Email"></span>
                                <div class="has-error">@if ($errors->has('email'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('email') }}</p>  @endif</div>
                            </div>
                        </div>
                    <hr>
                        <div class="form-group">
                            <div class="col-xs-offset-3 col-xs-10">
                                <button type="submit" class="btn btn-default" id="btn_pdse">Create Account</button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@include('index.footer')