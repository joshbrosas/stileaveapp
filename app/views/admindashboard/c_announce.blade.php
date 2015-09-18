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
                    <h5><strong>Administrator</strong></h5>
               </div>
              </div>

            <div class="list-group">
                <a class="list-group-item active">
                    Administrative Panel
                </a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cogs"></i> Control Panel</a>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h3><strong><i class="fa fa-volume-up"></i> Create Announcement </strong></h3>
                <hr>
                <div class="row">
                    <div class="col-xs-9 col-xs-offset-1">
                    @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>{{ Session::get('message') }}</strong>
                            </div>
                    @endif
                <form class="form-horizontal" action="{{ URL::route('post_announce') }}" enctype="multipart/form-data" method="post">
                    {{ Form::token() }}
                    <div class="form-group has-feedback">
                        <label for="inputEmail3" class="col-xs-2 control-label">Subject: </label>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-xs-12">
                            <span class="@if($errors->has('subject')) has-error @endif"><input type="text" class="form-control" name="subject" value="{{ Input::old('subject') }}" placeholder="Type your subject...."></span>
                            <div class="has-error">@if ($errors->has('subject'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('subject') }}</p>  @endif</div>
                        </div>
                    </div>
                    <div class="form-group has-feedback">
                        <label for="inputPassword3" class="col-xs-2 control-label">Message: </label>
                    </div>
                    <div class="form-group has-feedback">
                        <div class="col-xs-12">
                            <textarea class="form-control" id="text1"  name="announce" placeholder="Type message...."></textarea>
                            <div class="has-error">@if ($errors->has('announce'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <p class="label label-danger labelerror">{{ $errors->first('announce') }}</p>  @endif</div>
                        </div>
                    </div>

                     <div class="form-group has-feedback">
                     <label for="inputPassword3" class="col-xs-2 control-label">Add Image: </label>
                     <div class="col-xs-3">
                      <div class="inputWrapper btn btn-sm " id="btn_pdse">
                        Upload File
                        <input class="fileInput hiddens" id="file2" type="file"  name="image"/>
                       </div>
                     </div>
                     </div>

                      <div class="form-group has-feedback">
                      <div class="col-xs-12">

                        <div class="hidd">
                        <img src="" id="previewimage" class="img-responsive" >
                        </div>



                      </div>
                      </div>

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn" id="btn_pdse"><i class="fa fa-volume-up"></i> Post Announcements </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@include('index.footer')