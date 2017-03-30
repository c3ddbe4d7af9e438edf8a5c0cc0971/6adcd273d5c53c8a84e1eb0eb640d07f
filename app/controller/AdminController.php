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
	// ************* start functions for dashboard showing all the admins users **********//
    public function dashboard()
    {
    	$admin=Admins::auth();
		
		return View::make('admin_panel/public/dashboard',['admin'=>$admin]);
	}
    public function adminHome()
    {
		$admin=Admins::auth();
		if($admins_user=Admins::admin_management()){
		return View::make('admin_panel/public/adminhome',['admins_user' => $admins_user,'admin'=>$admin]);
		}
	}
	// ************* ends functions for showing all the admins users **********//

	// ************* start functions for showing all the front end users ********//
	public function get_user()
	{
		
		$admin=Admins::auth();
		if($users=Admins::get_users_list()){
			return View::make('admin_panel/public/user/users',['users' => $users,'admin' => $admin]);
		}
	}
	// ************* end functions for showing all the front end users ********//

	// ************* start functions to display the form for adding the front end users ********//
	public function add_user(){
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		$get_quiz= Admins::get_quiz_list($admin_id);
		return View::make('admin_panel/public/user/create_user',['admin' => $admin,'admin_id'=>$admin_id,'get_quiz' => $get_quiz]);
	}
	// ************* end functions to display the form for adding the front end users ******//

	// ************* start functions for adding the front end users ********//
	public function post_user()
	{
		$admin_id 	=	Input::get('admin_id');

		$details=Input::post(['name','roll_num','roll_code','reference_id','password','confirm-password','mobile','email','language','quiz_id']);
		if($users=Admins::add_post_user($details,$admin_id))
		{
			header('location:/users?admin_id='.$admin_id);
		}

	}
	// ************* end functions for adding the front end users ********//

	// ************* start functions for calling updating form the front end users ********//
	public function edit_user(){
		$user_id 	=	Input::get('user_id');
		$admin=Admins::auth();
		if($users=Admins::get_single_user($user_id))
		{
			return View::make('admin_panel/public/user/edit_user',['admin' => $admin,'users' => $users ]);
		}
	}
// ************* end functions for calling updating form the front end users ********//

	// ************* start functions for updating the front end users ********//
	public function update_user(){
		$user_edit_id 	=	Input::get('user_edit_id');
		$details=Input::post(['name','roll_num','roll_code','reference_id','password','confirm-password','mobile','email','language']);
		if($users=Admins::updatesingle_user($details,$user_edit_id))
		{
			header('location:/users');
		}
	}
// ************* end functions for updating the front end users ********//

// ************* start functions for deleting the front end users ********//
	public function delete_user($id)
	{
		if($users=Admins::delete_user($id))
		{
			header('location:/users');
		}
	}
// ************* end functions for deleting the front end users ********//

// ************* start functions for upload the front end users using csv file********//
	public function users_csv(){
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		return View::make('admin_panel/public/user/csv_user',['admin' => $admin,'admin_id' =>$admin_id]);
	}
	public function post_user_csv()
	{    
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		if($users=Admins::post_users_csv($admin_id)){
			header('location:/users');
		}
	}

     public function export_result_list()
	{    
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		if($results=Results::post_result_list_csv($admin_id)){
			header('location:/users');
		}
	}
	// ************* start functions for upload the front end users using csv file********//
	public function users_details_csv(){
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		return View::make('admin_panel/public/user/user_details_csv',['admin' => $admin,'admin_id' =>$admin_id]);
	}
	public function post_user_detail_csv()
	{    
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		if($users=Admins::post_users_csv_details($admin_id)){
			header('location:/users');
		}
	}
// ************* start functions for upload the front end users using csv file********//

// ************* start functions for calling form for add admin **********//
	public function create_admin_user()
	{
		$admin=Admins::auth();
		return View::make('admin_panel/public/admin/create_admin',['admin' => $admin]);
	}
// ************* end functions for calling form for add admin **********//

// ************* start functions for add admin **********//	
	public function postAdmin()
	{
		$details=Input::post(['name','email','mobile','password']);
		if($admins=Admins::add_admins($details))
		{
			header('location:/admindashboard');
		}
	}
// ************* end functions for add admin **********//	

	// ************* start functions for update admin form**********//	
	public function editAdmin(){
		$admin_id 	=	Input::get('admin_id');
		$admin=Admins::auth();
		if($admin_list=Admins::get_single_admin($admin_id))
		{
			return View::make('admin_panel/public/admin/edit_admin',['admin' => $admin,'admin_list' => $admin_list ]);
		}
	}
// ************* end functions for update admin form **********//

// ************* start functions for updating admin **********//		
	public function updateAdmin($id)
	{
		$details=Input::post(['name','mobile','email','password']);
		if($admin=Admins::updatesingle_admin($details,$id))
		{
			header('location:/admindashboard');
		}
	}
// ************* end functions for updating admin **********//
	public function deleteAdmin($id)
	{
		if($admin=Admins::delete_admin($id))
		{
			header('location:/admindashboard');
		}
	}
// ************* start functions for updating admin **********//

   
// ************* start functions for showing all authority **********************//
	public function authorityList()
	{
		$examinations = array();
		$admin=Admins::auth();
		$admin_id 		=	Input::get('admin_id');
		if($authorities=Authorities::authority_list($admin_id))
		{
			//echo '<pre>';print_r($authorities);
			
			
			//$authority_id = $authorities['0']->id;
			//echo $authority_id;
			//$examinations=Examinations::total_examination($authority_id);
			
			
			return View::make('admin_panel/public/authority',['admin'=>$admin,'authorities' => $authorities,'admins' => $admin,'examinations' => $examinations ]);
		}
	}
// ************* end functions for showing all authority **********************//

// ************* start functions for calling add authority form**********************//
	public function addAuthority()
	{
		$admin=Admins::auth();
		return View::make('admin_panel/public/authority/create_authority',['admin'=>$admin]);	
	}
// ************* end functions for calling add authority form**********************//

// ************* start functions for adding authority **********************//
	public function postAuthority()
	{
		$details=Input::post(['name','admin_id']);
		$admin_id 	=	Input::get('admin_id');
		if($authority=Authorities::add_authority($details,$admin_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
// ************* end functions for adding authority **********************//

// ************* start functions for updating authority form**********************//
	public function editAuthority()
	{
		$admin 			=   Admins::auth();
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		if($authority=Authorities::get_single_authority($authority_id))
		{
			return View::make('admin_panel/public/authority/edit_authority',['admin'=>$admin,'authority' => $authority ]);
		}
	}
// ************* end functions for updating authority form**********************//

// ************* start functions for updating authority**********************//
	public function updateAuthority()
	{
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		$details=Input::post(['name']);
		if($authority=Authorities::updatesingle_authority($details,$authority_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
	// ************* end functions for updating authority**********************//

	// ************* start functions for delete authority**********************//
	public function deleteAuthority()
	{
		$admin 			=   Admins::auth();
		$admin_id 		=	Input::get('admin_id');
		$authority_id 	=	Input::get('authority_id');
		if($authority=Authorities::delete_authority($authority_id))
		{
			header('location:/authority?admin_id='.$admin_id);
		}
	}
	// ************* end functions for delete authority**********************//

// ************* end functions for Authority ******************************//

	// ************* start functions for showing all examinations **********************//
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

	// ************* start functions for calling add examination form**********************//
	public function addExamination()
	{
		$admin 			=   Admins::auth();
		$authority_id 	=	Input::get('authority_id');
		return View::make('admin_panel/public/examination/create_examination',['authority_id' => $authority_id,'admin'=>$admin ]);	
	}
	// ************* ends functions for calling add examination form**********************//
	// ************* start functions for adding examination**********************//
	public function postExamination()
	{
		$authority_id 	=	Input::get('authority_id');
		$details=Input::post(['examination_name','examination_desc']);

		if($examination=Examinations::add_examination($details,$authority_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
	// ************* end functions for adding examination**********************//

	// ************* start functions for editing examination form **********************//
	public function editExamination()
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		$authority_id 	=	Input::get('authority_id');
		if($examinations=Examinations::get_single_examination($exam_id))
		{
			return View::make('/admin_panel/public/examination/edit_examination',['examinations' => $examinations,'authority_id'=> $authority_id,'admin'=>$admin ]);
		}
	}
	// ************* ends functions for editing examination form**********************//

	// ************* start functions for updating examination **********************//
	public function updateExamination()
	{
		$authority_id 	=	Input::get('authority_id');
		$exam_id 		=	Input::get('exam_id');
		$details=Input::post(['examination_name','examination_desc']);
		if($examinations=Examinations::updatesingle_examination($details,$exam_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
	// ************* end functions for updating examination**********************//

	// ************* start functions for deleting examination**********************//
	public function deleteExamination()
	{
		$authority_id 	=	Input::get('authority_id');
		$exam_id 		=	Input::get('exam_id');
		if($examination=Examinations::delete_examination($exam_id))
		{
			header('location:/examination?authority_id='.$authority_id);
		}
	}
	// ************* end functions for deleting examination**********************//
	// ************* end all  functions for examination **********************//

	// ************* start functions for quiz ******************************//
	// ************* start functions for getting quiz**********************//
	public function getQuiz()
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		$authority_id   =   Examinations::getAuthorityID($exam_id);
		// $exam_id 	=	Questions::getExamID($quiz_id);
		if($quizzes=Quizzes::quiz_list($exam_id))
		{
			return View::make('admin_panel/public/quiz/quiz',['quizzes' =>$quizzes,'exam_id' =>$exam_id,'admin' =>$admin,'authority_id'=>$authority_id]);
		}
	}
	// ************* ends functions for getting quiz**********************//
    // ************* start functions for adding quiz form**********************//
	public function addQuiz()
	{
		$admin 			=   Admins::auth();
		$exam_id 		=	Input::get('exam_id');
		return View::make('admin_panel/public/quiz/create_quiz',['exam_id' =>$exam_id,'admin' =>$admin ]);	
	}
	// ************* end functions for adding quiz form**********************//
	// ************* start functions for adding quiz**********************//
	public function postQuiz()
	{
		$exam_id 		=	Input::get('exam_id');
		$details=Input::post(['name','title','logo','time_duration','total_ques']);
		if($quiz=Quizzes::add_quiz($exam_id,$details))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	// ************* end functions for adding quiz**********************//
	// ************* start functions for edit quiz form **********************//
	public function editQuiz()
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quizzes=Quizzes::get_single_quiz($quiz_id))
		{
			return View::make('admin_panel/public/quiz/edit_quiz',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'exam_id'=>$exam_id,'admin' =>$admin ]);
		}
	}
	// ************* end functions for edit quiz form**********************//
	// ************* start functions for updating quiz**********************//
	public function updateQuiz()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		$details=Input::post(['name','title','logo','time_duration','total_ques']);
		// print_r($details);die;
		if($quizzes=Quizzes::updatesingle_quiz($details,$quiz_id))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	// ************* end functions for updating quiz**********************//
	// ************* start functions for deleting quiz**********************//
	public function deleteQuiz()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quiz=Quizzes::delete_quiz($quiz_id))
		{
			header('location:/quiz?exam_id='.$exam_id);
		}
	}
	public function get_quiz_logs()
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Input::get('exam_id');
		if($quizzes=Quizzes::get_single_quiz($quiz_id))
		{
			return View::make('admin_panel/public/quiz/quiz_logs',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'exam_id'=>$exam_id,'admin' =>$admin ]);
		}
	}

		public function get_quiz_details()
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		//$exam_id 		=	Input::get('exam_id');
		if($quizzes=Quizzes::get_single_quiz1($quiz_id))
		{
			return View::make('admin_panel/public/quiz/quiz_details',['quizzes' => $quizzes,'quiz_id' => $quiz_id,'admin' =>$admin ]);
		}
	}

	public function get_user_exam(){
		$quiz_id 		=	Input::get('quiz_id');
		$exam_id 		=	Questions::getExamID($quiz_id);
		//echo $exam_id;die;
		$admin=Admins::auth();
		return View::make('admin_panel/public/quiz/import_user_exam',['exam_id'=>$exam_id,'admin' => $admin,'quiz_id' =>$quiz_id]);
	}
	public function post_exam_user_csv()
	{    
		$quiz_id 	=	Input::get('quiz_id');
		$admin=Admins::auth();
		if($users=Quizzes::post_exam_users_csv($quiz_id)){
			header('location:/user_list?quiz_id='.$quiz_id);
		}
	}
	// ************* end functions for deleting quiz**********************//
	
	// ************* start functions for getting question**********************//
	public function getQuestion_manager()
	{   $quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		$exam_id 		=	Questions::getExamID($quiz_id);

		if($questions=Questions::question_list($quiz_id))
		{
			return View::make('admin_panel/public/question/question_manager',['quiz_id' =>$quiz_id,'questions'=>$questions,'admin'=>$admin,'exam_id' => $exam_id]);	
		}
	}
	// ************* end functions for getting question**********************//

	// ************* start functions for adding question form**********************//
	public function addQuestion()
	{
		$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		return View::make('admin_panel/public/question/create_question',['quiz_id' =>$quiz_id,'admin' =>$admin ]);	
	}
	// ************* end functions for adding question form**********************//
	// ************* start functions for adding question**********************//
	public function postQuestion()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$details=Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
		if($question=Questions::add_question($quiz_id,$details))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);
		}
	}
	// ************* end functions for adding question**********************//
	// ************* start functions for editing question form**********************//
	public function editQuestion()
	{
		$admin 			=   Admins::auth();
		$question_id 		=	Input::get('question_id');
		$quiz_id 			=	Input::get('quiz_id');
		if($questions=Questions::get_single_ques($question_id))
		{
			return View::make('admin_panel/public/question/edit_question',['questions' => $questions,'quiz_id' => $quiz_id,'question_id' => $question_id,'admin' =>$admin ]);
		}
	}
	// ************* end functions for editing question form**********************//

	// ************* start functions for updating question **********************//
	public function updateQuestion()
	{
		$quiz_id 			=	Input::get('quiz_id');
		if($quiz_id=='')
		{
			$question_id 		=	Input::get('question_id');
			
			$details=Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
		    // return $details; die;
			if($question=Questions::updatesingle_question($question_id,$details))
			{
				header('location:/questions');
			}	
		}
		else
		{
			$question_id 		=	Input::get('question_id');
			$details=Input::post(['passage','h_passage','question','h_question','A','B','C','D','answer','h_A','h_B','h_C','h_D','h_answer']);
			if($question=Questions::updatesingle_question($question_id,$details))
			{
				header('location:/question_manager?quiz_id='.$quiz_id);
			}
		}
		
	}
	// ************* end functions for updating question**********************//
    // ************* start functions for deleting question **********************// 
	public function deleteQuestion()
	{
		$question_id 		=	Input::get('question_id');
		$quiz_id 		=	Input::get('quiz_id');
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

	public function get_question_details()
	{
       $admin 		=Admins::auth();
       $question_id 		=	Input::get('question_id');
       if($questions=Questions::get_single_ques($question_id))
		{
			return View::make('admin_panel/public/question/question_detail',['questions' => $questions,'admin' =>$admin ]);
		}
      
	}
	// ************* end functions for deleting question **********************//

	// ************* start functions for uploading question form **********************//
	public function upload_csv()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/question/question_csv',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	// ************* end function for uploading question form**********************//

	// ************* start functions for updating answer key **********************//
	public function updateAnswerKey()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/question/update_answer_key',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	// ************* end function for uploading question form**********************//

 // ************* start functions for uploading answer key**********************//
	public function postAnswerKey()
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($questions=Questions::post_update_answer_key($quiz_id))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);	
		}
	}
    // ************* start functions for uploading question**********************//
	public function post_csv()
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($questions=Questions::post_csv_file1($quiz_id))
		{
			header('location:/question_manager?quiz_id='.$quiz_id);	
		}
	}

	public function question_export(){
			$quiz_id 		=	Input::get('quiz_id');
    		$export 	=	 Questions::exportToExl_2($quiz_id);
       		return 'Result Exported Successfully';


    }
    public function get_user_log()
    {
    	$admin =Admins::auth();
    	$question_id  =Input::get('question_id');
    	if($user_logs=Userlogs::get_user_log_by_qid($question_id)){
          return View::make('admin_panel/public/question/user_log',['admin'=>$admin,'user_logs'=>$user_logs]);
    	}

    }
    public function get_user_list()
    {
    	$admin 			= 	Admins::auth();
    	$quiz_id  		= 	Input::get('quiz_id');
    	$exam_id 		=	Questions::getExamID($quiz_id);
    	if($user_list=Userlogs::get_user_list_quizid($quiz_id)){
          return View::make('admin_panel/public/question/user_log_list',['admin'=>$admin,'quiz_id'=>$quiz_id,'user_list'=>$user_list,'exam_id'=>$exam_id]);
    	}
    }

     public function get_user_log_details()
    {
    	$admin =Admins::auth();
    	$user_id  =Input::get('user_id');
    	$quiz_id  =Input::get('quiz_id');
    	if($user_list_details=Userlogs::get_user_detail_list($user_id)){
          return View::make('admin_panel/public/question/user_log_detail',['quiz_id'=>$quiz_id,'admin'=>$admin,'user_list_details'=>$user_list_details]);
    	}
    }

    public function get_quiz_user_log()
    {
    	$admin =Admins::auth();
    	$user_id  =Input::get('user_id');
    	if($quiz_user_log=Userlogs::get_quiz_user_log($user_id)){
          return View::make('admin_panel/public/quiz/quiz_user_log',['admin'=>$admin,'quiz_user_log'=>$quiz_user_log]);
    	}
    }
    public function get_user_details()
    {
    	$admin =Admins::auth();
    	$user_id  =Input::get('user_id');
    	if($user_details=Userlogs::get_user_detail($user_id)){
          return View::make('admin_panel/public/quiz/user_details',['admin'=>$admin,'user_details'=>$user_details]);
    	}
    }

    public function update_user_status11()
    {
    	$admin =Admins::auth();
    	//echo 'hello';die;
    	//$user_id  =Input::post('id');return $user_id;die;
    	//$status  =Input::get('status');//return $user_id;die;
    	$details=Input::post(['id','status']);
    	//echo $user_id;
    	if($status_details=Userlogs::update_user_status($details)){
          //header('location:/users');
    		echo '<script>alert("status updated");</script>';
    	}
    }
	// ************* start functions for uploading questions**********************//
	// ************* end functions for question ******************************//

// ************* start functions for question bank **********************//
    public function Question_bank(){
    $admin 			=   Admins::auth();	
		if($questions=Questions::questionBank_list())
		{	
			return View::make('admin_panel/public/question_bank',['questions' => $questions,'admins' => $admin]);
		}
    } 
    // ************* end functions for question bank **********************//

// ************* start functions for logout**********************//
    public function getLogout()
    {
        $smin_logout = Admins::logout();
        header('location:/');
    }

    public function getResult()
    {
    		//$user_id 		=	Input::get('user_id');
    	   	//$res=Results::getRes($user_id);
  		   	//$user=Admins::auth();
		   
  			//return View::make('submits',['res'=>$res,'user'=>$user]);
    	     $admin 			=   Admins::auth();
       		if($results=Results::result_list())
		{	
			return View::make('admin_panel/public/result',['results' => $results,'admins' => $admin]);
		}
    }

    public function exportExl()
    {
    		$details=Input::post(['ExportType']);
    		$export 	=	 Results::exportToExl($details);
       		return View::make('admin_panel/public/result');
    }
    public function getView()
    {
    	$user_id 		=	Input::get('user_id');
    	 $admin 			=   Admins::auth();	
    	 if($user=Results::view_result($user_id))
    	 {
            return View::make('admin_panel/public/view',['admins'=>$admin,'user'=>$user,'user_id'=>$user_id]);
    	 }
       
    }

     public function getViewResult()
    {
    	$user_id 		=	Input::get('user_id');
    	 $admin 			=   Admins::auth();	
    	 if($user=Results::view_result($user_id))
    	 {
            return View::make('admin_panel/public/view_result',['admins'=>$admin,'user'=>$user,'user_id'=>$user_id]);
    	 }
       
    }

    public function result_export($id){
    		$export 	=	 Results::exportToExl_2($id);
       		return 'Result Exported Successfully';


    }

    public function export_user_list(){
    		$export 	=	 Admins::exportUserList();
       		return 'Result Exported Successfully';


    }
   //   public function delete_result(){
		 // $result_id 		=	Input::get('user_id');
		 // if($results=Results::delete_result($result_id))
		 // {
		 // 	header('location:/result');
		 // }

  //   }

    public function demo_user_csv(){
    		$export 	=	 Admins::demoUserCsv();
       		return 'Result Exported Successfully';


    }

    public function demo_question_csv(){
    		$export 	=	 Admins::demoQuestionCsv();
       		return 'Result Exported Successfully';


    }

    public function demo_answer_csv(){
    		$export 	=	 Admins::demoAnswerCsv();
       		return 'Result Exported Successfully';


    }
    public function user_result_details(){
    	$user_id 		=	Input::get('user_id');
    	 $admin 			=   Admins::auth();	
    	 if($results=Results::user_details_list($user_id)){

    	return View::make('admin_panel/public/user/result_detail',['results'=>$results,'admin'=>$admin,'user_id'=>$user_id]);
    	 }
    }

     public function view_result_details(){
    	$user_id 		=	Input::get('user_id');
    	 $admin 			=   Admins::auth();	
    	 if($results=Results::user_details_list($user_id)){

    	return View::make('admin_panel/public/user/view_result_detail',['results'=>$results,'admin'=>$admin,'user_id'=>$user_id]);
    	 }
    }
    public function export_result_details(){
    		$user_id 		=	Input::get('user_id');
    		$export 	=	 Results::exportResultList($user_id);
       		return 'Result Exported Successfully';


    }

    public function get_center_list()
    {
    	$quiz_id    	= 	Input::get('quiz_id');
    	$admin      	= 	Admins:: auth();
    	$exam_id 		=	Questions::getExamID($quiz_id);
    	if($centers 	= 	Centers::get_center()){
    		//$allocated_centers 	=	Centers::get_allocated_canter($quiz_id);
    		return View::make('admin_panel/public/quiz/center',['exam_id'=>$exam_id,'admins'=>$admin,'centers'=>$centers,'quiz_id'=>$quiz_id]);

    	}

    }
    public function update_center_list()
    {
    	$admin      = Admins:: auth();
    	$quiz_id    = Input::get('quiz_id');

    	$details=Input::post(['centers']);
    	//echo '<pre>';print_r($details);
    	$details['quiz_id']=$quiz_id;
    	if($allocated_centers =Centers::post_center($details)){
    		header('location:/centers?quiz_id='.$quiz_id);
    		

    	}
    }

    public function allocate_center_to_users()
    {
    	$admin      	= Admins:: auth();
    	$center_id    	= Input::get('center_id');
    	$quiz_id    	= Input::get('quiz_id');

    	$details=Input::post(['users']);
    	//echo '<pre>';print_r($details);
    	$details['center_id']=$center_id;
    	$details['quiz_id']=$quiz_id;
    	if($allocated_centers =Centers::post_center_to_users($details)){
    		header('location:/center_user?center_id='.$center_id.'&quiz_id='.$quiz_id);
    		

    	}
    }

    public function un_allocate_center_to_users()
    {
    	$admin      	= Admins:: auth();
    	$center_id    	= Input::get('center_id');
    	$quiz_id    	= Input::get('quiz_id');

    	$details=Input::post(['users']);
    	//echo '<pre>';print_r($details);
    	$details['center_id']=$center_id;
    	$details['quiz_id']=$quiz_id;
    	if($allocated_centers =Centers::un_post_center_to_users($details)){
    		header('location:/alloted_users?center_code='.$center_id.'&quiz_id='.$quiz_id);
    		

    	}
    }
    public function add_center()
    {
    	$admin =Admins:: auth();
    	$quiz_id  = Input::get('quiz_id');
    	return View::make('admin_panel/public/quiz/create_center',['quiz_id' =>$quiz_id,'admin' =>$admin ]);
    }
     public function post_center()
     {
    	$details=Input::post(['name','code','capacity']);
    	$admin =Admins:: auth();
    	$quiz_id  = Input::get('quiz_id');
    	if($centers=Centers::add_center($details)){
    	header('location:/centers?quiz_id='.$quiz_id);	
    	}
    	
    }
    public function edit_center()
    {
    	$admin =Admins:: auth();
    	$quiz_id  = Input::get('quiz_id');
    	$center_id =Input::get('center_id');
    	if($centers=Centers::get_center_list($center_id))
		{
			return View::make('admin_panel/public/quiz/edit_center',['centers' =>$centers,'quiz_id' =>$quiz_id,'admin' =>$admin,'center_id'=>$center_id]);
		}
    	
    }
    public function update_center()
    {
        $quiz_id 		=	Input::get('quiz_id');
		$center_id 		=	Input::get('center_id');
		$details=Input::post(['name','code','capacity']);
		$details['quiz_id'] = $quiz_id;
		 // print_r($details);die;
		if($centers=Centers::updatesingle_center($details,$center_id))
		{
			header('location:/centers?quiz_id='.$quiz_id);
		}
    }
    public function delete_center()
    {
       $center_id 	=	Input::get('center_id');
		$quiz_id 		=	Input::get('quiz_id');
		if($centers=Centers::delete_center($center_id))
		{
			header('location:/centers?quiz_id='.$quiz_id);
		}	
    }
    public function center_user()
    {
    	$admin 					= 	Admins:: auth();
    	$center_id 				= 	Input::get('center_id');
    	$quiz_id 				= 	Input::get('quiz_id');
    	$details['center_id'] 	=	$center_id;
    	$details['quiz_id'] 	= 	$quiz_id;

    	if($users_centers 		= 	Centers::get_user_center_list($details)){
    		$allocated_users 	= 	Centers::get_allocated_users($details);
    		return View::make('admin_panel/public/quiz/center_user',['users_centers' =>$users_centers,'admin' =>$admin,'center_id'=>$center_id,'allocated_users' => $allocated_users,'quiz_id'=>$quiz_id]);
    	}
    }

     public function alloted_users()
    {
    	$admin =Admins:: auth();
    	$center_id = Input::get('center_code');
    	$quiz_id = Input::get('quiz_id');
    	$details['center_id']= $center_id;
    	$details['quiz_id']= $quiz_id;

    	if($allocated_users = Centers::get_allocated_users11($details)){
    		
    		return View::make('admin_panel/public/quiz/alloted_users',['admin' =>$admin,'center_id'=>$center_id,'allocated_users' => $allocated_users,'quiz_id'=>$quiz_id]);
    	}
    }
    public function get_exam_instructions()
    {
    	$admin  			= 	Admins::auth();
    	$quiz_id 			= 	Input::get('quiz_id');
    	$exam_id 			=	Questions::getExamID($quiz_id);
    	if($instructions=Instructions::get_instructions($quiz_id)){
    		return View::make('admin_panel/public/instruction/instructions',['exam_id'=>$exam_id,'admin'=>$admin,'quiz_id'=>$quiz_id,'instructions'=>$instructions]);
    	}
    }
    public function add_exam_instructions()
    {
    	$admin 			=   Admins::auth();
		$quiz_id 		=	Input::get('quiz_id');
		return View::make('admin_panel/public/instruction/add_instruction',['quiz_id' =>$quiz_id,'admin' =>$admin ]);	
    }
    public function post_exam_instructions()
    {
         $details=Input::post(['instruction','instruction_h','type']);
    	$admin =Admins:: auth();
    	$quiz_id  = Input::get('quiz_id');
    	$details['quiz_id'] = $quiz_id;
    	if($instructions=Instructions::add_instruction($details)){
    	header('location:/exam_instructions?quiz_id='.$quiz_id);	
    	} 
    }
    public function edit_exam_instructions()
    {
    	$admin =Admins:: auth();
    	$quiz_id  = Input::get('quiz_id');
    	$instruction_id =Input::get('instruction_id');
    	if($instructions=Instructions::get_instruction_list($instruction_id))
		{
			return View::make('admin_panel/public/instruction/edit_instructions',['instructions' =>$instructions,'quiz_id' =>$quiz_id,'admin' =>$admin,'instruction_id'=>$instruction_id]);
		}
    	
    }
    public function update_exam_instructions()
    {
        $quiz_id 		=	Input::get('quiz_id');
		$instruction_id =Input::get('instruction_id');
		$details=Input::post(['instruction','instruction_h','type']);
		$details['quiz_id'] = $quiz_id;
		$details['instruction_id'] = $instruction_id;
		 // print_r($details);die;
		if($instructions=Instructions::updatesingle_instruction($details))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}
    }
     public function delete_exam_instructions()
    {
       $instruction_id 	=	Input::get('instruction_id');
		$quiz_id 		=	Input::get('quiz_id');
		// echo $instruction_id;die;
		if($instructions=Instructions::delete_instruction($instruction_id))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}	
    }
    public function import_exam_instructions()
	{
		$quiz_id 		=	Input::get('quiz_id');
		$admin 			=   Admins::auth();
		return View::make('admin_panel/public/instruction/instruction_csv',['quiz_id' =>$quiz_id,'admin' =>$admin]);
	}
	public function post_exam_instruction_csv()
	{
		$quiz_id 		=	Input::get('quiz_id');
		if($instructions=Instructions::post_csv_instructions($quiz_id))
		{
			header('location:/exam_instructions?quiz_id='.$quiz_id);
		}
	}
	public function demo_instruction_csv(){
    		$export 	=	 Instructions::demoInstructionCsv();
       		return 'Result Exported Successfully';


    }
   public function demo_answer_key_csv(){
    		$export 	=	 Questions::demoAnswerKeyCsv();
       		return 'Result Exported Successfully';


    }

    public function truncate_users_tbl(){
	    	$quiz_id 		=	Input::get('quiz_id');
			$admin 			=   Admins::auth();
    		$truncate 		=	Admins::truncateUsersTable();
    		if($truncate)
    		{
    			header('location:/import_user_exam?quiz_id='.$quiz_id);
    		}
       		


    }
    public function truncate_user_answer_tbl(){
			$admin 			=   Admins::auth();
    		$truncate 		=	Admins::truncateUserAnswerTable();
    		if($truncate)
    		{
    			header('location:/users');
    		}
       		


    }
     public function center_labes()
    {
    	$admin 					= 	Admins:: auth();
    	$details['center_id']	= 	Input::get('center_id');
    	$details['quiz_id'] 	= 	Input::get('quiz_id');

    	if($center_labs 		= 	Labs::get_center_labes_list($details)){
    		//$allocated_users 	= 	Centers::get_allocated_users($details);
    		return View::make('admin_panel/public/quiz/labs',['center_labs' =>$center_labs,'admin' =>$admin,'center_id'=>$details['center_id'],'quiz_id'=>$details['quiz_id']]);
    	}
    }
    public function add_labs()
    {
    	$admin =Admins::auth();
    	$center_id 				= 	Input::get('center_id');
    	$quiz_id 				= 	Input::get('quiz_id');

    	return View::make('admin_panel/public/quiz/add_labs',['quiz_id' =>$quiz_id,'center_id'=>$center_id,'admin' =>$admin]);
    }
     public function post_labs()
    {
    	$admin =Admins::auth();
    	$details                = 	Input::post(['name','code','capacity']);
        $details['center_id'] 	=	Input::get('center_id');
    	$details['quiz_id'] 	= 	Input::get('quiz_id');
    	if($labs 				= 	Labs::post_labs($details))
    	{
    		//$allocated_users 	= 	Centers::get_allocated_users($details);
    		header('location:/labs?center_id='.$details['center_id'].'&quiz_id='.$details['quiz_id']);
    	}

	}

	public function lab_users()
    {
    	$admin 							= 	Admins:: auth();
    	$details['quiz_id'] 			= 	Input::get('quiz_id');
    	$details['lab_id'] 				= 	Input::get('lab_id');
    	$details['center_id'] 			= 	Input::get('center_id');
    	$details['center_lab_id'] 		= 	Input::get('center_lab_id');

    	if($allocated_users 			= 	Labs::get_allocated_labs_users($details)){
    		//$users_centers 			= 	Labs::get_user_center_lab_list($details)
    		
    		return View::make('admin_panel/public/quiz/lab_users',['admin' =>$admin,'allocated_users' => $allocated_users,'quiz_id'=>$details['quiz_id'],'center_lab_id'=>$details['center_lab_id'],'lab_id'=>$details['lab_id'],'center_id'=>$details['center_id']]);
    	}
    }

    public function un_alloted_lab_users()
    {
    	$admin 							= 	Admins:: auth();
    	$details['quiz_id'] 			= 	Input::get('quiz_id');
    	$details['lab_id'] 				= 	Input::get('lab_id');
    	$details['center_id'] 			= 	Input::get('center_id');
    	$details['center_lab_id'] 		= 	Input::get('center_lab_id');

    	if($un_allocated_users 			= 	Labs::get_un_allocated_labs_users($details)){
    		$allocated_users 			= 	Labs::get_allocated_labs_users($details);
    		
    		return View::make('admin_panel/public/quiz/un_alloted_lab_users',['admin' =>$admin,'allocated_users' => $allocated_users,'un_allocated_users'=>$un_allocated_users,'quiz_id'=>$details['quiz_id'],'center_lab_id'=>$details['center_lab_id'],'lab_id'=>$details['lab_id'],'center_id'=>$details['center_id']]);
    	}
    }
    public function edit_labs()
    {
    	$admin =Admins::auth();
    	$details['quiz_id']     	= Input::get('quiz_id');
    	$details['lab_id']      	= Input::get('lab_id');
    	$details['center_id']      	= Input::get('center_id');
    	$lab 	=	 Labs::get_single_lab($details['lab_id']);
    	if($lab)
    	{
    		return View::make('admin_panel/public/quiz/edit_lab',['center_id'=>$details['center_id'],'admin' =>$admin,'quiz_id' => $details['quiz_id'],'lab'=>$lab]);
    	}
    	
    }

    public function update_lab()
    {
    	$admin 					= Admins::auth();
    	$quiz_id   				= Input::get('quiz_id');
    	$lab_id      			= Input::get('lab_id');
    	$center_id      		= Input::get('center_id');
    	$details                = Input::post(['name','code','capacity']);
    	$center_labs 			= Labs::update_lab($details,$lab_id);
    	if($center_labs)
    	{
    		header('location:/labs?center_id='.$center_id.'&quiz_id='.$quiz_id);
    	}
    	
    }
}
// ************* end functions for logout**********************//
?>