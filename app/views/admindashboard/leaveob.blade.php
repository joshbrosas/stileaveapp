@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3" id="prof">
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
              <a class="list-group-item active">Options</a>
              <a href="{{ URL::route('administrator') }}" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Control Panel</a>
            </div>

            <div class="list-group">
                <a class="list-group-item active">Leave Logs</a>
                <a href="{{ URL::route('recent_ob') }}" class="list-group-item"> Recent OB Logs <span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>

            </div>
        </div>

    <div class="col-xs-6" id="stat">
        <p class="bg-info" id="bginfo">
            <i class="fa fa-info-circle"></i> <strong>Application for Official Business (OB)</strong>
        </p>

        @if(count($getleave) == 0)
            <div class="panel panel-body">
                <p class="bg-info" id="bginfo">
                   <i class="fa fa-info-circle"></i> No Pending leave yet.
                </p>
            </div>
        @endif

        @foreach($getleave as $leavewithpay)
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div class="media-left">
                        {{ HTML::image($leavewithpay->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading text-primary"><strong>{{ ucfirst($leavewithpay->user->firstname) }} {{ ucfirst($leavewithpay->user->surname) }}</strong></h4>
                        <small class="help-block"><i class="fa fa-clock-o"></i> {{ $leavewithpay->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($leavewithpay->created_at))}})</small>
                    </div>
                    <h5>Date of Leave: <strong>{{$leavewithpay->date_from}} ({{ $leavewithpay->time_from }}) to {{$leavewithpay->date_to}}
                            @if($leavewithpay->time_to == '12:00 am') (12:00 pm)
                            @else
                               ({{ $leavewithpay->time_to }})
                            @endif</strong></h5>
                    <h5>Days of Leave: <strong>{{$leavewithpay->wdays_of_leave}}</strong></h5>
                    <h5>Name of Company, Institution, Agency, etc.: <b> {{ $leavewithpay->company }} </b></h5>
                    <h5>Address | Destination : <b> {{ $leavewithpay->address }} </b></h5>
                    Reason for the availment of leave:
                    <hr>
                    <p id="pformat">
                        {{ nl2br($leavewithpay->reason )}}
                    </p>
                    <div id="boothr"></div>
                </div>
                <div>
                <button id="glp" data-toggle="tooltip" onclick="toggle({{ $leavewithpay->id }})" class="btn-approve tip-bottom" data-original-title="Please select options"><span class="glyphicon glyphicon-option-horizontal"></span> </button>
                <span class="pull-right"><strong>Status: </strong><strong class="label label-info labelerror">Pending</strong></span>
                </div>
                <div id="{{ $leavewithpay->id }}" style="display: none">
                    {{ Form::open(array('url' => 'approval_ob/'.$leavewithpay->leave_id, 'method' => 'post', 'class' => 'form-horizontal')) }}
                    <div class="form-group">
                        <div class="col-xs-3 control-label"><strong>Select Options: </strong></div>
                        <div class="col-xs-5">
                            <select class="form-control input-sm"  name="status">
                                <option disabled>Please Select Option</option>
                                <option value="Approved">Approve this leave</option>
                                <option value="Denied">Denied this leave</option>
                                <option value="Reschedule">Reschedule this leave</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="employee_id" value="{{ $leavewithpay->employee_id }}">
                    <input type="hidden" name="leave_id" value="{{ $leavewithpay->leave_id }}">
                    <input type="hidden" name="company" value="{{ $leavewithpay->company }}">
                    <input type="hidden" name="address" value="{{ $leavewithpay->address }}">
                    <div class="media-body">
                        <textarea class="form-control txtare" rows="4" name="message" placeholder="Type your message..."></textarea>
                    </div>
                    <button type="submit" id="btn_pdse" class="btn btn-sm">Submit</button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        @endforeach
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