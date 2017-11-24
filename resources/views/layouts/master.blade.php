<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> Films Manager </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
            integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
            crossorigin="anonymous"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.3.4" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"
            type="text/javascript"></script>

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
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
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

            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
