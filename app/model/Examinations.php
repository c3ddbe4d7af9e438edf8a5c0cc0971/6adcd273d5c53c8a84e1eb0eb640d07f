<?php 
/**
* 
*/
class Examinations extends Model
{
// this function is used for examination list
	public static function examination_list($authority_id)
	{
		$model=new self;
		$examinations=$model->SELECT("SELECT * FROM examinations WHERE authority_id=$authority_id AND is_active='1' ORDER BY authority_id DESC");
		if($examinations)
		{
			return $examinations; die;
		}
		else
		{
			return 'null';
		}
	}
//  this functionis used for total examination
	public static function total_examination($authority_id)
	{
		$model=new self;
		$examinations=$model->SELECT("SELECT COUNT(*) AS total FROM examinations WHERE authority_id=$authority_id AND is_active='1'");
		if($examinations)
		{
			return $examinations; die;
		}
		else
		{
			return 'null';
		}
	}
// this function is used for adding the examination
	public static function add_examination($details,$authority_id)
	{
		$model 				=	new self;
		$examination_name 	= 	$details['examination_name'];
		$examination_desc 	= 	$details['examination_desc'];
		$current_date 		= 	date("Y-m-d H:i:s");
		return $model->insert(['authority_id'=>$authority_id,'examination'=>$examination_name,'description'=>$examination_desc,'created_at'=>$current_date,'updated_at'=>$current_date],'examinations');
	}
// this function is used for getting single examination
	public static  function get_single_examination($exam_id)
	{
		$model 				= 	new self;
		$examinations 		= 	$model->SELECT("SELECT * FROM examinations WHERE id=$exam_id LIMIT 1");
		return $examinations;
	}
// this function is used for updating the examination
	public static function updatesingle_examination($details,$exam_id)
	{
		$model 				= 	new self;
		$examination_name 	= $details['examination_name'];
		$examination_desc 	= $details['examination_desc'];
		$examination=$model->UPDATE("UPDATE examinations SET examination=?,description=? WHERE id=?",[$examination_name,$examination_desc,$exam_id]);
		return $examination;
	}
//  this function is used for deleting the examination
	public static function delete_examination($exam_id)
	{
		$model 			=	new self;
		$examination 	=	$model->UPDATE("UPDATE examinations SET is_active=? WHERE id=?",['0',$exam_id]);
		return $examination;
	}
// this function used to get t he authority id
	public static function getAuthorityID($exam_id)
	{
		$model 			= 	new self;
		$authority_id 	=	$model->SELECT("SELECT authority_id FROM examinations WHERE id=$exam_id limit 0,1");
		return $authority_id;
	}
}
?>