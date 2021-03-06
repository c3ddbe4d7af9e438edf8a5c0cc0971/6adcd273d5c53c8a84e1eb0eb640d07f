<?php 
/**
* 
*/
class AdminAuth
{
	public function __construct(){
		if (isset($_SESSION['user'])) {
			header('location:/admindashboard');
			die;
		}
	}
	/******* Function for calling the login screen for admin panel**********/
	public function getAdminLogin(){
		return View::make('adminLogin');
	}
	/******* End Function for calling the login screen for admin panel**********/

	/******* Function for Authenticate the Administrator **********/
	public function postAdminLogin()
	{
		$details=Input::post(['name','password']);
		if ($user=Admins::login($details)) 
		{
			$_SESSION['user']=json_encode($user);
		}
		else
		{
			header('location:/admin?error=1');
			die;
		}
		header('location:/dashboard');
	}
	/******* End Function for Authenticate the Administrator **********/

	/******* Function for Logout the Administrator **********/
	public function adminLogout()
	{

		 Auth::logout(); // logout user
       return Redirect::to('/'); //redirect back to login
		
			
		}

		/*******End  Function for Logout the Administrator **********/
}
?>