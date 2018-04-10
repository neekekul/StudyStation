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
            <h1><strong>Course Creator</strong></h1>
            <div class="dropdown" id="home">
                <a href="home" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
            </div>
        </div>
        <div id="meat" class="container-fluid">
            <form action="/courseCreator" method="post">
               {{ csrf_field() }}
               @include('layouts.message')
                    <div class="form-group" id="select">
                                <div class="alert alert-info">
                                    <ul>
                                        @foreach ($courses as $course)
                                            <li>
                                                {{ $course }}
                                            </li>
                                        @endforeach
                                    </ul>
                        </div>
                    </div>
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
</div>
@endsection
