<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: #a42a4e">
    <div class="container">
        <div class="navbar-header page-scroll" >
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/" >
                <h1 style="color:#FFF">ACE FAMILY LINK</h1>
            </a>
        </div>
        @if( ! Sentry::check() )
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse" style="background-color: #a42a4e">
            <ul class="nav navbar-nav">
                <li style="background-color: #a42a4e"><a href="/parent/home">Parents</a></li>
                <li class="active" style="background-color: #a42a4e"><a href="/teacher/home">Teachers</a></li> 
            </ul>
        </div>
        @else
        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown" style="background-color: #a42a4e"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->first_name;?>&nbsp;<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="/pwd/change" style="color:black">Change Password</a></li>
                    <li><a href="/logout" style="color:black">Logout</a></li>
                </ul>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>


