@include('index.header')
<body>
@include('admindashboard.navbar')
<div class="container" id="mfcont">
    <div class="row">
        <div class="col-xs-3">

            <div class="panel panel-default" id="profile">
                {{ HTML::image('img/naga.jpg', 'stinaga', array('class' => 'img-responsive', 'id' => 'coverlogo'))  }}
                <div id="pnelprofilepic">
                    <img src="{{ $profile->profile_mage }}" id="profile-pic" >
                </div>
                <div class="panel-body caption" id="pnelcaption">
                    <h4 style="font-weight: bold" class="text-primary">{{ ucfirst($profile->firstname) }} {{ ucfirst($profile->surname) }}</h4>
                </div>
            </div>

            <div class="list-group fontsize">
                <a class="list-group-item active">
                   HR Leave
                </a>
                <a href="dashboard" class="list-group-item"><i class="fa fa-home"></i> Home</a>
                <a href="leavepay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="{{ $countleave->remaining_leave }} remaining leave." ><span class="badge">{{ $countleave->remaining_leave }}</span> Leave with Pay</a>
                <a href="leavewopay" class="list-group-item tip-bottom"  data-toggle="tooltip"  data-original-title="{{ $countleave->remaining_leave_wopay }} remaining leave." ><span class="badge">{{ $countleave->remaining_leave_wopay }}</span> Leave without Pay</a>
                <a href="{{ URL::route('applyob') }}" class="list-group-item tip-bottom actives" data-toggle="tooltip"  data-original-title="Application for Official Business (OB)"> Application for (OB)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('applyatw') }}" class="list-group-item tip-bottom" data-toggle="tooltip"  data-original-title="Application for Authority to Work (ATW)"> Application for (ATW)<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
                <a href="{{ URL::route('notification') }}" class="list-group-item"> Notification Box<span class="pull-right glyphicon glyphicon-chevron-right"></span></a>
            </div>

            <div class="list-group">
                            <a class="list-group-item active">Recent Leave</a>
                            @if(count($rleave) === 0)
                                <a class="list-group-item" id="recentleave">
                                    No leave yet.
                                </a>
                            @else
                                @foreach($rleave as $recentleave)
                                    <a  href="leave_oblog/{{ $recentleave->leave_id }}" class="list-group-item" id="recentleave">
                                        <div>
                                            <h6><strong>{{ $recentleave->date_from }} to {{ $recentleave->date_to }}</strong></h6>
                                            <p id="pef">{{ htmlspecialchars(substr($recentleave->reason,0, 100)) }}...</p>
                                        </div>
                                    </a>
                                @endforeach
                            @endif
                        </div>


        </div>

        <div class="col-xs-8">
          <div class="panel panel-body">
              <h3><strong class="help-block">Applications for Official Business (OB)</strong></h3>
            <br>
              @if(Session::has('message'))
                  <div class="alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>{{ Session::get('message') }}</strong>
                  </div>
              @endif
              <p class="bg-info" id="bginfo">
              <b>Applications for Official Business (OB)</b> should be filed at least one day before the scheduled out-of-school meeting, appointment, event and all other activities recognized.
              </p>
              <hr>
              <br>
             {{ Form::open(array('url' => 'obleave', 'method' => 'post', 'class' => 'form-horizontal', 'autocomplete' => 'off')) }}
                  <div class="form-group">
                      <p id="plabel" class="col-sm-3 control-label">Employee name: </p>
                      <div class="col-sm-6">
                          <input type="text" value="{{ ucfirst($profile->surname) }}, {{ ucfirst($profile->firstname) }}" class="txtget" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <p id="plabel" class="col-sm-3 control-label">Department: </p>
                      <div class="col-sm-6">
                          <input type="text" value="{{ ucfirst($profile->department) }}" class="txtget" readonly>
                      </div>
                  </div>

                  <div class="form-group has-feedback">
                      <p id="plabel" class="col-sm-3 control-label">Date of Leave: <b>(From)</b> </p>
                       <div class="col-sm-4">
                              <input type="text" placeholder="Date from" class="input-sm form-control" name="date_from" id="dpd1" />
                              <div class="has-error">@if ($errors->has('date_from'))<div class="label label-danger labelerror">{{ $errors->first('date_from') }}</div>  @endif</div>
                       </div>

                       <div class="col-sm-3">
                       <div class="input-group">
                       <select name="time_from" id="timefrom" class="input-sm form-control">
                       <option value="8:00 am">8:00 am</option>
                       <option value="9:00 am">9:00 am</option>
                       <option value="10:00 am">10:00 am</option>
                       <option value="11:00 am">11:00 am</option>
                       <option value="12:00 am">12:00 pm</option>
                       <option value="1:00 pm">1:00 pm</option>
                       <option value="2:00 pm">2:00 pm</option>
                       <option value="3:00 pm">3:00 pm</option>
                       <option value="4:00 pm">4:00 pm</option>
                       <option value="5:00 pm">5:00 pm</option>
                       </select>
                       <span class="input-group-btn">
                         <a class="btn btndcolor input-sm"><span class="glyphicon glyphicon-time"></span> </a>
                       </span>
                       </div>
                       </div>
                       </div>


                        <div class="form-group has-feedback">
                       <p id="plabel" class="col-sm-3 control-label">Date of Leave: <b>(To)</b> </p>
                        <div class="col-sm-4">
                               <input type="text" placeholder="Date to" class="input-sm form-control" name="date_to" id="dpd2" />
                               <div class="has-error">@if ($errors->has('date_to'))<div class="label label-danger labelerror">{{ $errors->first('date_to') }}</div>  @endif</div>
                                <div class="has-error">@if (Session::has('error_message')) <div class="label label-danger labelerror">{{ Session::get('error_message'); }}</div>  @endif</div>
                        </div>

                        <div class="col-sm-3">
                         <div class="input-group">
                        <select name="time_to" id="timeto" class="input-sm form-control">
                        <option value="8:00 am">8:00 am</option>
                        <option value="9:00 am">9:00 am</option>
                        <option value="10:00 am">10:00 am</option>
                        <option value="11:00 am">11:00 am</option>
                        <option value="12:00 am">12:00 pm</option>
                        <option value="1:00 pm">1:00 pm</option>
                        <option value="2:00 pm">2:00 pm</option>
                        <option value="3:00 pm">3:00 pm</option>
                        <option value="4:00 pm">4:00 pm</option>
                        <option value="5:00 pm">5:00 pm</option>
                        </select>
                        <span class="input-group-btn">
                        <a class="btn btndcolor input-sm"><span class="glyphicon glyphicon-time"></span> </a>
                        </span>
                        </div>
                        </div>
                        </div>

             <div class="form-group has-feedback">
                      <p id="plabel" class="col-sm-3 control-label">Total days of leave: </p>
                      <div class="col-sm-5">
                          <div class="input-group">
                              <span class="input-group-btn">
                                <a class="btn btndcolor"><i class="fa fa-check"></i> </a>
                              </span>
                              <span class="@if($errors->has('totalleave')) has-error @endif"><input type="text" name="totalleave" class="form-control" id="totalleave" readonly></span>
                          </div>
                          <div class="has-error">@if ($errors->has('totalleave'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <div class="label label-danger labelerror">{{ $errors->first('totalleave') }}</div>  @endif</div>
                      </div>
                      </div>
                      <input type="hidden" name="totalleaves" class="form-control" id="totalleaves" readonly>


                <div class="form-group has-feedback">
                      <p id="plabel" class="col-sm-3 control-label">Name of Company, Institution, Agency, etc: </p>
                      <div class="col-sm-6">
                              <span class="@if($errors->has('company')) has-error @endif"><input type="text" name="company" class="form-control" placeholder="Name of Company, Institution, Agency, etc..."  ></span>
                          <div class="has-error">@if ($errors->has('company'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <div class="label label-danger labelerror">{{ $errors->first('company') }}</div>  @endif</div>
                      </div>
                      </div>

                 <div class="form-group has-feedback">
                      <p id="plabel" class="col-sm-3 control-label">Address | Destination : </p>
                      <div class="col-sm-6">

                              <span class="@if($errors->has('address')) has-error @endif"><input type="text" name="address" class="form-control" placeholder="Address | Destination..."  ></span>
                          <div class="has-error">@if ($errors->has('address'))<span class="glyphicon glyphicon-remove form-control-feedback"></span> <div class="label label-danger labelerror">{{ $errors->first('address') }}</div>  @endif</div>
                      </div>
                      </div>



                  <div class="form-group">
                      <p id="plabel" class="col-sm-4 control-label">Reason | Justification: </p>
                  </div>

                  <div class="form-group has-feedback">
                      <div class="col-sm-offset-1 col-md-11">
                          <span class="@if($errors->has('reason')) has-error @endif"><textarea class="form-control" id="text2" name="reason"  placeholder="Reason | Justification......"></textarea></span>
                          <div class="has-error">@if ($errors->has('reason'))<div class="label label-danger labelerror">{{ $errors->first('reason') }}</div>  @endif</div>

                      </div>
                  </div>




                <hr>

                  <div class="form-group">
                      <div class="col-sm-offset-3 col-md-9">
                          <button type="submit" disabled class="btn btn-default" id="btn_pdse" style="margin-top: 10px"><i class="fa fa-check-circle"></i> Apply Leave</button>
                      </div>
                  </div>
             {{ Form::close() }}
          </div>
        </div>
    </div>
</div>
@include('index.footer')