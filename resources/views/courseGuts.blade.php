@extends('layouts.inslayout')




@section('content')

<div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li><a href="editInstructor">Edit Account</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Course Lessons</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
                   @if(count($lessons))
                    <div class="form-group" id="select" style="margin-top: 5vw;">
                                <div class="alert alert-info">
                                    <ul class="list-group">
                                       <h2 class="list-group-header"><strong>"{{ $course->name }}" Lessons</strong></h2>
                                        @foreach ($lessons as $lesson)
                                            <a href="courseViewer/{{ $lesson->title }}"><li class="list-group-item">
                                                {{ $lesson->title  }}
                                                <span class="badge">{{ $lesson->id }}</span>
                                            </li></a>
                                        @endforeach
                                    </ul>
                        </div>
                    @endif
                    </div>
        </div>


@endsection
