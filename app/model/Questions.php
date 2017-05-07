<?php 
/**
* 
*/
class Questions extends Model
{
	// this function is used for adding the question
	public static function add_question($quiz_id,$details)
	{
		$model 					=	new self;
		$passage				= 	$details['passage'];
		$h_passage				= 	$details['h_passage'];
		$question				= 	$details['question'];
		$h_question				= 	$details['h_question'];
		$A 						= 	$details['A'];
		$B 						= 	$details['B'];
		$C 						= 	$details['C'];
		$D 						= 	$details['D'];
		$answer 				= 	$details['answer'];
		$h_A 					= 	$details['h_A'];
		$h_B 					= 	$details['h_B'];
		$h_C 					= 	$details['h_C'];
		$h_D 					= 	$details['h_D'];
		$h_answer 				= 	$details['h_answer'];

		if($answer=='1'){
			$answer = $details['A'];
		}else if($answer=='2'){
			$answer = $details['B'];
		}else if($answer=='3'){
			$answer = $details['C'];
		}else if($answer=='4'){
			$answer = $details['D'];
		}

		if($h_answer=='1'){
			$h_answer = $details['h_A'];
		}else if($h_answer=='2'){
			$h_answer = $details['h_B'];
		}else if($h_answer=='3'){
			$h_answer = $details['h_C'];
		}else if($h_answer=='4'){
			$h_answer = $details['h_D'];
		}

		return $model->insert([
			'passage' 				=> $passage,
			'h_passage' 			=> $h_passage,
			'question' 				=> $question,
			'h_question' 			=> $h_question,
			'quiz_id'				=> $quiz_id,
			'A'						=> $A,
			'B'						=> $B,
			'C'						=> $C,
			'D'						=> $D,
			'answer'   				=> $answer,
			'h_A'					=> $h_A,
			'h_B'					=> $h_B,
			'h_C'					=> $h_C,
			'h_D'					=> $h_D,
			'h_answer'   			=> $h_answer],
			'questions');
	}
	// this function is used for showing question list
	public static function question_list($quiz_id)
	{
		$model=new self;
		$questions=$model->SELECT("SELECT * FROM questions WHERE quiz_id=$quiz_id AND is_active='1'" );
		if($questions)
		{
			return $questions; die;
		}
		else
		{
			return 'null';
		}
	}
	// this function is used for fetching the question
	public static function get_single_ques($question_id)
	{
		$model=new self;
		$questions=$model->SELECT("SELECT * FROM questions WHERE id=$question_id LIMIT 1");
		return $questions;
	}
	// this function is used for update the single question
	public static function updatesingle_question($question_id,$details)
	{
		$model 					= new self;
		$passage				= $details['passage'];
		$h_passage				= $details['h_passage'];
		$question				= $details['question'];
		$h_question 			= $details['h_question'];
		$A 						= $details['A'];
		$B 						= $details['B'];
		$C 						= $details['C'];
		$D 						= $details['D'];
		$answer 				= $details['answer'];
		$h_A              		= $details['h_A'];
		$h_B              		= $details['h_B'];
		$h_C              		= $details['h_C'];
		$h_D              		= $details['h_D'];
		$h_answer               = $details['h_answer'];  

		if($answer=='1'){
			$answer = $details['A'];
		}else if($answer=='2'){
			$answer = $details['B'];
		}else if($answer=='3'){
			$answer = $details['C'];
		}else if($answer=='4'){
			$answer = $details['D'];
		}

		if($h_answer=='1'){
			$h_answer = $details['h_A'];
		}else if($h_answer=='2'){
			$h_answer = $details['h_B'];
		}else if($h_answer=='3'){
			$h_answer = $details['h_C'];
		}else if($h_answer=='4'){
			$h_answer = $details['h_D'];
		}
		$questions=$model->UPDATE("UPDATE questions SET passage=?,h_passage=?,question=?,h_question=?,A=?,B=?,C=?,D=?,answer=?,h_A=?,h_B=?,h_C=?,h_D=?,h_answer=? WHERE id=?",[$passage,$h_passage,$question,$h_question,$A,$B,$C,$D,$answer,$h_A,$h_B,$h_C,$h_D,$h_answer,$question_id]);
		return $questions;
	}
	// this function is used for deleting the question
	public static function delete_question($question_id)
	{
		$model=new self;
		//$questions=$model->DELETE("DELETE from questions WHERE  id=?",[$question_id]);
		$questions=$model->UPDATE("UPDATE questions SET is_active=? WHERE id=?",['0',$question_id]);
		return $questions;
	} 
	// this function is used for csv upload
	public static function post_csv_file1($quiz_id)
	{
		if($_FILES['import_file']['name']){
			$arrFileName = explode('.',$_FILES['import_file']['name']);
			if($arrFileName[1] == 'csv'){

				$handle = fopen($_FILES['import_file']['tmp_name'], "r");
				$row = 0;
        		while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
					$row++;
					if($row == 1){ $row++; continue; }
					$model=new self;
					$col0 = $data[0];
					$col1 = $data[1];
					$col2 = $data[2];
					$col3 = $data[3];

					$col4 = $data[4];
					$col5 = $data[5];
					$col7 = $data[7];
				    $col8 = $data[8];
					$col9 = $data[9]; 
					$col10 = $data[10];
				    $col11 = $data[11];//answer option
				    $col12 = $data[12];

				    $col13 = $data[13];
					$col14 = $data[14];
				    $col15 = $data[15];
					$col16 = $data[16]; 
					$col17 = $data[17];
					$col18 = $data[18];
					$col19 = $data[19];
				   

					$model->INSERT(['passage'=>$col1,'is_passage'=>$col2,'h_passage'=>$col3,'question'=>$col4,'h_question'=>$col5,'quiz_id'=>$quiz_id,'A'=>$col7,'B'=>$col8,'C'=>$col9,'D'=>$col10,'answer'=>$col11,'ansoption'=>$col12,'h_A'=>$col13,'h_B'=>$col14,'h_C'=>$col15,'h_D'=>$col16,'h_answer'=>$col17,'marks'=>$col18,'neg_marks'=>$col19,'is_active'=>'1'],'questions');
					
				}
				fclose($handle);
				return "Import done";
			}
		}
	}


	// this function is used for csv update
	public static function post_update_answer_key($quiz_id)
	{
		if($_FILES['import_file']['name']){
			$arrFileName = explode('.',$_FILES['import_file']['name']);
			if($arrFileName[1] == 'csv'){

				$handle = fopen($_FILES['import_file']['tmp_name'], "r");
				$row = 0;
        		while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
					$row++;
					if($row == 1){ $row++; continue; }
					$model=new self;
					$col0 = $data[0]; // question ID
				 	$col1 = $data[1]; // answer key
					$col2 = $data[2]; //  marks
					$col3 = $data[3];  // neg_marks
					$model->Update("UPDATE questions SET ansoption=:ansoption,marks=:marks,neg_marks=:neg_marks WHERE id=:id",array('ansoption'=>$col1,'marks'=>$col2,'neg_marks'=>$col3,'id'=>$col0));
					
				}
				fclose($handle);
				return "updation done";
			}
		}
	}
	//this function used for demo answer key
	public static function demoAnswerKeyCsv()
	{
		$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
			$db = mysql_select_db('exam', $link) or die("Couldn't select database");
			$setCounter = 0;
			$setMainHeader = '';
			$setData = '';
			$setExcelName = "demoAnswerKeyCsv";
			$setSql = "SELECT id,ansoption,marks,neg_marks FROM questions where id='1'";
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
//  this function is used for showing question bank
	public static function questionBank_list(){
		$model=new self;
			$questions=$model->SELECT("SELECT * FROM questions WHERE  is_active='1'" );
		if($questions)
		{
			return $questions; die;
		}
		else
		{
			return 'null';
		}
	}
// this function is used for export the questions
	public static function exportToExl_2($quiz_id){
    		$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
			$db = mysql_select_db('exam', $link) or die("Couldn't select database");
			$setCounter = 0;
			$setMainHeader = '';
			$setData = '';
			$setExcelName = "download_question_csv";
			$setSql = "SELECT * FROM questions WHERE quiz_id=$quiz_id";
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
// this function is used for get the exam id 
    public static function getExamID($quiz_id){
    	$model= new self;
    	$exam_id=$model->SELECT(" SELECT exam_id from quizzes where id=$quiz_id LIMIT 0,1");
    	return $exam_id; 
    }
}