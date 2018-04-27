@extends('layouts.inslayout')




@section('content')

<div class="container-fluid" id="main">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li><a href="/editInstructor">Edit Account <img src="/uploads/icons/{{ auth()->user()->icon }}" style="width:20px; height:20px; float:right; border-radius: 50%;"></a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
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
            <form action="/courseViewer/courseGuts/lessonViewer" method="get">
               {{ csrf_field() }}
                   @if(count($lessons))
                    <div class="form-group" id="select" style="margin-top:5vw;">
                    <label for="sel1">Select Lesson from "{{ $course->name }}": (select one)</label>
                    <select class="form-control" id="sel1" name="lesson" required>
    		            @foreach ($lessons as $lesson)
                            <option value="{{ $lesson->id }}">
                                {{ $lesson->title }}
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
        </div>


@endsection
