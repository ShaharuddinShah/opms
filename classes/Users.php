<?php
require_once('../config.php');
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_users(){
		if(!isset($_POST['status']) && $this->settings->userdata('login_type') == 1){
			$_POST['status'] = 1;
		}
		extract($_POST);
		$oid = $id;
		$data = '';
		if(isset($oldpassword)){
			if(md5($oldpassword) != $this->settings->userdata('password')){
				return 4;
			}
		}
		$chk = $this->conn->query("SELECT * FROM `users` where username ='{$username}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		foreach($_POST as $k => $v){
			if(in_array($k,array('firstname','middlename','lastname','username','type'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(!empty($password)){
			$password = md5($password);
			if(!empty($data)) $data .=" , ";
			$data .= " `password` = '{$password}' ";
		}

		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$id = $this->conn->insert_id;
				$this->settings->set_flashdata('success','User Details successfully saved.');
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				if($id == $this->settings->userdata('id')){
					foreach($_POST as $k => $v){
						if($k != 'id'){
							if(!empty($data)) $data .=" , ";
							$this->settings->set_userdata($k,$v);
						}
					}
					
				}
				$resp['status'] = 1;
			}else{
				$resp['status'] = 2;
			}
			
		}
		
		if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
			$fname = 'uploads/avatar-'.$id.'.png';
			$dir_path =base_app. $fname;
			$upload = $_FILES['img']['tmp_name'];
			$type = mime_content_type($upload);
			$allowed = array('image/png','image/jpeg');
			if(!in_array($type,$allowed)){
				$resp['msg'].=" But Image failed to upload due to invalid file type.";
			}else{
				$new_height = 200; 
				$new_width = 200; 
		
				list($width, $height) = getimagesize($upload);
				$t_image = imagecreatetruecolor($new_width, $new_height);
				imagealphablending( $t_image, false );
				imagesavealpha( $t_image, true );
				$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
				imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				if($gdImg){
						if(is_file($dir_path))
						unlink($dir_path);
						$uploaded_img = imagepng($t_image,$dir_path);
						imagedestroy($gdImg);
						imagedestroy($t_image);
				}else{
				$resp['msg'].=" Image failed to upload due to unknown reason.";
				}
			}
			if(isset($uploaded_img)){
				$this->conn->query("UPDATE users set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}' ");
				if($id == $this->settings->userdata('id')){
						$this->settings->set_userdata('avatar',$fname);
				}
			}
		}
		if(isset($resp['msg']))
		$this->settings->set_flashdata('success',$resp['msg']);
		return  $resp['status'];
	}
	public function delete_users(){
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM users where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$avatar = explode("?",$avatar)[0];
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			if(is_file(base_app.$avatar))
				unlink(base_app.$avatar);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	public function save_member(){
		if(!empty($_POST['password'])){
			$_POST['password'] = md5($_POST['password']);
		}else{
			unset($_POST['password']);
		}
		extract($_POST);
		$data = '';
		$chk = $this->conn->query("SELECT * FROM `member_list` where code ='{$code}' ".($id>0? " and id!= '{$id}' " : ""))->num_rows;
		if($chk > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = ' Member Code already exists.';
		}else{
			foreach($_POST as $k => $v){
				if(!in_array($k,array('id'))){
					if(!empty($data)) $data .=" , ";
					$data .= " {$k} = '{$v}' ";
				}
			}
			if(empty($id)){
				$sql = "INSERT INTO member_list set {$data}";
			}else{
				$sql = "UPDATE member_list set {$data} where id = '{$id}' ";
			}
			$save = $this->conn->query($sql);
			if($save){
				$eid = empty($id) ? $this->conn->insert_id : $id;
				$resp['status'] = 'success';
				if(empty($id))
				$resp['msg'] = ' Member successfully added';
				else
				$resp['msg'] = ' Member details successfully saved';
				if(isset($_FILES['img']) && $_FILES['img']['tmp_name'] != ''){
					$fname = 'uploads/member-'.$eid.'.png';
					$dir_path =base_app. $fname;
					$upload = $_FILES['img']['tmp_name'];
					$type = mime_content_type($upload);
					$allowed = array('image/png','image/jpeg');
					if(!in_array($type,$allowed)){
						$resp['msg'].=" But Image failed to upload due to invalid file type.";
					}else{
						$new_height = 200; 
						$new_width = 200; 
				
						list($width, $height) = getimagesize($upload);
						$t_image = imagecreatetruecolor($new_width, $new_height);
						imagealphablending( $t_image, false );
						imagesavealpha( $t_image, true );
						$gdImg = ($type == 'image/png')? imagecreatefrompng($upload) : imagecreatefromjpeg($upload);
						imagecopyresampled($t_image, $gdImg, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
						if($gdImg){
								if(is_file($dir_path))
								unlink($dir_path);
								$uploaded_img = imagepng($t_image,$dir_path);
								imagedestroy($gdImg);
								imagedestroy($t_image);
								if(isset($uploaded_img)){
									$this->conn->query("UPDATE member_list set `avatar` = CONCAT('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$eid}' ");
									if($this->settings->userdata('login_type') == 2 && $id == $this->settings->userdata('id')){
											$this->settings->set_userdata('avatar',$fname);
									}
								}
						}else{
						$resp['msg'].=" Image failed to upload due to unknown reason.";
						}
					}
				}
			}
		}
		
		if(isset($resp['msg']))
		$this->settings->set_flashdata('success',$resp['msg']);
		return  json_encode($resp);
	}
	public function delete_member(){
		extract($_POST);
		$avatar = $this->conn->query("SELECT avatar FROM member_list where id = '{$id}'")->fetch_array()['avatar'];
		$qry = $this->conn->query("DELETE FROM member_list where id = $id");
		if($qry){
			$avatar = explode("?",$avatar)[0];
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			if(is_file(base_app.$avatar))
				unlink(base_app.$avatar);
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
		}
		return json_encode($resp);
	}
	
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
	break;
	case 'delete':
		echo $users->delete_users();
	break;
	case 'save_member':
		echo $users->save_member();
	break;
	case 'delete_member':
		echo $users->delete_member();
	break;
	default:

		break;
}