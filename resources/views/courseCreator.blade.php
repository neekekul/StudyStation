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
            <h1><strong>Course Creator</strong></h1>
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
        <div id="meat" class="container-fluid">
            <form action="/courseCreator" method="post">
               {{ csrf_field() }}
               @include('layouts.message')
                   @if(count($user->courses))
                    <div class="form-group" id="select">
                                <div class="alert alert-info">
                                    <ul class="list-group">
                                       <h2 class="list-group-header" style="text-align: center;"><strong>{{ auth()->user()->username }}s Courses</strong></h2>
                                        @foreach ($user->courses as $course)
                                            <li class="list-group-item" style="background-color: #899372; color: white;">
                                                {{ $course->name  }}
                                                <span class="badge">{{ $course->id }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                        </div>
                    </div>
                    @endif
                <div class="form-group" id="one">
                    <label for="title">Name:</label>
                    <input type="text" class="form-control" id="title" name="name" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><strong>CREATE</strong></button>
                </div>
                @include('layouts.errors')
            </form>

        </div>
@endsection
