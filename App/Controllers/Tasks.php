<?php defined('APPPATH') OR exit('No direct script access allowed');

namespace App\Controllers;

class Tasks{
	
	protected $model;
	
	protected $filter_value = array(
		'default' => array('ORDER BY id DESC', 'Сортировка по умолчанию'),
		'name_asc' => array('ORDER BY user_name ASC', 'Имя Пользователя по возрастанию'),
		'name_desk' => array('ORDER BY user_name DESC', 'Имя Пользователя по убыванию'),
		'email_asc' => array('ORDER BY user_email ASC', 'E-mail по возрастанию'),
		'email_desk' => array('ORDER BY user_email DESC', 'E-mail по убыванию'),
		'status_asc' => array('ORDER BY status_task ASC', 'Сначала новые задачи'),
		'status_desk' => array('ORDER BY status_task DESC', 'Сначала выполненные задачи')		
	);
	
	public function __construct(){
		$this->model = new \App\Models\Tasks();		
	}
	
	public function getTasksList($num_page = null){	
		$this->getPagination($num_page);
		unset($params);
		$params['offset'] = $this->offset;
		$params['limit'] = $this->limit;
		if(isset($_SESSION['task_order_by']) && !empty($_SESSION['task_order_by'])){
			$params['order_by'] = $_SESSION['task_order_by'];
		}else{
			$params['order_by'] = 'ORDER BY id DESC';
			$_SESSION['task_order_by'] = 'ORDER BY id DESC';
		}
		$data['taskslist'] = $this->model->getTasksList('task', $params);
		$data['form_select'] = $this->getHtmlSelect($params['order_by']);
		if(isset($_SESSION['user_status']) && $_SESSION['user_status'] = 'SuperAdmin'){
			$data['user_status'] = 'SuperAdmin';
		}
		if(isset($_SESSION['message_to_user']) && !empty($_SESSION['message_to_user'])){
			$message_to_user = $_SESSION['message_to_user'];
			unset($_SESSION['message_to_user']);
		}		
		if($this->count_task > $this->limit){
			if(empty($num_page)){
				$num_page = '1';
			}
			$count_task = $this->total_count_page;
		}	
			require_once '../App/Views/common/header.php';
			require_once '../App/Views/task/tasklist.php';		
			require_once '../App/Views/common/html_end.php';
	}
	
	public function addNewTask(){
		$_POST['text_task'] = htmlspecialchars($_POST['text_task']);
		if(empty($_POST['text_task'])){
			print 'Поле задачи пустое !';
		}else{
			unset($params);
			$params['fields'] = array('user_name', 'user_email', 'text_task', 'status_task');
			$params['values'] = array($_POST['user_name'], $_POST['user_email'], $_POST['text_task'], '0');
			$add_task = $this->model->addNewTask('task', $params);
			if($add_task == true){
				$_SESSION['message_to_user'] = $_POST['user_name'].', <br/>Ваша задача успешно добавлена!';
				header('Location: https://beejee.skachgroup.ru');			
			}else{
				print 'Ошибка записи в базу данных !';						
			}
		}
	}

	public function getFormEditTask($id = null){
		if(isset($_SESSION['user_status']) && $_SESSION['user_status'] = 'SuperAdmin'){
			settype($id, 'integer');			
			$task = $this->model->getTask('task', $id);	
			require_once '../App/Views/common/header.php';
			require_once '../App/Views/task/edittask.php';		
			require_once '../App/Views/common/html_end.php';
		}else{
			header('Location: https://beejee.skachgroup.ru');
		}
	}
	
	public function saveEditTask($id = null){
		if(isset($_SESSION['user_status']) && $_SESSION['user_status'] = 'SuperAdmin'){
			settype($id, 'integer');;
			$_POST['text_task'] = htmlspecialchars($_POST['text_task']);
			if(empty($_POST['text_task'])){
				print 'Поле задачи пустое !';
			}else{
				$task = $this->model->getTask('task', $id);
				if($task['params'] == 1){
					$admin_edit = 1;
				}else{
					if($task['text_task'] === $_POST['text_task']){
						$admin_edit = 0;
					}else{
						$admin_edit = 1;
					}
				}	
				unset($params);
				$params['values'] = array('user_name' => $_POST['user_name'], 'user_email' => $_POST['user_email'], 'text_task' => $_POST['text_task'], 'status_task' => $_POST['status_task']);
				$edit_task = $this->model->saveEditTask('task', $id, $params, $admin_edit);
				if($edit_task == true){
					header('Location: https://beejee.skachgroup.ru');			
				}else{
					print 'Ошибка записи в базу данных !';						
				}
			}
		}else{
			header('Location: https://beejee.skachgroup.ru');
		}		
	}
	
	public function deleteTask($id = null){
		if(isset($_SESSION['user_status']) && $_SESSION['user_status'] = 'SuperAdmin'){		
			settype($id, 'integer');
			$delete_task = $this->model->deleteTask('task', $id);
			if($delete_task == true){
				header('Location: '.$_SERVER['HTTP_REFERER']);
			}else{
				print 'Ошибка удаления задачи с ID'.$id;
			}
		}else{
			header('Location: https://beejee.skachgroup.ru');
		}			
	}

	public function getPagination($num_page = null){
		if($num_page == null){
			$num_page = 1;
		}
		$this->limit = 3;
		$this->count_task = $this->model->getCountTask();
		$this->total_count_page = ceil($this->count_task / $this->limit);
		$this->offset = ($num_page - 1) * $this->limit;
	}

	public function ajaxOrderTask(){
		$order_by = $_POST['task_order_by'];
		if(empty($order_by)){
			$_SESSION['task_order_by'] = 'ORDER BY id DESC';
		}else{
			foreach($this->filter_value as $key=>$value){
				if($order_by == $key){
					$_SESSION['task_order_by'] = $value[0];
				}
			}
		}	
	}	
	
	public function ajaxUpdateStatusTask(){
		$id = $_POST['id_task'];
		settype($id, 'integer');
		$status_task = $_POST['status_task'];
		$update_status_task = $this->model->updateStatusTask('task', $id, $status_task);
		if($update_status_task == true){
			print '1';
		}else{
			print '0';
		}
	}		
	
	public function getHtmlSelect($selected = null){
		$html_select = '<select class="col-12 col-md-4 form-control" name="task_order_by">';
		foreach($this->filter_value as $key=>$value){
			if($value[0] == $selected){
				$html_select .= '<option value="'.$key.'" selected>'.$value[1].'</option>';
			}else{
				$html_select .= '<option value="'.$key.'">'.$value[1].'</option>';
			}	
		}
		$html_select .= '</select>';
		return $html_select;
	}
	
	
}