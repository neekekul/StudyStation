@include('main.header')
  <div class="main">
        <h1>Student Sign In</h1>
    </div>
   <div id="head">
        <form method="post" id="log" style="margin:0 auto; width:75%;">
          <br>
          <br>
           <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                    <input id="email" type="email" class="form-control" name="email" placeholder="Email" autocomplete="Off" maxlength="60" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" autocomplete="Off" maxlength="100" required>
                </div>
                <br>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
        </form>
        <h3>Don't have an account? Click the button below to sign up!</h3>
        <form action="registration" method="GET" style="margin:0 auto; width:75%; margin-top:-18vw;">
                <button class="btn btn-default btn-lg btn-block">REGISTER</button>
            </form>

   </div>
@include('main.footer')
