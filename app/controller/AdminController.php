<?php 
/**
* 
*/
class AdminController
{
	public function __construct(){
		if (!isset($_SESSION['user'])) {
			header('location:/admin');
			die;
		}
	}
	
	// ******************************** Start Function For Admin Dashboard ******************************//
    public function dashboard()
    {
    	$admin=Admins::auth();
		return View::make('admin_panel/public/dashboard',['admin'=>$admin]);
	}
    public function adminHome()
    {
		$admin 		   = Admins::auth();
		if($admins_user=Admins::admin_management())
		{
			return View::make('admin_panel/public/adminhome',['admins_user' => $admins_user,'admin'=>$admin]);
		}
	}
	// ***************************** Start functions for logout **************************************//
    public function getLogout()
    {
        $smin_logout 	= Admins::logout();
        header('location:/');
    }
    // ******************************* End functions for logout *************************************//

    // ******************************* End functions for Admin Dashboard ***************************//

	// ********************************** Start functions For  Users ******************************//
	
	public function get_user() // method showing all user list
	{
		$admin 			= Admins::auth();
		if($users=Admins::get_users_list())
		{
			return View::make('admin_panel/public/user/users',['users' => $users,'admin' => $admin]);
		}
	}
	public function add_user() //method showing create user  
	{
		$admin_id 	 =	Input::get('admin_id');
		$admin 		 = 	Admins::auth();
		$get_quiz 	 =  Admins::get_quiz_list($admin_id);
		return View::make('admin_panel/public/user/create_user',['admin' => $admin,'admin_id'=>$admin_id,'get_quiz' => $get_quiz]);
	}
	public function post_user() //method used for post the users
	{
		$admin_id 		=	Input::get('admin_id');
		$details 		= 	Input::post(['name','roll_num','roll_code','reference_id','password','confirm-password','mobile','email','language','quiz_id']);
		if($users=Admins::add_post_user($details,$admin_id))
		{
			header('location:/users?admin_id='.$admin_id);
		}
	}
	public function edit_user() //method showing edit user
	{
		$user_id 		=	Input::get('user_id');
		$admin 			= 	Admins::auth();
		if($users=Admins::get_single_user($user_id))
		{
			return View::make('admin_panel/public/user/edit_user',['admin' => $admin,'users' => $users ]);
		}
	}
	public function update_user() //method used for update the user
	{
		$user_edit_id 	=	Input::get('user_edit_id');
		$details 		= 	Input::post(['name','roll_num','roll_code','reference_id','password','confirm-password','mobile','email','profile_pic','profile','sig_pic','sign','language']);
		if($users=Admins::updatesingle_user($details,$user_edit_id))
		{
			header('location:/users');
		}
	}

	public function upload_user_profile() //method used for upload the user profile picture
	{
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/user/upload_user_profile',['admin'=>$admin,'admin_id'=>$admin_id]);
	}

	public function post_user_profile() //method used for update the user
	{
		$admin_id 		=	Input::get('admin_id');
		$details 		= 	Input::post(['profile_pic']);
		//echo '<pre>'; print_r($details);die;
		$count1=Admins::upload_user_profile_pic($details);
		//echo $count1; die;
		if($count1==1)
		{
			header('location:/users');
		}
	}
	public function upload_user_sign() //method used for upload the user profile picture
	{
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/user/upload_user_sign',['admin'=>$admin,'admin_id'=>$admin_id]);
	}
	public function post_user_sign() //method used for update the user
	{
		$admin_id 		=	Input::get('admin_id');
		$details 		= 	Input::post(['sign']);
		//echo '<pre>'; print_r($details);die;
		$count=Admins::upload_user_sign_pic($details);
		//echo $count; die;
		if($count==1)
		{
			header('location:/users');
		}
	}
	public function delete_user($id) // method used for delete the user
	{
		if($users=Admins::delete_user($id))
		{
			header('location:/users');
		}
	}
	public function get_user_detail() //method used for showing user details
    {
    	$admin 			= 	Admins::auth();
    	$user_id  		= 	Input::get('user_id');
    	if($user_details=Admins::get_user_detail($user_id)){
          return View::make('admin_panel/public/quiz/user_details1',['admin'=>$admin,'user_details'=>$user_details]);
    	}
    }
	public function users_csv() //method showing user csv page 
	{
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/user/csv_user',['admin' => $admin,'admin_id' =>$admin_id]);
	}
	public function post_user_csv() //method used for import the user csv
	{    
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		if($users=Admins::post_users_csv($admin_id)){
			header('location:/users');
		}
	}
	 public function export_user_list() //method used for export user list 
    {
    	$export 	=	 Admins::exportUserList();
       	return 'Result Exported Successfully';
	}
// ********************************** Ends functions For  Users ****************************//

// ***************** start functions for upload the front end users using csv file ********//
	public function users_details_csv() //method showing user details csv page
	{
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/user/user_details_csv',['admin' => $admin,'admin_id' =>$admin_id]);
	}
	public function post_user_detail_csv() //method used for post the user details csv
	{    
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		if($users=Admins::post_users_csv_details($admin_id)){
			header('location:/users');
		}
	}
// ************** start functions for upload the front end users using csv file **********//

// ************************ start functions  Admins *************************************//
	public function create_admin_user() //method showing the add admin page
	{
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/admin/create_admin',['admin' => $admin]);
	}
	public function postAdmin() //method used for post the admin
	{
		$details 		= 	Input::post(['name','email','mobile','password']);
		if($admins=Admins::add_admins($details))
		{
			header('location:/admindashboard');
		}
	}
	public function editAdmin() //method showing the edit admin page
	{
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		if($admin_list=Admins::get_single_admin($admin_id))
		{
			return View::make('admin_panel/public/admin/edit_admin',['admin' => $admin,'admin_list' => $admin_list ]);
		}
	}
	public function updateAdmin($id) //method used for updating the admins
	{
		$details 		= 	Input::post(['name','mobile','email','password']);
		if($admin=Admins::updatesingle_admin($details,$id))
		{
			header('location:/admindashboard');
		}
	}
	public function deleteAdmin($id) //method used for delete the admin
	{
		if($admin=Admins::delete_admin($id))
		{
			header('location:/admindashboard');
		}
	}
// ************************ Ends all functions for admins *****************************//
  
// ************* start functions for showing all methods authority *******************//
	public function authorityList() //method showing all authority list
	{
		$examinations 	= array();
		$admin 			= Admins::auth();
		$admin_id 		= Input::get('admin_id');
		if($authorities=Authorities::authority_list($admin_id))
		{
			return View::make('admin_panel/public/authority',['admin'=>$admin,'authorities' => $authorities,'admins' => $admin,'examinations' => $examinations ]);
		}
	}
	public function addAuthority() //method showing add authority page
	{
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/authority/create_authority',['admin'=>$admin]);	
	}
	public function postAuthority() //method used for post the authority
	{
		$details 		= 	Input::post(['name','admin_id']);
		$admin_id 		=	Input::get('admin_id');
		if($authority=Authorities::add_authority($details,$admin_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
	public function editAuthority() //method showing edit authority page
	{
		$admin 			=   Admins::auth();
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		if($authority=Authorities::get_single_authority($authority_id))
		{
			return View::make('admin_panel/public/authority/edit_authority',['admin'=>$admin,'authority' => $authority ]);
		}
	}
	public function updateAuthority() //method used for updating the authority
	{
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		$details=Input::post(['name']);
		if($authority=Authorities::updatesingle_authority($details,$authority_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
	public function deleteAuthority() //method used for deleting the authority
	{
		$admin 			=   Admins::auth();
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		if($authority=Authorities::delete_authority($authority_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
// ****************** End All functions for Authority ********************************//

// ************** Start functions for showing all methods of examinations ***********//
	public function examinationList()
	{
		$authority_id 	=	Input::get('authority_id');
		$admin 			=   Admins::auth();
		if($examinations=Examinations::examination_list($authority_id))
		{
			return View::make('admin_panel/public/examination/examination',['examinations' => $examinations,'authority_id' => $authority_id,'admin'=>$admin ]);
		}
	}
// ************* end functions for showing all examinations **********************//
	public function addExamination() //method showing add examination page
	{
		$admin 			=   Admins::auth();
		$authority_id 	=	Input::get('authority_id');
		return View::make('admin_panel/public/examination/create_examination',['authority_id' => $authority_id,'admin'=>$admin ]);	
	}
	public function postExamination() //method used for post the examinations
	{
		$authority_id 	=	Input::get('authority_id');
		$details 		= 	Input::post(['examination_name','examination_desc']);

		if($examination=Examinations::add_examination($details,$authority_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
	public function editExamination() //method showing edit examination page
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		$authority_id 	=	Input::get('authority_id');
		if($examinations=Examinations::get_single_examination($exam_id))
		{
			return View::make('/admin_panel/public/examination/edit_examination',['examinations' => $examinations,'authority_id'=> $authority_id,'admin'=>$admin ]);
		}
	}
	public function updateExamination() //method used for updating the examination
	{
		$authority_id 	=	Input::get('authority_id');
		$exam_id 		=	Input::get('exam_id');
		$details 		= 	Input::post(['examination_name','examination_desc']);
		if($examinations=Examinations::updatesingle_examination($details,$exam_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
	public function deleteExamination() //method used for delete the examination
	{
		$authority_id 	=	Input::get('authority_id');
		$exam_id 		=	Input::get('exam_id');
		if($examination=Examinations::delete_examination($exam_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
// **************** End all functions for examination **********************//

// ************* Start All functions for quiz(exam) ***********************//
	public function getQuiz() //method showing all quiz(exam) list
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		$authority_id   =   Examinations::getAuthorityID($exam_id);
		if($quizzes=Quizzes::quiz_list($exam_id))
		{
			return View::make('admin_panel/public/quiz/quiz',['quizzes' =>$quizzes,'exam_id' =>$exam_id,'admin' =>$admin,'authority_id'=>$authority_id]);
		}
	}
	public function addQuiz() //method showing add quiz(exam) page
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		return View::make('admin_panel/public/quiz/create_quiz',['exam_id' =>$exam_id,'admin' =>$admin ]);	
	}
	public function postQuiz() //method used for post the quiz(exam)
	{
		$exam_id 		=	Input::get('exam_id');
		$details 		= 	Input::post(['name','title','logo','time_duration','total_ques']);
		if($quiz=Quizzes::add_quiz($exam_id,$details))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	public function editQuiz() //method showing edit quiz(exam) page
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quizzes=Quizzes::get_single_quiz($quiz_id))
		{
			return View::make('admin_panel/public/quiz/edit_quiz',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'exam_id'=>$exam_id,'admin' =>$admin ]);
		}
	}
	public function updateQuiz() //method used for updating the quiz(exam)
	{
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		$details 		= 	Input::post(['name','title','logo','logo1','time_duration','total_ques']);
		if($quizzes=Quizzes::updatesingle_quiz($details,$quiz_id))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	public function deleteQuiz() //method used for delete the quiz(exam)
	{
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quiz=Quizzes::delete_quiz($quiz_id))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	public function get_quiz_logs() //method used for showing quiz(exam) log
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quizzes=Quizzes::get_single_quiz($quiz_id))
		{
			return View::make('admin_panel/public/quiz/quiz_logs',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'exam_id'=>$exam_id,'admin' =>$admin ]);
		}
	}
    public function get_quiz_details() //method used for showing quiz(exam) details
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		if($quizzes=Quizzes::get_single_quiz1($quiz_id))
		{
			return View::make('admin_panel/public/quiz/quiz_details',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'admin' =>$admin ]);
		}
	}
	public function get_user_exam() //method used for showing quiz(exam) users import page
	{
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Questions::getExamID($quiz_id);
		$admin 			= 	Admins::auth();
		return View::make('admin_panel/public/quiz/import_user_exam',['exam_id'=>$exam_id,'admin' => $admin,'quiz_id' =>$quiz_id]);
	}
	public function post_exam_user_csv() //method used for post quiz(exam) users
	{    
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			= 	Admins::auth();
		if($users=Quizzes::post_exam_users_csv($quiz_id)){
			header('location:/user_list?quiz_id='.$quiz_id);
		}
	}
// ************* Ends All functions for Quiz(Exam) *************************//

// ************* start functions for getting question**********************//
	public function getQuestion_manager() //method showing all questions list
	{   $quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		$exam_id 		=	Questions::getExamID($quiz_id);

		if($questions=Questions::question_list($quiz_id))
		{
			return View::make('admin_panel/public/question/question_manager',['quiz_id' =>$quiz_id,'questions'=>$questions,'admin'=>$admin,'exam_id' => $exam_id]);	
		}
	}
	public function addQuestion() //method showing add question page
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		return View::make('admin_panel/public/question/create_question',['quiz_id' =>$quiz_id,'admin' =>$admin ]);	
	}
	public function postQuestion() //method used for post question 
	{
		$quiz_id 		=	Input::get('quiz_id');
		$details 		= 	Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
		if($question=Questions::add_question($quiz_id,$details))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);
		}
	}
	public function editQuestion() //method used for edit question page
	{
		$admin 				=   Admins::auth();
		$question_id 		=	Input::get('question_id');
		$quiz_id 			=	Input::get('quiz_id');
		if($questions=Questions::get_single_ques($question_id))
		{
			return View::make('admin_panel/public/question/edit_question',['questions' => $questions,'quiz_id' => $quiz_id,'question_id' => $question_id,'admin' =>$admin ]);
		}
	}
	public function updateQuestion() //method used for updating the questions
	{
		$quiz_id 				=	Input::get('quiz_id');
		if($quiz_id=='')
		{
			$question_id 		=	Input::get('question_id');
			$details 			= 	Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
			if($question=Questions::updatesingle_question($question_id,$details))
			{
				header('location:/questions');
			}	
		}
		else
		{
			$question_id 		=	Input::get('question_id');
			$details 			= 	Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
			if($question=Questions::updatesingle_question($question_id,$details))
			{
				header('location:/question_manager?quiz_id='.$quiz_id);
			}
		}	
	} 
	public function deleteQuestion() //method used for delete the questions
	{
		$question_id 		=	Input::get('question_id');
		$quiz_id 			=	Input::get('quiz_id');
		if($quiz_id=='')
		{
          	if($questions=Questions::delete_question($question_id))
			{
				header('location:/questions');
			}
		}
		else
		{
			if($questions=Questions::delete_question($question_id))
			{
				header('location:/question_manager?quiz_id='.$quiz_id);
			}
		}
	}
    public function get_question_details() //method showing questions details
	{
       $admin 				= 	Admins::auth();
       $question_id 		=	Input::get('question_id');
       if($questions=Questions::get_single_ques($question_id))
		{
			return View::make('admin_panel/public/question/question_detail',['questions' => $questions,'admin' =>$admin ]);
		}  
	}
	public function upload_csv() // method showing the question csv import page
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/question/question_csv',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	public function post_csv() //method used for posting the question csv
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($questions=Questions::post_csv_file1($quiz_id))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);	
		}
	}
	public function updateAnswerKey() //method showing the update answer key page 
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/question/update_answer_key',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	public function postAnswerKey() //method used for post the answer key 
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($questions=Questions::post_update_answer_key($quiz_id))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);	
		}
	}
	public function question_export() //method used for export question
	{
			$quiz_id 		=	Input::get('quiz_id');
    		$export 		=	Questions::exportToExl_2($quiz_id);
       		return 'Result Exported Successfully';
    }
// ******************* Ends All Functions Of Questions ********************* //

// **************** Start All Functions Of User Logs ********************** //
    public function get_user_log() //method showing user log for the questions
    {
    	$admin 				= 	Admins::auth();
    	$question_id  		=   Input::get('question_id');
    	if($user_logs=Userlogs::get_user_log_by_qid($question_id)){
          return View::make('admin_panel/public/question/user_log',['admin'=>$admin,'user_logs'=>$user_logs]);
    	}
    }
    public function get_user_list() //method showing user list 
    {
    	$admin 			= 	Admins::auth();
    	$quiz_id  		= 	Input::get('quiz_id');
    	$exam_id 		=	Questions::getExamID($quiz_id);
    	if($user_list=Userlogs::get_user_list_quizid($quiz_id)){
          return View::make('admin_panel/public/question/user_log_list',['admin'=>$admin,'quiz_id'=>$quiz_id,'user_list'=>$user_list,'exam_id'=>$exam_id]);
    	}
    }

        public function failure_users() //method showing user list 
    {
    	$admin 			= 	Admins::auth();
    	$details  		= 	Input::get(array('quiz_id','is_failure'));
    	if($user_failure_list=Quizzes::get_user_failure_list_quizid($details)){
          return View::make('admin_panel/public/quiz/failure_users',['admin'=>$admin,'quiz_id'=>$details['quiz_id'],'user_failure_list'=>$user_failure_list]);
    	}
    }


    public function get_user_log_details() //method used for showing the user log details
    {
    	$admin 			= 	Admins::auth();
    	$user_id  		= 	Input::get('user_id');
    	$quiz_id  		= 	Input::get('quiz_id');
    	if($user_list_details=Userlogs::get_user_detail_list($user_id)){
          return View::make('admin_panel/public/question/user_log_detail',['quiz_id'=>$quiz_id,'admin'=>$admin,'user_list_details'=>$user_list_details]);
    	}
    }
    public function get_quiz_user_log() //method used for showing the quiz(exam) user log
    {
    	$admin 			= 	Admins::auth();
    	$user_id  		= 	Input::get('user_id');
    	if($quiz_user_log=Userlogs::get_quiz_user_log($user_id)){
          return View::make('admin_panel/public/quiz/quiz_user_log',['admin'=>$admin,'quiz_user_log'=>$quiz_user_log]);
    	}
    }
    public function get_user_details() //method used for showing user details
    {
    	$admin 			= 	Admins::auth();
    	$user_id  		= 	Input::get('user_id');
    	if($user_details=Userlogs::get_user_detail($user_id)){
          return View::make('admin_panel/public/quiz/user_details',['admin'=>$admin,'user_details'=>$user_details]);
    	}
    }
    public function update_user_status11() //method used for update user status
    {
    	$admin 			= 	Admins::auth();
    	$details 		= 	Input::post(['id','status']);
    	if($status_details=Userlogs::update_user_status($details))
    	{
    		echo '<script>alert("status updated");</script>';
    	}
    }
// ************* end functions for User Logs ******************************//

// ************* start functions for question bank **********************//
    public function Question_bank() //method showing all question list 
    {
    	$admin 			=   Admins::auth();	
		if($questions=Questions::questionBank_list())
		{	
			return View::make('admin_panel/public/question_bank',['questions' => $questions,'admins' => $admin]);
		}
    } 
// ************* end functions for question bank *********************//

// ***************** Start Function For Results *********************//
    public function getResult() //method showing result list of user
    {
    	$admin 			=   Admins::auth();
       	if($results=Results::result_list())
		{	
			return View::make('admin_panel/public/result',['results' => $results,'admins' => $admin]);
		}
    }
     public function exportExl() //method used for export result
    {
    	$details 	= 	 Input::post(['ExportType']);
    	$export 	=	 Results::exportToExl($details);
       	return View::make('admin_panel/public/result');
    }
    public function getView() //method showing all user results
    {
    	$user_id 		=	Input::get('user_id');
    	$admin 			=   Admins::auth();	
    	if($user=Results::view_result($user_id))
    	{
            return View::make('admin_panel/public/view',['admins'=>$admin,'user'=>$user,'user_id'=>$user_id]);
    	}    
    }
    public function getViewResult() //method showing single user result 
    {
    	$user_id 		=	Input::get('user_id');
    	$admin 			=   Admins::auth();	
    	if($user=Results::view_result($user_id))
    	{
            return View::make('admin_panel/public/view_result',['admins'=>$admin,'user'=>$user,'user_id'=>$user_id]);
    	}    
    }
    public function export_result_list() //method used for export result list
	{    
		$admin_id 		=	Input::get('admin_id');
		$admin 			= 	Admins::auth();
		if($results=Results::post_result_list_csv($admin_id)){
			header('location:/users');
		}
	}
    public function result_export($id) //method used for export result
    {
    	$export 	=	 Results::exportToExl_2($id);
       	return 'Result Exported Successfully';
	}
	public function user_result_details() //method used for showing user result details
    {
    	$user_id 		=	Input::get('user_id');
    	 $admin 		=   Admins::auth();	
    	 if($results=Results::user_details_list($user_id))
    	 {
			return View::make('admin_panel/public/user/result_detail',['results'=>$results,'admin'=>$admin,'user_id'=>$user_id]);
    	 }
    }
    public function view_result_details() //method used for showing result details for the user
    {
    	$user_id 		=	Input::get('user_id');
    	$admin 			=   Admins::auth();	
    	if($results=Results::user_details_list($user_id))
    	{
			return View::make('admin_panel/public/user/view_result_detail',['results'=>$results,'admin'=>$admin,'user_id'=>$user_id]);
    	}
    }
    public function export_result_details() //method used for export result list
    {
    	$user_id 	=	 Input::get('user_id');
    	$export 	=	 Results::exportResultList($user_id);
       	return 'Result Exported Successfully';
	}
// **************** End Functions For Results********************************//

//***************** Start Fuction For Export the demo Csv*******************//
    public function demo_user_csv() //method for  export user csv demo
    {
    	$export 	=	 Admins::demoUserCsv();
       	return 'Result Exported Successfully';
	}

    public function demo_question_csv() //method for export questions csv demo
    {
    	$export 	=	 Admins::demoQuestionCsv();
       	return 'Result Exported Successfully';
	}

    public function demo_answer_csv() //method for export answer csv demo
    {
    	$export 	=	 Admins::demoAnswerCsv();
       	return 'Result Exported Successfully';
	}
	public function demo_instruction_csv() //method for export instruction demo
	{
    	$export 	=	 Instructions::demoInstructionCsv();
       	return 'Result Exported Successfully';
	}
   	public function demo_answer_key_csv() //method for export answer key demo
   	{
    	$export 	=	 Questions::demoAnswerKeyCsv();
       	return 'Result Exported Successfully';
   	}
// ************** Ends Functions For Demo Csv ***************************//

// ************** Starts All Functions For Centers *********************//
    public function get_center_list() //method used for showing center list
    {
    	$quiz_id    	= 	Input::get('quiz_id');
    	$admin      	= 	Admins:: auth();
    	$exam_id 		=	Questions::getExamID($quiz_id);
    	if($centers 	= 	Centers::get_center())
    	{
    		return View::make('admin_panel/public/quiz/center',['exam_id'=>$exam_id,'admins'=>$admin,'centers'=>$centers,'quiz_id'=>$quiz_id]);

    	}

    }
     public function add_center() //method showing add center page
    {
    	$admin 					= 	Admins:: auth();
    	$quiz_id  				= 	Input::get('quiz_id');
    	return View::make('admin_panel/public/quiz/create_center',['quiz_id' =>$quiz_id,'admin' =>$admin ]);
    }
    public function post_center() //method used for post center
    {
    	$details 				= 	Input::post(['name','code','capacity']);
    	$admin 					= 	Admins:: auth();
    	$quiz_id  				= 	Input::get('quiz_id');
    	if($centers=Centers::add_center($details))
    	{
    		header('location:/centers?quiz_id='.$quiz_id);	
    	}
   }
    public function edit_center() //method showing edit center page
    {
    	$admin 			=	Admins:: auth();
    	$quiz_id  		= 	Input::get('quiz_id');
    	$center_id 		=	Input::get('center_id');
    	if($centers=Centers::get_center_list($center_id))
		{
			return View::make('admin_panel/public/quiz/edit_center',['centers' =>$centers,'quiz_id' =>$quiz_id,'admin' =>$admin,'center_id'=>$center_id]);
		}
    	
    }
    public function update_center() //method used for update center
    {
        $quiz_id 			=	Input::get('quiz_id');
		$center_id 			=	Input::get('center_id');
		$details 			=	Input::post(['name','code','capacity']);
		$details['quiz_id'] = 	$quiz_id;
		if($centers=Centers::updatesingle_center($details,$center_id))
		{
			header('location:/centers?quiz_id='.$quiz_id);
		}
    }
    public function delete_center() //method used for delete center
    {
       $center_id 		=	Input::get('center_id');
		$quiz_id 		=	Input::get('quiz_id');
		if($centers=Centers::delete_center($center_id))
		{
			header('location:/centers?quiz_id='.$quiz_id);
		}	
    }
    public function update_center_list() //method used for update center list
    {
    	$admin      		= 	Admins:: auth();
    	$quiz_id    		= 	Input::get('quiz_id');
		$details 			= 	Input::post(['centers']);
    	$details['quiz_id'] =	$quiz_id;
    	if($allocated_centers =Centers::post_center($details))
    	{
    		header('location:/centers?quiz_id='.$quiz_id);
    	}
    }
    public function allocate_center_to_users() //method used for allocate center to users
    {
    	$admin      			= 	Admins:: auth();
    	$center_id    			= 	Input::get('center_id');
    	$quiz_id    			= 	Input::get('quiz_id');
		$details 				= 	Input::post(['users']);
    	$details['center_id'] 	= 	$center_id;
    	$details['quiz_id'] 	= 	$quiz_id;
    	if($allocated_centers   =   Centers::post_center_to_users($details))
    	{
    		header('location:/center_user?center_id='.$center_id.'&quiz_id='.$quiz_id);
    	}
    }
    public function un_allocate_center_to_users() //method used to un-allocate center to users
    {
    	$admin      			= 	Admins:: auth();
    	$center_id    			= 	Input::get('center_id');
    	$quiz_id    	        = 	Input::get('quiz_id');
		$details 				= 	Input::post(['users']);
    	$details['center_id'] 	= 	$center_id;
    	$details['quiz_id'] 	= 	$quiz_id;
    	if($allocated_centers 	=	Centers::un_post_center_to_users($details))
    	{
    		header('location:/alloted_users?center_code='.$center_id.'&quiz_id='.$quiz_id);
    		
    	}
    }
    public function center_user() //method used for center users
    {
    	$admin 					= 	Admins:: auth();
    	$center_id 				= 	Input::get('center_id');
    	$quiz_id 				= 	Input::get('quiz_id');
    	$details['center_id'] 	=	$center_id;
    	$details['quiz_id'] 	= 	$quiz_id;

    	if($users_centers 		= 	Centers::get_user_center_list($details))
    	{
    		$allocated_users 	= 	Centers::get_allocated_users($details);
    		return View::make('admin_panel/public/quiz/center_user',['users_centers' =>$users_centers,'admin' =>$admin,'center_id'=>$center_id,'allocated_users' => $allocated_users,'quiz_id'=>$quiz_id]);
    	}
    }
    public function alloted_users() //method used to allocate user to the center
    {
    	$admin 					=	Admins:: auth();
    	$center_id 				= 	Input::get('center_code');
    	$quiz_id 				= 	Input::get('quiz_id');
    	$details['center_id'] 	= 	$center_id;
    	$details['quiz_id'] 	= 	$quiz_id;
		if($allocated_users = Centers::get_allocated_users11($details))
		{
    		return View::make('admin_panel/public/quiz/alloted_users',['admin' =>$admin,'center_id'=>$center_id,'allocated_users' => $allocated_users,'quiz_id'=>$quiz_id]);
    	}
    }
//************** Ends all Functions For the centers *************************//

//************** Starts all Functions For the Instructions *****************//
    public function get_exam_instructions() //method showing instructions
    {
    	$admin  			= 	Admins::auth();
    	$quiz_id 			= 	Input::get('quiz_id');
    	$exam_id 			=	Questions::getExamID($quiz_id);
    	if($instructions=Instructions::get_instructions($quiz_id))
    	{
    		return View::make('admin_panel/public/instruction/instructions',['exam_id'=>$exam_id,'admin'=>$admin,'quiz_id'=>$quiz_id,'instructions'=>$instructions]);
    	}
    }
    public function add_exam_instructions() //method showing add instructions page
    {
    	$admin 				=   Admins::auth();
		$quiz_id 			=	Input::get('quiz_id');
		return View::make('admin_panel/public/instruction/add_instruction',['quiz_id' =>$quiz_id,'admin' =>$admin ]);	
    }
    public function post_exam_instructions() //method used for post instructions
    {
        $details 			=	Input::post(['instruction','instruction_h','type']);
    	$admin 				=	Admins:: auth();
    	$quiz_id  			= 	Input::get('quiz_id');
    	$details['quiz_id'] = 	$quiz_id;
    	if($instructions=Instructions::add_instruction($details))
    	{
    		header('location:/exam_instructions?quiz_id='.$quiz_id);	
    	} 
    }
    public function edit_exam_instructions() //method showing  edit instructions page
    {
    	$admin 				= 	Admins:: auth();
    	$quiz_id  			= 	Input::get('quiz_id');
    	$instruction_id 	=	Input::get('instruction_id');
    	if($instructions=Instructions::get_instruction_list($instruction_id))
		{
			return View::make('admin_panel/public/instruction/edit_instructions',['instructions' =>$instructions,'quiz_id' =>$quiz_id,'admin' =>$admin,'instruction_id'=>$instruction_id]);
		}
    }
    public function update_exam_instructions() //method used for update instructions
    {
        $quiz_id 			=	Input::get('quiz_id');
		$instruction_id 	=	Input::get('instruction_id');
		$details 			= 	Input::post(['instruction','instruction_h','type']);
		$details['quiz_id'] = 	$quiz_id;
		$details['instruction_id'] = $instruction_id;
		if($instructions=Instructions::updatesingle_instruction($details))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}
    }
     public function delete_exam_instructions() //method used for delete instructions
    {
       	$instruction_id 	=	Input::get('instruction_id');
		$quiz_id 			=	Input::get('quiz_id');
		if($instructions=Instructions::delete_instruction($instruction_id))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}	
    }
    public function import_exam_instructions() //method showing instructions page
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/instruction/instruction_csv',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	public function post_exam_instruction_csv() //method used for post exam instructions
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($instructions=Instructions::post_csv_instructions($quiz_id))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}
	}
//************** Ends all Functions For the Instructions *****************//

//************** Starts all Functions For the Trancate *****************//	
    public function truncate_users_tbl() //method used for trancate user tabel
    {
	    $quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
   		$truncate 		=	Admins::truncateUsersTable();
   		if($truncate)
   		{
   			header('location:/import_user_exam?quiz_id='.$quiz_id);
   		}
    }
    public function truncate_user_answer_tbl() //method used  for trancate users answer table 
    {
		$admin 			=   Admins::auth();
    	$truncate 		=	Admins::truncateUserAnswerTable();
    	if($truncate)
    	{
    		header('location:/users');
    	}
    }
//************** Ends all Functions For the Trancate *****************//

//************** Starts all Functions For the Labs *****************//	
    public function center_labes() //method showing center labs
    {
    	$admin 					= 	Admins:: auth();
    	$details['center_id']	= 	Input::get('center_id');
    	$details['quiz_id'] 	= 	Input::get('quiz_id');

    	if($center_labs 		= 	Labs::get_center_labes_list($details))
    	{
    		return View::make('admin_panel/public/quiz/labs',['center_labs' =>$center_labs,'admin' =>$admin,'center_id'=>$details['center_id'],'quiz_id'=>$details['quiz_id']]);
    	}
    }
    public function add_labs() //method showing add lab page
    {
    	$admin 					=	Admins::auth();
    	$center_id 				= 	Input::get('center_id');
    	$quiz_id 				= 	Input::get('quiz_id');
		return View::make('admin_panel/public/quiz/add_labs',['quiz_id' =>$quiz_id,'center_id'=>$center_id,'admin' =>$admin]);
    }
    public function post_labs() // method used for post labs
    {
    	$admin =Admins::auth();
    	$details                = 	Input::post(['name','code','capacity']);
        $details['center_id'] 	=	Input::get('center_id');
    	$details['quiz_id'] 	= 	Input::get('quiz_id');
    	if($labs 				= 	Labs::post_labs($details))
    	{
    		header('location:/labs?center_id='.$details['center_id'].'&quiz_id='.$details['quiz_id']);
    	}
	}
	public function lab_users() //method used for lab users
    {
    	$admin 							= 	Admins:: auth();
    	$details['quiz_id'] 			= 	Input::get('quiz_id');
    	$details['lab_id'] 				= 	Input::get('lab_id');
    	$details['center_id'] 			= 	Input::get('center_id');
    	$details['center_lab_id'] 		= 	Input::get('center_lab_id');
    	if($allocated_users 			= 	Labs::get_allocated_labs_users($details))
    	{
    		return View::make('admin_panel/public/quiz/lab_users',['admin' =>$admin,'allocated_users' => $allocated_users,'quiz_id'=>$details['quiz_id'],'center_lab_id'=>$details['center_lab_id'],'lab_id'=>$details['lab_id'],'center_id'=>$details['center_id']]);
    	}
    }
    public function un_alloted_lab_users() //method used for un-allocated lab users
    {
    	$admin 							= 	Admins:: auth();
    	$details['quiz_id'] 			= 	Input::get('quiz_id');
    	$details['lab_id'] 				= 	Input::get('lab_id');
    	$details['center_id'] 			= 	Input::get('center_id');
    	$details['center_lab_id'] 		= 	Input::get('center_lab_id');
         // echo "abc";die;
    	if($un_allocated_users 			= 	Labs::get_un_allocated_labs_users($details))
    	{
    		$allocated_users 			= 	Labs::get_allocated_labs_users($details);
    		return View::make('admin_panel/public/quiz/un_alloted_lab_users',['admin' =>$admin,'allocated_users' => $allocated_users,'un_allocated_users'=>$un_allocated_users,'quiz_id'=>$details['quiz_id'],'center_lab_id'=>$details['center_lab_id'],'lab_id'=>$details['lab_id'],'center_id'=>$details['center_id']]);
    	}
    }
    public function allocate_center_lab_to_users() //method used for allocate center lab to users 
    {
    	$admin      			= 	Admins:: auth();
    	$center_id    			= 	Input::get('center_id');
    	$quiz_id    			= 	Input::get('quiz_id');
    	$center_lab_id    		= 	Input::get('center_lab_id');
    	$lab_id    				= 	Input::get('lab_id');
		$details 				= 	Input::post(['users']);
    	$details['center_id'] 	=	$center_id;
    	$details['quiz_id'] 	=	$quiz_id;
    	$details['center_lab_id']=	$center_lab_id;
    	$details['lab_id'] 		= 	$lab_id;
    	if($allocated_centers =Centers::post_center_lab_to_users($details))
    	{
    		header('location:/lab_users?center_id='.$center_id.'&quiz_id='.$quiz_id.'&center_lab_id='.$center_lab_id.'&lab_id='.$lab_id);
    	}
    }
    public function un_allocate_center_lab_to_users() //method used for un-allocate center lab to users
    {
    	$admin      				= 	Admins:: auth();
    	$center_id    				= 	Input::get('center_id');
    	$quiz_id    				= 	Input::get('quiz_id');
    	$center_lab_id  			= 	Input::get('center_lab_id');
    	$lab_id    					= 	Input::get('lab_id');
		$details 					= 	Input::post(['users']);
    	$details['center_id'] 		=	$center_id;
    	$details['quiz_id'] 		=	$quiz_id;
    	$details['center_lab_id'] 	=	$center_lab_id;
    	$details['lab_id'] 			=	$lab_id;
    	if($allocated_centers =Centers::un_post_center_lab_to_users($details))
    	{
    		header('location:/lab_users?center_id='.$center_id.'&quiz_id='.$quiz_id.'&center_lab_id='.$center_lab_id.'&lab_id='.$lab_id);
    	}
    }
    public function edit_labs() //method showing edit labs
    {
    	$admin  					= 	Admins::auth();
    	$details['quiz_id']     	= 	Input::get('quiz_id');
    	$details['lab_id']      	= 	Input::get('lab_id');
    	$details['center_id']      	= 	Input::get('center_id');
    	$lab 						=	Labs::get_single_lab($details['lab_id']);
    	if($lab)
    	{
    		return View::make('admin_panel/public/quiz/edit_lab',['center_id'=>$details['center_id'],'admin' =>$admin,'quiz_id' => $details['quiz_id'],'lab'=>$lab]);
    	}
    }

    public function update_lab() //method used for update the labs
    {
    	$admin 					= 	Admins::auth();
    	$quiz_id   				= 	Input::get('quiz_id');
    	$lab_id      			= 	Input::get('lab_id');
    	$center_id      		= 	Input::get('center_id');
    	$details                = 	Input::post(['name','code','capacity']);
    	$center_labs 			= 	Labs::update_lab($details,$lab_id);
    	if($center_labs)
    	{
    		header('location:/labs?center_id='.$center_id.'&quiz_id='.$quiz_id);
    	}
    }
//************** Ends all Functions For the Labs *****************//
    
}

?>