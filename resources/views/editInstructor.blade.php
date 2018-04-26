@extends('layouts.inslayout')


@section('content')
<div class="container-fluid" id="main">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Account Editor</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
        <div class="container-fluid" id="ereg">
          <img src="/uploads/icons/{{ auth()->user()->icon }}" style="width:100px; height:100px; float:right; border-radius: 50%; margin-right: 10vw; margin-top:1vw;">
          <form method="post" enctype="multipart/form-data" style="float:right; width: 3vw; margin-top: 10vw;">
             {{ csrf_field() }}
              <input type="file" name="icon">
              <input type="submit">
          </form>
           <h2>{{ auth()->user()->username }}'s Registration Data:</h2>
            <h4>Type: <small>{{ auth()->user()->type }}</small></h4>
            <br>
            <h4>Username: <small>{{ auth()->user()->username }}</small></h4>
            <br>
            <h4>Email: <small>{{ auth()->user()->email }}</small></h4>
        </div>
            <form action="/editInstructor/email" method="post">
               {{ csrf_field() }}
               @include('layouts.message')
                <div class="form-group" id="ename">
                    <label for="title">Email:</label>
                    <input type="text" class="form-control" id="title" name="email" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><strong>CHANGE EMAIL</strong></button>
                </div>
            </form>
            <form action="/editInstructor/username" method="post" style="margin-top: 0;">
               {{ csrf_field() }}
               @include('layouts.message')
                <div class="form-group">
                    <label for="title">Username:</label>
                    <input type="text" class="form-control" id="title" name="username" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"><strong>CHANGE USERNAME</strong></button>
                </div>
                @include('layouts.errors')
            </form>

        </div>

@endsection
