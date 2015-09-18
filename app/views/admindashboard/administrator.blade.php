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
                   <div class="inputWrapper chngepic"  id="chngepic">
                Change Picture
                {{ Form::open(array('url' => 'u_upload/'.$admin->employee_id, 'method' => 'put', 'files' => 'true')) }}
                 <input class="fileInput hiddens" id="uploadimg" type="file" name="images"/>
                 </div>
                     <div id="uploadimage" style="display: none;margin-left: 15px">
                     {{ Form::submit('Upload',array('class' => 'btn btn-xs','id' => 'btn_pdse', 'style' => 'margin-bottom:8px')) }}
                     {{ Form::button('Cancel',array('class' => 'btn btn-xs btncancel','id' => 'btn_pdse', 'style' => 'margin-bottom:8px')) }}
                     {{ Form::close() }}
                  <input type="hidden" id="hiddenimg" value="{{ $admin->profile_mage }}">
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
                <a href="{{ URL::route('home') }}" class="list-group-item"><i class="fa fa-home"></i> Home</a>
                <a href="{{ URL::route('admin_policies') }}" class="list-group-item"><span class="glyphicon glyphicon-pencil"></span> School Policies</a>
            </div>

        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h2><strong><i class="fa fa-cogs"></i> Administrator Control Panel</strong></h2>
                <hr>
                <h3><strong class="help-block">Manage Users</strong></h3>
                <hr>
                <div class="row">
                    <div class="col-xs-2">
                        <div class="thumbnails">
                            <a href="{{ URL::route('home') }}" data-toggle="tooltip"  data-original-title="Home Panel" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-home fa-5x color"></i><br> <br> <strong>Home</strong> </a>
                        </div>
                    </div>

                    <div class="col-xs-2">
                      <div class="thumbnails">
                          <a href="{{ URL::route('view_users') }}" data-toggle="tooltip"  data-original-title="View Users,Manage User" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-users fa-5x color"></i> <br> <br><strong>View Users</strong> </a>
                      </div>
                     </div>

                       <div class="col-xs-2">
                           <div class="thumbnails">
                               <a href="{{ URL::route('create_user') }}" data-toggle="tooltip"  data-original-title="Create new User" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-user-plus fa-5x color"></i><br> <br> <strong>Create User</strong> </a>
                           </div>
                       </div>

                    <div class="col-xs-2">
                        <div class="thumbnails">
                            <a href="{{ URL::route('create_admin') }}" data-toggle="tooltip"  data-original-title="Create new Administrator" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-user-secret fa-5x color"></i><br> <br><strong>Create Admin</strong> </a>
                        </div>
                    </div>

                </div>

                <h3><strong class="help-block">Transactions</strong></h3>
                <hr>

                <div class="row">
                    <div class="col-xs-2">
                        <div class="thumbnails">
                            <a href="{{ URL::route('announce') }}" data-toggle="tooltip"  data-original-title="Post announcements" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-volume-up fa-5x color"></i> <br> <br><strong>Announcements</strong> </a>
                        </div>
                    </div>

                    <div class="col-xs-2">
                         <div class="thumbnails">
                             <a href="{{ URL::route('leavepay') }}" data-toggle="tooltip"  data-original-title="View pending leave with pay" class="list-group-item tip-bottom" id="bgpls">@if($countlw != 0)<span class="badgeac">{{ $countlw }}</span>@endif<i class="fa fa-file-text-o fa-5x color"></i><br> <br><strong> Leave with Pay</strong> </a>
                         </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="thumbnails">
                             <a href="{{ URL::route('leavewopay') }}" data-toggle="tooltip"  data-original-title="View pending leave without pay" class="list-group-item tip-bottom" id="bgpls">@if($countlwo != 0)<span class="badgeac">{{ $countlwo }}</span>@endif<i class="fa fa-file-text fa-5x color"></i><br> <br><strong>Leave W/O Pay</strong> </a>
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="thumbnails">
                             <a href="{{ URL::route('leaveob_admin') }}" data-toggle="tooltip"  data-original-title="View pending leave in Official Business (OB)" class="list-group-item tip-bottom" id="bgpls">@if($countob != 0)<span class="badgeac">{{ $countob }}</span>@endif<i class="fa fa-briefcase fa-5x color"></i><br> <br><strong>Leave (OB)</strong> </a>
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="thumbnails">
                             <a href="{{ URL::route('leaveatw_admin') }}" data-toggle="tooltip"  data-original-title="View pending leave in Authorization to work (AWT)" class="list-group-item tip-bottom" id="bgpls">@if($countawt != 0)<span class="badgeac">{{ $countawt }}</span>@endif<i class="fa fa-newspaper-o fa-5x color"></i><br> <br><strong>Leave (ATW)</strong> </a>
                        </div>
                    </div>
               </div>

               <div class="row">
                <div class="col-xs-2">
                        <div class="thumbnails">
                             <a href="{{ URL::route('admin_policies') }}" data-toggle="tooltip"  data-original-title="View Policies.Upload PDF Files" class="list-group-item tip-bottom" id="bgpls"><i class="fa fa-file-pdf-o fa-5x color"></i><br> <br><strong>Policies</strong> </a>
                        </div>
                    </div>
               </div>
                <hr>
            </div>
        </div>
    </div>
</div> <!-- /container -->
@include('index.footer')