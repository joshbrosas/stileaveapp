@include('index.header')
<body>
@include('dashboard.navbar')
<div class="container" id="mfcont">
<div class="row">
<div class="col-xs-3">
            <div class="panel panel-default" id="profile" >
                {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                    <div id="pnelprofilepic">
                    <img src="{{ $profile->profile_mage }}" id="profile-pic">
                    </div>

                <div class="panel-body caption" id="pnelcaption">
                    <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                    <h6><b>{{ $profile->department }}</b></h6>
                    <h6><b><a href="mailto:{{ $profile->email }}">{{ $profile->email }}</a> </b></h6>
                    <div class="has-error">@if ($errors->has('images')) <p class="label label-danger labelerror">{{ $errors->first('images') }}</p>  @endif</div>
                </div>
            </div>

            <div class="list-group fontsize">
                <a class="list-group-item active">HR Leave</a>
                <a href="{{ URL::route('dash') }}" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="Go to dashboard" ><i class="fa fa-home"></i> Home </a>
                <a href="leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave with pay) {{ $countleave->remaining_leave }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave }}</span> Leave with Pay</a>
                <a href="leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave without pay) {{ $countleave->remaining_leave_wopay }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave_wopay }}</span> Leave without Pay</a>
                <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Official Business (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>
                 <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Authority to Work (ATW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('notification') }}" class="list-group-item"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>
        </div>

        <div class="col-xs-6">
        <div class="panel panel-body">
        <h3><b class="help-block"><i class="fa fa-file-o"></i> School Policies and Documents</b></h3>
        <hr>
        @foreach($policies as $policy)
        <a href="{{ URL::to('download/'.$policy->download_id) }}" class="tip-bottom" data-toggle="tooltip" data-original-title="Download {{ $policy->subject }}.{{ $policy->extension }}">
         @if($policy->extension == 'pdf')
                 <i class="fa fa-file-pdf-o"></i>
                 @elseif($policy->extension == 'docx')
                 <i class="fa fa-file-word-o"></i>
                 @elseif($policy->extension == 'xlsx' or $policy->extension == 'csv')
                 <i class="fa fa-file-excel-o"></i>
                 @elseif($policy->extension == 'zip' or $policy->extension == 'rar')
                 <i class="fa fa-file-archive-o"></i>
                 @elseif($policy->extension == 'jpeg' or $policy->extension == 'png' or $policy->extension == 'bmp' )
                 <i class="fa fa-image"></i>
                 @elseif($policy->extension == 'mp4' or $policy->extension == 'avi' or $policy->extension == 'mkv')
                 <i class="fa fa-file-video-o"></i>
                 @else
                 <i class="fa fa-file"></i>
         @endif
                 {{ $policy->subject }}</a><br/>
        @endforeach
        </div>
        </div>

        <div class="col-xs-3">
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
        </div>


</div>


</div>
@include('index.footer')
