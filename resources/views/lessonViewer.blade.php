@extends('layouts.inslayout')




@section('content')
<div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li><a href="/editInstructor">Edit Account</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Lesson Viewer</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
           <br>
           <br>
            {{ $lesson->title }}
            <br>
            <br>
            {{ $lesson->body }}
            <br>
            <br>
            {{ $lesson->summary }}
        </div>


@endsection
