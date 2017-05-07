<?php 
/**
* 
*/
class Admins extends Model
{
// this function is used for login the admin
	public static function login($details)
	{
		//echo '<pre>';print_r($user);die;
		$model 	= new self;
		$user 	= $model->first("SELECT * FROM admins WHERE name=:name AND is_active='1'",array('name'=>$details['name']));
		return $user;
	}

	public static function update_login_time($user_id,$login_at)
{
	$model 			= 	new self;
	$update_user 	= 	$model->UPDATE("UPDATE admins SET login_at=? WHERE id=?",[$login_at,$user_id]);
	return $update_user;
}

// this function is used for authintication
	public static function auth()
	{
		if (isset($_SESSION['user'])) 
		{
			return json_decode($_SESSION['user']);
		}
		return false;
	}

// this function is used for admin magement list
	public static function admin_management()
	{
		$model 		= new self;
		$admins 	= $model->SELECT("SELECT * FROM admins WHERE is_active='1'");
		return $admins;
	}

// this function is used for getting user list
	public static function get_users_list()
	{
		$model 		= 	new self;
		$users 		= 	$model->SELECT("SELECT users.*,admins.name AS admin_name FROM users JOIN admins ON users.creator_id= admins.id WHERE status='1' ");
		if($users)
		{
			return  $users; die;
		}
		else
		{
			return 'null';
		}
	}

function randomDigits($length) // function used for random digit
{
	$numbers = range(1,9);
	$digits ='';
	shuffle($numbers);
	for($i = 1;$i <= $length;$i++)
		$digits .= $numbers[$i];
	return $digits;
}

// this function is used for user csv import
public static function post_users_csv($admin_id)
{
	if($_FILES['import_file']['name'])
	{
		$arrFileName = explode('.',$_FILES['import_file']['name']);
		if($arrFileName[1] == 'csv')
		{
			$handle = fopen($_FILES['import_file']['tmp_name'], "r");
			$row = 0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
			{
				$row++;
				if($row == 1){ $row++; continue; }
				$model 			= new self;
				$col0 			= $data[0];
				$col1 			= $data[1];
				$col2 			= $data[2];
				$col3 			= $data[3];
				$col4 			= $data[4];
				$col5 			= $data[5];
				$col6 			= $data[6];
				$col7 			= $data[7];
				$col8 			= $data[8];
				$col9 			= $data[9];
				$col10 			= $data[10];
				$col11 			= $data[11];
				$col12 			= $data[12];
				$alphabet 		= '123456789';
				$alphaLength 	= strlen($alphabet) - 1; //put the length -1 in cache = strlen($alphabet) - 1; //put the length -1 in cache
				$digits 		= self::randomDigits($alphaLength);
				$password 		= sha1($digits);
				$hash 			= $digits;
				$col13 			= $data[13]; 
				$col14 			= $data[14];//die;
				$col15 			= $data[15];
				$col16 			= $data[16];
			$model->INSERT([
				'quiz_id'		=>	$col1,
				'reg_num'		=>	$col2,
				'post'			=>	$col3,
				'reg_date'		=>	$col4,
				'name'			=>	$col5,
				'father_name'	=>	$col6,
				'gender' 		=>	$col7,
				'dob'			=>	$col8,
				'category'		=>	$col9,
				'roll_num'		=>	$col10,
				'roll_code'		=>	$col11,
				'reference_id'	=>	$col12,
				'password'      =>  $password,
				'hash_pwd' 		=>	$hash,
				'profile_pic'	=>	$col13.'.jpg',
				'sig_pic'		=>	$col14.'.jpg',
				'email' 		=> 	$col15,
				'mobile' 		=> 	$col16,
				'created_at' 	=>	time(),
				'language' 		=>	'1',
				'is_admin' 		=>	'0',
				'creator_id' 	=> 	$admin_id,
				'is_login'		=>	'0',
				'login_at'		=> 	'00-00-0000',
				'is_start'		=>	'0',
				'status'		=>	'1',
				'completed'		=>	'0'
				],'users');

			$model->INSERT([
				'user_id'       =>  $col0,
				'quiz_id'	   => $col1,
				'center_code'  => '',
				'language'     => 1,
				'count'        => 0,
				],'user_quizes');
			}
fclose($handle);
return "Import done";
}
}

}
// this function is used for user csv import
public static function post_users_csv_details($admin_id)
{
//function to remove multiple space with single space
	function remMultSpace($v)
	{
		$string2=preg_replace('!\s+!', ' ', $v);
		$string2=str_replace(' ', '_',$string2);
		return($string2);
	}

//table Name
	$tableName 	= "MyTable";
//database name
	$dbName 	= "exam";
	$conn 		= mysql_connect("localhost", "root", "") or die(mysql_error()); 
	mysql_select_db($dbName) or die(mysql_error()); 
//get the first row fields 
	$fields 		= "";
	$fieldsInsert 	= "";
	if (($handle 	= fopen("uploads/filename.csv", "r")) !== FALSE) 
	{
		if(($data 	= fgetcsv($handle, 10000, ",")) !== FALSE) 
		{
			$data 	= array_map("remMultSpace",$data);
// print_r($data);die; 
			$num = count($data);
			$fieldsInsert .= '(';
			for ($c=0; $c < $num; $c++) 
			{
				$fieldsInsert .=($c==0) ? '' : ', ';
				$fieldsInsert .="`".$data[$c]."`";
				$fields 	  .="`".$data[$c]."` text DEFAULT NULL,";
			}
			$fieldsInsert .= ')';
		}
//drop table if exist
		if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$tableName."'"))>=1) 
		{
			mysql_query('DROP TABLE IF EXISTS `'.$tableName.'`') or die(mysql_error());
		}
//create table
		$sql = "CREATE TABLE `".$tableName."` (
		`".$tableName."Id` int(100) unsigned NOT NULL AUTO_INCREMENT,
		".$fields."
		PRIMARY KEY (`".$tableName."Id`)
		) ";
		$retval = mysql_query( $sql, $conn );
		if(! $retval )
		{
			die('Could not create table: ' . mysql_error());
		}
		else 
		{
			while(($data = fgetcsv($handle, 10000, ",")) !== FALSE) 
			{
				$num 	 			= count($data);
				$fieldsInsertvalues	= "";
//get field values of each row
				for ($c=0; $c < $num; $c++) 
				{
					$fieldsInsertvalues .=($c==0) ? '(' : ', ';
					$fieldsInsertvalues .="'".$data[$c]."'";
				}
				$fieldsInsertvalues .= ')';
//insert the values to table
				$sql = "INSERT INTO ".$tableName." ".$fieldsInsert."  VALUES  ".$fieldsInsertvalues;
				mysql_query($sql,$conn);    
			}
			echo 'Table Created';   
		}
		fclose($handle);
	}
}

// this function is used for adding the admins
public static function add_admins($details)
{
	$model 			= 	new self;
	$name 			= 	$details['name'];
	$email 			= 	$details['email'];
	$mobile 		=	$details['mobile'];
	$password 		= 	crypt($details['password']);
	$current_date 	= date("Y-m-d H:i:s");
	return $model->insert(['name'=>$name,'email'=>$email,'mobile'=>$mobile,'password'=>$password,'created_at'=>$current_date,'updated_at'=>$current_date,'is_active'=>'1'],'admins');
}
// this function is getting the quiz list
public static function get_quiz_list($admin_id)
{
	$model=new self;
	$quizzes=$model->SELECT("SELECT * FROM quizzes a WHERE  a.status='1'");
	return $quizzes;
}
// this function is used for adding the users
public static function add_post_user($details,$admin_id)
{
	$model 			=	new self;
	$name 			= 	$details['name'];
	$roll_num 		= 	$details['roll_num'];
	$roll_code 		= 	$details['roll_code'];
	$reference_id 	= 	$details['reference_id'];
	$password 		= 	$details['password'];
	$hash_pwd 		= 	password_hash($password,PASSWORD_DEFAULT);
	$mobile 		= 	$details['mobile'];
	$email 			= 	$details['email'];
	$language 		= 	$details['language'];
	$quiz_id 		= 	$details['quiz_id'];
	$current_date 	= 	date("Y-m-d H:i:s");
	return $model->insert(['quiz_id'=>$quiz_id,'name'=>$name,'roll_num'=>$roll_num,'roll_code'=>$roll_code,'reference_id'=>$reference_id,'password'=>$password,'hash_pwd'=>$hash_pwd,'mobile'=>$mobile,'email'=>$email,'created_at'=>$current_date,'language'=>$language,'is_admin'=>'0','creator_id'=>$admin_id,'updated_at'=>$current_date,'login_at'=>$current_date],'users');
}
// this function is used for getting the single user
public static function get_single_user($user_id)
{
	$model 		= 	new self;
	$users 		= 	$model->SELECT("SELECT * FROM users where id=$user_id LIMIT 1");
	return $users;
}
// this function is used for getting the single admin
public static function get_single_admin($admin_id)
{
	$model 			= 	new self;
	$admins 		=	$model->SELECT("SELECT * FROM admins WHERE id=$admin_id LIMIT 1");
	return $admins;
}
// this function is used for updating the users
public static function updatesingle_user($details,$user_edit_id)
{
	$model 			=	new self;
	$profile_pic 	= 	'';
	$sig_pic 		=	'';
	$name 			= 	$details['name'];
	$roll_num 		= 	$details['roll_num'];
	$roll_code 		= 	$details['roll_code'];
	$reference_id 	= 	$details['reference_id'];
	$hash_pwd 		= 	$details['password'];

	$password 		= 	sha1($hash_pwd);
	$mobile 		= 	$details['mobile'];
	$email 			= 	$details['email'];
	$profile 	    = 	$details['profile'];
	$sign 			= 	$details['sign'];

	if(!empty($_FILES['profile_pic']))
	{
		$errors= array();
		$profile_pic = $_FILES['profile_pic']['name'];
		$file_size = $_FILES['profile_pic']['size'];
		$file_tmp  = $_FILES['profile_pic']['tmp_name'];
		$file_type = $_FILES['profile_pic']['type'];
		$file_ext=strtolower(end(explode('.',$_FILES['profile_pic']['name'])));

		$expensions= array("jpeg","JPEG","jpg","JPG","png","PNG");
		if($profile_pic!='')
		{
			if(in_array($file_ext,$expensions)=== false)
			{
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size >25000) 
			{
				$errors[]='File size must be less than 25 KB';
			}
			if(empty($errors)==true) 
			{
				move_uploaded_file($file_tmp,"uploads/photo/".$profile_pic);
				echo "Success";
			}
			else
			{	 
				print_r($errors); exit();
			}
		}
		else
		{
			$profile_pic = $details['profile'];
		}
	} 
	if(!empty($_FILES['sig_pic']))
	{
		$errors 		= array();
		$sig_pic 		= $_FILES['sig_pic']['name'];
		$file_size 		= $_FILES['sig_pic']['size'];
		$file_tmp 		= $_FILES['sig_pic']['tmp_name'];
		$file_type 		= $_FILES['sig_pic']['type'];
		$file_ext 		= strtolower(end(explode('.',$_FILES['sig_pic']['name']))); 
		$expensions 	= array("jpeg","JPEG","jpg","JPG","png","PNG");
		if($sig_pic!='')
		{
			if(in_array($file_ext,$expensions)=== false)
			{
				$errors[]="extension not allowed, please choose a JPEG or PNG file.";
			}
			if($file_size > 15000) 
			{
				$errors[]='File size must be less than 15 KB';
			}
			if(empty($errors)==true) 
			{
				move_uploaded_file($file_tmp,"uploads/sign/".$sig_pic);
				echo "Success";
			}
			else
			{	
				print_r($errors);  exit();
			}
		}
		else
		{
			$sig_pic = $details['sign'];
		}
	} 
	$language 		= 	$details['language'];
	$users 			= 	$model->UPDATE("UPDATE users SET name=?,roll_num=?,roll_code=?,reference_id=?,password=?,hash_pwd=?,profile_pic=?,sig_pic=?,mobile=?,email=?,language=? WHERE id=?",[$name,$roll_num,$roll_code,$reference_id,$password,$hash_pwd,$profile_pic,$sig_pic,$mobile,$email,$language,$user_edit_id]);
	return $users;
}
function getExtension($str)
{
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l 		= strlen($str) - $i;
	$ext 	= substr($str,$i+1,$l);
	return $ext;
}
//function for uploading profile pic
public static function upload_user_profile_pic($details) 
{
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	if(!empty($_FILES['profile_pic']))
	{
		$errors 		= array();
		define ("MAX_SIZE","100"); 
$uploaddir = "uploads/photo/"; //image upload directory
foreach ($_FILES['profile_pic']['name'] as $name => $value)
{
	$filename = stripslashes($_FILES['profile_pic']['name'][$name]);
	$size     = filesize($_FILES['profile_pic']['tmp_name'][$name]);
	$ext      = (new self)->getExtension($filename);
	$ext      = strtolower($ext);
	if(in_array($ext,$valid_formats))
	{
		if ($size < (MAX_SIZE*1024))
		{
			$image_name 	= $filename;
			$newname 		= $uploaddir.$image_name;
			$success 		= move_uploaded_file($_FILES['profile_pic']['tmp_name'][$name], $newname);
			$count1 		= 0;
			if ($success) 
			{
				$count1=1;
			}
			else
			{
				echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
			}

		}
		else
		{
			echo '<span class="imgList">You have exceeded the size limit!</span>';
		}
	}
	else
	{ 
		echo '<span class="imgList">Unknown extension!</span>';
	}
}
return $count1;    
}
}
//function used for uploading user signature pic
public static function upload_user_sign_pic($details)
{
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	if(!empty($_FILES['sign']))
	{
		$errors 		= array();
		define ("MAX_SIZE","15000"); 
$uploaddir = "uploads/sign/"; //image upload directory
foreach ($_FILES['sign']['name'] as $name => $value)
{
	$filename = stripslashes($_FILES['sign']['name'][$name]);
	$size     = filesize($_FILES['sign']['tmp_name'][$name]);
//get the extension of the file in a lower case format
	$ext = (new self)->getExtension($filename);
	$ext = strtolower($ext);
	if(in_array($ext,$valid_formats))
	{
		if ($size < (MAX_SIZE))
		{
			$image_name	= $filename;
			$newname	= $uploaddir.$image_name;
			$success 	= move_uploaded_file($_FILES['sign']['tmp_name'][$name], $newname);
			$count 		= 0;
			if($success) 
			{
				$count=1; 		
			}
			else
			{
				echo '<span class="imgList">You have exceeded the size limit! so moving unsuccessful! </span>';
			}
		}
		else
		{
			echo '<span class="imgList">You have exceeded the size limit!</span>';
		}
	}
	else
	{ 
		echo '<span class="imgList">Unknown extension!</span>';
	}
}
return $count;

}
}
// this function is used for deleting the users
public static function delete_user($id)
{
	$model 			=	new self;
	$users 			=	$model->UPDATE("UPDATE users SET status=?  WHERE id=?",['0',$id]);
	return $users;
}
//function used for getting the user details
public static function get_user_detail($user_id)
{
	$model =new self;
	$user_details=$model->SELECT("SELECT * from users where id=$user_id");
	return $user_details;
}
// this function is used for updating the users
public static function updatesingle_admin($details,$admin_id)
{
	$model 			= 	new self;
	$name 			= 	$details['name'];
	$mobile 		= 	$details['mobile'];
	$email 			= 	$details['email'];
	$password 		=	$details['password'];
	$admins 		= 	$model->UPDATE("UPDATE admins SET name=?,mobile=?,email=?,password=? WHERE id=?",[$name,$mobile,$email,$password,$admin_id]);
	return $admins;
}
// this function is used for deleting the admin
public static function delete_admin($admin_id)
{
	$model 			= 	new self;
	$admin          = $model->UPDATE("UPDATE admins set is_active=? WHERE id=?",['0',$admin_id]);
	return $admin;
}
// this function is used for logout
public static function logout()
{
	session_destroy();
}
//this function used for export user list
public static function exportUserList()
{
	$link 			= mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db 			= mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter 	= 0;
	$setMainHeader 	= '';
	$setData 		= '';
	$setExcelName 	= "download_excal_file";
	$setSql 		= "SELECT id,quiz_id,reg_num,post,reg_date,name,father_name,gender,dob,category,roll_num,roll_code,reference_id,hash_pwd,profile_pic,sig_pic,mobile,email,language FROM users";
	$setRec 		= mysql_query($setSql);
	$setCounter 	= mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) 
	{
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  
	{
		$rowLine = '';
		foreach($rec as $value)       
		{
			if(!isset($value) || $value == "")  
			{
				$value = "\t";
			}   
			else  
			{
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);
	if ($setData == "") 
	{
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";
}

// this function used for download the demo version for users
public static function demoUserCsv()
{
	$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db = mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter = 0;
	$setMainHeader = '';
	$setData = '';
	$setExcelName = "demo_user_csv";
	$setSql = "SELECT id,quiz_id,reg_num,post,reg_date,name,father_name,gender,dob,category,roll_num,roll_code,examination_center,lab_code,reference_id,profile_pic,sig_pic,mobile,email FROM users where id='1'";
	$setRec = mysql_query($setSql);
	$setCounter = mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) 
	{
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  
	{
		$rowLine = '';
		foreach($rec as $value)       
		{
			if(!isset($value) || $value == "")  
			{
				$value = "\t";
			}   
			else  
			{
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);
	if ($setData == "") 
	{
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";
}
// this function used for download the demo version for Questions
public static function demoQuestionCsv()
{
	$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db = mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter = 0;
	$setMainHeader = '';
	$setData = '';
	$setExcelName = "demo_question_csv";
	$setSql = "SELECT id,passage,is_passage,h_passage,question,h_question,quiz_id,A,B,C,D,answer,ansoption,h_A,h_B,h_C,h_D,h_answer,marks,neg_marks FROM questions WHERE id='1'";
	$setRec = mysql_query($setSql);
	$setCounter = mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) 
	{
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  
	{
		$rowLine = '';
		foreach($rec as $value)       
		{
			if(!isset($value) || $value == "")  
			{
				$value = "\t";
			}   
			else  
			{
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);
	if ($setData == "") 
	{
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";
}
// this function used for download the demo version for Answwer key
public static function demoAnswerCsv()
{
	$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db = mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter = 0;
	$setMainHeader = '';
	$setData = '';
	$setExcelName = "demo_answer_key";
	$setSql = "SELECT id,ansoption,marks,neg_marks FROM questions WHERE id='1'";
	$setRec = mysql_query($setSql);
	$setCounter = mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) 
	{
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  
	{
		$rowLine = '';
		foreach($rec as $value)       
		{
			if(!isset($value) || $value == "")  
			{
				$value = "\t";
			}   
			else  
			{
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);
	if ($setData == "") 
	{
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
echo ucwords($setMainHeader)."\n".$setData."\n";//TRUNCATE TABLE `yourTable` 
}
// this function used for trancate all tabels 
public static function truncateUsersTable()
{
	$model 			= new self;
	$model1 		= new self;
	$truncate 		= $model->sql("TRUNCATE TABLE users");
	$truncate_uq 	= $model1->sql("TRUNCATE TABLE user_quizes");
	$truncate_c 	= (new self)->sql("TRUNCATE TABLE centers");
	$truncate_l 	= (new self)->sql("TRUNCATE TABLE labs");
	$truncate_cl	= (new self)->sql("TRUNCATE TABLE center_lab");
	return $truncate;
}
// this function used for trancate all tabels user answer and user logs
public static function truncateUserAnswerTable()
{
	$model 			=	new self;
	$truncate 		= 	(new self)->sql("TRUNCATE TABLE user_answers");
	$model1 		=	new self;
	$truncate1 		= 	$model1->sql("TRUNCATE TABLE user_logs");
	return $truncate;
}

}
?>