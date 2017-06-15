<html>
<head>
  <meta name="viewport" content="width=device-width">
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css">
  <script src="js/jquery.js"></script> 
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.simple.timer.js"></script>

  <!-- keyboard widget css & script (required) -->

  <link href="monty_virtual/css/jquery-ui.css" rel="stylesheet">
  <script src="monty_virtual/js/jquery.js"></script>


  <link href="monty_virtual/css/keyboard.css" rel="stylesheet">
  <script src="monty_virtual/js/jquery.keyboard.js"></script>

  <!-- keyboard extensions (optional) -->
  <script src="monty_virtual/js/jquery.mousewheel.js"></script>


  <!-- *************************** -->
  <script>

    $(function(){
      $('#text').keyboard();
      $('#password').keyboard();
    });
  </script>
  <title>Binsys</title>

</head>
<body>
  <div id="wrap">
<div class="container-fluid">


<div class="custom_nav"><h1 class="text-center">Binsys</h1>

</div>


<div class="row">



<div class="login_form">
<p style="color:red;display:<?=Input::get('error')=='1'?'':'none'?>">Invalid reference id/password</p>
<form action="/adminlogin" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">User Name:</label>
    <input type="text" class="form-control" id="text" placeholder="User Name" name="name" value="10001">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password:</label>
    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="46951273">
  </div>
  

  <div class="col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4">
  <button type="submit" class="login_btn">Sign in</button>
  </div>


</form>






</div>






</div>

</div>
<script type="text/javascript">
$(document).ready(function() {
    $(document)[0].oncontextmenu = function() { return false; }
    $(document).mousedown(function(e) {
        if( e.button == 2 ) {
            alert('Sorry, this functionality is disabled!');
            return false;
        } else {
            return true;
        }
    });
});
$(document).ready(function() {
    $(document)[0].oncontextmenu = function() { return false; }
    $(document).mousedown(function(e) {
        if( e.button == 2 ) {
            alert('Sorry, this functionality is disabled!');
            return false;
        } else {
            return true;
        }
    });
});
    </script>
</body>
</html>