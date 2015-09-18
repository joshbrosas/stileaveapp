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
                <a href="#" class="list-group-item active">Leave</a>
                <a href="{{ URL::route('leavewopay') }}" class="list-group-item"><span class="glyphicon glyphicon-chevron-left pull-left"></span> Pending Leave</a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cog"></i> Control Panel</a>

            </div>


        </div>

        <div class="col-xs-6" id="stat">

            <p class="bg-info" id="bginfo">
                <i class="fa fa-info-circle"></i> <strong>Recent Leave logs (without pay)</strong>
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
                                <h4 class="media-heading text-primary"><strong>{{ ucfirst($leavewithpay->user->firstname) }} {{ ucfirst($leavewithpay->user->surname) }}<span id="glp" class="pull-right"><a id="glp" href="{{ URL::to('woapprove/'.$leavewithpay->leave_id) }}"><i class="fa fa-remove"></i></a> </span></strong></h4>
                                <small class="help-block"><i class="fa fa-clock-o"></i> {{ $leavewithpay->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($leavewithpay->created_at))}})</small>
                            </div>
                            <h5>Date of Leave: <strong>{{$leavewithpay->date_from}} ({{ $leavewithpay->time_from }}) to {{$leavewithpay->date_to}}
                                    @if($leavewithpay->time_to == '12:00 am') (12:00 pm)
                                    @else
                                       ({{ $leavewithpay->time_to }})
                                    @endif</strong></h5>
                            <h5>Days of Leave: <strong>{{$leavewithpay->wdays_of_leave}}</strong></h5>
                            @if($leavewithpay->status == 'Approved')
                            <h5>Status: <strong class="label label-primary labelerror">{{$leavewithpay->status}}</strong></h5>
                            @elseif($leavewithpay->status == 'Denied')
                            <h5>Status: <strong class="label label-danger labelerror">{{$leavewithpay->status}}</strong></h5>
                            @elseif($leavewithpay->status == 'Reschedule')
                             <h5>Status: <strong class="label label-warning labelerror">{{$leavewithpay->status}}</strong></h5>
                            @endif
                            Reason for the availment of leave:
                            <hr>
                            <p id="pformat">
                                {{ $leavewithpay->reason }}
                            </p>
                            <div id="boothr"></div>
                            @foreach(Approval::getSender($leavewithpay->leave_id) as $sender)
                                           <div class="media">
                                               <a class="pull-left">
                                                   {{ HTML::image($sender->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                                               </a>
                                               <div class="media-body">
                                                   <h4 class="media-heading text-danger"><strong>{{ ucfirst($sender->user->firstname) }} {{ ucfirst($sender->user->surname) }}</strong></h4>
                                                   <p class="help-block"><i class="fa fa-clock-o"></i><small> {{ $sender->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($sender->created_at))}})</small></p>
                                                   @if($sender->status == 'Approved')
                                                       <strong>Leave Status : <p class="label label-primary labelerror">{{ $sender->status }}</p></strong>
                                                   @elseif($sender->status == 'Denied')
                                                       <strong>Leave Status : <p class="label label-danger labelerror">{{ $sender->status }}</p></strong>
                                                   @elseif($sender->status == 'Reschedule')
                                                       <strong>Leave Status : <p class="label label-warning labelerror">{{ $sender->status }}</p></strong>
                                                   @endif
                                                   <br><br>
                                                   <p id="pcformat">
                                                       {{ nl2br($sender->message) }}
                                                   </p>
                                               </div>
                                           </div>
                            @endforeach
                        </div>
                        <div>
                     <span class="pull-left"><strong>Checked on: </strong><strong>{{date('M d, Y',strtotime($leavewithpay->created_at))}}</strong></span>
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