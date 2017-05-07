<?php
 /**
* 
*/
class Centers extends Model
{
  //function used for get center list
	   public static function get_center()
	   {
	       $model        =   new self;
	       $centers      =   $model->SELECT("SELECT * from centers WHERE is_active=1");
        if($centers)
        {
          return $centers;die;
        }
        else
        {
          return 'NULL';
        }
	    }
// function used for get allocated center
	   public static function get_allocated_canter($quiz_id)
	   {
	       $model              =     new self;
	       $allocated_centers  = $model->SELECT("SELECT * from quiz_centers WHERE quiz_id=$quiz_id");
		     return $allocated_centers;
	   }
     //function used for post centres 
	public static function post_center_11($details)
	{
          $model    = new self;
          $model1   = new self;
          $centers  = $details['centers'];
          $quiz_id  = $details['quiz_id'];
          foreach ($centers as $key => $value) {
          	$allocated_centers= $model->sql("INSERT  IGNORE INTO quiz_centers (quiz_id,center_id) values(:quiz_id,:center_id)",array('quiz_id'=> $quiz_id,'center_id'=>$value));   
      }
          return $allocated_centers;       
	}
  //function used for post the centers
	public static function post_center($details)
	{
          $model              = new self;
          $model1             = new self;
          $allocated_centers  = '';
          $quiz_id            = $details['quiz_id'];
          $center_code        = $model1->SELECT("SELECT group_concat(center_id) as center_id from quiz_centers WHERE quiz_id=$quiz_id group by quiz_id")[0]->center_id;
          $center_code        = explode(',', $center_code); 
          $centers            = $details['centers'];
          $result1            = array_diff($center_code,$centers);
          $result2            = array_diff($centers,$center_code); 
	        foreach($result1 as $key1 => $value1)
	        {  	
	          $allocated_centers= $model->DELETE("DELETE FROM quiz_centers WHERE quiz_id=$quiz_id AND center_id=$value1");
	        }
      		foreach ($result2 as $key2 => $value2) 
	        {
      			$allocated_centers= $model->sql("INSERT INTO quiz_centers (quiz_id,center_id) values(:quiz_id,:center_id)",array('quiz_id'=> $quiz_id,'center_id'=>$value2));
      		}
          return $allocated_centers;         
	}
// function used for un post center lab to the user
    public static function un_post_center_lab_to_users($details)
  {
          $model              = new self;
          $model1             = new self;
          $allocated_centers  = '';
          $allocated_users    = '';
          $center_id          = $details['center_id'];
          $quiz_id            = $details['quiz_id'];
          $center_lab_id      = $details['center_lab_id'];
          $lab_id             = $details['lab_id'];
          $allocated_centers  = '';
          $center_code=$model1->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_lab_id=$center_lab_id AND quiz_id=$quiz_id")[0]->user_id;
          $center_code       = explode(',', $center_code);
          $users             = $details['users'];
          $result1           = array_diff($center_code,$users);
          $result2           = array_diff($users,$center_code);
          foreach($result1 as $key1 => $value1)
          {   
            $allocated_users = $model->UPDATE("UPDATE user_quizes SET center_lab_id='0' WHERE user_id=$value1 and quiz_id=$quiz_id");
            $update_user     = $model->UPDATE("UPDATE users SET alloted=0 WHERE id=$value1 and quiz_id=$quiz_id");
          }
          return $allocated_users;       
  }
// function used for post the center lab to users
   public static function post_center_lab_to_users($details)
  {
          $model             = new self;
          $model1            = new self;
          $allocated_centers = '';
          $center_id         = $details['center_id'];
          $quiz_id           = $details['quiz_id'];
          $center_lab_id     = $details['center_lab_id'];
          $lab_id            = $details['lab_id'];
          $center_code       = $model1->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_lab_id=$center_lab_id AND quiz_id=$quiz_id")[0]->user_id;
          $center_code      = explode(',', $center_code);
          $users            = $details['users'];
          $result1          = array_diff($center_code,$users);
          $result2          = array_diff($users,$center_code);
          foreach($result1 as $key1 => $value1)
          {    
            $allocated_users= $model->UPDATE("UPDATE user_quizes SET center_lab_id=$center_lab_id WHERE user_id=$value1 and quiz_id=$quiz_id");
            $update_user    = $model->UPDATE("UPDATE users SET alloted=1 WHERE id=$value1 and quiz_id=$quiz_id");
          }
          foreach ($result2 as $key2 => $value2) 
          {
            $allocated_users= $model->UPDATE("UPDATE user_quizes SET center_lab_id=$center_lab_id WHERE user_id=$value2 and quiz_id=$quiz_id");
            $update_user    = $model->UPDATE("UPDATE users SET alloted=1 WHERE id=".$value2." and quiz_id=".$quiz_id."");
          }
          return $allocated_users;       
  }
  // function used for add center
	public static function add_center($details)
	{
        $model      = new self;
		    $name       = $details['name'];
        $code       = $details['code'];
		    $capacity   = $details['capacity'];
		    $center     = $model->insert(['name'=>$name,'code'=>$code,'capacity'=>$capacity],'centers');
        return $center;
	}
  //function used for get center list
	public static function get_center_list($quiz_id)
	{
      $model     = new self;
      $centers   = $model->SELECT("SELECT * from centers WHERE id=$quiz_id");
      if($centers)
      {
		return $centers;die;
      }
      else
      {
          return 'null';
      }   
	}
  // function used for update center
	public static function updatesingle_center($details,$center_id)
	{
		$model        = new self;
		$name 	      = $details['name'];
    $code         = $details['code'];
		$capacity 	  = $details['capacity'];
		$centers      = $model->UPDATE("UPDATE centers SET name=?,code=?,capacity=? WHERE id=?",[$name,$code,$capacity,$center_id]);
		return $centers;
	}
  // function used for delete center
    public static function delete_center($center_id)
    {
    	$model          =  new self;
      $del_center_lab = (new self)->DELETE("DELETE FROM `center_lab` WHERE center_id=?",[$center_id]);
		  $centers        = $model->UPDATE("UPDATE centers SET is_active=? WHERE id=?",['0',$center_id]);
		return $centers;
    }
//function used to get allocated users
    public static function get_allocated_users($details)
  {
      $model             = new self;
      $model1            = new self;
      $center_id         = $details['center_id'];
      $quiz_id           = $details['quiz_id'];
      $center            = $model1->SELECT("SELECT code,capacity FROM centers WHERE id=?",[$center_id]);
      $capacity          = $center[0]->capacity; 
      $code              =  $center[0]->code; 
      $sql               = "LIMIT ".$capacity;
      $users_centers     = $model->SELECT("SELECT uq.*,u.name,u.reg_num,c.name as center_name,c.code as center_code from user_quizes uq left join users u on uq.user_id=u.id left join centers c on uq.center_code=c.code where center_code=$code");
      return $users_centers;
  }
  //function used for get allocated users
  public static function get_allocated_users11($details)
  {
      $model         = new self;
      $model1        = new self;
      $center_id     = $details['center_id'];
      $quiz_id       = $details['quiz_id'];
      $center        = $model1->SELECT("SELECT code,capacity FROM centers WHERE id=?",[$center_id]);
      $capacity      = $center[0]->capacity;
      $code          =  $center[0]->code;
      $sql           = "LIMIT ".$capacity;
      $users_centers = $model->SELECT("SELECT uq.*,u.name,u.reg_num,c.name as center_name,c.code as center_code from user_quizes uq left join users u on uq.user_id=u.id left join centers c on uq.center_code=c.code where uq.center_code=$code and uq.quiz_id=$quiz_id");
      if($users_centers)
      {
      return $users_centers; die;
      }
      else
      {
      return 'null';
      }
  }
// function used for get user center list
    public static function get_user_center_list($details)
    {
    	$model       = new self;
      $model1      = new self;
    	$model2      = new self;
      $center_id   = $details['center_id'];
      $quiz_id     = $details['quiz_id'];
      $alloted     = 0;
      $center      = $model1->SELECT("SELECT code,capacity FROM centers WHERE id=?",[$center_id]);
      $capacity    = $center[0]->capacity;
      $code        = $center[0]->code;
      $alloted     = $model1->SELECT("SELECT count(id) as count FROM user_quizes   WHERE center_code=?",[$code])[0]->count;
      $alloted_users=$model2->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$code AND quiz_id=$quiz_id")[0]->user_id;
      $sql          = "LIMIT ".($capacity-$alloted);
      if($capacity==$alloted){
        return 'NULL'; die;
      }
      if($alloted_users){
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$code WHERE u.quiz_id=$quiz_id AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql");
        $q1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$code WHERE u.quiz_id=$quiz_id AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql";
      return $users_centers; 
      }
      else{
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$code WHERE u.quiz_id=$quiz_id and u.alloted!=1 $sql");
        $q2 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$code WHERE u.quiz_id=$quiz_id and u.alloted!=1 $sql"; 
      if($users_centers){
        return $users_centers;die;
      }
      else
      {
        return 'NULL';
      }
      }  	
    }
}
?>