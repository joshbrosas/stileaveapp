@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3">
            <div class="panel panel-default" id="profile">
                {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                <div id="pnelprofilepic">
                    {{ HTML::image($profile->profile_mage, 'profileimage', array('id' => 'profile-pic')) }}
                </div>
                <div class="panel-body caption" id="pnelcaption">
                    <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                </div>
            </div>

            <div class="list-group fontsize">
                <a class="list-group-item active">HR Leave</a>
                <a href="{{ URL::route('dash') }}" class="list-group-item"><i class="fa fa-home"></i> Home </a>
                <a href="../leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave with pay) {{ $countleave->remaining_leave }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave }}</span> Leave with Pay</a>
                <a href="../leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave without pay) {{ $countleave->remaining_leave_wopay }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave_wopay }}</span> Leave without Pay</a>
                <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Official Business (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>
                <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Authority to Work (ATW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('notification') }}" class="list-group-item"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>

            <div class="list-group">
                <a class="list-group-item active">Recent Leave</a>
                @if(count($rleave) === 0)
                    <a class="list-group-item" id="recentleave">
                        No leave yet.
                    </a>
                @else
                    @foreach($rleave as $recentleave)
                        <a  href="{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                            <div>
                                <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                <p id="pef">{{ htmlspecialchars(substr($recentleave->reason,0, 100)) }}...</p>
                            </div>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-xs-8">
            <div class="panel panel-body">
                <h3><strong class="help-block">Recent Application for Official Business (OB)</strong></h3>
                <hr>
                <div class="form-horizontal">

                <div class="form-group">
                    <p id="plabel" class="col-sm-3 control-label">Date of Leave:</p>
                    <div class="col-sm-9">
                        <p class="form-control-static"><strong>{{ $getleave->date_from }} ({{ $getleave->time_from }}) to {{ $getleave->date_to }}
                                @if($getleave->time_to == '12:00 am') (12:00 pm)
                                @else
                                   ({{ $getleave->time_to }})
                                @endif</strong></p>

                    </div>
                </div>

                    <div class="form-group">
                        <p id="plabel" class="col-sm-3 control-label">Type of Leave:</p>
                        <div class="col-sm-9">
                            <p class="form-control-static"><strong>Application for Official Business (OB)</strong></p>
                        </div>
                    </div>

                <div class="form-group">
                    <p id="plabel" class="col-sm-3 control-label">Days of Leave:</p>
                    <div class="col-sm-9">
                        <p class="form-control-static"><strong>{{ $getleave->wdays_of_leave }}</strong></p>
                   </div>
                </div>

                <div class="form-group">
                    <p id="plabel" class="col-sm-3 control-label">Name of Company, Institution, Agency, etc:</p>
                    <div class="col-sm-9">
                        <p class="form-control-static"><strong>{{ $getleave->company }}</strong></p>
                   </div>
                </div>

                <div class="form-group">
                    <p id="plabel" class="col-sm-3 control-label">Address | Destination :</p>
                    <div class="col-sm-9">
                        <p class="form-control-static"><strong>{{ $getleave->address }}</strong></p>
                   </div>
                </div>

                <div class="form-group">
                        <p id="plabel" class="col-sm-3 control-label">Status:</p>
                        <div class="col-sm-9">
                            @if($getleave->status == 'Approved')
                            <p class="form-control-static"><strong class="label label-info labelerror">{{ $getleave->status }}</strong></p>
                            @elseif($getleave->status == 'Denied')
                                <p class="form-control-static"><strong class="label label-danger labelerror">{{ $getleave->status }}</strong></p>
                            @elseif($getleave->status == 'Reschedule')
                                <p class="form-control-static"><strong class="label label-warning labelerror" >{{ $getleave->status }}</strong></p>
                            @elseif($getleave->status == '')
                                <p class="form-control-static"><strong class="label label-default labelerror">Pending</strong></p>
                            @endif
                        </div>
                </div>

                <div class="form-group">
                    <p id="plabel" class="col-sm-5 control-label"><strong>Reason | Justification:</strong> </p>
                </div>

                <div class="form-group">
                <div class="col-sm-offset-1 col-sm-9">
                        <p class="form-control-static" id="pef">{{ nl2br(htmlspecialchars($getleave->reason)) }}</p>
                   </div>
                </div>
                    <hr>

                @if($getleave->status !== '')
                   <div class="form-group">
                      <div class="col-xs-offset-1 col-xs-9">
                           <a class="btn btn-sm btn-danger"  href="{{ URL::to('delete_ob/'.$getleave->leave_id) }}"><i class="fa fa-remove"></i> Remove</a>
                      </div>
                   </div>
                @endif

                </div>
            </div>
        </div>
    </div>
</div>
@include('index.footer')