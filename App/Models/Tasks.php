<?php defined('APPPATH') OR exit('No direct script access allowed'); 

namespace App\Models;

class Tasks{

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

	public function getTasksList($table = null, $params = null){
		$query = "SELECT * FROM `".$table."` ".$params['order_by']." LIMIT ".$params['limit']." OFFSET ".$params['offset']." ";
		$result = mysqli_query($this->db, $query);
		return $result->fetch_all(MYSQLI_ASSOC);
		mysql_close($this->db);
	}	

	public function getCountTask(){
		$query = "SELECT * FROM `task` ";
		$result = mysqli_query($this->db, $query);
		return $result->num_rows;
	}
	
	public function addNewTask($table = null, $params = null){	
		$query = "INSERT INTO `".$table."` (`".implode("`,`", $params['fields'])."`) VALUES ('".implode("','", $params['values'])."')";
		$result = mysqli_query($this->db, $query);
		if($result){
			return true;
		}else{
			return false;
		}
		mysql_close($this->db);
	}
	
	public function saveEditTask($table = null, $id = null, $params = null, $admin_edit = null){
		$query = "UPDATE `".$table."` SET ";
		foreach($params['values'] as $key=>$value){
			$query .= " `".$key."` = '".$value."', ";  
		}
		$query .= "`params` = '".$admin_edit."' WHERE `id` = '".$id."' ";
		$result = mysqli_query($this->db, $query);
		if($result){
			return true;
		}else{
			return false;
		}
		mysql_close($this->db);
	}	

	public function getTask($table = null, $id = null){
		$query = "SELECT * FROM `".$table."` WHERE `id` = '".$id."' ";
		$result = mysqli_query($this->db, $query);
		return $result->fetch_array(MYSQLI_ASSOC);
		mysql_close($this->db);		
	}

	public function updateStatusTask($table = null, $id = null, $status_task = null){
		$query = "UPDATE `".$table."` SET `status_task` = '".$status_task."' WHERE `id` = '".$id."' ";
		$result = mysqli_query($this->db, $query);
		if($result){
			return true;
		}else{
			return false;
		}
		mysql_close($this->db);		
	}
	
	public function deleteTask($table = null, $id = null){
		$query = "DELETE FROM `".$table."` WHERE `id` = '".$id."' ";
		print $query;
		$result = mysqli_query($this->db, $query);
		if($result){
			return true;
		}else{
			return false;
		}
		mysql_close($this->db);		
	}

}