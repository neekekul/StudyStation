@extends('layouts.inslayout')


@section('content')

<div class="container-fluid" id="main">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li><a href="editInstructor">Edit Account</a></li>
                    <li class="divider"></li>
                    <li><a href="logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Course Viewer</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid" style="height: 54vw;">
            <form action="#" method="get">
               {{ csrf_field() }}
                   @if(count($courses))
                    <div class="form-group" id="select">
                    <label for="sel1">Select Course: (select one)</label>
                    <select class="form-control" id="sel1" name="course" required>
    		            @foreach ($courses as $course)
                            <option value="{{ $course->id }}">
                                {{ $course->name }}
                                {{'--Created By: '}}
                                {{ $course->username }}

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
