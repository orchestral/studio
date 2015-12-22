<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @title()

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body id="{!! get_meta('html::body.id') !!}">
    <header class="navbar navbar-default white" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{!! Request::root() !!}" class="navbar-brand">{!! memorize('site.name') !!}</a>
            </div>
            <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="{!! handles('app::/') !!}">Home</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                @unless (is_null($user = Auth::user()))
                    <li class="dropdown" id="user-menu">
                        <a href="#user-menu" rel="user-menu" class="dropdown-toggle" data-toggle="dropdown">{{ $user->fullname }}</a>
                        <ul class="dropdown-menu">
                            <li><a href="{!! handles('app::logout') !!}">Logout</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{!! handles('app::login') !!}">Login</a></li>
                    @if (memorize('site.registrable', false))
                    <li><a href="{!! handles('app::register') !!}">Register</a></li>
                    @endif
                @endif
                </ul>
            </nav>
        </div>
    </header>

    <div class="container-fluid">
        @include('orchestra/foundation::components.messages')
    </div>

    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
