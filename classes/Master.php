<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_project(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `project_list` set {$data} ";
		}else{
			$sql = "UPDATE `project_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `project_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = 'Project Name already exists.';
			
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Project has successfully added.";
				else
					$resp['msg'] = "Project details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occurred.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_project(){
		extract($_POST);
		$check = $this->conn->query("SELECT * FROM `report_list` where project_id ='{$id}'")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['mesg'] = 'Unable to delete this project because this has a report listed already.';
		}else{
			$del = $this->conn->query("UPDATE `project_list` set delete_flag = 1 where id = '{$id}'");
			if($del){
				$resp['status'] = 'success';
				$this->settings->set_flashdata('success',"Project has been deleted successfully.");
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = $this->conn->error;
			}
		}
		return json_encode($resp);
	}
	function close_project(){
		extract($_POST);
		
		$update = $this->conn->query("UPDATE `project_list` set status = 2 where id = '{$id}'");
		if($update){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Project has been closed successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_work_type(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `work_type_list` set {$data} ";
		}else{
			$sql = "UPDATE `work_type_list` set {$data} where id = '{$id}' ";
		}
		$check = $this->conn->query("SELECT * FROM `work_type_list` where `name` = '{$name}' ".(is_numeric($id) && $id > 0 ? " and id != '{$id}'" : "")." ")->num_rows;
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = 'Work Type already exists.';
			
		}else{
			$save = $this->conn->query($sql);
			if($save){
				$rid = !empty($id) ? $id : $this->conn->insert_id;
				$resp['id'] = $rid;
				$resp['status'] = 'success';
				if(empty($id))
					$resp['msg'] = "Work Type has successfully added.";
				else
					$resp['msg'] = "Work Type details has been updated successfully.";
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = "An error occured.";
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_work_type(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `work_type_list` set delete_flag = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Work Type has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_report(){
		$_POST['description'] = htmlentities($_POST['description']);
		$_POST['member_id'] = $this->settings->userdata('id');
		$duration = strtotime($_POST['datetime_to']) - strtotime($_POST['datetime_from']);
		$_POST['duration'] = $duration;
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!is_numeric($v))
					$v = $this->conn->real_escape_string($v);
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `report_list` set {$data} ";
		}else{
			$sql = "UPDATE `report_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$rid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['id'] = $rid;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = " Report has successfully added.";
			else
				$resp['msg'] = " Report details has been updated successfully.";

			$this->conn->query("UPDATE `project_list` set `status` ='1' where id = '{$project_id}' ");
		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occured.";
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] =='success')
			$this->settings->set_flashdata('success',$resp['msg']);
		return json_encode($resp);
	}
	function delete_report(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `report_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Report has been deleted successfully.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_project':
		echo $Master->save_project();
	break;
	case 'delete_project':
		echo $Master->delete_project();
	break;
	case 'close_project':
		echo $Master->close_project();
	break;
	case 'save_work_type':
		echo $Master->save_work_type();
	break;
	case 'delete_work_type':
		echo $Master->delete_work_type();
	break;
	case 'save_report':
		echo $Master->save_report();
	break;
	case 'delete_report':
		echo $Master->delete_report();
	break;
	default:
		// echo $sysset->index();
		break;
}