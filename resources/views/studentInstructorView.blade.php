@extends('layouts.inslayout')

@section('content')
<div class="container-fluid" id="main">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="#">Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        <h1><strong>{{ $ins->username }}</strong></h1>
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
            <a href="/studentInstructorView" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
           <ul class="nav nav-pills nav-stacked" role="tablist">
               <li><a href="studentCourseView">View Courses</a></li>
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
               <li><a href="#"></a></li>
               <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="container-fluid" id="feed">
            @include('layouts.message')
           <div id="meat" class="container-fluid">
            <form action="/courseViewer/courseGuts" method="get">
               {{ csrf_field() }}
                   @if(count($courses))
                    <div class="form-group" id="select">
                    <label for="sel1">Select Course: (select one)</label>
                    <select class="form-control" id="sel1" name="course" required>
    		            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }}
                            </option>
                        @endforeach
  		            </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><strong>VIEW</strong></button>
                    </div>
                    @endif
                    @include('layouts.errors')
            </form>
            <form action="/courseViewer/courseGuts" method="get" style="margin-top: 0vw;">
               {{ csrf_field() }}
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><strong>Link to {{ $ins->username }}</strong></button>
                    </div>
                    @include('layouts.errors')
            </form>
        </div>
        </div>
    </div>
@endsection
