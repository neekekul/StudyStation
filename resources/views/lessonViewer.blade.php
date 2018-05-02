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
            <h1><strong>Lesson Viewer</strong></h1>
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
        <div id="meat" class="container-fluid" style="padding-left: 5vw; padding-right: 5vw; text-align:center">
           <h2>{{ $course->name }} Lesson Data:</h2>
            <h3>Title: {{ $lesson->title }}</h3>
            <br>
            <h3 style="word-wrap: break-word;">Body: <br> <small>{{ $lesson->body }}</small></h3>
            @if($lesson->image)
                <h3><img src="/uploads/images/{{ $lesson->image }}" style="width:600px; height:400px;"></h3>
            @endif
            <br>
            <h3>Summary: <br><small>{{ $lesson->summary }}</small></h3>
                <div class="container-fluid" id="vert" style="margin-top:8vw;">
                  <form method="post" style="width:65%; margin-left:17.4%;">
                            <div class="form-group" id="two">
                                <label for="body" style="text-align:center; font-size:2vw;">{{ auth()->user()->username }} add a comment:</label>
                                <textarea class="form-control" id="body" name="body" maxlength="2000" style="height:5vw;"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="lesson" class="btn btn-primary" value="{{ $lesson->id }}"><strong>COMMENT</strong></button>
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
                                   @if($lessonComment->user_id == $lesson->course->user->id)
                                    <div class="blog-post" style="width: 50vw; border: 2px solid #8bc34a; margin-left:3vw;">
                                       <img src="/uploads/icons/{{ $lessonComment->user->icon }}" style="float:right; width:100px; height:100px; border-radius:50%; margin-top:.5vw; margin-right:1vw;">
                                        <h3 class="blog-post-title">(Owner)&nbsp;{{ $lessonComment->user->username }}: <small>{{ $lessonComment->user->type }}</small></h3>

                                    @else
                                      <img src="/uploads/icons/{{ $lessonComment->user->icon }}" style="float:right; width:100px; height:100px; border-radius:50%; margin-top:.5vw; margin-right:4.3vw;">
                                       <div class="blog-post" style="width: 50vw; border: 2px solid #2f556b;">
                                        <h3 class="blog-post-title">&nbsp;{{ $lessonComment->user->username }}: <small>{{ $lessonComment->user->type }}</small></h3>

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
