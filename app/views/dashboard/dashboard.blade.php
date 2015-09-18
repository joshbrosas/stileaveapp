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

                 <div class="inputWrapper chngepic"  id="chngepic">
                    Change Picture
                    {{ Form::open(array('url' => 'imageupload/'.$profile->employee_id, 'method' => 'put', 'files' => 'true')) }}
                    <input class="fileInputs hiddens" id="uploadimg" type="file" accept="image/x-png, image/gif, image/jpeg" name="images"/>
                 </div>

                <div id="uploadimage" style="display: none;margin-left: 15px">
                     {{ Form::submit('Upload',array('class' => 'btn btn-xs','id' => 'btn_pdse', 'style' => 'margin-bottom:8px')) }}
                     {{ Form::button('Cancel',array('class' => 'btn btn-xs btncancel','id' => 'btn_pdse', 'style' => 'margin-bottom:8px')) }}
                     {{ Form::close() }}
                        <input type="hidden" id="hiddenimg" value="{{ $profile->profile_mage }}">
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
                <a href="leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave with pay) {{ $countleave->remaining_leave }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave }}</span> Leave with Pay</a>
                <a href="leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="(Leave without pay) {{ $countleave->remaining_leave_wopay }} days remaining leave." ><span class="badge">{{ $countleave->remaining_leave_wopay }}</span> Leave without Pay</a>
                <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Official Business (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span> </a>
                <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Authority to Work (ATW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('notification') }}" class="list-group-item"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>

        </div>



        <div class="col-xs-6" id="stat">
            @if(count($announce) === 0)
                <p class="bg-info" id="bginfo">
                <strong><i class="fa fa-info-circle"></i> No Announcements yet.</strong>
                </p>
            @endif

    @foreach($announce as $post)
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                   <div class="media-left">
                    {{ HTML::image($post->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                   </div>
                <div class="media-body">
                   <h4 class="media-heading text-primary">
                      <span class="preview-card">
                        <label class="name">{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</label>
                      <span class="details">
                      <div>{{ HTML::image('img/hovernaga.jpg', 'stinaga', array('id' => 'hovercard'))}}</div>
                       {{ HTML::image($post->user->profile_mage, 'profile-pic', array('id' => 'hoverpicture')) }}
                       <div id="hovertext">
                        {{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}<br>
                        </div>

                      <div id="hovercontent">
                       Department: {{ ucfirst($post->user->department) }}<br/>
                       Email: <a href="mailto:{{ $post->user->email }}">{{ $post->user->email }}</a>
                       </div>
                       </span>
                       </span>
                       <label >{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</label>
                   </h4>

                <small class="help-block" style="margin-top: -5px"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($post->created_at))}})</small>
                    </div>
                   <h4><strong>Subject: {{ ucwords($post->subject) }}</strong></h4>

                @if($post->announce != '')
                   <p id="pformat">
                          {{ nl2br(htmlspecialchars(substr($post->announce,0, 500))) }}
                    @if(strlen($post->announce) >=500)
                       <a href="{{ URL::to('v_announce/'.$post->post_id) }}">See more....</a>
                    @endif
                       </p>
                @endif



                      @if($post->image != '')
                       <a href=".{{ $post->post_id  }}" data-toggle="modal">{{ HTML::image($post->image, 'AnnounceImage', array('class' => 'img-responsive')) }}</a>
                         <div class="modal {{ $post->post_id  }}">
                           <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <div class="media-left">{{HTML::image($post->user->profile_mage, '', array('id' =>  'medialeft'))}}</div>
                                      <div class="media-body">
                                          <h5 class="media-heading"><strong class="text-primary">{{ ucfirst($post->user->firstname) }}   {{ ucfirst($post->user->surname) }}</strong>  <h5><small class="help-block"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($post->created_at))}})</small></h5></h5>
                                      </div>
                               </div>
                               <div class="modal-body">
                                    <div class="center-block"> {{ HTML::image($post->image,'', array('class' => 'img-responsive')) }}</div>
                               </div>

                             </div>
                           </div>
                         </div>
                       @endif
                        </div>
                        <hr class="linehr">
                        @if(AnnouncementComments::CountReply($post->post_id) !=0)
                            <div style="margin-top: 10px">
                                 <a id="glp"  data-toggle="tooltip" onclick="toggle({{ $post->post_id }})" class="tip-bottom" data-original-title="Show comments." ><i class="fa fa-comments-o"></i> {{ AnnouncementComments::CountReply($post->post_id) }} Commented on this.</a>
                            </div>
                        @else
                        <div style="margin-top: 5px">
                          <a id="glp"  target="_blank" href="{{ URL::route('vannounce', $post->post_id) }}"  data-toggle="tooltip" class="tip-bottom" data-original-title="Write a comment." ><i class="fa fa-comments"></i> Write a comment</a>
                        </div>
                        @endif

                    <div id="{{ $post->post_id}}" style="display: none;margin-top: 15px;">

                @foreach(AnnouncementComments::getComment($post->post_id) as $comment)
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
                                       Department: {{ ucfirst($comment->user->department) }}<br/>
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

                    <div style="margin-top: 10px;">
                     <a  href="{{ URL::route('vannounce', $post->post_id) }}" target="_blank"  data-toggle="tooltip" class="post_write tip-bottom" data-original-title="Write a comment." ><i class="fa fa-comment"></i> Write a comment</a>
                    </div>
                        </div>


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
                <a  class="list-group-item active">
                    Policies
                </a>
                <a href="{{ URL::route('policies') }}" class="list-group-item">Policies and Documents <span class="glyphicon glyphicon-chevron-right pull-right"></span> </a>
            </div>

            {{ HTML::image('img/nagalogo.png', '', array('style' => 'float:left;margin-right:5px')) }}<p id="pfoot">STI Academic Center | Naga<br>Connect: <a href="https://www.facebook.com/sticollegenaga" style="color: inherit"><i class="fa fa-facebook-square"></i></a>&nbsp; <a href="https://plus.google.com/117059459217910730754/about" style="color: inherit"><i class="fa fa-google-plus-square"></i></a> <br>Dev by:JRB </p>
        </div>

    </div>
</div> <!-- /container -->
@include('index.footer')