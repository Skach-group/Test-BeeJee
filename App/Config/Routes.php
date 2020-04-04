<?php defined('APPPATH') OR exit('No direct script access allowed');  

namespace App\Config;

class Routes{

	public $routes = array(
		'([0-9]+)' => '\App\Controllers\Tasks::getTasksList/$1',
		'add-new-task' => '\App\Controllers\Tasks::addNewTask',
		'edit-task/([0-9]+)' => '\App\Controllers\Tasks::getFormEditTask/$1',
		'save-edit-task/([0-9]+)' => '\App\Controllers\Tasks::saveEditTask/$1',		
		'delete-task/([0-9]+)' => '\App\Controllers\Tasks::deleteTask/$1',		
		'ajax-task-order-by' => '\App\Controllers\Tasks::ajaxOrderTask',
		'ajax-update-status-task' => '\App\Controllers\Tasks::ajaxUpdateStatusTask',
		'get-form-authorization' => '\App\Controllers\User::getFormAuthorization',
		'user-authorization' => '\App\Controllers\User::getUserAuthorization/$1',
		'user-logout' => '\App\Controllers\User::userLogout',
		'error-404' => '\App\Controllers\Error::getPageError404'
	);
}
