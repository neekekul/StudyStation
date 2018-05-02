@extends('layouts.inslayout')


@section('content')
<div class="container-fluid" id="main">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Account Editor</strong></h1>
            <form method="post" action="/studentHome/search">
               {{ csrf_field() }}
                <div class="input-group">
                    <input id="email" type="text" class="form-control" name="search" placeholder="Search" autocomplete="Off" maxlength="300" list="students">
                    <datalist id="students">
                    @if(count($instructors))
                    @foreach($instructors as $instructor)
                    <option value="{{ $instructor->id }}">
                        {{$instructor->username}}
                        </option>
                    @endforeach
                        @endif
                    </datalist>
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </form>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid" style="background-color: #d2c9bc;">
        <div class="container-fluid" id="ereg" style="background-color: #d2c9bc;">
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
