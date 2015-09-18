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
                    <h6><b>{{ $admin->department }}</b></h6>
                    <h6><b>{{ $admin->email }}</b></h6>
                </div>
            </div>

            <div class="list-group">
                <a class="list-group-item active">
                    Administrative Panel
                </a>
                <a href="{{ URL::route('administrator') }}" class="list-group-item"><i class="fa fa-chevron-left"></i> Control Panel</a>
                <a href="{{ URL::route('admin_policies') }}" class="list-group-item">School Policies <span class="pull-left glyphicon glyphicon-chevron-left"></span> </a>
            </div>
        </div>

        <div class="col-xs-9">
            <div class="panel panel-body">
                <h3><strong class="help-block"><i class="fa fa-users"></i> All Users</strong></h3>
                <hr>
                    <div class="table table-responsive">
                  {{ $table->render() }}
                  {{ $table->script() }}
                    </div>
            </div>
        </div>
    </div>
</div>

@include('index.footer')