@extends('layouts.inslayout')


@section('content')
<div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Account Editor</strong></h1>
            <div class="dropdown" id="home">
                <a href="home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div class="container-fluid" id="ereg">
           <h2>Current Registration Data:</h2>
            <h4>Type: <small>{{ auth()->user()->type }}</small></h4>
            <br>
            <h4>Username: <small>{{ auth()->user()->username }}</small></h4>
            <br>
            <h4>Email: <small>{{ auth()->user()->email }}</small></h4>
        </div>
        <div id="meat" class="container-fluid">
            <form action="/editInstructor" method="post">
               {{ csrf_field() }}
               @include('layouts.message')
                <div class="form-group" id="ename">
                    <label for="title">Username:</label>
                    <input type="text" class="form-control" id="title" name="username" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="title" name="email" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><strong>CHANGE</strong></button>
                </div>
                @include('layouts.errors')
            </form>

        </div>

@endsection
