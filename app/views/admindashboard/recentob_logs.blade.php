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
              <a href="{{ URL::route('leaveob_admin') }}" class="list-group-item"> <span class="glyphicon glyphicon-chevron-left"></span> Show Application for (OB)</a>
            </div>


        </div>

    <div class="col-xs-6" id="stat">
        <p class="bg-info" id="bginfo">
            <i class="fa fa-info-circle"></i> Logs for <strong>Application for Official Business (OB)</strong>
        </p>

        @if(count($getleave) == 0)
            <div class="panel panel-body">
                <p class="bg-info" id="bginfo">
                   <i class="fa fa-info-circle"></i> No Pending leave yet.
                </p>
            </div>
        @endif
            @foreach($getleave as $leave)
                       <div class="panel panel-body">
                           <div class="media">
                               <div class="media-left">
                                  {{ HTML::image($leave->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                               </div>
                           <div class="media-body">
                             <h4 class="media-heading text-primary">{{ ucfirst($leave->user->firstname) }} {{ ucfirst($leave->user->surname) }} <span class="pull-right"><a href="{{ URL::to('d_oblogs/'.$leave->leave_id) }}" id="glp" data-toggle="tooltip" class="tip-bottom" data-original-title="Remove this application"><i class="fa fa-remove"></i> </a> </span> </h4>
                             </div>
                               <h5>Type of Leave: <strong>Application for OB</strong></h5>
                               <h5>Date of Leave: <strong>{{$leave->date_from}} ({{ $leave->time_from }}) to {{$leave->date_to}}
                                       @if($leave->time_to == '12:00 am') (12:00 pm)
                                       @else
                                          ({{ $leave->time_to }})
                                       @endif</strong></h5>
                               <h5>Days of Leave: <strong>{{$leave->wdays_of_leave}}</strong></h5>
                               <h5>Name of Company, Institution, Agency, etc.: <b> {{ $leave->company }} </b></h5>
                               <h5>Address | Destination : <b> {{ $leave->address }} </b></h5>
                               <h5><strong><i>Reason for availment of leave: </i></strong></h5>
                               <hr>
                               <p id="pformat">
                                  {{ nl2br($leave->reason) }}
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
                                                       {{ nl2br($sender->message) }}
                                                   </p>
                                               </div>
                                           </div>
                                               @endforeach
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