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
            <h1><strong>Lesson Viewer</strong></h1>
            <div class="dropdown" id="home">
                <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
           <h2>{{ $course->name }} Lesson Data:</h2>
            <h3>Title: <small>{{ $lesson->title }}</small></h3>
            <br>
            <h3 style="word-wrap: break-word;">Body: <small>{{ $lesson->body }}</small></h3>
            @if($lesson->image)
                <h3><img src="/uploads/images/{{ $lesson->image }}" style="width:600px; height:400px;"></h3>
            @endif
            <br>
            <h3>Summary: <small>{{ $lesson->summary }}</small></h3>
                <div class="container-fluid" id="vert" style="margin-top:8vw;">
                  <form method="post">
                            <div class="form-group" id="select">
                            <!--<label for="sel1">Select Lesson from "{{ $course->name }}": (select one)</label>-->
                            <select class="form-control" id="sel1" name="lesson" size="1" required>
                                    <option value="{{ $lesson->id }}" selected>
                                        {{ $lesson->title }}
                                    </option>
                            </select>
                            </div>
                            <div class="form-group" id="two">
                                <label for="body">{{ auth()->user()->username }} add a Comment:</label>
                                <textarea class="form-control" id="body" name="body" maxlength="2000" style="height:5vw;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><strong>COMMENT</strong></button>
                            </div>
                            @include('layouts.errors')
                    </form>
                   <div class="container-fluid" id="commentfeed">
                        <div class="blog-header">
                            <h2 class="blog-title" style="text-align:center;">{{ $lesson->title }} Comment Data</h2>
                            <p class="lead blog-description" style="text-align:center;">See what people are saying about {{ $lesson->title }}</p>
                            <br>
                        </div>
                            @if(count($lesson->comments))
                               @foreach($lesson->comments as $lessonComment)
                                   @if($lessonComment->user_id == $lesson->course->user_id)
                                    <div class="blog-post" style="width: 50vw; border: 2px solid #8bc34a; margin-left:3vw;">
                                       <img src="/uploads/icons/{{ auth()->user()->icon }}" style="float:right; width:100px; height:100px; border-radius:50%; margin-top:.5vw; margin-right:1vw;">
                                        <h3 class="blog-post-title">(Owner)&nbsp;{{ auth()->user()->username }}: <small>{{ auth()->user()->type }}</small></h3>

                                    @else
                                      <img src="/uploads/icons/{{ auth()->user()->icon }}" style="float:right; width:100px; height:100px; border-radius:50%; margin-top:.5vw; margin-right:1vw;">
                                       <div class="blog-post" style="width: 50vw; border: 2px solid #2f556b;">
                                        <h3 class="blog-post-title">&nbsp;{{ auth()->user()->username }}: <small>{{ auth()->user()->type }}</small></h3>

                                    @endif
                                        <p class="blog-post-meta">&nbsp;Created: &nbsp;<strong>{{ $lessonComment->created_at->diffForHumans() }}</strong></p>
                                        <p>&nbsp;Comment: &nbsp;{{ $lessonComment->body }}</p>
                                    </div>
                                    <br>
                                @endforeach
                            @endif
                </div>
            </div>
        </div>


@endsection
