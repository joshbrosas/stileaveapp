@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">

    <div class="row">
        <div class="col-xs-3"  id="prof">
         <div class="panel panel-default" id="profile">
           {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
             <div id="pnelprofilepic">
                <img src="{{ $profile->profile_mage }}" id="profile-pic">
              </div>
                 <div class="panel-body caption" id="pnelcaption">
                     <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                        <h5><strong>Administrator</strong></h5>
                 </div>
         </div>
            <div class="list-group">
                <a class="list-group-item active">HR</a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Control Panel</a>
                <a href="{{ URL::route('announce') }}" class="list-group-item">Create Announcements <span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('view_users') }}" class="list-group-item">View Users <span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('admin_policies') }}" class="list-group-item"><span class="glyphicon glyphicon-info-sign"></span> Policies</a>
            </div>
        </div>

        <div class="col-xs-6" id="stat">
            @if(count($announce) == 0)
                    <p class="bg-info" id="bginfo">
                        <i class="fa fa-info-circle"></i> <strong>No Announcements yet.</strong>
                    </p>
            @endif

            @foreach($announce as $post)
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="media">
                      <div class="media-left" style="float: left">
                     {{ HTML::image($post->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading text-primary">
                        <strong>
                        <span class="preview-card">
                                         <label class="name">{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</label>
                                           <span class="details">
                                            <div>{{ HTML::image('img/hovernaga.jpg', 'stinaga', array('id' => 'hovercard'))}}</div>

                                            {{ HTML::image($post->user->profile_mage, 'profile-pic', array('id' => 'hoverpicture')) }}
                                            <div id="hovertext">
                                              {{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}<br>
                                            </div>
                                              <div id="hovercontent">
                                              Email: <a href="mailto:{{ $post->user->email }}">{{ $post->user->email }}</a>
                                              </div>



                                           </span>
                                        </span>
                                        <label>{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</label>
                         <span class="pull-right"><a id="glp" href="{{ URL::to('deleteannounce/'.$post->post_id) }}" data-toggle="tooltip" class="btn-approve tip-bottom" data-original-title="Remove this post"><i class="fa fa-remove"></i> </a></span> </strong></h4>
                         <small class="help-block" style="margin-top: -5px"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }} ({{date('l M d, Y',strtotime($post->created_at))}})</small>
</div>
                          <h4><strong>Subject: {{ ucwords($post->subject) }}</strong></h4>

                        @if($post->announce !='')
                        <p id="pformat">
                           {{ nl2br(substr($post->announce,0, 500)) }}
                            @if(strlen($post->announce) >=500)
                             <a href="{{ URL::to('v_post/'.$post->post_id) }}">See more....</a>
                            @endif
                        </p>
                        @endif
                       @if($post->image != '')
                           <a href=".{{ $post->post_id  }}" data-toggle="modal">{{ HTML::image($post->image, 'AnnounceImage', array('class' => 'img-responsive', 'id' => 'postimg')) }}</a>
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
                <hr class="linehr">
                 @if(AnnouncementComments::CountReply($post->post_id) !=0)
                  <div style="margin-top: 10px">
                     <a id="glp"  data-toggle="tooltip" onclick="toggle({{ $post->id }})" class="tip-bottom" data-original-title="Show comments." ><i class="fa fa-comments-o"></i> {{ AnnouncementComments::CountReply($post->post_id) }} Commented on this.</a>
                  </div>
                 @else
                   <div style="margin-top: 5px">
                     <a id="glp"  target="_blank" href="{{ URL::route('viewpost', $post->post_id) }}"  data-toggle="tooltip" class="tip-bottom" data-original-title="Write a comment." ><i class="fa fa-comments"></i> Write a comment</a>
                   </div>
                 @endif

                     <div id="{{ $post->id}}" style="display: none;margin-top: 15px;">

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
                     <a  href="{{ URL::route('viewpost', $post->post_id) }}" target="_blank"  data-toggle="tooltip" class="post_write tip-bottom" data-original-title="Write a comment." ><i class="fa fa-comment"></i> Write a comment</a>
                    </div>
                        </div>

                        <div>
                        </div>
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

