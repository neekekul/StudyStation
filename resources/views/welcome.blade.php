@extends('layouts.layout')



@section('content')
    <div class="main">
        <h1>Study Station</h1>
    </div>
<div id="head">
  <br><br>
    <form method="get" action="Login" style="margin:0 auto; width:75%; height:7vw;">
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="height:4vw;">LOGIN</button>
        </form>
    <form method="get" action="registration" style="margin:0 auto; width:75%; height:7vw;">
            <button type="submit" class="btn btn-primary btn-lg btn-block" style="height:4vw;">REGISTER</button>
        </form>
</div>
@endsection
