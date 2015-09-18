@include('index.header')
  <body>
    <div class="container center-block" id="mfcont">

    <div class="row">
      <div class="col-xs-5 col-xs-offset-3">
      <div class="panel panel-default" id="form_login">
        <div class="panel-heading" id="head_psaq"><img src="img/nagalogo.png"> <strong>Online Leave Application</strong></div>
          <div class="panel-body">
         @if(Session::has('message'))
            <div class="alert alert-danger" id="bgerror">
              <span class="glyphicon glyphicon-exclamation-sign"></span>
              {{ Session::get('message') }}
            </div>
          @endif

         <form class="form-horizontal" action="login" method="post">
            {{ Form::token() }}
            <div class="form-group">
                <label class="col-xs-3 control-label">Username:</label>
                <div class="col-xs-8">
                  <input type="text" name="txt_username" class="form-control" id="inputEmail3" autofocus placeholder="username">
                </div>
            </div>

          <div class="form-group">
            <label class="col-xs-3 control-label">Password:</label>
            <div class="col-xs-8">
              <input type="password" name="txt_password" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
          </div>

          <div class="form-group">
            <div class="col-xs-offset-3 col-xs-10">
              <button type="submit" class="btn btn-default" id="btn_pdse">Sign in</button>
            </div>
          </div>
      </form>


      </div>
      </div>
      </div>

    </div>
    </div>
    @include('index.footer')
