<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => [
                'auth' => auth()->check(),
                'data' => auth()->user()
            ]
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <router-link class="navbar-brand" :to="{ name: 'index' }">
                        {{ config('app.name', 'Laravel') }}
                    </router-link>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right" v-cloak>
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <router-link tag="li" active-class="active" :to="{ name: 'message.index' }">
                                <a href="#">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                    Messages
                                </a>
                            </router-link>

                            <router-link tag="li" active-class="active" :to="{ name: 'user.index' }">
                                <a href="#">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Users
                                </a>
                            </router-link>

                            <router-link tag="li" active-class="active" :to="{ name: 'setting' }">
                                <a href="#">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                </a>
                            </router-link>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <strong>@{{ user.data.name }}</strong>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <router-link :to="{ name: 'user.notification' }" active-class="active">
                                            Notifications
                                            <span class="label label-info">
                                                @{{ user.totalNotification }}
                                            </span>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'user.profile' }" active-class="active">
                                            Profile
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link :to="{ name: 'user.password' }" active-class="active">
                                            Change Password
                                        </router-link>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
