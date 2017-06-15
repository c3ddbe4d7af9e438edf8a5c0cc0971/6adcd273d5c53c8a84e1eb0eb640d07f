<?php 
/**
* 
*/
class Quizzes extends Model
{
	// this function is for adding the quiz
	public static function add_quiz($exam_id,$details)
	{
		$model 					= new self;
		$name 				    = $details['name'];
		$title 					= $details['title'];
		$time_duration 			= $details['time_duration'];
		$total_ques 		    = $details['total_ques'];
		$current_date 			= date("Y-m-d H:i:s");
		if(isset($_FILES['logo']))
		{
	      $errors				= array();
	      $file_name 			= time().$_FILES['logo']['name'];
	      $file_size 			= $_FILES['logo']['size'];
	      $file_tmp 			= $_FILES['logo']['tmp_name'];
	      $file_type 			= $_FILES['logo']['type'];
	      $file_ext				= strtolower(end(explode('.',$_FILES['logo']['name'])));
	      $expensions			= array("jpeg","JPEG","jpg","JPG","png","PNG");
      	  if(in_array($file_ext,$expensions)=== false)
      		{
         		$errors[]="extension not allowed, please choose a JPEG or PNG file.";
      		}
      		if($file_size > 2097152) 
      		{
         		$errors[]='File size must be excately 2 MB';
      		}
      
      		if(empty($errors)==true) 
      		{
         		move_uploaded_file($file_tmp,"uploads/logo/".$file_name);
         		echo "Success";
      		}
      		else
      		{
         		print_r($errors);
      		}
   		}
		return $model->insert([
			'exam_id' 		=> $exam_id,
			'name' 			=> $name,
			'title'         => $title,
			'logo'          => $file_name,
			'duration' 		=> $time_duration,
			'total_ques'    => $total_ques,
			'created_at'    => $current_date, 
			'updated_at'    => $current_date],
			'quizzes');
	}
	// this function is used for showing quiz list

	public static function quiz_list($exam_id)
	{
		$model=new self;
		$quizzes=$model->SELECT("SELECT * FROM quizzes WHERE  exam_id=$exam_id AND status='1' ORDER BY id ASC");
		if($quizzes)
		{
			return $quizzes; die;
		}
		else
		{
			return 'null';
		}
	}
	// this function is used for fetching the quiz
	public static function get_single_quiz($quiz_id)
	{
		$model 			=	new self;
		$quizzes 		=	$model->SELECT("SELECT * FROM 	quizzes WHERE id=$quiz_id");
		return $quizzes;
	}
    // function used for fetching the single quiz
		public static function get_single_quiz1($quiz_id)
	{
		$model 			=	new self;
		$quizzes 		=	$model->SELECT("SELECT q.*,e.examination FROM quizzes q left join examinations e on q.exam_id=e.id WHERE q.id=$quiz_id");
		return $quizzes;
	}
	//  this function is used for update the quiz
	public static function updatesingle_quiz($details,$quiz_id)
	{
		$model=new self;
		//echo '<pre>';print_r($details);die;
		$name 			    = $details['name'];
		$title 				= $details['title'];
		$logo 				= '';
		if(!empty($_FILES['logo']))
		{
			//echo 'hello'; die;
	      $errors 			= array();
	      $logo 			= $_FILES['logo']['name'];
	      $file_size 		= $_FILES['logo']['size'];
	      $file_tmp 		= $_FILES['logo']['tmp_name'];
	      $file_type 		= $_FILES['logo']['type'];
	      $file_ext 		= strtolower(end(explode('.',$_FILES['logo']['name'])));
	      
	      $expensions 		= array("jpeg","JPEG","jpg","JPG","png","PNG");

	      if($logo!='')
	      {
	      	//echo 'helloooo'; die;
	      	 if(in_array($file_ext,$expensions)=== false)
	      {
	         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
	      }
      
	      if($file_size > 20000) 
	      {
	         $errors[]='File size must be less than 20 KB';
	      }
      
	      if(empty($errors)==true) 
	      {
	         move_uploaded_file($file_tmp,"uploads/logo/".$logo);
	         echo "Success";
	      }
	      else
	      {
	         print_r($errors); exit;
	      }
	      }
	      else
	      {
	      	$logo = $details['logo1'];
	      }
      
	     
   		}

		$time_duration	  	= $details['time_duration'];
		$total_ques	        = $details['total_ques'];

		$quiz=$model->UPDATE("UPDATE quizzes SET name=?,title=?,logo=?,duration=?,total_ques=? WHERE id=?",[$name,$title,$logo,$time_duration,$total_ques,$quiz_id]);
		return $quiz;
	}
	// this function is used for delete the quiz
	public static function delete_quiz($quiz_id)
	{
		$model=new self;
		//$quiz=$model->DELETE("DELETE FROM quizzes WHERE id=?",[$quiz_id]);
		$quiz=$model->UPDATE("UPDATE quizzes SET status=? WHERE id=?",['0',$quiz_id]);
		return $quiz;
	}
	// function used for random digit
	function randomDigits($length)
	{
	    $numbers 	= 	range(1,9);
	    $digits 	=	'';
	    shuffle($numbers);
	    for($i = 0;$i < $length;$i++)
	       $digits .= $numbers[$i];
	    return $digits;
}
	public static function post_exam_users_csv_bckup($quiz_id)
	{
			if($_FILES['import_file']['name'])
			{
				$arrFileName = explode('.',$_FILES['import_file']['name']);
				if($arrFileName[1] == 'csv')
				{
					$handle = fopen($_FILES['import_file']['tmp_name'], "r");
					$row = 0;
					while (($data = fgetcsv($handle, 100000, ",")) !== FALSE) 
					{
						$row++;
						if($row == 1)
						{ 
							$row++; continue; 
						}

						$model 					= new self;
						$id 					= $data[0];
						$quiz_id 				= $data[1];
						$reg_num 				= $data[2];
						$post 					= $data[3];
						$reg_date 				= $data[4];
						$name 					= $data[5];
						$father_name 			= $data[6];
						$gender 				= $data[7];
						$dob 					= $data[8];
						$category 				= $data[9];
						$roll_num 				= $data[10];
						$roll_code 				= $data[11];
						$lab_code 				= $data[12];
						$examination_center 	= $data[13];

						$alphabet 	 			= '123456789';
						$alphaLength 			= strlen($alphabet) - 1; //put the length -1 in cache = strlen($alphabet) - 1; //put the length -1 in cache
						$digits 	 			= self::randomDigits($alphaLength);
					
						$password 				= sha1($digits);
						$hash 					= $digits;
						
						$reference_id 			= $data[14];
						$profile_pic 			= $data[15];
						$sig_pic 				= $data[16];
						$mobile 				= $data[17];
						$email 					= $data[18];



						$model->INSERT([

									'quiz_id'				=>	$quiz_id,
									'reg_num'				=>	$reg_num,
									'post'					=>	$post,
									'reg_date'				=>	$reg_date,
									'name'					=>	$name,
									'father_name'			=>	$father_name,
									'gender' 				=>	$gender,
									'dob'					=>	$dob,
									'category'				=>	$category,
									'roll_num'				=>	$roll_num,
									'roll_code'				=>	$roll_code,
									'examination_center'  	=> 	$examination_center,
									'reference_id'			=>	$reference_id,
									'password'      		=>  $password,
									'hash_pwd' 				=>	$hash,
									'profile_pic'			=>	$profile_pic.'.jpg',
									'sig_pic'				=>	$sig_pic.'.jpg',
									'mobile' 				=> 	$mobile,
									'email' 				=> 	$email,
									'created_at' 			=>	time(),
									'language' 				=>	'1',
									'is_admin' 				=>	'0',
									'creator_id' 			=> 	'1',
									'is_login'				=>	'0',
									'login_at'				=> 	'00-00-0000',
									'is_start'				=>	'0',
									'status'				=>	'1',
									'completed'				=>	'0'
												],'users');

						$rc=(new self)->SELECT("SELECT id from centers where code='".$roll_code."'");
						if(!empty($rc)){
							$center_id=$rc[0]->id;
							
						}else{
							$center_id=(new self)->INSERT([

									'name'				=>	$examination_center,
									'code'				=>	$roll_code,
									'is_active'			=>	1
										],'centers');
						}
						$la=(new self)->SELECT("SELECT id from labs where code='".$lab_code."'");

						if(!empty($la)){
							$lab_id=$la[0]->id;
							
						}else{
							$lab_id=(new self)->INSERT([

									'name'				=>	$lab_code,
									'code'				=>	$lab_code,
									'is_active'			=>	1
										],'labs');
						}

						$cl=(new self)->SELECT("SELECT id from center_lab where center_id='".$center_id."' and lab_id='".$lab_id."' ");
						if(!empty($cl)){
							$center_lab_id=$cl[0]->id;
							

						}else{
							$center_lab_id=(new self)->INSERT([
									'center_id'				=>	$center_id,
									'lab_id'				=>	$lab_id
										],'center_lab');
						}
						
							
						
						
						
					
						(new self)->INSERT([
	                                'user_id'      => $id,
	                                'quiz_id'	   => $quiz_id,
	                                'center_lab_id'  => $center_lab_id,
	                                'language'     => 1,
	                                'count'        => 0,

									],'user_quizes');
					}

				fclose($handle);
				return "Import done";
				}
			}
	
	}
	/*-------------------------------------------------------------------------*/
// function used for import csv for users,user_quizzes,centers,labs and center labs
	public static function post_exam_users_csv($quiz_id)
	{
			if($_FILES['import_file']['name'])
			{
				$arrFileName = explode('.',$_FILES['import_file']['name']);
				if($arrFileName[1] == 'csv')
				{
					$handle = fopen($_FILES['import_file']['tmp_name'], "r");
					$row = 0;
					while (($data = fgetcsv($handle, 10000000000000000000000000000000, ",")) !== FALSE) 
					{
						$row++;
						if($row == 1)
						{ 
							$row++; continue; 
						}

						$model 					= new self;
						$id 					= $data[0];
						$quiz_id 				= $data[1];
						$reg_num 				= $data[2];
						$post 					= $data[3];
						$reg_date 				= $data[4];
						$name 					= $data[5];
						$father_name 			= $data[6];
						$gender 				= $data[7];
						$dob 					= $data[8];
						$category 				= $data[9];
						$roll_num 				= $data[10];
						$roll_code 				= $data[11];
						$lab_code 				= $data[12];
						$examination_center 	= $data[13];

						$alphabet 	 			= '123456789';
						$alphaLength 			= strlen($alphabet) - 1; //put the length -1 in cache = strlen($alphabet) - 1; //put the length -1 in cache
						$digits 	 			= self::randomDigits($alphaLength);
					
						$password 				= sha1($digits);
						$hash 					= $digits;
						
						$reference_id 			= $data[14];
						$profile_pic 			= $data[15];
						$sig_pic 				= $data[16];
						$mobile 				= $data[17];
						$email 					= $data[18];

						if($roll_code =='' AND $lab_code=='' AND $examination_center=='')
						{
							$model->INSERT([

									'quiz_id'				=>	$quiz_id,
									'reg_num'				=>	$reg_num,
									'post'					=>	$post,
									'reg_date'				=>	$reg_date,
									'name'					=>	$name,
									'father_name'			=>	$father_name,
									'gender' 				=>	$gender,
									'dob'					=>	$dob,
									'category'				=>	$category,
									'roll_num'				=>	$roll_num,
									'roll_code'				=>	'',
									'examination_center'  	=> 	'',
									'lab_code'  			=> 	'',
									'alloted'  				=> 	0,
									'reference_id'			=>	$reference_id,
									'password'      		=>  $password,
									'hash_pwd' 				=>	$hash,
									'profile_pic'			=>	$profile_pic.'.jpg',
									'sig_pic'				=>	$sig_pic.'.jpg',
									'mobile' 				=> 	$mobile,
									'email' 				=> 	$email,
									'created_at' 			=>	time(),
									'language' 				=>	'1',
									'is_admin' 				=>	'0',
									'creator_id' 			=> 	'1',
									'is_login'				=>	'0',
									'login_at'				=> 	'00-00-0000',
									'is_start'				=>	'0',
									'status'				=>	'1',
									'completed'				=>	'0'
												],'users');

							(new self)->INSERT([
	                                'user_id'      => $id,
	                                'quiz_id'	   => $quiz_id,
	                                'center_lab_id'=> 0,
	                                'language'     => 1,
	                                'count'        => 0,

									],'user_quizes');
							}
							else
							{
								$model->INSERT([

									'quiz_id'				=>	$quiz_id,
									'reg_num'				=>	$reg_num,
									'post'					=>	$post,
									'reg_date'				=>	$reg_date,
									'name'					=>	$name,
									'father_name'			=>	$father_name,
									'gender' 				=>	$gender,
									'dob'					=>	$dob,
									'category'				=>	$category,
									'roll_num'				=>	$roll_num,
									'roll_code'				=>	$roll_code,
									'examination_center'  	=> 	$examination_center,
									'lab_code'  			=> 	$lab_code,
									'alloted'  				=> 	1,
									'reference_id'			=>	$reference_id,
									'password'      		=>  $password,
									'hash_pwd' 				=>	$hash,
									'profile_pic'			=>	$profile_pic.'.jpg',
									'sig_pic'				=>	$sig_pic.'.jpg',
									'mobile' 				=> 	$mobile,
									'email' 				=> 	$email,
									'created_at' 			=>	time(),
									'language' 				=>	'1',
									'is_admin' 				=>	'0',
									'creator_id' 			=> 	'1',
									'is_login'				=>	'0',
									'login_at'				=> 	'00-00-0000',
									'is_start'				=>	'0',
									'status'				=>	'1',
									'completed'				=>	'0'
												],'users');

						$rc=(new self)->SELECT("SELECT id from centers where code='".$roll_code."'");
						if(!empty($rc)){
							$center_id=$rc[0]->id;
							
						}else{
							$center_id=(new self)->INSERT([

									'name'				=>	$examination_center,
									'code'				=>	$roll_code,
									'is_active'			=>	1
										],'centers');
						}
						$la=(new self)->SELECT("SELECT id from labs where code='".$lab_code."'");

						if(!empty($la)){
							$lab_id=$la[0]->id;
							
						}else{
							$lab_id=(new self)->INSERT([

									'name'				=>	$lab_code,
									'code'				=>	$lab_code,
									'is_active'			=>	1
										],'labs');
						}

						$cl=(new self)->SELECT("SELECT id from center_lab where center_id='".$center_id."' and lab_id='".$lab_id."' ");
						if(!empty($cl)){
							$center_lab_id=$cl[0]->id;
							

						}else{
							$center_lab_id=(new self)->INSERT([
									'center_id'				=>	$center_id,
									'lab_id'				=>	$lab_id
										],'center_lab');
						}
						
							
						
						
						
					
						(new self)->INSERT([
	                                'user_id'      => $id,
	                                'quiz_id'	   => $quiz_id,
	                                'center_lab_id'  => $center_lab_id,
	                                'language'     => 1,
	                                'count'        => 0,

									],'user_quizes');
					}

						
					

						
				}
						fclose($handle);
						//return "Import done";
			}
			$count_lab_cap = (new self)->SELECT("select center_lab_id, count(id) as lab_capacity from user_quizes where center_lab_id!=0 group by center_lab_id ");
			// echo '<pre>';print_r($count);
			//echo $count_lab_cap[0]->lab_capacity;//die;
			foreach ($count_lab_cap as $key => $value) {
			$update_capacity = (new self)->UPDATE("UPDATE labs SET capacity=? WHERE id=?",[$value->lab_capacity,$value->center_lab_id]);

}
$count_center_cap = (new self)->SELECT("select SUM(b.capacity) as center_cap,a.center_id from center_lab a left join labs b on b.id=a.lab_id group by a.center_id ");
			echo '<pre>';print_r($count_center_cap);
			echo $count_center_cap[0]->center_cap;//die;
			foreach ($count_center_cap as $key1 => $value1) {
			$update_capacity = (new self)->UPDATE("UPDATE centers SET capacity=? WHERE id=?",[$value1->center_cap,$value1->center_id]);

	
		}
		return  "Import done"; //die;
	}
	}

	// function used for getting the user list 
	public static function get_user_failure_list_quizid($details){
		//echo 'hhh'; die;
		$model 		= new self;
		$sql="SELECT users.*,user_quizes.failure_time,user_quizes.started_time, TIMESTAMPDIFF(MINUTE,user_quizes.`failure_time`,NOW())
		as Minutes 
		from user_quizes left JOIN users on user_quizes.user_id=users.id where user_quizes.quiz_id =:quiz_id";

		if($details['is_failure']==1){
			$sql.=' having Minutes>2';
		}else{
			$sql.=' having Minutes<2';
		}
		// var_dump($sql);
		return $model->SELECT($sql,array('quiz_id'=>$details['quiz_id']));
		
	}
}

?>