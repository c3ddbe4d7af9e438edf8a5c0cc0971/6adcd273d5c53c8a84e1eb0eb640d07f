<?php
// View::make('admin/includes/header');
$quizzes=$data['quizzes'];
$quiz_id=$data['quiz_id'];
$exam_id =$data['exam_id'];
$admin=$data['admin'];
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
            Exam
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
            <style>
                .form-control.col-lg-6 {
                    width: 50% !important;
                }
            </style>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <header>
                            <div class="icons"><i class="fa fa-ellipsis-h"></i></div>
                            <h5>Edit Exam</h5>
                            <!-- .toolbar -->
                            <div class="toolbar">
                                <nav style="padding: 8px;">
                                    <a href="javascript:;" class="btn btn-default btn-xs collapse-box">
                                        <i class="fa fa-minus"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default btn-xs full-box">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-danger btn-xs close-box">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </nav>
                            </div>            <!-- /.toolbar -->
                        </header>
                        <div id="collapse3" class="body">
                            <?php foreach($quizzes as $key=>$value) {?>
                                <form action="<?php echo '/update_quiz?exam_id='.$exam_id.'&quiz_id='.$value->id ?>" method="POST" id="add_quiz" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="control-label col-lg-4"> Exam Name:</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="name" name="name" placeholder="Exam Name" value="<?php echo $value->name;?>" class="form-control col-lg-6">
                                        </div>
                                        <br>
                                    </div>
                                     <div class="form-group">
                                        <label class="control-label col-lg-4"> Title:</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="title" name="title" placeholder="Title" value="<?php echo $value->title; ?>" class="form-control col-lg-6">
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                     <input type="hidden" name="logo1" value="<?=$value->logo?>">
                                        <label class="control-label col-lg-4"> Logo:</label>
                                        <div class="col-lg-8">
                                            <img src="<?php echo 'uploads/logo/'.$value->logo; ?>" height="50" width="80">
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                         <label class="control-label col-lg-4"></label>
                                        <div class="col-lg-8">
                                            <input type="file" id="logo" name="logo" class="col-lg-6">
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="control-label col-lg-4"> Time Duration:</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="time_duration" name="time_duration" placeholder="Time in Minutes" value="<?php echo $value->duration; ?>" class="form-control col-lg-6">
                                        </div>
                                        <br>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-4"> Total Question:</label>
                                        <div class="col-lg-8">
                                            <input type="text" id="total_ques" name="total_ques" placeholder="Total Questions" value="<?php echo $value->total_ques; ?>" class="form-control col-lg-6">
                                        </div>
                                        <br>
                                    </div>
                                    <br>
                                    <div class="form-actions col-lg-8 col-lg-offset-4">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                    <br>
                                    <br>
                                </form>
                                <?php }?>
                            </div>
                            <a  href="quiz?exam_id=<?=$exam_id;?>">
                                <button type="button" class="btn btn-primary"> Back </button></a>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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
<script src="assets/js/jquery-ui.min.js"></script>
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
     var a= document.getElementById('logo');
    a.onchange=function(){
        var file=a.files[0];
        if(file.size>15000){
            alert("file size must be less than 15kb");
        }
    };
    // script for handling back button functionality
                      history.pushState(null, null, document.URL);
                      window.addEventListener('popstate', function () {
                      history.pushState(null, null, document.URL);
                      alert("Please use Back Button on page");
                      });
</script>
<!-- <script src="assets/js/style-switcher.js"></script> -->
</body>
</html>
<script src="/admin_assets/js/jquery.validate.min.js"></script>
<script type="text/javascript">
    (function($,W,D)
    {
        var JQUERY4U = {};
        JQUERY4U.UTIL =
        {
            setupFormValidation: function()
            {
//form validation rules
$("#add_quiz").validate({
    rules: {
        quiz_name: "required",
        time_duration:"required",
        total_ques:  "required",
    },
    messages: {
        quiz_name: "Please enter your exam name",
        time_duration:"Please enter the time duration",
        total_ques:  "Please enter the number of questions",
    },
    submitHandler: function(form) {
        form.submit();
    }
});
}
}
//when the dom has loaded setup form validation rules
$(D).ready(function($) {
    JQUERY4U.UTIL.setupFormValidation();
});
})(jQuery, window, document);
</script>