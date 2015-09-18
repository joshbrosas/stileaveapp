<nav class="navbar navbar-default navblue navbar-fixed-top">
    <div style="margin-left: 80px;">
        <div class="navbar-header">
            <a class="navbar-brand" >{{ HTML::image('img/nagalogo.png', 'stilogo', array('id' => 'css_logo') ) }}</a>
            <a class="navbar-brand" >Online Leave Application</a>

</div>
   </div>
   <div style="float: right;margin-right: 80px">
   <ul class="nav navbar-nav">
                   <li><a href="{{ URL::to('logout') }}">Logout</a></li>
               </ul>
   </div>



</nav>