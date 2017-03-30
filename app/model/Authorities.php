<?php 
/**
* 
*/
class Authorities extends Model
{
	// this function is used for  showing authority list
	public static function authority_list($admin_id){
		$model=new self;
		$authorities=$model->SELECT("SELECT * FROM authorities WHERE admin_id= $admin_id AND is_active='1' ORDER BY id DESC");
		if($authorities)
		{
			return $authorities; die;
		}
		else
		{
			return 'null';
		}
	}
	// this function is used for showing single authority list
	public static function getAuthorities(){
		$model=new self;
		$authorities=$model->SELECT("SELECT * FROM authorities");
		return $authorities;
	}
	// this function is used for adding authority
	public static function add_authority($details,$admin_id)
	{
		$model=new self;
		$name = $details['name'];
		$current_date = date("Y-m-d H:i:s");
		return $model->insert(['admin_id'=>$admin_id,'name'=>$name,'created_at'=>$current_date,'updated_at'=>$current_date],'authorities');
	}
	// this function is used for getting single authority
	public static function get_single_authority($authority_id){
		$model=new self;
		$authorities=$model->SELECT("SELECT * FROM authorities WHERE id=$authority_id LIMIT 1");
		return $authorities;
	}
	// this function is used for updating the uthority
	public static function updatesingle_authority($details,$authority_id){
		$model=new self;
		$authority_name = $details['name'];
		$authority=$model->UPDATE("UPDATE authorities SET name=?  WHERE id=?",[$authority_name,$authority_id]);
		return $authority;
	}
	// this function is used for deleting the authority
	public static function delete_authority($authority_id){
		$model=new self;
		//$authority=$model->DELETE("DELETE FROM authorities WHERE id=?",[$authority_id]);
		$authority=$model->UPDATE("UPDATE authorities SET is_active=?  WHERE id=?",['0',$authority_id]);
		return $authority;
	}
}
?>