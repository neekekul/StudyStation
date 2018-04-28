@extends('layouts.inslayout')




@section('content')

<div class="container-fluid" id="main">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="/editInstructor">Edit Account <img src="/uploads/icons/{{ auth()->user()->icon }}" style="width:20px; height:20px; float:right; border-radius: 50%;"></a></li>
                <li class="divider"></li>
                <li><a href="/logout">Logout</a></li>
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
            <a href="/home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div id="meat" class="container-fluid">
        @if(count($user->links))
                    <div class="form-group" id="select" style="margin-top:5vw;">
                                <div class="alert alert-info">
                                    <ul class="list-group">
                                       <h2 class="list-group-header" style="text-align: center;"><strong>{{ auth()->user()->username }}s Linked Instructors</strong></h2>
                                        @foreach ($user->links as $link)
                                           @foreach($instructors as $instructor)
                                               @if($instructor->id == $link->link_id)
                                                    <li class="list-group-item" style="background-color: #899372; color: white;">
                                                        {{ $instructor->username  }}
                                                        <span class="badge">{{ $instructor->id }}</span>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </ul>
                        </div>
                    </div>
        @endif
    </div>

@endsection
