<?php
$user_details=$data['user_details'];
// $exam_id=$data['exam_id'];
$admin=$data['admin'];
 // echo "<pre>";print_r($user_details);die;
$actual_link = $_SERVER['REQUEST_URI'];
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
   <!--  <link rel="stylesheet" href="assets/css/style-switcher.css">
    <link rel="stylesheet/less" type="text/css" href="assets/less/theme.less">
    <script src="assets/js/less.js"></script> -->
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
                         <img src="assets/img/logo1.jpg" alt="">
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
            User Details
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
                <h5 class="media-heading">Update: <?=$admin->updated_at?></h5>
                <ul class="list-unstyled user-info">
                   <!--  <li><a href=""><?=$admin->name?></a></li>
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
            <!--Begin Datatables-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-table"></i></div>
                            <h5>User Details</h5>

                            </header>
                            <div class="panel">
                            <div class="panel-content">
                    
                            <div class="btn-group btn-group-justified">
                        <a href="/user_details?quiz_id=<?=$user_details[0]->quiz_id?>&user_id=<?=$user_details[0]->id?>" class="btn btn-primary col-sm-3 <?php if($actual_link=='/user_details?quiz_id='.$user_details[0]->quiz_id.'&user_id='.$user_details[0]->id) {echo 'active';} ?>">
                          <i class="glyphicon glyphicon-plus"></i>
                          <p>User Details</p>
                        </a>
                        <a href="/user_log_details?quiz_id=<?=$user_details[0]->quiz_id?>&user_id=<?=$user_details[0]->id?>" class="btn btn-primary col-sm-3 <?php if($actual_link=='/user_log_details?quiz_id='.$user_details[0]->quiz_id.'&user_id='.$user_details[0]->id) {echo 'active';} ?>">
                          <i class="glyphicon glyphicon-cloud"></i>
                          <p>Questions Details</p>
                        </a>
                        <!-- <a href="/user_list?quiz_id=<?=$quizzes[0]->id?>" class="btn btn-primary col-sm-3 <?php if($actual_link=='/user_list?quiz_id='.$quizzes[0]->id) {echo 'active';} ?>">
                          <i class="glyphicon glyphicon-cog"></i>
                          <p>Quiz User</p>
                        </a> -->
                      </div>
                  </div><!--/panel content-->
              </div><!--/panel-->
                            <div id="collapse4" class="body">
                                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                   <!--  <thead>
                                        <tr>
                                            <th>Sr.No</th>
                                            <th>Quiz name</th>
                                             <th>Users</th>
                                             <th>Questions</th>
                                            <th>Duration</th>
                                            <th>Total Question</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead> -->
                                    <tbody>
                                    <tr>
                                     <td><b>Registration Number</b></td>
                                      <td><?=$user_details[0]->reg_num?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Post</b></td>
                                      <td><?=$user_details[0]->post?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Name</b></td>
                                      <td><?=$user_details[0]->name?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Father Name</b></td>
                                      <td><?=$user_details[0]->father_name?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Gender</b></td>
                                      <td><?=$user_details[0]->gender?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Date Of Birth</b></td>
                                      <td><?=$user_details[0]->dob?></td>
                                    </tr>
                                    <tr>
                                      <td><b>Refernce Id</b></td>
                                      <td><?=$user_details[0]->reference_id?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Profile Pic</b></td>
                                      <td><img width="60" height="60" src="uploads/photo/<?=$user_details[0]->profile_pic?>" /></td>
                                    </tr>
                                     <tr>
                                      <td><b>Signature Pic</b></td>
                                      <td><img width="80" height="60" src="uploads/sign/<?=$user_details[0]->sig_pic?>" /></td>
                                    </tr>
                                    <tr>
                                      <td><b>Mobile</b></td>
                                      <td><?=$user_details[0]->mobile?></td>
                                    </tr>
                                     <tr>
                                      <td><b>Email</b></td>
                                      <td><?=$user_details[0]->email?></td>
                                    </tr>
                                        
                                                    </tbody>

                                                </table>
                                                 <a  href="user_list?quiz_id=<?=$user_details[0]->quiz_id;?>">
                                <button type="button" class="btn btn-primary"> Back </button></a>   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <!--End Datatables-->
                            </div>
                            <!-- /.inner -->
                        </div>
                        <!-- /.outer -->
                    </div>
                    <!-- /#content -->
                    <!-- /#right -->
                </div>
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
                <!-- <script src="assets/js/jquery.tablesorter.min.js"></script> -->
                <!-- <script src="assets/js/jquery.ui.touch-punch.min.js"></script> -->
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
                </script>
                <!-- <script src="assets/js/style-switcher.js"></script> -->
            </body>
            </html>
