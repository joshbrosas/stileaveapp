@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">
<div class="row">
<div class="col-xs-3">

           <div class="panel panel-default" id="profile">
              {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
               <div id="pnelprofilepic">
                   <img src="{{ $admin->profile_mage }}" id="profile-pic">
               </div>
               <div class="panel-body caption" id="pnelcaption">
                   <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($admin->firstname) }} {{ ucfirst($admin->surname) }}</h4>
                    <h5><b>Administrator</b></h5>
                    <h5><strong>({{ $admin->department }})</strong></h5>
               <div class="has-error">@if ($errors->has('images')) <p class="label label-danger labelerror">{{ $errors->first('images') }}</p>  @endif</div>
               </div>
           </div>

            <div class="list-group">
                <a class="list-group-item active">
                    HR
                </a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><span class="glyphicon glyphicon-cog"></span> Control Panel</a>
            </div>
        </div>


        <div class="col-xs-6">
        <div class="panel panel-body">
            <h3><b class="help-block">School Policies</b> </h3>
            <hr>
                    @if(Session::has('message'))
                       <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>{{ Session::get('message') }}</strong>
                       </div>
                    @endif

                {{ Form::open(['url' => 'upload_pdf', 'class' => 'form-horizontal', 'method'  => 'post', 'files' => true]) }}
             <div class="form-group has-feedback">
              <label for="inputPassword3" class="col-sm-2 control-label">Subject: </label>
                 <div class="col-sm-8">
                   <span class="@if($errors->has('title')) has-error @endif"><input type="text" class="form-control" name="title" placeholder="Type subject..."/></span>
                   <div class="has-error">@if ($errors->has('title'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('title') }}</p>  @endif</div>
               </div>
             </div>
              <div class="form-group has-feedback">
                <label for="inputPassword3" class="col-sm-3 control-label">Upload Files: </label>
                <div class="col-sm-8">

                       <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn imgbtnpanel btn-sm btn-file" id="btn_pdse">
                                            <span class="glyphicon glyphicon-file"></span>
                                            Browse File ..
                                            <input type="file" name="file" accept=".pdf, .docx , .xlsx, .csv">
                                        </span>
                                    </span>
                                      <input type="text" class="form-control input-sm" readonly>
                                  </div>
                   <div class="has-error">@if ($errors->has('file'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('file') }}</p>  @endif</div>
                </div>
              </div>
                <hr>

              <div class="form-group">
                <div class="col-xs-offset-3 col-xs-10">
                  <button type="submit" class="btn btn-sm" id="btn_pdse">Submit</button>
                </div>
              </div>

            {{ Form::close() }}

            <hr>
            <h3><b class="help-block">Recent Uploaded Documents...</b></h3>
             @foreach($policies as $policy)
                <a href="{{ URL::to('download_admin/'.$policy->download_id) }}" class="tip-bottom" data-toggle="tooltip" data-original-title="Download {{ $policy->subject }}.{{ $policy->extension }}">
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