@include('index.header')
<body>
@include('dashboard.navbar')
<div class="container" id="mfcont">
    <div class="row">

        <div class="col-xs-3" id="prof">
            <div class="panel panel-default" id="profile" >
              {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                <div id="pnelprofilepic">
                  <img src="{{ $profile->profile_mage }}" id="profile-pic">
                </div>
                <div class="panel-body caption" id="pnelcaption">
                    <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                    <h6><b>{{ $profile->department }}</b></h6>
                    <div class="has-error">@if ($errors->has('images')) <p class="label label-danger labelerror">{{ $errors->first('images') }}</p>  @endif</div>
                </div>
            </div>

            <div class="list-group fontsize">
                <a class="list-group-item active">HR Leave</a>
                <a href="{{ URL::route('dash') }}" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="Return to home." ><i class="fa fa-home"></i> Home</a>
                <a href="leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="Go to notifications (Leave with pay)" >Leave With Pay<span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>
                <a href="leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="Go to notifications (Leave without pay)" >Leave Without Pay<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Go to notifications for (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Go to notifications for (OTW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('notification') }}" class="list-group-item actives"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>

        </div>

        <div class="col-xs-6" id="stat">
           <p class="bg-info" id="bginfo">
            <strong><i class="fa fa-envelope"></i> Notification Box</strong>
           </p>
                @foreach($leavelog as $leave)
                    <div class="panel panel-body">
                      <div class="media">
                       <div class="media-left">
                        {{ HTML::image($leave->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                       </div>
                       <div class="media-body">
                       <h4 class="media-heading text-primary">{{ ucfirst($leave->user->firstname) }} {{ ucfirst($leave->user->surname) }} <span class="pull-right"><a href="{{ URL::to('d_notification/'.$leave->leave_id) }}" id="glp" data-toggle="tooltip" class="tip-bottom" data-original-title="Delete this notification"><i class="fa fa-remove"></i> </a> </span> </h4>
                       </div>
                        @if($leave->type_of_leave == 'Application for Authority to Work (ATW)')
                        <h5>Type of Leave: <strong class="text-primary">{{$leave->type_of_leave}}</strong></h5>
                        @elseif($leave->type_of_leave == 'Application for OB')
                        <h5>Type of Leave: <strong class="text-warning">{{$leave->type_of_leave}}</strong></h5>
                        @elseif($leave->type_of_leave == 'Leave with pay')
                        <h5>Type of Leave: <strong class="text-danger">{{$leave->type_of_leave}}</strong></h5>
                        @elseif($leave->type_of_leave == 'Leave without pay')
                        <h5>Type of Leave: <strong class="text-success text-capitalize">{{$leave->type_of_leave}}</strong></h5>
                        @endif

                        <h5>Date of Leave: <strong>{{$leave->date_from}} ({{ $leave->time_from }}) to {{$leave->date_to}}
                        @if($leave->time_to == '12:00 am') (12:00 pm)
                        @else
                         ({{ $leave->time_to }})
                        @endif</strong></h5>

                        <h5>Days of Leave: <strong>{{$leave->wdays_of_leave}}</strong></h5>

                        @if($leave->company != '' and $leave->address)
                        <h5>Name of Company, Institution, Agency, etc: <strong>{{$leave->company}}</strong></h5>
                        <h5>Address | Destination : <strong>{{$leave->address}}</strong></h5>
                        @endif

                        <h5><strong><i>Reason for availment of leave: </i></strong></h5>
                        <hr>
                        <p id="pformat">
                         {{ nl2br(htmlspecialchars($leave->reason)) }}
                        </p>
                    <hr>
                       @foreach(Approval::getSender($leave->leave_id) as $sender)
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
                                     {{ nl2br(htmlspecialchars($sender->message)) }}
                                     </p>
                               </div>
                           </div>
                       @endforeach
           </div>
           </div>
    @endforeach
</div>

        <div class="col-xs-3" id="prof1">
            <div class="list-group">
                <a class="list-group-item active">
                    Mission and Vision
                </a>
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

            <div class="list-group">
                <a class="list-group-item active">
                    Recent Leave (With Pay)
                </a>
                @if(count($rleave) === 0)
                    <a class="list-group-item" id="recentleave">
                        No leave yet.
                    </a>
                @else
                    @foreach($rleave as $recentleave)
                        <a  href="leavelog/{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                            <div>
                                <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                <p id="pef"> {{ nl2br(htmlspecialchars(substr($recentleave->reason,0, 100))) }}...</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>

            <div class="list-group">
                <a  class="list-group-item active">
                    Recent Leave (Without Pay)
                </a>
                @if(count($sleave) === 0)
                    <a class="list-group-item" id="recentleave">
                        No leave yet.
                    </a>
                @else
                    @foreach($sleave as $recentleave)
                        <a  href="leavelogw/{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                            <div>
                                <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                <p id="pef"> {{ nl2br(htmlspecialchars(substr($recentleave->reason,0, 100))) }}...</p>
                            </div>
                        </a>

                    @endforeach
                @endif
            </div>


            <div class="list-group">
                <a  class="list-group-item active">
                    Recent Application for OB
                </a>
                @if(count($obleave) === 0)
                    <a class="list-group-item" id="recentleave">
                        No leave yet.
                    </a>
                @else
                    @foreach($obleave as $recentleave)
                        <a  href="leave_oblog/{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                            <div>
                                <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                <p id="pef"> {{ nl2br(htmlspecialchars(substr($recentleave->reason,0, 100))) }}...</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>


            <div class="list-group">
                <a  class="list-group-item active">
                    Recent Application for ATW
                </a>
                @if(count($leaveawt) === 0)
                    <a class="list-group-item" id="recentleave">
                        No leave yet.
                    </a>
                @else
                    @foreach($leaveawt as $recentleave)
                        <a  href="leave_atwlog/{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                            <div>
                                <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                <p id="pef"> {{ nl2br(htmlspecialchars(substr($recentleave->reason,0, 100))) }}...</p>
                            </div>
                        </a>

                    @endforeach
                @endif
            </div>
            {{ HTML::image('img/nagalogo.png', '', array('style' => 'float:left;margin-right:5px')) }}<p id="pfoot">STI Academic Center | Naga<br>Connect: <a href="https://www.facebook.com/sticollegenaga" style="color: inherit"><i class="fa fa-facebook-square"></i></a>&nbsp; <a href="https://plus.google.com/117059459217910730754/about" style="color: inherit"><i class="fa fa-google-plus-square"></i></a> <br>Dev by:JRB </p>
        </div>
    </div>
</div> <!-- /container -->
@include('index.footer')