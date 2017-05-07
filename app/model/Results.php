<?php 
/**
* 
*/
class Results extends Model
{

//function used for output fro csv 

	public static function outputCSV($data,$file_name = 'file.csv') {
# output headers so that the file is downloaded rather than displayed
		header("Content-Type: text/csv");
		header("Content-Disposition: attachment; filename=$file_name");
# Disable caching - HTTP 1.1
		header("Cache-Control: no-cache, no-store, must-revalidate");
# Disable caching - HTTP 1.0
		header("Pragma: no-cache");
# Disable caching - Proxies
		header("Expires: 0");

# Start the ouput
		$output = fopen("php://output", "w");

# Then loop through the rows
		foreach ($data as $row) {
# Add the rows to the body
fputcsv($output, $row); // here you can change delimiter/enclosure
}
# Close the stream off
fclose($output);
}
// function used for export the user result list
public static function exportToExl_2($id){
	$link 			= mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db 			= mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter 	= 0;
	$setMainHeader 	= '';
	$setData 		= '';
	$setExcelName 	= "download_users_result";
	if($id==1){
		$sql="order by ua.ques_id asc";
	}
	if($id==2){
		$sql="order by ua.ques_num asc";
	}
	$setSql = "SELECT ua.user_id,u.reg_num,u.name,u.gender,u.dob,u.category,u.roll_num,
	u.roll_code,u.reference_id,IF(u.is_login=1, 'P', 'A') AS Present,
	sum(if((ua.ansoption=q.ansoption and ua.ansoption!=''),1,0)) as Correct,
	sum(if((ua.ansoption!=q.ansoption and ua.ansoption!=''),1,0)) as InCorrect,
	sum(if(ua.ansoption='',1,0)) as Blank,
	sum(if(ua.ansoption=q.ansoption,1,if(ua.ansoption='',0,-0.25))) as Score,
	GROUP_CONCAT(if(ua.ansoption='','x',ua.ansoption) ".$sql.")  AS Answer_options 
	FROM `user_answers` ua left join questions q on ua.ques_id=q.id 
	left join users u on u.id=ua.user_id
	where q.quiz_id=1 group by ua.user_id";
//echo $setSql; die;
	$setRec 	= mysql_query($setSql);
	$setCounter = mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) {
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  {
		$rowLine = '';
//echo '<pre>'; print_r($rec); die;
		foreach($rec as $value)       {
			if(!isset($value) || $value == "")  {
				$value = "\t";
			}   else  {
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);

	if ($setData == "") {
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";
}
//function used for get the user result list 2
public static function post_result_list_csv(){
	$link 			= mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db 			= mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter 	= 0;
	$setMainHeader 	= '';
	$setData 		= '';
	$setExcelName 	= "download_users_result_list";
	$setSql = "SELECT ua.user_id,u.reg_num,u.name,u.gender,u.dob,u.category,u.roll_num,u.roll_code,u.reference_id,IF(u.is_login=1, 'P', 'A') AS Present,sum(if(ua.ansoption=q.ansoption,1,0)) as Correct,sum(if(ua.ansoption!=q.ansoption,1,0)) as InCorrect,sum(if(ua.ansoption='',1,0)) as Blank,sum(if(ua.ansoption=q.ansoption,1,0)) as Score FROM `user_answers` ua left join questions q on ua.ques_id=q.id 
	cross join users u on u.id=ua.user_id
	where q.quiz_id=1 group by ua.user_id";
	$setRec = mysql_query($setSql);
	$setCounter = mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) {
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  {
		$rowLine = '';
		foreach($rec as $value)       {
			if(!isset($value) || $value == "")  {
				$value = "\t";
			}   else  {
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);
	if ($setData == "") {
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";
}
// function used for view result for the user
public static function view_result($user_id)
{
	$model 		= new self;
	$user 		= $model->SELECT("SELECT a.user_id,sum(a.ansoption!= '') as answered,sum(a.visited) as visited,c.name,c.roll_num,c.roll_code,c.reference_id,sum(if(a.ansoption=b.ansoption,1,0)) as score FROM `user_answers` a left join questions b on a.ques_id=b.id 
		left join users c on c.id=a.user_id
		where b.quiz_id=1 and a.user_id=$user_id group by a.user_id");
	return $user;
}
// funtion used for showing result list
public function result_list()
{
	$model      = new self;
	$results    = $model->SELECT("SELECT a.user_id,c.name,c.roll_num,c.roll_code,c.reference_id,sum(if(a.ansoption=b.ansoption,1,0)) as score FROM `user_answers` a left join questions b on a.ques_id=b.id 
		left join users c on c.id=a.user_id
		where b.quiz_id=1 group by a.user_id" );
	if($results)
	{
		return $results; die;
	}
	else
	{
		return 'null';
	}
}
// function used for delete the result
public function delete_result($result_id){
	$model =new self;
	$results=$model->Delete("DELETE FROM user_answers WHERE id=?",[$result_id]);
	return $results;
}
// function used for showing user detail list
public static function user_details_list($user_id){
// return $user_id;die;
	$model  = new self;
	$results= $model->Select("SELECT a.ques_id,a.opt1,a.opt2,a.opt3,a.opt4,a.answer,a.ansoption,a.mark,a.visited,b.question,b.ansoption as correct_option,b.marks FROM `user_answers` a left join questions b on a.ques_id=b.id WHERE a.user_id=$user_id");
	return $results;
}
// function used for export the result list for users
public static function exportResultList($user_id){
	$link 				= mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
	$db 			= mysql_select_db('exam', $link) or die("Couldn't select database");
	$setCounter 	= 0;
	$setMainHeader 	= '';
	$setData 		= '';
	$setExcelName 	= "download_resultlistuser_file";
	$setSql 		= "SELECT u.id,u.reg_num,u.name,u.father_name,u.gender,u.dob,u.category,u.roll_num,u.roll_code,u.mobile,u.email,a.ques_id,q.question,q.marks,a.opt1,a.opt2,a.opt3,a.opt4,a.ansoption as answered,q.ansoption as correct_option,a.mark as marked,a.visited FROM `users` u left join user_answers a on u.id=a.user_id left join questions q on a.ques_id=q.id WHERE a.user_id=$user_id";
	$setRec 		= mysql_query($setSql);
	$setCounter 	= mysql_num_fields($setRec);
	for ($i = 0; $i < $setCounter; $i++) {
		$setMainHeader .= mysql_field_name($setRec, $i)."\t";
	}
	while($rec = mysql_fetch_row($setRec))  {
		$rowLine = '';
		foreach($rec as $value)       {
			if(!isset($value) || $value == "")  {
				$value = "\t";
			}   else  {
				$value = strip_tags(str_replace('"', '""', $value));
				$value = '"' . $value . '"' . "\t";
			}
			$rowLine .= $value;
		}
		$setData .= trim($rowLine)."\n";
	}
	$setData = str_replace("\r", "", $setData);

	if ($setData == "") {
		$setData = "\nno matching records found\n";
	}
	$setCounter = mysql_num_fields($setRec);
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=".$setExcelName."_Reoprt.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	echo ucwords($setMainHeader)."\n".$setData."\n";

}
}


?>