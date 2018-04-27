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
            <h1><strong>Lesson Creator</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
            <form action="/lessonCreator" enctype="multipart/form-data" method="post">
               {{ csrf_field() }}
               @include('layouts.message')
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
                <div class="form-group" id="one">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group" id="two">
                    <label for="body">Body:</label>
                    <textarea class="form-control" id="body" name="body" maxlength="13000"></textarea>
                </div>
                <div class="form-group" id="twohalf">
                   <label for="image">Upload Image:</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group" id="three">
                    <label for="note">Note:</label>
                    <textarea class="form-control" id="note" name="note" maxlength="700"></textarea>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><strong>SAVE LESSON</strong></button>
                </div>
                @include('layouts.errors')
            </form>

        </div>

@endsection
