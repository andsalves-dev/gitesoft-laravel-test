<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Films Manager </title>

    <link rel="stylesheet" href="/css/bootstrap4.0.0-alpha.min.css">
    <link rel="stylesheet" href="/css/bootstrap4.0.0-alpha.min.css">

    <script src="/js/jquery-1.12.4.js"></script>

    <script src="/js/vue.min.js" type="text/javascript"></script>
    <script src="/js/vue.resource-1.3.4.js" type="text/javascript"></script>

    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>

    <script src="/js/films.js" type="text/javascript"></script>

    <style>
        body {
            padding: 30px 10px 20px;
        }

        @media (max-width: 980px) {
            body {
                padding: 5px;
            }
        }

        label.error {
            color: #a94442;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        @if (Auth::check() && Route::currentRouteName() != 'films.insert')
            <section class="col-sm-12 text-left">
                <a class="nav-link" href="{{route('films.insert')}}">Insert new film</a>
            </section>
        @endif

        <section class="col-sm-12 text-right">
            <span class="">
                @if(Route::currentRouteName() != 'auth.login')
                    @if (!Auth::check())
                        You are not signed in.
                        <a href="{{route('auth.login')}}">Login</a>
                    @else
                        Hi, {{Auth::user()->name}}. <a href="{{route('auth.logout')}}">Logout</a>
                    @endif
                @else
                    <a href="/">Home</a>
                @endif
            </span>
        </section>

        <div class="col-sm-12">
            @if (session('error_message'))
                <div class="alert alert-danger">
                    {{ session('error_message') }}
                </div>
            @endif

            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                </div>
            @endif

            @if (session('warning_message'))
                <div class="alert alert-warning">
                    {{ session('warning_message') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
