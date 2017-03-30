<?php 
/**
* 
*/
class Instructions extends Model
{
	// this function is used for examination list
	public static function get_instructions($quiz_id){
		$model=new self;
		$instructions=$model->SELECT("SELECT * FROM instructions WHERE quiz_id=$quiz_id AND is_active='1' ORDER BY quiz_id DESC");
		if($instructions)
		{
			return $instructions; die;
		}
		else
		{
			return 'null';
		}
	}
	public static function add_instruction($details)
	{
     	$model=new self;
		$instruction = $details['instruction'];
		$instruction_h = $details['instruction_h'];
		$type = $details['type'];
		$quiz_id = $details['quiz_id'];
		
		$current_date = date("Y-m-d H:i:s");
		return $model->insert(['instruction'=>$instruction,'instruction_h'=>$instruction_h,'quiz_id'=>$quiz_id,'type'=>$type,'created_at'=>$current_date,'updated_at'=>$current_date,'is_active'=>'1'],'instructions');
	}
	public static function get_instruction_list($instruction_id)
	{
		$model=new self;
		$instructions=$model->SELECT("SELECT * FROM instructions WHERE id=$instruction_id");
		return $instructions;
	}
	public static function updatesingle_instruction($details){
		$model=new self;
		$instruction = $details['instruction'];
		$instruction_h = $details['instruction_h'];
		$type = $details['type'];
		$quiz_id = $details['quiz_id'];
		$instruction_id = $details['instruction_id'];
		
		$current_date = date("Y-m-d H:i:s");
		$instructions=$model->UPDATE("UPDATE instructions SET instruction=?,instruction_h=?,type=? WHERE id=?",[$instruction,$instruction_h,$type,$instruction_id]);
		return $instructions;
	}
	public static function delete_instruction($instruction_id){
		$model=new self;
		//$users=$model->DELETE("DELETE FROM users WHERE id=?",[$user_edit_id]);
		$instructions=$model->UPDATE("UPDATE instructions SET is_active=?  WHERE id=?",['0',$instruction_id]);
		return $instructions;
	}
	public static function post_csv_instructions($quiz_id)
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

					$model->INSERT(['instruction'=>$col1,'instruction_h'=>$col2,'type'=>$col3,'quiz_id'=>$quiz_id,'created_at' =>time(),'updated_at'=>time(),'is_active'=>'1'],'instructions');
					
				}
				fclose($handle);
				return "Import done";
			}
		}
	}

	public static function demoInstructionCsv()
	{
		$link = mysql_connect('localhost', 'root', '') or die("Couldn't make connection.");
			$db = mysql_select_db('exam', $link) or die("Couldn't select database");
			$setCounter = 0;
			$setMainHeader = '';
			$setData = '';
			$setExcelName = "demo_instruction_csv";
			$setSql = "SELECT id,instruction,instruction_h,quiz_id,type FROM instructions where id='1'";
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
}
?>