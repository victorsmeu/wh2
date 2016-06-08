<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>WH2</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ url('/css') }}/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/css') }}/metisMenu.min.css">
    <link rel="stylesheet" href="{{ url('/css') }}/sb-admin-2.css">
    <link href='//fonts.googleapis.com/css?family=Antic+Slab' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="{{ url('/css') }}/frontend.css">
    <link href="{{ url('/css') }}/style_mobile.css" rel="stylesheet" type="text/css" media="only screen and (max-width: 767px)" />
    <link href="{{ url('/css') }}/style_tablet.css" rel="stylesheet" type="text/css" media="only screen and (min-width: 768px) and (min-device-width: 768px) and (max-width: 1024px) and (max-device-width: 1024px)" />
	

</head>
<body data-spy="scroll" data-offset="25">
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0" role="navigation">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <div id='logo'>
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <span>web</span>hippocrates<sup>2</sup>
                    </a>
                </div>    
            </div>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-top-links navbar-right navbar-collapse collapse">
                <li><a href='{{ url('/set-lang/ro') }}'>Ro</a></li>
                <li><a href='{{ url('/set-lang/en') }}'>En</a></li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>

        <div id="content">
            @yield('content')
        </div>

    </div>

    <!-- JavaScripts -->
    <script src="{{ url('/js') }}/jquery.min.js"></script>
    <script src="{{ url('/js') }}/bootstrap.min.js"></script>
    <script src="{{ url('/js') }}/metisMenu.min.js"></script>
    <script src="{{ url('/js') }}/smoothScroll.js"></script>
    <script src="{{ url('/js') }}/scrollReveal.js"></script>
    <script src="{{ url('/js') }}/newsite_scripts.js"></script>
</body>
</html>

