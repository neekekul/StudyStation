@extends('layouts.inslayout')

@section('content')
<div class="container-fluid" id="main">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-hamburger"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li>
                    <a href="/editInstructor">Edit Account <img src="/uploads/icons/{{ auth()->user()->icon }}" style="width:20px; height:20px; float:right; border-radius: 50%;"></a>

                </li>
                <li class="divider"></li>
                <li><a href="/logout">Logout</a></li>
            </ul>
        </div>
        <h1><strong>{{ auth()->user()->username }}</strong></h1>
        <form method="post">
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
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
           <ul class="nav nav-pills nav-stacked" role="tablist">
               <li><a href="/lessonCreator">Lesson Creator</a></li>
               <li><a href="/courseCreator">Course Creator</a></li>
               <li><a href="/courseViewer">Course Viewer</a></li>
               <li><a href="#"></a></li>

            </ul>
        </div>
        <div class="container-fluid" id="feed">
            @include('layouts.message')
            <div class="blog-header">
                <h2 class="blog-title">Study Station's Activity Feed</h2>
                <p class="lead blog-description"></p>
                <br>
            </div>
            @if(count($lessons))
               @foreach($lessons as $lesson)
                    <div class="blog-post" style="width: 50vw;">
                        <h3 class="blog-post-title">{{ $lesson->title }}</h4>
                        <p class="blog-post-meta">{{ $lesson->created_at->toFormattedDateString() }}&nbsp;by: {{ $lesson->course->user->username }}</p>
                        <h4>Body:</h4>
                        <p>{{ $lesson->body }}</p>
                        @if($lesson->image)
                            <img src="/uploads/images/{{ $lesson->image }}" style="width:400px; height:200px;">
                        @endif
                        <h4>Summary:</h4>
                        <p>{{ $lesson->summary }}</p>
                        <br>
                        <hr>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
