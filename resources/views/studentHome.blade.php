@extends('layouts.inslayout')

@section('content')
<div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="#">Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </div>
        <h1><strong>{{ auth()->user()->username }}</strong></h1>
        <form method="post" action="studentHome/search">
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
            <a href="studentInstructorView.blade.php" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
           <ul class="nav nav-pills nav-stacked" role="tablist">
               <li><a href="studentCourseView">View Courses</a></li>
               <li><a href="#">View Linked Instructors</a></li>
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
    </div>
@endsection
