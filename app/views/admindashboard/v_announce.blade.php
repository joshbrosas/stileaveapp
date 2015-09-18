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
                <a class="list-group-item active">
                    Administrative Panel
                </a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cogs"></i> Control Panel</a>
                <a href="{{ URL::route('home') }}" class="list-group-item"><i class="fa fa-home"></i> Home</a>
            </div>
        </div>

        <div class="col-xs-6">
            <div class="panel panel-body">

                <div class="media">
                    <div class="media-left">
                        {{ HTML::image($post->user->profile_mage, 'profile-pic',array('id' => 'medialeft')) }}
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading text-primary"><strong>{{ ucfirst($post->user->firstname) }} {{ ucfirst($post->user->surname) }}</strong></h4>
                        <small class="help-block"><i class="fa fa-clock-o"></i> {{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <h4><strong>Subject: {{ ucwords($post->subject) }}</strong></h4>
                    <p>
                        {{ nl2br(htmlspecialchars($post->announce)) }}
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
                            {{ HTML::image($admin->profile_mage, 'profile-pic',array('id' => 'commentboxphoto')) }}
                      </a>
                       <div class="media-body">
                          {{ Form::open(['url' => 'post_admin_comment', 'method' => 'post']) }}
                          <input type="hidden" value="{{ $post->post_id }}" name="postid">
                           <textarea class="form-control txtare input-sm" id="commenttext" name="comment"  placeholder="Type your comment...."></textarea>
                           <button class="btn btn-sm btnpdd" disabled id="btn_pdse"><i class="fa fa-send-o"></i> Post Comment</button>
                           <div class="has-error">@if ($errors->has('comment'))<div class="label label-danger labelerror">{{ $errors->first('comment') }}</div>  @endif</div>
                          {{ Form::close() }}
                       </div>
                    </div>
                 </div>


            </div>
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