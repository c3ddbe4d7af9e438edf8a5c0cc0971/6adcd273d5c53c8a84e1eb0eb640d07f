<?php
/**
* 
*/

class UserLogs extends Model
{
	public static function get_user_log_by_qid($question_id)
	{
	   $model=new self;
	   $user_logs= $model->SELECT("SELECT ul.ques_id,ul.user_id,ul.ansoption,ul.quiz_id,ul.mark,ul.visited,ul.updated_at,u.name FROM user_logs ul left join users u on ul.user_id=u.id where ques_id=$question_id ");
		 return $user_logs;

	}

	public static function get_user_list_quizid($quiz_id){
		$model =new self;
		$user_list=$model->SELECT("SELECT * from users where quiz_id=$quiz_id");
		if($user_list)
		{
			return $user_list;
		}
		else
		{
			return 'null';
		}
		

	}
	public static function get_user_detail_list($user_id)
	{
       $model =new self;
		$user_list_details=$model->SELECT("SELECT ul.*,u.name,u.is_login,q.question from user_logs ul left join users u on ul.user_id=u.id left join questions q on ul.ques_id=q.id where ul.user_id=$user_id");
		// return $user_list_details;
		if($user_list_details)
		{
			return $user_list_details; die;
		}
		else
		{
			return 'null';
		}
	}
	public static function get_quiz_user_log($user_id)
	{
       $model =new self;
		$quiz_user_log=$model->SELECT("SELECT ul.*,u.name,u.is_login,q.question from user_logs ul left join users u on ul.user_id=u.id left join questions q on ul.ques_id=q.id where ul.user_id=$user_id group by u.name");
	    return $quiz_user_log;
	}
	public static function get_user_detail($user_id)
	{
       $model =new self;
		$user_details=$model->SELECT("SELECT * from users where id=$user_id");
	    return $user_details;
	}

	public static function update_user_status($details){
		$model =new self;
		$user_id = $details['id']; //die;
		$status = $details['status']; //die;
		$status_details=$model->UPDATE("UPDATE users SET is_login=$status WHERE id=$user_id");
	    return $status_details;
	}
}



?>