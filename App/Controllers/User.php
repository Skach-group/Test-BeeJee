<?php defined('APPPATH') OR exit('No direct script access allowed');

namespace App\Controllers;

class User{
	
	protected $model;
	
	public function __construct(){
		$this->model = new \App\Models\Users();
	}	

	public function getFormAuthorization(){
		// Блок SEO страницы авторизации Пользовтеля
		$data['title'] = 'Форма авторизации';
		$data['description'] = 'Форма авторизации';
		$data['keywords'] = '';
		$data['author'] = 'Skachgroup';
		require_once '../App/Views/common/header.php';
		require_once '../App/Views/user/form_authorization.php';		
		require_once '../App/Views/common/html_end.php';		
	}

	
//======= Формируем страницу авторизации Пользователя	
	public function getUserAuthorization(){
		// Блок SEO страницы авторизации Пользовтеля
		$data['title'] = 'Форма авторизации';
		$data['description'] = 'Форма авторизации';
		$data['keywords'] = '';
		$data['author'] = 'Skachgroup';	
		$username = strip_tags(trim($_POST['username']));
		$password = trim($_POST['password']);
		$admin = $this->model->getAdmin('users', $username);
		if(empty($admin)){
			$data['error_authorization'] = 'Упс! У нас Пользователя с такими данными точно нет!';	
			require_once '../App/Views/common/header.php';
			require_once '../App/Views/user/form_authorization.php';		
			require_once '../App/Views/common/html_end.php';			
		}else{
			if(password_verify($password, $admin['password'])){
				$_SESSION['user_status'] = 'SuperAdmin';
				header('Location: https://beejee.skachgroup.ru');						
			}else{
				$data['error_authorization'] = 'Упс! С Паролем слегка лажанулись!';
				require_once '../App/Views/common/header.php';
				require_once '../App/Views/user/form_authorization.php';		
				require_once '../App/Views/common/html_end.php';						
			}				
		}
		
	}		
	
    function userLogout(){		
        unset($_SESSION['user_status']);
		unset($_SESSION['task_order_by']);
        session_destroy();
		header('Location: https://beejee.skachgroup.ru');	
    }			
	
}














