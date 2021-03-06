<?php
$admins_user=$data['users'];
// echo '<pre>';print_r($admins_user);die;
$admin=$data['admin'];
?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
   <!--  <META HTTP-EQUIV="Refresh" CONTENT="15"> -->

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
            Users
            <a href="/demo_user_csv">
                <button type="button" class="btn btn-success"> Demo User CSV </button>
            </a>

            <a href="/demo_question_csv">
                <button type="button" class="btn btn-success"> Demo Question CSV </button>
            </a>

            <a href="/demo_answer_csv">
                <button type="button" class="btn btn-success"> Demo Answer Key CSV </button>
            </a>
            <button class="btn btn-danger" id="delete" type="button">Truncate User Answer Table</button>
            
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
                   <!--  <li><?=$admin->name?></li> -->
                   <!--  <li>Update :<br> -->
                       <!--  <small><i class="fa fa-calendar"></i>&nbsp;<?=$admin->updated_at?></small> -->
                    </li>
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
                            <h5>Users</h5>
                             <!-- <a href="/result_export">
                                    <button type="button" class="btn btn-primary pull-left"> Export Result </button></a>
                            &nbsp;<a href="/export_user_list">
                                    <button type="button" class="btn btn-danger"> Export User List </button></a>
                                    <a href="/export_result_list">
                                    <button type="button" class="btn btn-warning"> Export Result List </button></a> -->

                            <?php if($admin->is_superadmin==1) {?>
                                <a href="/add_user?admin_id=<?=$admin->id?>">
                                    <button type="button" class="btn btn-success pull-right"> Create Users </button></a>
                                    <!--<a href="/users_csv?admin_id=<?=$admin->id?>">
                                        <button type="button" class="btn btn-warning pull-right"> Csv Import User </button></a>
                                        <a href="/users_details_csv?admin_id=<?=$admin->id?>">
                                        <button type="button" class="btn btn-primary pull-right"> Csv Import User Details </button></a>
                                        -->
                                        <?php } else {}?>
                                    </header>

                                     <div class="panel">
                  <div class="panel-content">
                    
                      <div class="btn-group btn-group-justified">
                       <a href="/result_export/1" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-download"></i>
                          <p>Export Result 1</p>
                        </a>
                        <a href="/result_export/2" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-download"></i>
                          <p>Export Result 2</p>
                        </a>
                        <a href="/export_user_list" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-download"></i>
                          <p>Export User List</p>
                        </a>
                        <a href="/export_result_list" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-download"></i>
                          <p>Export Result List </p>
                        </a>
                        <a href="/users_csv?admin_id=<?=$admin->id?>" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-upload"></i>
                          <p>Csv Import User</p>
                        </a>
                        <a href="/users_details_csv?admin_id=<?=$admin->id?>" class="btn btn-primary col-sm-3">
                          <i class="glyphicon glyphicon-upload"></i>
                          <p>Csv Import User Details</p>
                        </a>
                      </div>
                  </div><!--/panel content-->
              </div><!--/panel-->
                                    <div id="collapse4" class="body">
                                        <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Sr.No</th>
                                                    <th>Name</th>
                                                    <th>Reg. Number</th>
                                                    <th>Roll Number</th>
                                                    <th>Mobile</th>
                                                    <th>Result</th>
                                                    <th>Change Status</th>
                                                    <th>Test Completed</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=0; ?>
                                                 <?php if($admins_user!='null') { ?>
                                                <?php foreach ($admins_user as $key => $value) { ?>
                                                    <tr>
                                                        <td><?php echo ++$i ;?></td>
                                                        <td><?php echo $value->name ;?></td>
                                                        <td><?php echo $value->reg_num ;?></td>
                                                        <td><?php echo $value->roll_num ;?></td>
                                                        <td><?php echo $value->mobile ;?></td>
                                                        <td>
                                                            <a href="/view?user_id=<?php echo $value->id?>">
                                                                <button type="button" class="btn btn-primary pull-left">
                                                                    <i class="fa fa-pencil-square" aria-hidden="true"></i> Result </button>
                                                                </a>
                                                        </td>
                                                        
                                                        <td> 
                                                       <i data="<?php echo $value->id;?>" class="status_checks btn

                                                          <?php echo ($value->is_login)?

                                                          'btn-success': 'btn-danger'?>"><?php echo ($value->is_login)? 'Active' : 'Inactive'?>

                                                         </i>
                                                        </td>
                                                        <td><i data="<?php echo $value->id;?>" class="btn

                                                          <?php echo ($value->completed)?

                                                          'btn-success': 'btn-danger'?>"><?php echo ($value->completed)? 'completed' : 'not Completed'?>

                                                         </i></td>
                                                        <td>
                                                            <a href="/edit_user?user_id=<?php echo $value->id?>">
                                                                <button type="button" class="btn btn-primary pull-left">
                                                                    <i class="fa fa-pencil-square" aria-hidden="true"></i> Edit </button>
                                                                </a>
                                                                <form action="<?php echo '/delete_user/'.$value->id ?>" method="POST" class="smart-forms">
                                                                    &nbsp&nbsp<button type ="submit" id="Reco" class="btn btn-danger" style="display:inline"> Delete</button>
                                                                </form>
                                                            </td>
                                                            
                                                        </tr> 
                                                        <?php }?>
                                                         <?php } else {?>
                                                        <td>
                                                            <div class="sparkline bar_week"></div>
                                                            <div class="stat_text">
                                                                <strong>Not Found</strong>
                                                            </div>
                                                        </td>
                                                        <?php }?>
                                                    </tbody>                
                                                </table>
                                                <a  href="dashboard?admin_id=<?=$admin->id;?>">
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
                </script>
               <script type="text/javascript">
                $(document).on('click','.status_checks',function(){
                      var status = ($(this).hasClass("btn-success")) ? '0' : '1';

                      var msg = (status=='0')? 'Deactivate' : 'Activate';
                      if(confirm("Are you sure to "+ msg)){
                        var current_element = $(this);
                        url = "/update_user_status";
                        var id = $(current_element).attr('data');
                        //alert(id);
                        $.ajax({
                          type:"POST",
                          url: "/update_user_status",
                          data: {id:id,status:status},
                          success: function(data)
                          {   //alert(data);
                            alert("status updated");
                            location.reload();
                            
                          }
                        });
                      }      
                    });

                 $('#delete').click(function() {
       
        //where #table could be an input with the name of the table you want to truncate
        var ans = confirm('Do you want to truncate User Answer table?');
        if(ans==true)
        {
             //alert(quiz_id);
               $.ajax({
               type: "GET",
               url: "/truncate_user_answer_tbl",
                //data: 'quiz_id='+ quiz_id,
               cache: false,
               success: function(response) {
                    alert('users and user exam tables dropped successfully');
                },
                error: function(xhr, textStatus, errorThrown) {
                   alert('request failed');
                }
            });

        }

        
    });
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
