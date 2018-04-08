@extends('layouts.layout')


@section('content')
    <div class="main">
        <h1>Sign Up</h1>
    </div>
    <div id="head">

                @include('layouts.message')

            <form method="post" action="/registration" id="registrate" style="margin:0 auto; width:75%;">

                {{ csrf_field() }}

               <br>
               <br>

                <div class="form-group">
                    <label for="sel1">Select list: (select one)</label>
                    <select class="form-control" id="sel1" name="type" required>
    		            <option value="student" selected>Student</option>
    		            <option value="instructor">Instructor</option>
  		            </select>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" autocomplete="Off" maxlength="60" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" autocomplete="Off" maxlength="60" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="Off" maxlength="100" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="passwordCheck" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter Password" autocomplete="Off" maxlength="100" required>
                </div>
                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" name="signed">Sign Up</button>
                </div>


                @include('layouts.errors')

            </form>

            <div class="container-fluid" style="margin-top:3vw">
                <h3>Already have an account? Click the button below to sign in!</h3>
            </div>

            <form action="/instructorLogin" method="GET" style="margin:0 auto; width:75%; margin-top:3vw;">
                <div class="form-group">
                    <button class="btn btn-default btn-lg btn-block">LOGIN</button>
                </div>
            </form>
    </div>
@endsection
