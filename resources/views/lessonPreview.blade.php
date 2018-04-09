@extends('layouts.inslayout')


@section('content')
<div class="container-fluid">
            <div class="dropdown">
                <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
                <ul class="dropdown-menu">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">Edit Account</a></li>
                    <li class="divider"></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <h1><strong>Lesson Preview</strong></h1>
            <div class="dropdown" id="home">
                <a href="home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
        {{ $title }}
        <br>
        {{ $body }}
        <br>
        {{ $note }}
        <br>
        <form action="/lessonPreview" method="post" style="margin-top: 5vw;">
               {{ csrf_field() }}
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><strong>SUBMIT</strong></button>
                </div>
                @include('layouts.errors')
            </form>
</div>
</div>
@endsection
