@extends('layouts.inslayout')


@section('content')

<div class="container-fluid" id="main">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="/editInstructor">Edit Account <img src="/uploads/icons/{{ auth()->user()->icon }}" style="width:20px; height:20px; float:right; border-radius: 50%;"></a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Course Viewer</strong></h1>
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
        <div id="meat" class="container-fluid" style="height: 54vw;">
            <form action="/courseViewer/courseGuts" method="get">
               {{ csrf_field() }}
                   @if(count($user->links))
                    <div class="form-group" id="select" style="margin-top:5vw;">
                    <label for="sel1">Select Course: (select one)</label>
                    <select class="form-control" id="sel1" name="course" required>
                        @foreach($user->links as $link)
                            @foreach ($courses as $course)
                               @if($course->user->id == $link->link_id)
                                    <option value="{{ $course->id }}">
                                        {{ $course->name }}
                                        {{'--Created By: '}}
                                        {{ $course->user->username }}

                                    </option>
                                @endif
                            @endforeach
                        @endforeach
  		            </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><strong>VIEW</strong></button>
                    </div>
                    @else
                            <h1>Don't see anything? Try linking to an instructor. (search bar)</h1>
                    @endif
                    @include('layouts.errors')
            </form>
        </div>
@endsection
