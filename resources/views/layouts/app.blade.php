<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/components/input-group/"> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
  
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neapps.css') }}" rel="stylesheet" type="text/css" >

</head>
<body class="" style="overflow: hidden;">
    <div class="sidebar-container">
        <div class="d-flex align-items-start flex-column h-100">
            <div class="sidebar-logo">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div>
                <ul class="sidebar-navigation">
                    <li class="header">
                        &nbsp;
                    </li>
                    <li>
                    <a href="{{ route('home') }}">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            {{ __('welcome.home') }}
                        </a>
                    </li>
                    @can('manage-users')
                        <li>
                            <a href="#">
                                <i class="fas fa-user-friends"></i>
                                {{ __('app.admin.users.managment') }}
                            </a>
                        </li>
                    @endcan
                    <li class="header">
                        {{ __('app.group.apps') }}
                    </li>
                     <li>
                        <a href="{{ route('medical_reports.index') }}">
                            <i class="fa fa-users" aria-hidden="true"></i>
                            {{ __('app.medical-reports') }}
                        </a>
                    </li>
                    {{-- <li>
                        <a href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i> 
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-info-circle" aria-hidden="true"></i> 
                            Information
                        </a>
                    </li> --}}
                </ul>
            </div>

            <div class="mt-auto">
                <ul class="sidebar-user-navigation">
                    <li>
                        <a href="#">
                            <i class="fa fa-cog" aria-hidden="true"></i> 
                            Settings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                {{ __('auth.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </li>
                </ul>
                <div class="mb-3"></div>
            </div>
        </div>
    </div>


    <div class="content-container">
        <div class="container-fluid">
            <div class="ne-navbar d-flex d-flex align-items-center">
                <div class="ml-3">
                    @yield('application-module-name')
                 </div>
            </div>

              <div class="ne-main">
                    @yield('content')
              </div>
        </div>
    </div>
</body>
</html>
