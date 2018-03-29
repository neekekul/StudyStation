@extends('layouts.layout')


@section('content')
  <div class="main">
        <h1>Student Log In</h1>
    </div>
   <div id="head">
       @include('layouts.message')
        <form method="post" id="log" style="margin:0 auto; width:75%;">
             {{ csrf_field() }}
          <br>
          <br>
           <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" autocomplete="Off" maxlength="60" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="Off" maxlength="100" required>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                </div>
                @include('layouts.errors')
        </form>
        <div class="container-fluid" style="margin-top:3vw">
            <h3>Don't have an account? Click the button below to sign up!</h3>
        </div>
        <form action="registration" method="GET" style="margin:0 auto; width:75%; height:10vw; margin-top:3vw;">
                <button class="btn btn-default btn-lg btn-block">REGISTER</button>
            </form>

        <div class="container-fluid" style="margin-top:0vw">
            <h3>Have an instructor account? Click the button below!</h3>
        </div>
        <form action="instructorLogin" method="GET" style="margin:0 auto; width:75%; margin-top:3vw;">
                <button class="btn btn-default btn-lg btn-block">STUDENT LOGIN</button>
            </form>

   </div>
@endsection
