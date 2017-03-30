<?php
require_once '../app/init.php';
header("Access-Control-Allow-Origin:".DOMAIN_URL);
ini_set('display_errors', 1);
$route=new Route;
$route->get('/','AdminAuth@getAdminLogin');
$route->get('/admin','AdminAuth@getAdminLogin');
$route->post('/adminlogin','AdminAuth@postAdminLogin');
// ************* start  routes for  user ************************************//
$route->get('/dashboard','AdminController@dashboard');
$route->get('/admindashboard','AdminController@adminHome');
$route->get('/users','AdminController@get_user');
$route->get('/add_user','AdminController@add_user');
$route->post('/post_user','AdminController@post_user');
$route->get('/edit_user','AdminController@edit_user');
$route->post('/update_user','AdminController@update_user');
$route->post('/delete_user/:id','AdminController@delete_user');
$route->get('/users_details_csv','AdminController@users_details_csv');
$route->post('/post_user_detail_csv','AdminController@post_user_detail_csv');
$route->get('/export_result_list','AdminController@export_result_list');
$route->get('/users_csv','AdminController@users_csv');
$route->post('/post_user_csv','AdminController@post_user_csv');
$route->post('/update_user_status','AdminController@update_user_status11');

// ************* end routes for all user ************************************//

// ************* start routes for all admin *********************************//
$route->get('/create_admin_user','AdminController@create_admin_user');
$route->post('/post_admin','AdminController@postAdmin');
$route->get('/edit_admin','AdminController@editAdmin');
$route->post('/update_admin/:id','AdminController@updateAdmin');
$route->post('/delete_admin/:id','AdminController@deleteAdmin');
// ************* end routes for all admin ************************************//

// ************* start routes for all authority ******************************//
$route->get('/authority','AdminController@authorityList');
$route->get('/add_authority','AdminController@addAuthority');
$route->post('/post_authority','AdminController@postAuthority');
$route->get('/edit_authority','AdminController@editAuthority');
$route->post('/update_authority','AdminController@updateAuthority');
$route->post('/delete_authority','AdminController@deleteAuthority');
// ************* ends routes for all authority ******************************//

// ************* ends routes for all examination ******************************//
$route->get('/examination','AdminController@examinationList');
$route->get('/add_examination','AdminController@addExamination');
$route->post('/post_examination','AdminController@postExamination');
$route->get('/edit_examination','AdminController@editExamination');
$route->post('/update_examination','AdminController@updateExamination');
$route->post('/delete_examination','AdminController@deleteExamination');
// ************* ends routes for all examination ******************************//

// ************* start routes for all Quiz ******************************//
$route->get('/quiz','AdminController@getQuiz');
$route->get('/add_quiz','AdminController@addQuiz');
$route->post('/post_quiz','AdminController@postQuiz');
$route->get('/edit_quiz','AdminController@editQuiz');
$route->post('/update_quiz','AdminController@updateQuiz');
$route->post('/delete_quiz','AdminController@deleteQuiz');
$route->get('/user_list','AdminController@get_user_list');
$route->get('/quiz_logs','AdminController@get_quiz_logs');
$route->get('/quiz_details','AdminController@get_quiz_details');
$route->get('/quiz_user_log','AdminController@get_quiz_user_log');
$route->get('/user_details','AdminController@get_user_details');
$route->get('/import_user_exam','AdminController@get_user_exam');
$route->post('/post_exam_user_csv','AdminController@post_exam_user_csv');

$route->get('/exam_instructions','AdminController@get_exam_instructions');
$route->get('/add_instructions','AdminController@add_exam_instructions');
$route->post('/post_instruction','AdminController@post_exam_instructions');
$route->get('/edit_instructions','AdminController@edit_exam_instructions');
$route->post('/update_instruction','AdminController@update_exam_instructions');
$route->post('/delete_instructions','AdminController@delete_exam_instructions');
$route->get('/import_instructions','AdminController@import_exam_instructions');
$route->post('/post_exam_instruction_csv','AdminController@post_exam_instruction_csv');
$route->get('/demo_instruction_csv','AdminController@demo_instruction_csv');
 $route->get('/demo_answer_csv','AdminController@demo_answer_key_csv');

// ************* ends routes for all quiz ******************************//

// ************* start routes for all question ******************************//
$route->get('/question_manager','AdminController@getQuestion_manager');
$route->get('/add_question','AdminController@addQuestion');
$route->post('/post_question','AdminController@postQuestion');
$route->get('/edit_question','AdminController@editQuestion');
$route->post('/update_question','AdminController@updateQuestion');
$route->post('/delete_question','AdminController@deleteQuestion');
$route->get('/upload_csv','AdminController@upload_csv');
$route->post('/post_csv','AdminController@post_csv');
$route->get('/question_export','AdminController@question_export');
$route->get('/update_answer_key','AdminController@updateAnswerKey');
$route->post('/post_answer_key','AdminController@postAnswerKey');
$route->get('/user_log','AdminController@get_user_log');
$route->get('/user_log_details','AdminController@get_user_log_details');
$route->get('/question_details','AdminController@get_question_details');

// ************* ends routes for all question ******************************//

// ************* start routes for showing all questions ******************************//
$route->get('/questions','AdminController@Question_bank');
$route->get('/logout','AdminController@getLogout');
$route->get('/result','AdminController@getResult');
// $route->post('/delete_result','AdminController@delete_result');
//$route->post('/exportExl','AdminController@exportExl');
$route->get('/view','AdminController@getView');
$route->get('/view_result','AdminController@getViewResult');
$route->get('/result_export/:id','AdminController@result_export');
$route->get('/export_user_list','AdminController@export_user_list');

// demo export csv files
$route->get('/demo_user_csv','AdminController@demo_user_csv');
$route->get('/demo_question_csv','AdminController@demo_question_csv');
$route->get('/result_details','AdminController@user_result_details');
$route->get('/view_result_details','AdminController@view_result_details');
$route->get('/export_result_details','AdminController@export_result_details');
// ************************center allocation****************************** //
$route->get('/centers','AdminController@get_center_list');
$route->post('/update_quiz_center','AdminController@update_center_list');
$route->post('/allocate_center_to_users','AdminController@allocate_center_to_users');
$route->post('/un_allocate_center_to_users','AdminController@un_allocate_center_to_users');
$route->get('/add_center','AdminController@add_center');
$route->post('/post_center','AdminController@post_center');
$route->get('/edit_center','AdminController@edit_center');
$route->post('/update_center','AdminController@update_center');
$route->post('/delete_center','AdminController@delete_center');
$route->get('/center_user','AdminController@center_user');
$route->get('/labs','AdminController@center_labes');
$route->get('/alloted_users','AdminController@alloted_users');
$route->get('/truncate_users_tbl','AdminController@truncate_users_tbl');
$route->get('/truncate_user_answer_tbl','AdminController@truncate_user_answer_tbl');
$route->get('/add_labs','AdminController@add_labs');
$route->post('/post_labs','AdminController@post_labs');
$route->get('/lab_users','AdminController@lab_users');
$route->get('/un_alloted_lab_users','AdminController@un_alloted_lab_users');
$route->get('/edit_labs','AdminController@edit_labs');
$route->post('/update_lab','AdminController@update_lab');


// ************* ends routes for showing all questions ******************************//

$route->run();
?>