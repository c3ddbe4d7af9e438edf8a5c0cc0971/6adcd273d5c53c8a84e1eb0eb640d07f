<?php
// $admins_user=$data['admins_user'];
$admin=$data['admin'];
//echo '<pre>';print_r($admin);die;
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <!--IE Compatibility modes-->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--Mobile first-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>BinSys</title>
  <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
  <meta name="author" content="">
  <meta name="msapplication-TileColor" content="#5bc0de" />
  <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />
  <!-- Bootstrap -->
  <link rel="stylesheet" href="assets/lib/bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
 <link rel="stylesheet" type="text/css" href="/font-awesome-4.7.0/css/font-awesome.css">
  <!-- Metis core stylesheet -->
  <link rel="stylesheet" href="assets/css/main.css">
  <!-- metisMenu stylesheet -->
  <link rel="stylesheet" href="assets/lib/metismenu/metisMenu.css">
  <!-- animate.css stylesheet -->
  <link rel="stylesheet" href="assets/lib/animate.css/animate.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap.min.css">
  <script>
    less = {
      env: "development",
      relativeUrls: false,
      rootpath: "/assets/"
    };
  </script>
  <!-- <link rel="stylesheet" href="assets/css/style-switcher.css">
  <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
  <script src="assets/js/less.js"></script> -->
  <style type="text/css">
    label.error {
      color: #FB3A3A;
      display: inline-block;
      /*margin: 4px 0 5px 125px;*/
      padding: 0;
      text-align: left;
      width: 220px;
    }
    body { padding-top:20px; }
.panel-body .btn:not(.btn-block) { width:220px;margin-bottom:17px; }
.btn-lg
{
 padding: 27px 17px;
 font-size: 24px;
  
}
</style>
</head>
<body class="  ">
  <div class="bg-dark dk" id="wrap">
    <div id="top">
      <!-- .navbar -->
      <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <header class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
             <img src="assets/img/logo1.png" height="50" alt="">
          </header>
          <div class="topnav">
    <div class="btn-group">
      <a href="/logout" data-toggle="tooltip" data-original-title="Logout" data-placement="bottom"
      class="btn btn-metis-1 btn-sm">
      <i class="fa fa-power-off"></i>
    </a>
  </div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse">
    <!-- .nav -->
    <ul class="nav navbar-nav">
        <li><a href="dashboard?admin_id=<?=$admin->id?>"><i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span></a></li>
        <li class=""><a href="admin?admin_id=<?=$admin->id?>"><i class="fa fa-lock"></i><span class="link-title">&nbsp;Admins</span></a></li>
        <li><a href="/users"><i class="fa fa-users" aria-hidden="true">&nbsp;Users</i></a></li>
        <li class='dropdown '>
            <a href="authority?admin_id=<?=$admin->id?>">
            <i class="fa fa-building" aria-hidden="true">&nbsp; Authority</i>
               
            </a>
        </li>
        <li><a href="/questions"><i class="fa fa-question-circle" aria-hidden="true">&nbsp;Question Bank</i></a></li>
        <li><a href="/result"><i class="fa fa-table" aria-hidden="true">&nbsp;Results</i></a></li>
    </ul>
    <!-- /.nav -->
</div>
</div>
<!-- /.container-fluid -->
</nav>
<!-- /.navbar -->                        
<header class="head">
  <div class="search-bar">
    <!-- /.main-search -->                                
  </div>
  <!-- /.search-bar -->
  <div class="main-bar">
    <h3>
      <i class="fa fa-table"></i>&nbsp;
      Dashboard
       <a href="/demo_user_csv">
                <button type="button" class="btn btn-success"> Demo User CSV </button>
            </a>

            <a href="/demo_question_csv">
                <button type="button" class="btn btn-success"> Demo Question CSV </button>
            </a>

            <a href="/demo_answer_csv">
                <button type="button" class="btn btn-success"> Demo Answer Key CSV </button>
            </a>
    </h3>
  </div>
  <!-- /.main-bar -->
</header>
<!-- /.head -->
</div>
<!-- /#top -->
<div id="left">
  <div class="media user-media bg-dark dker">
    <div class="user-media-toggleHover">
      <span class="fa fa-user"></span>
    </div>
     <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
                <img class="media-object img-thumbnail user-img" height="100" width="100" alt="User Picture" src="<?php echo 'profile_pic/'.$admin->profile_pic; ?>">
                <!-- <span class="label label-danger user-label">16</span> -->
            </a>
            <div class="media-body">
               <div style="background-color:green;border-radius:50px;width:15px;height:15px;"></div>
                <h5 class="media-heading">Name: <?=$admin->name?> </h5>
                <h5 class="media-heading">Last Login: <?=$admin->login_at?></h5>
                <ul class="list-unstyled user-info">
                    <!-- <li><a href=""><?=$admin->name?></a></li>
                    <li>Update :<br>
                        <small><i class="fa fa-calendar"></i>&nbsp;<?=$admin->updated_at?></small>
                    </li> -->
                </ul>
            </div>
        </div>
  </div>
  <!-- #menu -->
 <ul id="menu" class="bg-blue dker">
        <li class="nav-header">Menu</li>
        <li class="nav-divider"></li>
        <li class="">
            <a href="dashboard?admin_id=<?=$admin->id?>">
                <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Dashboard</span>
            </a>
        </li>
        <li>
            <a href="admin?admin_id=<?=$admin->id?>">
                <i class="fa fa-lock"></i>
                <span class="link-title">Admins</span>
            </a>
        </li>
        <li>
            <a href="/users">
                <i class="fa fa-users"></i>
                <span class="link-title">Users</span>
            </a>
        </li>
        <li class="">
            <a href="authority?admin_id=<?=$admin->id?>">
                <i class="fa fa-building "></i>
                <span class="link-title">Authorities</span>
                <span class="fa arrow"></span>
            </a>
        </li>
        <li>
            <a href="/questions">
                <i class="fa fa-question-circle"></i>
                <span class="link-title">Questions Bank</span>
            </a>
        </li>
        <li>
            <a href="/result">
                <i class="fa fa-table"></i>
                <span class="link-title">Results</span>
            </a>
        </li>
    </ul>
  <!-- /#menu -->
</div>
<!-- /#left -->
<div id="content">
  <div class="outer">
    <div class="inner bg-light lter">
      <div class="text-center">
             <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 ">
                          <a href="/admin?admin_id=<?=$admin->id?>" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Admins</a>
                           <a href="/users" class="btn btn-success btn-lg" role="button"><span class="glyphicon glyphicon-user"></span> <br/>Users</a>
                          <a href="authority?admin_id=<?=$admin->id?>" class="btn btn-warning btn-lg" role="button"><span class="glyphicon glyphicon-bookmark"></span> <br/>Authorities</a>
                          <!-- <a href="" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-signal"></span> <br/>Examinations</a> -->
                          <a href="/questions" class="btn btn-danger btn-lg" role="button"><span class="glyphicon glyphicon-home"></span> <br/>Questions</a>
                           <a href="/result" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-list-alt"></span> <br/>Results</a>
                         
                        </div>
                        <!-- <div class="col-xs-6 col-md-6">
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-comment"></span> <br/>Comments</a>
                          <a href="#" class="btn btn-info btn-lg" role="button"><span class="glyphicon glyphicon-file"></span> <br/>Notes</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-picture"></span> <br/>Photos</a>
                          <a href="#" class="btn btn-primary btn-lg" role="button"><span class="glyphicon glyphicon-tag"></span> <br/>Tags</a>
                        </div> -->
                    </div>
                   
                </div>
                      </div>
                      <hr>
                    </div>
                    <!-- /.inner -->
                  </div>
                  <!-- /.outer -->
                </div>
                <!-- /#content -->
                <!-- /#wrap -->
                <footer class="Footer bg-dark dker">
                  <p>2016 &copy; BinSys Admin Panel</p>
                </footer>
                <!-- /#footer -->
                <!--jQuery -->
                <script src="assets/lib/jquery/jquery.js"></script>
                <!-- <script src="assets/js/jquery-ui.min.js"></script> -->
                <script src="assets/js/jquery.dataTables.min.js"></script>
                <script src="assets/js/dataTables.bootstrap.min.js"></script>
                <script src="assets/js/jquery.tablesorter.min.js"></script>
                <script src="assets/js/jquery.ui.touch-punch.min.js"></script>
                <!--Bootstrap -->
                <script src="assets/lib/bootstrap/js/bootstrap.js"></script>
                <!-- MetisMenu -->
                <script src="assets/lib/metismenu/metisMenu.js"></script>
                <!-- Screenfull -->
                <script src="assets/lib/screenfull/screenfull.js"></script>
                <!-- Metis core scripts -->
                <script src="assets/js/core.js"></script>
                <!-- Metis demo scripts -->
                <script src="assets/js/app.js"></script>
                <script>
                  $(function() {
                    Metis.MetisTable();
                    Metis.metisSortable();
                  });

                  history.pushState(null, null, document.URL);
                  window.addEventListener('popstate', function () {
                  history.pushState(null, null, document.URL);
                  alert("Please use Back Button on page");
                  });
                </script>
                <!-- <script src="assets/js/style-switcher.js"></script> -->
              </body>
              </html>