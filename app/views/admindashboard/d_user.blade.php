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
            <a href="{{ URL::route('view_users') }}" class="list-group-item"><span class="pull-left glyphicon glyphicon-chevron-left"></span> Go Back</a>
            <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-cogs"></i> Control Panel</a>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h3><strong><i class="fa fa-user-times"></i> Delete User </strong></h3>
                <hr>
                 <div class="row">
                     <div class="col-xs-5 col-xs-offset-3">
                         <div class="thumbnail">
                             {{ HTML::image($profile->profile_mage, 'stilogo', array('class' => 'img-circle img-responsive')) }}
                             <div class="caption">
                                 <h4 class="text-primary"><strong>{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</strong></h4>
                                 <address>
                                     Employee ID: <strong class="text-primary">{{ $profile->employee_id }}  </strong><br>
                                     Department: <strong>{{ ucfirst($profile->department) }}</strong><br>
                                     <a href="mailto:#">{{ ucfirst($profile->email) }}</a>
                                 </address>
                                 {{ Form::open(array('url' =>'d_user/'.$profile->employee_id, 'method' => 'post')) }}
                                 <button href="#" class="btn btn-danger" type="submit"><i class="fa fa-user-times"></i> Delete this user</button>
                                {{ Form::close() }}
                             </div>
                         </div>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>
@include('index.footer')