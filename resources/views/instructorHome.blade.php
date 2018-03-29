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
        <h1><strong>{{ auth()->user()->username }}</strong></h1>
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
        <div class="container">
            <iframe name="hub"></iframe>
        </div>
    </div>
@endsection
