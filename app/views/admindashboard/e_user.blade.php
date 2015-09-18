@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3">
            <div class="panel panel-default" id="profile">
                {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                    <div id="pnelprofilepic">
                     {{ HTML::image($admin->profile_mage, 'stilogo',array('id' =>'profile-pic')) }}
                    </div>
             <div class="panel-body caption" id="pnelcaption">
                    <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($admin->firstname) }} {{ ucfirst($admin->surname) }}</h4>
                    <h5><strong>Administrator</strong></h5>
             </div>
            </div>
            <div class="list-group">
                <a class="list-group-item active">HR</a>
                <a href="{{ URL::route('view_users') }}" class="list-group-item"><span class="pull-left glyphicon glyphicon-chevron-left"></span> Go Back</a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cogs"></i> Control Panel</a>
                <a href="{{ URL::route('admin_policies') }}" class="list-group-item"><span class="glyphicon glyphicon-info-sign"></span> Policies</a>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h3><strong><i class="fa fa-edit"></i> Edit Users</strong></h3>
                <hr>

                <div class="col-xs-10 col-xs-offset-1">
                    @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('message') }} </strong> details updated successfully!
                        </div>
                    @endif
                    {{ Form::open(array('url' => 'u_user/'.$user->employee_id, 'class' => 'form-horizontal', 'method' => 'put')) }}
                    <p class="help-block">User Account</p>
                    <hr>

                    <div class="form-group has-feedback">
                        <label class="col-xs-3 control-label">Username:</label>
                        <div class="col-xs-6">
                            <span class="@if($errors->has('username')) has-error @endif">{{ Form::text('username',  $userlogin->username, array('class' => 'form-control', 'placeholder' => 'Username', 'readonly')) }}</span>
                            <div class="has-error">@if ($errors->has('username'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('username') }}</p>  @endif</div>
                        </div>
                    </div>
                    <hr>
                    <p class="help-block">User Details</p>

                    <div class="form-group has-feedback">
                        <label class="col-xs-3 control-label">Employee ID:</label>
                        <div class="col-xs-6">
                            <span class="@if($errors->has('employeeid')) has-error @endif"><input type="text" class="form-control" value="{{ $user->employee_id }}" name="employeeid" placeholder="Employee ID" readonly></span>
                            <div class="has-error">@if ($errors->has('employeeid'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('employeeid') }}</p>  @endif</div>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="col-xs-3 control-label">Firstname:</label>
                        <div class="col-xs-6">
                            <span class="@if($errors->has('firstname')) has-error @endif"><input type="text" class="form-control" value="{{ $user->firstname }}" name="firstname" placeholder="Firstname"></span>
                            <div class="has-error">@if ($errors->has('firstname'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('firstname') }}</p>  @endif</div>
                        </div>
                    </div>

                    <div class="form-group has-feedback">
                        <label class="col-xs-3 control-label">Surname:</label>
                        <div class="col-xs-6">
                            <span class="@if($errors->has('surname')) has-error @endif"><input type="text" class="form-control" value="{{ $user->surname }}" name="surname" placeholder="Surname"></span>
                            <div class="has-error">@if ($errors->has('surname'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('surname') }}</p>  @endif</div>
                        </div>
                    </div>

                        <div class="form-group has-feedback">
                            <label class="col-xs-3 control-label">Employment Status:</label>
                            <div class="col-xs-6">
                                <select class="form-control" name="status">
                                    <option value="{{ $user->e_status }}">{{ $user->e_status }}</option>
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
                                <option value="{{ $user->department }}">{{ $user->department }}</option>
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
                        <label for="inputPassword3" class="col-xs-3 control-label">Email:</label>
                        <div class="col-xs-6">
                            <span class="@if($errors->has('email')) has-error @endif"><input type="email" class="form-control"  value="{{ $user->email }}" name="email" readonly placeholder="Email"></span>
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