@extends('layouts/master')

@section('content')

    <div class="row">
        <div class="col-sm-6" style="margin: 20px auto">
            <h3> Register </h3>
            <hr class="col-sm-12 hr">

            <form id="register-form" enctype="multipart/form-data" action="{{route('register.save')}}" method="post">
                <div class="form-group row">
                    <label for="input-name" class="col-2 col-form-label">Name</label>
                    <div class="col-10">
                        <input name="name" required class="form-control" type="text" id="input-name"
                               placeholder="Your Name" value="{{isset($values['name']) ? $values['name'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-email" class="col-2 col-form-label">Email</label>
                    <div class="col-10">
                        <input name="email" required class="form-control" type="email" id="input-email"
                               placeholder="Your Email" value="{{isset($values['email']) ? $values['email'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-username" class="col-2 col-form-label">Username</label>
                    <div class="col-10">
                        <input name="username" required class="form-control" type="text" id="input-username"
                               placeholder="Username" value="{{isset($values['username']) ? $values['username'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-password" class="col-2 col-form-label">Password</label>
                    <div class="col-10">
                        <input name="password" required class="form-control" type="password" id="input-username"
                               placeholder="Password" value="{{isset($values['password']) ? $values['password'] : ''}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-password" class="col-2 col-form-label">&nbsp;</label>
                    <div class="col-10">
                        <button type="submit" class="btn btn-primary"> Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        $('#register-form').validate();
    </script>

@endsection