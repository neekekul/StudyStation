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
            <h1><strong>Lesson Creator</strong></h1>
            <div class="dropdown" id="home">
                <a href="home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
            <form action="/lessonCreator" method="post">
               {{ csrf_field() }}
                <div class="form-group" id="one">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="100" autocomplete="Off">
                </div>
                <div class="form-group" id="two">
                    <label for="body">Body:</label>
                    <textarea class="form-control" id="body" name="body" maxlength="13000"></textarea>
                </div>
                <div class="form-group" id="three">
                    <label for="note">Note:</label>
                    <textarea class="form-control" id="note" name="note" maxlength="700"></textarea>
                </div>
                <div class="form-group">
                <button type="submit" class="btn btn-primary"><strong>PREVIEW</strong></button>
                </div>
                @include('layouts.errors')
            </form>

        </div>

@endsection
