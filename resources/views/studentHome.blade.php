@extends('layouts.inslayout')

@section('content')
<div class="container-fluid">
        <div class="dropdown">
            <button class="btn btn-link dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">Help</a></li>
                <li><a href="#">Edit Account</a></li>
                <li class="divider"></li>
                <li><a href="logout">Logout</a></li>
            </ul>
        </div>
        <h1><strong>{{ auth()->user()->type }}</strong></h1>
        <form method="post" style="width: 20vw; float: right; margin-top: -3.5vw; margin-right: 7vw;">
           {{ csrf_field() }}
            <div class="input-group" style="width: 15vw;">
                <input id="email" type="text" class="form-control" name="search" placeholder="Search" autocomplete="On" maxlength="300">
                <button class="btn btn-default" type="submit" style="margin-top: 0vw; margin-right: -2.35vw; float: right;"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </form>
        <div class="dropdown" id="home">
            <a href="_home.php" target="_self">
                <button class="btn btn-link dropdown-toggle" type="button"><span class="glyphicon glyphicon-home"></span></button>
            </a>
        </div>
    </div>
    <div class="container-fluid" id="vert">
        <div class="vertical-menu">
            <a href="_home.php" target="hub">myCourses</a>
            <a href="#" target="hub">myStudents</a>
            <a href="lessonFactory.php" target="hub">lessonFactory</a>
            <a href="#" target="hub">quizFactory</a>
            <a href="#" target="hub">courseTimelines</a>
            <a href="#" target="hub">studentReports</a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>
            <a href="#" target="hub"></a>


        </div>
    </div>
@endsection
