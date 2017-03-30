<?php
/**
* 
*/
class Helper
{
	
	public static function pre($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		
	}
	public static function unique($id){
		$replace=array('a','b','c','d','e','f','g','h','i','j','k');
		$time=time().$id;
		$time[0]=$replace[0];
		$time[1]=$replace[1];
		$time[1]=$replace[1];
		$time[5]=$replace[5];
		echo $time;
	}
	public static function make_set(Array $details, Array $escape=array()){
		$set='';
		foreach ($details as $key => $value) {
			if (!in_array($key, $escape)) {
				$set.=$key.'=:'.$key.',';
			}
		}
		return rtrim($set,',');
	}
	public static function sorting(){
		$sort=Input::get('sort');
		$GET=$_GET;
		unset($GET['sort']);
		$self_url=count($GET)?'/artist?'.http_build_query($GET).'&sort=':'/artist'.'?sort=';
		switch ($sort) {
			case 'trending':
				return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_0">Name</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
				break;
			case 'name_0':
				return '<option value="">--Sort By--</option>
		                <option selected value="'.$self_url.'name_1">Name &#8593;</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
            case 'name_1':
            	return '<option value="">--Sort By--</option>
		                <option selected value="'.$self_url.'name_0">Name &#8595;</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
            case 'rating_0':
            	return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_1">Name</option>
		                <option selected value="'.$self_url.'rating_1">Creation Time &#8593;</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
            	break;
            case 'rating_1':
            	return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_1">Name</option>
		                <option selected value="'.$self_url.'rating_0">Creation Time &#8595;</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
            	break;
            case 'fan_0':
            	return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_1">Name</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option selected value="'.$self_url.'fan_1">Approvel(n)</option>';
            	break;
            case 'fan_1':
            	return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_1">Name</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option selected value="'.$self_url.'fan_0">Approvel(y)</option>';
            	break;
            
			default:
				if (!$details['search'] && !$sort) {
					return '<option value="">--Sort By--</option>
		                <option value="'.$self_url.'name_0">Name</option>
		                <option value="'.$self_url.'rating_1">Creation Time</option>
		                <option value="'.$self_url.'fan_1">Approvel</option>';
				}
				return '<option value="">--Sort By--</option>
		                <option  value="'.$self_url.'name_0">Name</option>
		                <option  value="'.$self_url.'rating_1">Creation Time</option>
		                <option  value="'.$self_url.'fan_1">Approvel</option>';
				break;
		}
        return $option;         
	}
	
	public static function get_limit(){
		$limit=Input::get('limit');
	    $limit=(int)$limit?(int)$limit:PER_PAGE_LIMIT;
	    return $limit;
	}

	public static function getKey(Array $arr,$key='id'){
	    $result=array();
		foreach ($arr as $keys => $value) {
			$result[]=$value->{$key};
		}
		return $result;
	}
	public static function isAjax(){
		$header=apache_request_headers();
		if (@$header['X-Requested-With']=='XMLHttpRequest') {
			return true;
		}
		return false;
	}

	public static function editQuery(Array $details,Array $editable,$table,$query=''){
		foreach ($details as $key => $value) {
			if(!in_array($key, $editable) or strlen($value)==0){
				unset($details["$key"]);
			}
		}
		$sql="UPDATE $table  SET ";
		foreach ($details as $key => $value) {
			$sql.=$key."=:".$key.",";
		}
		$sql=rtrim($sql,',');
		$sql.=$query;
		$arr=array();
		$arr['details']=$details;
		$arr['sql']=$sql;
		return $arr;
	}
	public static function getArrayFromObject($data){
		$arr=array();
		foreach ($data as $key => $value) {
			foreach ($value as $key => $value) {
				$arr[]=$value;
			}
		}
		return $arr;

	}

	public static function pagination($count,$per_page=10){
		if (!$count) {
			return ;
		}
		$pages=ceil($count/$per_page);
		$page=(int)Input::get('page')>0?(int)Input::get('page'):1;
		$get=Input::get();
		unset($get['page']);

		$e=count($get)?"?":"";

		$url=parse_url("$_SERVER[REQUEST_URI]",PHP_URL_PATH);
		echo '<div class="pagination clearfix">';
		if ($pages>=2) {
			echo '<a href="'.$url.$e.http_build_query($get).'">First</a>&nbsp;';
		}
		if (($pages<=5 && $pages>1 && $page<=$pages) ||($pages>=6 && $page<=3)) {
			for ($i=1; $i <=min($pages,5); $i++) {
				echo self::getUrl($i);
			}
		} elseif ($pages>=5 && $page>=4 && $page<=$pages && $pages-$page>=2) {
			$p1=$page-2;
			$p2=$page-1;
			$n1=$page+1;
			$n2=$page+2;  
			echo self::getUrl($p1);
			echo self::getUrl($p2);
			echo self::getUrl($page);
			echo self::getUrl($n1);
			echo self::getUrl($n2);

		}elseif ($pages>=6 && $pages-$page<2) {

			for ($i=$pages-4; $i<=$pages ; $i++) { 
				echo self::getUrl($i);
			}

		}
		$get['page']=$pages;
		if ($pages>=2) {
			echo '<a href="'.$url.'?'.http_build_query($get).'">Last</a>';
		}
		echo '</div>';
	}
	private static function getUrl($page){
		$url=parse_url("$_SERVER[REQUEST_URI]",PHP_URL_PATH);
		$get=$_GET;
		@$cur=(int)$get['page']>0?(int)$get['page']:'1';
		unset($get['page']);
		if ($page!='1') {
			$get['page']=$page;
		}
		if ($page==$cur) {
			return '<strong>'.$page.'</strong>&nbsp;';
		}
		return '<a href="'.$url.'?'.http_build_query($get).'">'.$page.'</a>&nbsp;';
	}

	public static function getNav($val=0){
		@$section=min(self::getKey(Auth::getSections()));
		if ($val>0 && $section!=1) {
			$section=$val;
		}
		switch ($section) {
			case '1':
				$name='general/navigation';
				break;
			case '2':
				$name='artist/navigation';
				break;
			case '3':
				$name='business/navigation';
				break;
			default:
				$name='general/navigation';
				break;
		}
		return $name;
	}

	public static function zomato_id($url){
		if ($url=='') {
			return '';
		}
		$details['url']=strtolower(parse_url($url)['path']);
		$model=new model;
		$zomato=$model->first("SELECT * FROM zomato WHERE url=:url",$details);
		if ($zomato) {
			return $zomato->zomato_id;
		}

		$result=file_get_contents($url);
		preg_match_all('/(window.RES_ID)(.*)/', $result, $matches);
		$details['zomato_id']=rtrim(trim(str_replace('"', '', explode('=', $matches[2][0])[1])),';');
		$model->insert($details,'zomato');
		return $details['zomato_id'];

	}

	public static function zomato_url($id){
		if (!$id) {
			return false;
		}
		$model=new model;
		$zomato=$model->first("SELECT * FROM zomato WHERE zomato_id=?",array($id));
		if ($zomato) {
			return 'https://zomato.com'.$zomato->url;
		}
		return false;
	}
	public static function activate($artist){
		$artist=(array)$artist;
		$fields=array(
			'name','profile_pic','brief_intro','mobile','art_category_id','artist_category_id','genres',
			'city','event_type',
			'gender','dob','linguage','specializations','travel_city','performance_start'
			);
		foreach ($fields as $key => $value){
			if(empty($artist[$value])){
				return false;
			}
		}
		return true;
	}

	public static function uniqueMobile($mobile,$id,$type){
		$db=DB::getInstance();
		$sql="SELECT id,'1' AS type FROM `artists`  WHERE mobile=:mobile LIMIT 1
			UNION 
			SELECT id,'2' AS type FROM `business`  WHERE mobile=:mobile LIMIT 1
			UNION
			SELECT id,'3' AS type FROM `users`  WHERE mobile=:mobile LIMIT 1";

		$sth=$db->prepare($sql);
		$sth->execute(array('mobile'=>$mobile));
		if (!$sth->rowCount()) {
			return true;
		}
		$user=$sth->fetch();
		if ($user->id===$id && $user->type==$type) {
			return true;
		}
		return false;
	}


	public static function formatDate($params = array())
        {
            if(isset($params['date']))
            {
                return date('d-M-Y', strtotime($params['date']));
            }
        }
    public static function encodeSlug($string,$id){
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return strtolower(preg_replace('/-{2,}/', '-', $slug.'-'.$id));
	}

	public static function decodeSlug($string){
		return end(explode('-', $string));
	}

	public static function fiscal($data){
		
		$c=date("Y");
		$result=array('fy1'=>0,'fy2'=>0,'fy3'=>0,'fy4'=>0,'total'=>0);
		/*if(empty($data)){
			$result=array('fy1'=>'N/A','fy2'=>'N/A','fy3'=>'N/A','fy4'=>'N/A','total'=>'N/A');
			return $result;
		}*/
		$arr1=array('4','5','6','7','8','9','10','11','12');
		$arr2=array('1','2','3');

		foreach ($data as $key => $value) {
			if(($value->y==$c and  in_array($value->m, $arr1))     or ($value->y==($c+1) and  in_array($value->m, $arr2))){
				$result['fy1']+=$value->count;
			}
			if(($value->y==($c-1) and  in_array($value->m, $arr1)) or ($value->y==($c) and  in_array($value->m, $arr2))){
				$result['fy2']+=$value->count;
			}
			if(($value->y==($c-2) and  in_array($value->m, $arr1)) or ($value->y==($c-1) and  in_array($value->m, $arr2))){
				$result['fy3']+=$value->count;
			}
			if(($value->y==($c-3) and  in_array($value->m, $arr1)) or ($value->y==($c-2) and  in_array($value->m, $arr2))){
				$result['fy4']+=$value->count;
			}
			$result['total']+=$value->count;
		}
		return $result;
	}
	public static function annual($data,$year){
		$result=array('q1'=>0,'q2'=>0,'q3'=>0,'q4'=>0,'total'=>0);
		/*if(empty($data)){
			$result=array('q1'=>'N/A','q2'=>'N/A','q3'=>'N/A','q4'=>'N/A','total'=>'N/A');
			return $result;
		}*/
		$q1=array('4','5','6');
		$q2=array('7','8','9');
		$q3=array('10','11','12');
		$q4=array('1','2','3');
		foreach ($data as $key => $value) {
			if(in_array($value->m,$q1) and $value->y==$year){
				$result['q1']+=$value->count;
			}
			if(in_array($value->m,$q2) and $value->y==$year){
				$result['q2']+=$value->count;
			}
			if(in_array($value->m,$q3) and $value->y==$year){
				$result['q3']+=$value->count;
			}
			if(in_array($value->m,$q4) and $value->y==($year+1)){
				$result['q4']+=$value->count;
			}
		}
		$result['total']=$result['q1']+$result['q2']+$result['q3']+$result['q4'];
		return $result;
	}

	public static function date($data,$date){

		$result=array('q1'=>0,'q2'=>0,'q3'=>0,'q4'=>0,'total'=>0);
		/*if(empty($data)){
			$result=array('q1'=>'N/A','q2'=>'N/A','q3'=>'N/A','q4'=>'N/A','total'=>'N/A');
			return $result;
		}*/
		$m1=date('m', strtotime(date('Y-m-d',strtotime($date))." - 0 month"));
		$m2=date('m', strtotime(date('Y-m-d',strtotime($date))." - 1 month"));
		$m3=date('m', strtotime(date('Y-m-d',strtotime($date))." - 2 month"));
		$m4=date('m', strtotime(date('Y-m-d',strtotime($date))." - 3 month"));

		//Helper::pre($data);

		foreach ($data as $key => $value) {
			if($date==$value->date){
				$result['total']+=$value->count;
			}
			if(strtotime($date)>=strtotime($value->date) and $value->month==$m1){
				$result['q1']+=$value->count;
			}
			if($value->month==$m2){
				$result['q2']+=$value->count;
			}
			if($value->month==$m3){
				$result['q3']+=$value->count;
			}
			if($value->month==$m4){
				$result['q4']+=$value->count;
			}
		}
		
		return $result;
	
	}

	public static function can_feature($artist){
		return $artist->is_approved==1;
	}
}
?>