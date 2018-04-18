@extends('layouts.inslayout')

@section('content')
<div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="/editInstructor">Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        <h1><strong>{{ auth()->user()->username }}</strong></h1>
        <form method="post">
           {{ csrf_field() }}
            <div class="input-group">
                <input id="email" type="text" class="form-control" name="search" placeholder="Search" autocomplete="On" maxlength="300">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </form>
        <div class="dropdown" id="home">
            <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
           <ul class="nav nav-pills nav-stacked" role="tablist">
               <li><a href="/lessonCreator">Lesson Creator</a></li>
               <li><a href="/courseCreator">Course Creator</a></li>
               <li><a href="/courseViewer">Course Viewer</a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="container-fluid" id="feed">
            @include('layouts.message')
        </div>
    </div>
@endsection
