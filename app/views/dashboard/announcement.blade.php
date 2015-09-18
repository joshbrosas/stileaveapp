@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3" id="prof">
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
                   <a href="{{ URL::route('dash') }}" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="Go to Home." ><span class="glyphicon glyphicon-home"></span> Home</a>
                   <a href="../leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave with pay) {{ $countleave->remaining_leave }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave }}</span> Leave with Pay</a>
                   <a href="../leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave without pay) {{ $countleave->remaining_leave_wopay }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave_wopay }}</span> Leave without Pay</a>
                   <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Official Business (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>
                   <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Authority to Work (ATW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                   <a href="{{ URL::route('notification') }}" class="list-group-item"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>


        </div>

        <div class="col-xs-6" id="stat">
            
            <div class="panel panel-body">
                <div class="media">

                    <div class="media-left">
                        {{ HTML::image($post->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                    </div>
                    <div class="media-body">
                      <span class="preview-card">
                           <label class="name">{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</label>
                               <span class="details">
                                 <div>{{ HTML::image('img/hovernaga.jpg', 'stinaga', array('id' => 'hovercard'))}}</div>
                                       {{ HTML::image($post->user->profile_mage, 'profile-pic', array('id' => 'hoverpicture')) }}
                                 <div id="hovertext" class="text-primary">
                                        {{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}<br>
                                 </div>

                                 <div id="hovercontent">
                                 Department: {{ ucfirst($post->user->department) }}<br/>
                                   Email: <a href="mailto:{{ $post->user->email }}">{{ $post->user->email }}</a>
                                 </div>
                               </span>
                       </span>
                        <h4 class="media-heading text-primary"><strong>{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</strong></h4>
                        <small class="help-block"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($post->created_at))}})</small>
                    </div>
                    <h4><strong>Subject: {{ ucwords($post->subject) }}</strong></h4>
                    <hr>
                    <p id="pformat">
                        {{ nl2br(htmlspecialchars_decode($post->announce)) }}
                    </p>
                    @if($post->image != '')
                     <a href=".{{ $post->post_id  }}" data-toggle="modal">{{ HTML::image($post->image, 'AnnounceImage', array('class' => 'img-responsive', 'id' => 'postimg')) }}</a>
                    @endif

                </div>

                @if(count($post_comment)!== 0)
                <div>
                 <button id="glp"><i class="fa fa-comments-o"></i> {{ count($post_comment) }} Commented this. </button>
                </div>
                @endif

                @foreach($post_comment as $comment)
                    <div class="media">
                      <div class="media-left">
                          {{ HTML::image($comment->user->profile_mage, 'profile-pic',array('class' => 'post_photo')) }}
                      </div>
                      <div class="media-body post_media">
                       <span class="preview-card">
                           <label class="name">{{ ucfirst($comment->user->firstname) }} {{ ucfirst($comment->user->surname) }}</label>
                               <span class="details">
                                 <div>{{ HTML::image('img/hovernaga.jpg', 'stinaga', array('id' => 'hovercard'))}}</div>
                                       {{ HTML::image($comment->user->profile_mage, 'profile-pic', array('id' => 'hoverpicture')) }}
                                 <div id="hovertext">
                                        {{ ucfirst($comment->user->firstname) }} {{ ucfirst($comment->user->surname) }}<br>
                                 </div>

                                 <div id="hovercontent">
                                    Department: {{ ucfirst($post->user->department) }}<br/>
                                    Email: <a href="mailto:{{ $comment->user->email }}">{{ $comment->user->email }}</a>
                                 </div>
                               </span>
                       </span>
                            <p class="help-block post_header"><b class="text-primary">{{ ucfirst($comment->user->firstname) }}&nbsp;{{ ucfirst($comment->user->surname) }}</b> <i class="fa fa-clock-o"></i> <span style="font-size: 11px"> {{ $comment->created_at->diffForHumans() }}</span></p>
                            <p class="post_mcomments">
                            {{ nl2br(htmlspecialchars($comment->post_comment))}}
                            </p>
                          </div>
                    </div>
                @endforeach


                 <div class="commentbox">
                    <div class="media">
                      <a class="pull-left" href="#">
                            {{ HTML::image($profile->profile_mage, 'profile-pic',array('id' => 'commentboxphoto')) }}
                      </a>
                       <div class="media-body has-feedback">
                          {{ Form::open(['url' => 'post_comment', 'method' => 'post']) }}
                          <input type="hidden" value="{{ $post->post_id }}" name="postid">
                           <textarea class="form-control commenttext input-sm" id="commenttext" name="comment"  placeholder="Type your comment...."></textarea>
                          <div class="has-error">@if ($errors->has('comment'))<div class="label label-danger labelerror">{{ $errors->first('comment') }}</div>  @endif</div>
                           <button class="btn btn-sm btnpdd" disabled id="btn_pdse"><i class="fa fa-send-o"></i> Post Comment</button>
                          {{ Form::close() }}
                       </div>
                    </div>
                 </div>
            </div>

        </div>
        <!--STAT -->
        
        <div class="col-xs-3" id="prof">
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