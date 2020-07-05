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
            <div class="sidebar-logo text-center">
                <a class="navbar-brand" href="{{ route('home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div>
                <ul class="sidebar-navigation">
                    <li class="user-header">
                        <div class="mt-3 d-flex flex-row">
                            <div class="">
                                <svg width="40px" height="40px" viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
                                    <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                                    <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                {{ Auth::user()->name }}<br>
                                @if (Auth::user()->hasRole('admin'))
                                    <p class="text-danger">administrator</p>
                                @elseif(Auth::user()->hasRole('user'))
                                    <p class="text-warning">użytkownik</p>
                                @else
                                    <p class="text-info">Gość</p>
                                @endif

                            </div>
                        </div>
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
                        <a href="{{ route('user.settings') }}">
                            <i class="fa fa-cog" aria-hidden="true"></i> 
                            Ustawienia
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
                <div class="ml-4">
                    @yield('application-module-name')
                 </div>
            </div>

              <div class="ne-main ml-4">
                    @yield('content')
              </div>
        </div>
    </div>
</body>
</html>
