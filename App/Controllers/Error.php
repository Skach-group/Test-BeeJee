<?php defined('APPPATH') OR exit('No direct script access allowed');

namespace App\Controllers;

class Error{

	public function getPageError404(){
		require_once '../App/Views/common/header.php';
		require_once '../App/Views/common/error404.php';		
		require_once '../App/Views/common/html_end.php';	
	}	
	
}