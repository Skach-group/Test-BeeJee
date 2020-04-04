<?php defined('APPPATH') OR exit('No direct script access allowed'); 

namespace App\Models;

class Users{

	protected $db;

	public function __construct(){
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		$this->db = mysqli_connect('helpinge.mysql.tools', 'helpinge_beejee', '1Gx8mJ5m9AKm', 'helpinge_beejee');
		$this->db->set_charset("utf8");
		if(!$this->db) {
			print "Ошибка соединения с базой данных ";
			exit;
		}
	}

	public function getAdmin($table = null, $username = null){
		$query = "SELECT * FROM `".$table."` WHERE `name` = '".$username."' ";
		$result = mysqli_query($this->db, $query);
		return $result->fetch_array(MYSQLI_ASSOC);
		mysql_close($this->db);
	}	


}