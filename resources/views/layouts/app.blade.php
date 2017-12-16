@extends('layouts.search')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PickBook @yield('title')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/assets/font-awesome-4.6.3/css/font-awesome.min.css">

    <link rel="stylesheet" href="/assets/css/fonts/google-lato.css">

    <!-- Styles -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.original.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="/assets/css/bootstrap.min.css"/>

    <link href="/assets/css/flat-ui.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    @yield('includes')

	<style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

</head>
<body id="app-layout">

    <nav class="navbar navbar-inverse navbar-embrossed navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                    </button>
                                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    PickBook
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li @yield('HomeisActive')><a href="{{ url('/home') }}">{{htmlentities('Books')}}</a></li>
                    <li @yield('AboutusisActive')><a href="{{ url('/aboutus') }}">About US</a></li>
                    <li @yield('ContactusisActive')><a href="{{ url('/contactus') }}">Contact US</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li @yield('LoginisActive')><a href="{{ url('/login') }}">Login</a></li>
                        <li @yield('RegisterisActive')><a href="{{ url('/register') }}">Register</a></li>
                   @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                @if(Auth::user()->role==1)
                                <li><a href="{{ url('/myprofile') }}" style="font-size: 14px;"><i class="fa fa-btn fa-user"></i>My Profile</a></li>
                                <li><a href="{{ url('/0/inbox') }}" style="font-size: 14px;"><i class="fa fa-btn fa-inbox"></i>Inbox</a></li>
                                @endif

                                @if(Auth::user()->role==2)
                                <li><a href="{{ url('/QShome') }}" style="font-size: 14px;"><i class="fa fa-btn fa-bars"></i>QS panel</a></li>
                                @endif
                                @if(Auth::user()->role==3)
                                <li><a href="{{ url('/HRPanel') }}" style="font-size: 14px;"><i class="fa fa-btn fa-bars"></i>HR panel</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}" style="font-size: 14px;"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>

                            </ul>
                        </li>

                    @endif
                    <li>
                         <form id="tfnewsearch" method="get" action="/search">
                               <input type="text" id="tfq" class="tftextinput2" name="keyword" size="18" maxlength="120" placeholder="Search.."><input type="submit" value="Go" class="tfbutton2">
                         </form>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <footer class="navbar-inverse navbar-fixed-bottom">
          <div class="container-fluid">
            <p class="text-center" style="color:#FFFFFF; font-size:12px;">&copy2016 Delta Systems. All rights reserved.</p>
          </div>
    </footer>

</body>
    <style>
        .gold {
            color: #D4AF37;
        }
        body { padding-top: 80px; padding-bottom: 70px; }
    </style>
</html>
