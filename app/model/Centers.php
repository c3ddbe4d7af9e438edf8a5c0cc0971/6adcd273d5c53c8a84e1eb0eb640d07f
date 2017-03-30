<?php
 
 /**
* 
*/

class Centers extends Model
{
	public static function get_center()
	{
	   $model=new self;
	   $centers= $model->SELECT("SELECT * from centers WHERE is_active=1");
     if($centers){
      return $centers;die;
     }
     else
     {
      return 'NULL';
     }
		
	}

	public static function get_allocated_canter($quiz_id)
	{
	   $model=new self;
	   $allocated_centers= $model->SELECT("SELECT * from quiz_centers WHERE quiz_id=$quiz_id");
		return $allocated_centers;
	}

  

	public static function post_center_11($details)
	{
          $model =new self;
          $model1 =new self;
         
          $centers=$details['centers'];
          echo '<pre>';print_r($centers);//die;
          $quiz_id=$details['quiz_id'];

          foreach ($centers as $key => $value) {
          	//echo $value;
          	$allocated_centers= $model->sql("INSERT  IGNORE INTO quiz_centers (quiz_id,center_id) values(:quiz_id,:center_id)",array('quiz_id'=> $quiz_id,'center_id'=>$value));
       
      }
          return $allocated_centers;
          
	}


	public static function post_center($details)
	{
          $model =new self;
          $model1 =new self;
          $allocated_centers = '';
          $quiz_id=$details['quiz_id'];
          // $allocated_centers = '';
          $center_code=$model1->SELECT("SELECT group_concat(center_id) as center_id from quiz_centers WHERE quiz_id=$quiz_id group by quiz_id")[0]->center_id;
          $center_code=explode(',', $center_code);
            // $array = objectToArray( $center_code );
           // $result = $center_code->array();
          // $result = $center_code->array();
          echo '<pre>';print_r($center_code);//die;
           
          $centers=$details['centers'];
          echo '<pre>';print_r($centers);//die;
          $result1=array_diff($center_code,$centers);
          echo '<pre>'; print_r($result1); //die;

          $result2=array_diff($centers,$center_code);
          echo '<pre>'; print_r($result2); //die;
          
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

  public static function post_center_to_users_bck($details)
  {
          $model =new self;
          $model1 =new self;
          $allocated_centers = '';
          $center_id=$details['center_id'];
          $quiz_id=$details['quiz_id'];
          //echo '<pre>';print_r($center_id);die;
          //echo 'called'; die;
          // $allocated_centers = '';
          $center_code=$model1->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$center_id AND quiz_id=$quiz_id")[0]->user_id;
          $center_code=explode(',', $center_code);
            // $array = objectToArray( $center_code );
           // $result = $center_code->array();
          // $result = $center_code->array();
          echo '<pre>';print_r($center_code);//die;
           
          $users=$details['users'];
          echo '<pre>';print_r($users);//die;
          $result1=array_diff($center_code,$users);
          echo '<pre>'; print_r($result1); //die;

          $result2=array_diff($users,$center_code);
          echo '<pre>'; print_r($result2); //die;
          
          foreach($result1 as $key1 => $value1)
          {
              
            $allocated_users= $model->DELETE("DELETE FROM user_quizes WHERE user_id=$value1 and quiz_id=$quiz_id");
          }
         
          foreach ($result2 as $key2 => $value2) 
          {
            $allocated_users= $model->sql("INSERT INTO user_quizes (user_id,quiz_id,center_code,language,count) values(:user_id,:quiz_id,:center_code,:language,:count)",array('user_id'=>$value2,'quiz_id'=> $quiz_id,'center_code'=>$center_id,'language'=>1,'count'=>0));
          }
      
        
          return $allocated_users;
          
          
  }

    public static function un_post_center_to_users($details)
  {
          $model =new self;
          $model1 =new self;
          $allocated_centers = '';
          $center_id=$details['center_id'];
          $quiz_id=$details['quiz_id'];
          //echo '<pre>';print_r($center_id);die;
          //echo 'called'; die;
          // $allocated_centers = '';
          $center_code=$model1->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$center_id AND quiz_id=$quiz_id")[0]->user_id;
          $center_code=explode(',', $center_code);
            // $array = objectToArray( $center_code );
           // $result = $center_code->array();
          // $result = $center_code->array();
          //echo '<pre>';print_r($center_code);//die;
           
          $users=$details['users'];
          //echo '<pre>';print_r($users);//die;
          $result1=array_diff($center_code,$users);
          //echo '<pre>'; print_r($result1); //die;

          //$result2=array_diff($users,$center_code);
          //echo '<pre>'; print_r($result2); //die;
          
          foreach($result1 as $key1 => $value1)
          {
              
            $allocated_users= $model->UPDATE("UPDATE user_quizes SET center_code='0' WHERE user_id=$value1 and quiz_id=$quiz_id");
          }
         
          /*foreach ($result2 as $key2 => $value2) 
          {
            $allocated_users= $model->sql("INSERT INTO user_quizes (user_id,quiz_id,center_code,language,count) values(:user_id,:quiz_id,:center_code,:language,:count)",array('user_id'=>$value2,'quiz_id'=> $quiz_id,'center_code'=>$center_id,'language'=>1,'count'=>0));
          }*/
      
        
          return $allocated_users;
          
          
  }

   public static function post_center_to_users($details)
  {
          $model =new self;
          $model1 =new self;
          $allocated_centers = '';
          $center_id=$details['center_id'];
          $quiz_id=$details['quiz_id'];
          //echo '<pre>';print_r($center_id);die;
          //echo 'called'; die;
          $allocated_centers = '';
          $center_code=$model1->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$center_id AND quiz_id=$quiz_id")[0]->user_id;
          $center_code=explode(',', $center_code);
          // $array = objectToArray( $center_code );
          // $result = $center_code->array();
          // $result = $center_code->array();
          //echo 'center alloted'.'<br>'.'<pre>';print_r($center_code);//die;
           
          $users=$details['users'];
         // echo 'users checked'.'<br>'.'<pre>';print_r($users);//die;
          $result1=array_diff($center_code,$users);
          //echo '<pre>'; print_r($result1); //die;

          $result2=array_diff($users,$center_code);
          //echo '<pre>'; print_r($result2); //die;
          
          foreach($result1 as $key1 => $value1)
          {
              
            $allocated_users= $model->UPDATE("UPDATE user_quizes SET center_code=$center_id WHERE user_id=$value1 and quiz_id=$quiz_id");
            //echo "UPDATE users SET roll_code=1 WHERE id=".$value1." and quiz_id=".$quiz_id."";//die;
            $update_user= $model->UPDATE("UPDATE users SET alloted=1 WHERE id=$value1 and quiz_id=$quiz_id");
          }
         
          foreach ($result2 as $key2 => $value2) 
          {
            $allocated_users= $model->UPDATE("UPDATE user_quizes SET center_code=$center_id WHERE user_id=$value2 and quiz_id=$quiz_id");
            //echo "UPDATE users SET roll_code=1 WHERE id=".$value2." and quiz_id=".$quiz_id."";//die;
            $update_user= $model->UPDATE("UPDATE users SET alloted=1 WHERE id=".$value2." and quiz_id=".$quiz_id."");
          }
      
        
          return $allocated_users;
          
          
  }
	public static function add_center($details)
	{
        $model=new self;
		    $name = $details['name'];
        $code = $details['code'];
		    $capacity = $details['capacity'];
        
		    $center=$model->insert(['name'=>$name,'code'=>$code,'capacity'=>$capacity],'centers');
        //$center_lab=(new self)->insert(['center_id'=>$center,'lab_id'=>'0'],'center_lab');
        return $center;
	}
	public static function get_center_list($quiz_id)
	{
      $model=new self;
      $centers=$model->SELECT("SELECT * from centers WHERE id=$quiz_id");
      if($centers)
      {
		return $centers;die;
      }
      else
      {
          return 'null';
      }
      
	}
	public static function updatesingle_center($details,$center_id)
	{
		$model=new self;
		$name 	      = $details['name'];
    $code         = $details['code'];
		$capacity 	= $details['capacity'];
		$centers=$model->UPDATE("UPDATE centers SET name=?,code=?,capacity=? WHERE id=?",[$name,$code,$capacity,$center_id]);
		return $centers;
	}
    public static function delete_center($center_id)
    {
    	$model=new self;
		//$examination=$model->DELETE("DELETE FROM examinations WHERE id=?",[$exam_id]);
      $del_center_lab=(new self)->DELETE("DELETE FROM `center_lab` WHERE center_id=?",[$center_id]);
		$centers=$model->UPDATE("UPDATE centers SET is_active=? WHERE id=?",['0',$center_id]);

		return $centers;
    }

    public static function get_allocated_users($details)
  {
    //  $model=new self;
    //  $allocated_users= $model->SELECT("SELECT * from user_quizes WHERE center_code=$center_id");
    // return $allocated_users;

      $model =new self;
      $model1 =new self;
      $center_id=$details['center_id'];
      $quiz_id=$details['quiz_id'];
      $center=$model1->SELECT("SELECT code,capability FROM centers WHERE id=?",[$center_id]);
      //return $capability; //die;
      $capability   = $center[0]->capability; //die;
      $code         =  $center[0]->code; //die;
      //echo $capability.'-'.$code; die;
      $sql = "LIMIT ".$capability;
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where u.id!=uq.user_id  $sql";
      //echo $sql1; die;
      //$users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where uq.user_id!=''  $sql");
      $users_centers = $model->SELECT("SELECT uq.*,u.name,u.reg_num,c.name as center_name,c.code as center_code from user_quizes uq left join users u on uq.user_id=u.id left join centers c on uq.center_code=c.code where center_code=$code");
      return $users_centers;
  }
  public static function get_allocated_users11($details)
  {
    //  $model=new self;
    //  $allocated_users= $model->SELECT("SELECT * from user_quizes WHERE center_code=$center_id");
    // return $allocated_users;

      $model =new self;
      $model1 =new self;
      $center_id=$details['center_id'];
      $quiz_id=$details['quiz_id'];
      $center=$model1->SELECT("SELECT code,capability FROM centers WHERE id=?",[$center_id]);
      //return $capability; //die;
      $capability   = $center[0]->capability; //die;
      $code         =  $center[0]->code; //die;
      //echo $capability.'-'.$code; die;
      $sql = "LIMIT ".$capability;
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where u.id!=uq.user_id  $sql";
      //echo $sql1; die;
      //$users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where uq.user_id!=''  $sql");
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

    public static function get_user_center_list($details)
    {
    	$model =new self;
      $model1 =new self;
    	$model2 =new self;
      $center_id=$details['center_id'];
      $quiz_id=$details['quiz_id'];
      $alloted=0;
      $center=$model1->SELECT("SELECT code,capability FROM centers WHERE id=?",[$center_id]);
      //echo '<pre>'; print_r($center); die;
      $capability = $center[0]->capability;
      $code = $center[0]->code;
      //echo $capability.'-'.$code;die; 
      $alloted=$model1->SELECT("SELECT count(id) as count FROM user_quizes   WHERE center_code=?",[$code])[0]->count;
      //echo '<pre>'; print_r($alloted); die;
    	//$alloted_users=$model2->SELECT("SELECT user_id FROM user_quizes WHERE quiz_id=? AND center_code=?",[$quiz_id,$center_id]);
      $alloted_users=$model2->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$code AND quiz_id=$quiz_id")[0]->user_id;
          //$center_code=explode(',', $alloted_users);
      //echo '<pre>'; print_r($alloted_users); die;
      //echo $capability[0]->capability; die;
      $sql = "LIMIT ".($capability-$alloted);
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$center_id WHERE u.quiz_id=$quiz_id AND uq.user_id NOT IN ($alloted_users)  $sql";
      //echo $sql; die;
      if($capability==$alloted){
        return 'NULL'; die;
      }
      if($alloted_users){
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$code WHERE u.quiz_id=$quiz_id AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql");
        $q1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$code WHERE u.quiz_id=$quiz_id AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql";
        //echo $qi;die;
      return $users_centers; 
      }
      else{
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$code WHERE u.quiz_id=$quiz_id and u.alloted!=1 $sql");
        $q2 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$code WHERE u.quiz_id=$quiz_id and u.alloted!=1 $sql"; 
        //echo $q2;die;
      // return $users_centers;
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