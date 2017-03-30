<?php
$quiz_id       =  $data['quiz_id'];
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
   <script type="text/javascript" src="jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
  tinyMCE.init({
    // General options
    mode : "textareas",
    theme : "advanced",
    plugins : "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

    // Theme options
    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks,|,openmanager",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true,
    
    //Open Manager Options
    file_browser_callback: "openmanager",
    open_manager_upload_path: '../../../../uploads/',

    // Example content CSS (should be your site CSS)
    content_css : "css/content.css",

    // Drop lists for link/image/media/template dialogs
    template_external_list_url : "lists/template_list.js",
    external_link_list_url : "lists/link_list.js",
    external_image_list_url : "lists/image_list.js",
    media_external_list_url : "lists/media_list.js",

    // Style formats
    style_formats : [
      {title : 'Bold text', inline : 'b'},
      {title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
      {title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
      {title : 'Example 1', inline : 'span', classes : 'example1'},
      {title : 'Example 2', inline : 'span', classes : 'example2'},
      {title : 'Table styles'},
      {title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
    ],

    // Replace values for the template plugin
    template_replace_values : {
      username : "Some User",
      staffid : "991234"
    }
  });
</script>
<!-- /TinyMCE -->
<!-- Gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
    
    <!-- Some integration calls -->
   <!--  <a href="javascript:;" onclick="tinyMCE.get('elm1').show();return false;">[Show]</a>
    <a href="javascript:;" onclick="tinyMCE.get('elm1').hide();return false;">[Hide]</a>
    <a href="javascript:;" onclick="tinyMCE.get('elm1').execCommand('Bold');return false;">[Bold]</a>
    <a href="javascript:;" onclick="alert(tinyMCE.get('elm1').getContent());return false;">[Get contents]</a>
    <a href="javascript:;" onclick="alert(tinyMCE.get('elm1').selection.getContent());return false;">[Get selected HTML]</a>
    <a href="javascript:;" onclick="alert(tinyMCE.get('elm1').selection.getContent({format : 'text'}));return false;">[Get selected text]</a>
    <a href="javascript:;" onclick="alert(tinyMCE.get('elm1').selection.getNode().nodeName);return false;">[Get selected element]</a>
    <a href="javascript:;" onclick="tinyMCE.execCommand('mceInsertContent',false,'<b>Hello world!!</b>');return false;">[Insert HTML]</a>
    <a href="javascript:;" onclick="tinyMCE.execCommand('mceReplaceContent',false,'<b>{$selection}</b>');return false;">[Replace selection]</a> -->

    <!-- <br />
    <input type="submit" name="save" value="Submit" />
    <input type="reset" name="reset" value="Reset" /> -->
  </div>
</form>

<script type="text/javascript">
if (document.location.protocol == 'file:') {
  alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>
</body>
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
      Questions
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
                    <<!-- li><a href=""><?=$admin->name?></a></li>
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
              <h5>Add Questions</h5>
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
              <form class="smart-forms" action="/post_question?quiz_id=<?php echo $quiz_id?>" method="POST" id="add_question">

              <div class="form-group">
                  <label class="control-label col-lg-4"> Passage:</label>
                  <div class="col-lg-8">
                    <textarea id="e_paggage" class="gui-input" name="passage" placeholder="English Passage"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">hindi Passage:</label>
                  <div class="col-lg-8">
                    <textarea id="h_paggage" class="gui-input" name="h_passage" placeholder="Hindi Passage"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Questions:</label>
                  <div class="col-lg-8">
                    <textarea id="editor" class="gui-input" name="question" placeholder=" English Questions"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4">hindi Questions:</label>
                  <div class="col-lg-8">
                    <textarea id="editor_h" class="gui-input" name="h_question" placeholder="Hindi Questions"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Option1:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="1" name="answer" selected="selected" >
                    <br>
                    <textarea id="optionEng" class="gui-input" name="A" class="form-control col-lg-6" placeholder="English Option 1"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Option2:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="2" name="answer" selected="selected" >
                    <br>
                    <textarea id="optionEng2" class="gui-input" name="B" class="form-control col-lg-6" placeholder="English Option 2"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Option3:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="3" name="answer" selected="selected" >
                    <br>
                    <textarea id="optionEng3" class="gui-input" name="C" class="form-control col-lg-6" placeholder="English Option 3"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Option4:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="4" name="answer" selected="selected" >
                    <br>
                    <textarea id="optionEng4" class="gui-input" name="D" class="form-control col-lg-6" placeholder="English Option 4"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Hindi Option1:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="4" name="h_answer" selected="selected" >
                    <br>
                    <textarea id="optionEng_4" class="gui-input" name="h_A" class="form-control col-lg-6" placeholder="Hindi Option 1"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Hindi Option2:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="4" name="h_answer" selected="selected" >
                    <br>
                    <textarea id="optionEng_3" class="gui-input" name="h_B" class="form-control col-lg-6" placeholder="Hindi Option 2"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Hindi Option3:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="4" name="h_answer" selected="selected" >
                    <br>
                    <textarea id="optionEng_2" class="gui-input" name="h_C" class="form-control col-lg-6" placeholder="Hindi Option 3"></textarea>
                  </div>
                  <br>
                </div>
                <div class="form-group">
                  <label class="control-label col-lg-4"> Hindi Option4:</label>
                  <div class="col-lg-8">
                    <input type="radio" id="radiobtn" value="4" name="h_answer" selected="selected" >
                    <br>
                    <textarea id="optionEng_1" class="gui-input" name="h_D" class="form-control col-lg-6" placeholder="Hindi Option 4"></textarea>
                  </div>
                  <br>
                </div>
                
                &nbsp;<div class="form-actions col-lg-8 col-lg-offset-4">
                  <input type="submit" value="Submit" class="btn btn-primary">
                  <br>
                </div>
              </form>
            </div>
            <a  href="/question_manager?quiz_id=<?=$quiz_id;?>">
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
//   (function($,W,D)
//   {
//     var JQUERY4U = {};
//     JQUERY4U.UTIL =
//     {
//       setupFormValidation: function()
//       {
// //form validation rules
// $("#add_question").validate({
//   rules: {
//     question: {
//       required: true
//     },
//     option1 : {
//       required:true
//     },
//     option2 : {
//       required:true
//     },
//     option3 :{
//      required :true
//    },
//     option4 : {
//       required:true,
//     },
//     answer :{
//       required:true,
//     },
//   },
//   submitHandler: function(form) {
//     form.submit();
//   }
// });
// }
// }
// //when the dom has loaded setup form validation rules
// $(D).ready(function($) {
//   JQUERY4U.UTIL.setupFormValidation();
// });
// })(jQuery, window, document);
</script>