<?php 
/**
* 
*/
class Labs extends Model
{
	// this function is used for login the admin
	public static function post_labs($details){
		$model        = new self;
		$name         = $details['name'];
    $code         = $details['code'];
		$capacity     = $details['capacity'];
		$quiz_id      = $details['quiz_id'];
		$center_id    = $details['center_id'];
		// return $model->insert(['lab_name'=>$name,'lab_code'=>$code,'capacity'=>$capacity,'quiz_id'=>$quiz_id,'center_id'=>$center_id],'labs');
    // $labs=$model->sql("INSERT INTO labs (name,code,capacity) values(:name,:code,:capacity)",array('name'=>$name,'code'=>$code,'capacity'=>$capacity));
		$labs=$model->insert(['name'=>$name,'code'=>$code,'capacity'=>$capacity,'is_active'=>1],'labs');
    // print_r($labs);die;
     $center_lab=(new self)->insert(['center_id'=>$center_id,'lab_id'=>$labs],'center_lab');
     return $labs;
	}
	public static function get_center_labes_list($details)
  {
      $model      =  new self;
      $center_id  =  $details['center_id'];
      $quiz_id    =  $details['quiz_id'];
      //$center_labes=$model->SELECT("SELECT l.id,l.lab_name,l.lab_code,l.capability as lab_capability,l.quiz_id,l.center_id,c.name as center_name,c.code as center_code,c.capability as center_capability from labs l left join centers c on l.center_id=c.id  WHERE center_id=$center_id AND quiz_id=$quiz_id");
      $center_labs=$model->SELECT("SELECT l.id,l.name as lab_name,l.code as lab_code,l.capacity as lab_capacity,cl.id,cl.lab_id,c.name as center_name from labs l left join center_lab cl on l.id=cl.lab_id left join centers c on c.id=$center_id where cl.center_id=$center_id AND l.is_active=1");
      if($center_labs)
      {
    return $center_labs;die;
      }
      else
      {
          return 'null';
      }
      
  }

   public static function get_user_center_lab_list($details)
    {
      $model =new self;
      $model1 =new self;
      $model2 =new self;
      $center_id=$details['center_id'];
      $quiz_id=$details['quiz_id'];
      $alloted=0;
      $center=$model1->SELECT("SELECT code,capability FROM centers WHERE id=?",[$center_id]);
      //echo '<pre>'; print_r($center); die;
      $center_capability = $center[0]->capability;
      $center_code = $center[0]->code;
      //echo $center_capability.'-'.$center_code;die; 

       $labs=$model1->SELECT("SELECT lab_code,capability FROM labs WHERE center_id=?",[$center_id]);
      //echo '<pre>'; print_r($center); die;
      $lab_capability = $labs[0]->capability;
      $lab_code = $labs[0]->lab_code;
      //echo $lab_capability.'-'.$lab_code;die; 


      $alloted=$model1->SELECT("SELECT count(id) as count FROM user_quizes   WHERE center_code=? AND lab_code=?",[$center_code,$lab_code])[0]->count;
      //echo '<pre>'; print_r($alloted); die;
      //$alloted_users=$model2->SELECT("SELECT user_id FROM user_quizes WHERE quiz_id=? AND center_code=?",[$quiz_id,$center_id]);
      $alloted_users=$model2->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_code=$center_code AND quiz_id=$quiz_id AND lab_code='".$lab_code."'")[0]->user_id;
          //$center_code=explode(',', $alloted_users);
      //echo '<pre>'; print_r($alloted_users); die;
      //echo $capability[0]->capability; die;
      $sql = "LIMIT ".($lab_capability-$alloted);
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$center_id WHERE u.quiz_id=$quiz_id AND uq.user_id NOT IN ($alloted_users)  $sql";
      //echo $sql; die;
      if($lab_capability==$alloted){
        return 'NULL'; die;
      }
      if($alloted_users){
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$center_code WHERE u.quiz_id=$quiz_id AND u.lab_code=$lab_code AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql");
        $q1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$center_code WHERE u.quiz_id=$quiz_id AND u.id NOT IN ($alloted_users) and u.alloted!=1 $sql";
        //echo $q1;die;
      return $users_centers; 
      }
      else{
        $users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.code=$center_code WHERE u.quiz_id=$quiz_id u.lab_code=$lab_code and u.alloted!=1 $sql");
        $q2 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$center_code WHERE u.quiz_id=$quiz_id and u.alloted!=1 $sql"; 
        //echo $q2;die;
      return $users_centers;
      if($users_centers){
        return $users_centers;die;
      }
      else
      {
        return 'NULL';
      }
      }

      
    }

  public static function get_allocated_labs_users($details)
  {

      $model            =   new self;
      $model1           =   new self;
      $center_lab_id    =   $details['center_lab_id'];
      $quiz_id          =   $details['quiz_id'];
      $center_id        =   $details['center_id'];
      $lab_id           =   $details['lab_id'];
      $center=$model1->SELECT("SELECT code,capacity FROM centers WHERE id=?",[$center_id]);
      $capacity     = $center[0]->capacity; //die;
      $code         =  $center[0]->code; //die;
      //echo $capacity.'-'.$code; die;

      $labs=$model1->SELECT("SELECT l.code,l.capacity,cl.center_id,cl.lab_id FROM labs l left join center_lab cl on l.id=cl.lab_id WHERE cl.center_id=? AND cl.lab_id=?",[$center_id,$lab_id]);
      $lab_capacity     = $labs[0]->capacity; //die;
      $lab_code         =  $labs[0]->code; //die;
      //echo $lab_capacity.'-'.$lab_code; die;
      //echo '<pre>';print_r($labs);die;


      $sql = "LIMIT ".$lab_capacity;
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where u.id!=uq.user_id  $sql";
      //echo $sql1; die;
      //$users_centers=$model->SELECT("SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join centers c on c.id=$center_id left join user_quizes uq on uq.user_id=u.id where uq.user_id!=''  $sql");

      $allocated_users = $model->SELECT("SELECT uq.*,u.name,u.reg_num,u.roll_num,c.name as center_name,cl.center_id,cl.lab_id, c.name as center_name,l.name as lab_name from user_quizes uq left join users u on uq.user_id=u.id left join center_lab cl on uq.center_lab_id=cl.id left join centers c on c.id=cl.center_id left join labs l on l.id=cl.lab_id  where uq.center_lab_id=$center_lab_id");
      if($allocated_users){
        return $allocated_users; die;
      } 
      else{
        return 'NULL';
      }
      
  }

  public static function get_un_allocated_labs_users($details)
  {

      $model            =   new self;
      $model1           =   new self;
      $center_lab_id    =   $details['center_lab_id'];
      $quiz_id          =   $details['quiz_id'];
      $center_id        =   $details['center_id'];
      $lab_id           =   $details['lab_id'];
      $un_allocated_users   = '';
      $center=$model1->SELECT("SELECT code,capacity FROM centers WHERE id=?",[$center_id]);
      $capacity     = $center[0]->capacity; //die;
      $code         =  $center[0]->code; //die;
      //echo $capacity.'-'.$code; die;

      $labs=$model1->SELECT("SELECT l.code,l.capacity,cl.center_id,cl.lab_id FROM labs l left join center_lab cl on l.id=cl.lab_id WHERE cl.center_id=? AND cl.lab_id=?",[$center_id,$lab_id]);
      $lab_capacity     = $labs[0]->capacity; //die;
      $lab_code         =  $labs[0]->code; //die;
      //echo $lab_capacity.'-'.$lab_code; die;
      //echo '<pre>';print_r($labs);die;

      $alloted=$model1->SELECT("SELECT count(id) as count FROM user_quizes   WHERE center_lab_id=?",[$center_lab_id])[0]->count;
      //echo '<pre>'; print_r($alloted); die;
      //$alloted_users=$model2->SELECT("SELECT user_id FROM user_quizes WHERE quiz_id=? AND center_code=?",[$quiz_id,$center_id]);
      $alloted_users=(new self)->SELECT("SELECT group_concat(user_id) as user_id from user_quizes
          WHERE center_lab_id=$center_lab_id AND quiz_id=$quiz_id")[0]->user_id;
      //echo '<pre>'; print_r($alloted_users); die;
    $sql = "LIMIT ".($lab_capacity-$alloted);
      //$sql1 = "SELECT u.*, c.name as center_name,c.code as center_code,uq.user_id from users u left join user_quizes uq on uq.user_id=u.id left join centers c on c.id=$center_id WHERE u.quiz_id=$quiz_id AND uq.user_id NOT IN ($alloted_users)  $sql";
      //echo $sql; die;
      if($lab_capacity==$alloted){
        return 'NULL'; die;
      }
      if($alloted_users){
        $un_allocated_users=$model->SELECT("SELECT uq.*,u.name,u.reg_num,u.roll_num,c.name as center_name,cl.center_id,cl.lab_id, c.name as center_name,l.name as lab_name from user_quizes uq left join users u on uq.user_id=u.id left join center_lab cl on uq.center_lab_id=cl.id left join centers c on c.id=cl.center_id left join labs l on l.id=cl.lab_id  where uq.center_lab_id=0 AND uq.user_id NOT IN ($alloted_users) and u.alloted!=1 $sql");
        $q1 = "SELECT uq.*,u.name,u.reg_num,u.roll_num,c.name as center_name,cl.center_id,cl.lab_id, c.name as center_name,l.name as lab_name from user_quizes uq left join users u on uq.user_id=u.id left join center_lab cl on uq.center_lab_id=cl.id left join centers c on c.id=cl.center_id left join labs l on l.id=cl.lab_id  where uq.center_lab_id=$center_lab_id NOT IN ($alloted_users) and u.alloted!=1 $sql";
        //echo $q1;die;
      return $un_allocated_users; 
      }
     /* else
      {
        $un_allocated_users=$model->SELECT("SELECT uq.*,u.name,u.reg_num,u.roll_num,c.name as center_name,cl.center_id,cl.lab_id, c.name as center_name,l.name as lab_name from user_quizes uq left join users u on uq.user_id=u.id left join center_lab cl on uq.center_lab_id=cl.id left join centers c on c.id=cl.center_id left join labs l on l.id=cl.lab_id  where uq.center_lab_id=0 and u.alloted!=1 $sql");
        $q2 = "SELECT uq.*,u.name,u.reg_num,u.roll_num,c.name as center_name,cl.center_id,cl.lab_id, c.name as center_name,l.name as lab_name from user_quizes uq left join users u on uq.user_id=u.id left join center_lab cl on uq.center_lab_id=cl.id left join centers c on c.id=cl.center_id left join labs l on l.id=cl.lab_id  where uq.center_lab_id=$center_lab_id and u.alloted!=1 $sql"; 
        echo $q2;die;
        return $un_allocated_users;
      }*/
      if($un_allocated_users){
        return $un_allocated_users;die;
      }
      else
      {
        return 'NULL';
      }

      
  }
  public static function get_single_lab($lab_id)
  {
    $model            =   new self;
    $lab = $model->SELECT("SELECT * from labs where id=$lab_id");
    if($lab){
        return $lab; die;
      } 
      else{
        return 'NULL';
      }

  }

  public static function update_lab($details,$lab_id)
  {
    $model=new self;
    $center_labs=$model->UPDATE("UPDATE labs SET name=?,code=?,capacity=? WHERE id=?",[$details['name'],$details['code'],$details['capacity'],$lab_id]);
    return $center_labs;
  }
}
	?>