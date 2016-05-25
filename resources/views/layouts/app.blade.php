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
    <link rel="stylesheet" href="{{ url('/css') }}/timeline.css">
    <link rel="stylesheet" href="{{ url('/css') }}/font-awesome.min.css">

</head>
<body id="app-layout">
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
                <a class="navbar-brand" href="{{ url('/') }}">
                    WH2
                </a>
            </div>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-top-links navbar-right">
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
                            <li>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul id="side-menu" class="nav in">
                        <li>
                            <a class="active" href="{{ url('/dashboard') }}">
                                <i class="fa fa-dashboard fa-fw"></i>&nbsp; Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="active" href="{{ url('/patients') }}">
                                <i class="fa fa-dashboard fa-fw"></i>&nbsp; Pacients
                            </a>
                        </li>
                        <li>
                            <a class="active" href="{{ url('/medics/index') }}">
                                <i class="fa fa-dashboard fa-fw"></i>&nbsp; Medics
                            </a>
                        </li>
                        <li>
                            <a class="active" href="{{ url('/reports/index') }}">
                                <i class="fa fa-dashboard fa-fw"></i>&nbsp; Reports
                            </a>
                        </li>
                        <li>
                            <a class="active" href="{{ url('/conference/index') }}">
                                <i class="fa fa-dashboard fa-fw"></i>&nbsp; Conference
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </nav>

        <div id="page-wrapper">
            @if(Session::has('flash_message'))
                <div class="alert alert-success alert-dismissable">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">X</button>
                    {{ Session::get('flash_message') }}
                </div>
            @endif
            @yield('content')
        </div>

    </div>

    <!-- JavaScripts -->
    <script src="{{ url('/js') }}/jquery.min.js"></script>
    <script src="{{ url('/js') }}/bootstrap.min.js"></script>
    <script src="{{ url('/js') }}/metisMenu.min.js"></script>
    <script src="{{ url('/js') }}/sb-admin-2.js"></script>
</body>
</html>
