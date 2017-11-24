@extends('layouts/master')

@section('content')
    <div class="row">
        <div class="col-sm-4" style="margin: 20px auto">
            <h3> Login </h3>
            <hr class="col-sm-12 hr">

            <form id="register-form" enctype="multipart/form-data" action="{{route('auth.authenticate')}}"
                  method="post">
                <div class="form-group row">
                    <label for="input-username" class="col-10 col-form-label">Username/Email</label>
                    <div class="col-12">
                        <input name="username" required class="form-control" type="text" id="input-username"
                               placeholder="Username" value="{{isset($values['username']) ? $values['username'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-password" class="col-10 col-form-label">Password</label>
                    <div class="col-12">
                        <input name="password" required class="form-control" type="password" id="input-username"
                               placeholder="Password" value="{{isset($values['password']) ? $values['password'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary"> Login</button>
                    </div>
                    <div class="col-sm-12 text-right">
                        <small>
                            <a href="{{route('register')}}">Sign up</a>
                        </small>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#register-form').validate();
    </script>

@endsection