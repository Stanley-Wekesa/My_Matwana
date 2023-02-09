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
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id','description'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		if(isset($_POST['description'])){
			if(!empty($data)) $data .=",";
				$data .= " `description`='".addslashes(htmlentities($description))."' ";
		}
		$check = $this->conn->query("SELECT * FROM `categories` where `category` = '{$category}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Category already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `categories` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `categories` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Category successfully saved.");
			else
				$this->settings->set_flashdata('success',"Category successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `categories` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Category successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_service(){
		extract($_POST);
		$data = "";
		$_POST['description'] = addslashes(htmlentities($description));
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `service_list` where `service` = '{$service}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Service already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `service_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `service_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Service successfully saved.");
			else
				$this->settings->set_flashdata('success',"Service successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_service(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `service_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Service successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_mechanic(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `mechanics_list` where `name` = '{$name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Mechanic already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `mechanics_list` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `mechanics_list` set {$data} where id = '{$id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Mechanic successfully saved.");
			else
				$this->settings->set_flashdata('success',"Mechanic successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_route(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('route_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `routes` where `route_id` = '{$route_id}' ".(!empty($route_id) ? " and route_id != {$route_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Route already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($route_id)){
			$sql = "INSERT INTO `routes` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `routes` set {$data} where route_id = '{$route_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($route_id))
				$this->settings->set_flashdata('success',"New Route successfully saved.");
			else
				$this->settings->set_flashdata('success',"route successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_vehicle(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('vehicle_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `vehicles` where `vehicle_id` = '{$vehicle_id}' ".(!empty($vehicle_id) ? " and vehicle_id != {$vehicle_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Vehicle already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($vehicle_id)){
			$sql = "INSERT INTO `vehicles` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `vehicles` set {$data} where vehicle_id = '{$vehicle_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($vehicle_id))
				$this->settings->set_flashdata('success',"New Vehicle successfully saved.");
			else
				$this->settings->set_flashdata('success',"Vehicle successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_company(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('company_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `companies` where `company_id` = '{$company_id}' ".(!empty($company_id) ? " and company_id != {$company_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Company already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($company_id)){
			$sql = "INSERT INTO `companies` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `companies` set {$data} where company_id = '{$company_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($company_id))
				$this->settings->set_flashdata('success',"New Company successfully saved.");
			else
				$this->settings->set_flashdata('success',"Company successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_expense(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('expense_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `expenses` where `description` = '{$description}' ".(!empty($expense_id) ? " and expense_id != {$expense_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Expense already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($expense_id)){
			$sql = "INSERT INTO `expenses` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `expenses` set {$data} where expense_id = '{$expense_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Expense successfully saved.");
			else
				$this->settings->set_flashdata('success',"Expense successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_employee(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('employee_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `employees` where `first_name` = '{$first_name}' ".(!empty($employee_id) ? " and employee_id != {$employee_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Employee already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($employee_id)){
			$sql = "INSERT INTO `employees` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `employees` set {$data} where employee_id = '{$employee_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($employee_id))
				$this->settings->set_flashdata('success',"New empolyee successfully saved.");
			else
				$this->settings->set_flashdata('success',"Employee successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_account(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('account_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `accounts` where `account_name` = '{$account_name}' ".(!empty($account_id) ? " and account_id != {$account_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Account already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($account_id)){
			$sql = "INSERT INTO `accounts` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `accounts` set {$data} where account_id = '{$account_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Account successfully saved.");
			else
				$this->settings->set_flashdata('success',"Account successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function save_revenue(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('revenue_id'))){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `revenue` where `description` = '{$description}' ".(!empty($revenue_id) ? " and revenue_id != {$revenue_id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Revenue already exist.";
			return json_encode($resp);
			exit;
		}
		if(empty($revenue_id)){
			$sql = "INSERT INTO `revenue` set {$data} ";
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE `revenue` set {$data} where revenue_id = '{$revenue_id}' ";
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($revenue_id))
				$this->settings->set_flashdata('success',"New Revenue successfully saved.");
			else
				$this->settings->set_flashdata('success',"Revenue successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_mechanic(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `employees` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Employee successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_company(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `companies` where company_id = '{$company_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Company successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_comment(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `comments` where comment_id = '{$comment_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Comment successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_post(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `posts` where post_id = '{$post_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Post successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_route(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `routes` where route_id = '{$route_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Route successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_vehicle(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `vehicles` where vehicle_id = '{$vehicle_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Vehicle successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function delete_employee(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `employees` where employee_id = '{$employee_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Employee successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_account(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `accounts` where account_id = '{$account_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Account successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_revenue(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `revenue` where revenue_id = '{$revenue_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Revenue successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function delete_expense(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `expenses` where expense_id = '{$expense_id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Expense successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_request(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k=> $v){
			if(in_array($k,array('owner_name','category_id','service_type','mechanic_id','status'))){
				if(!empty($data)){ $data .= ", "; }

				$data .= " `{$k}` = '{$v}'";

			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `service_requests` set {$data} ";
		}else{
			$sql = "UPDATE `service_requests` set {$data} where id ='{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$rid = empty($id) ? $this->conn->insert_id : $id ;
			$data = "";
			foreach($_POST as $k=> $v){
				if(!in_array($k,array('id','owner_name','category_id','service_type','mechanic_id','status'))){
					if(!empty($data)){ $data .= ", "; }
					if(is_array($_POST[$k]))
					$v = implode(",",$_POST[$k]);
					$v = $this->conn->real_escape_string($v);
					$data .= "('{$rid}','{$k}','{$v}')";
				}
			}
			$sql = "INSERT INTO `request_meta` (`request_id`,`meta_field`,`meta_value`) VALUES {$data} ";
			$this->conn->query("DELETE FROM `request_meta` where `request_id` = '{$rid}' ");
			$save = $this->conn->query($sql);
			if($save){
				$resp['status'] = 'success';
				$resp['id'] = $rid;
			}else{
				$resp['status'] = 'failed';
				$resp['msg'] = $this->conn->error;
				$resp['sql'] = $sql;
			}

		}else{
			$resp['status'] = 'failed';
			$resp['msg'] = $this->conn->error;
			$resp['sql'] = $sql;
		}

		return json_encode($resp);
	}
	function delete_request(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `service_requests` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Request successfully deleted.");
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
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_service':
		echo $Master->save_service();
	break;
	case 'delete_service':
		echo $Master->delete_service();
	break;
	case 'save_mechanic':
		echo $Master->save_mechanic();
	break;
	case 'save_route':
		echo $Master->save_route();
	break;
	case 'save_company':
		echo $Master->save_company();
	break;
	case 'save_expense':
		echo $Master->save_expense();
	break;
	case 'save_account':
		echo $Master->save_account();
	break;
	case 'save_employee':
		echo $Master->save_employee();
	break;
	case 'save_vehicle':
		echo $Master->save_vehicle();
	break;
	case 'delete_mechanic':
		echo $Master->delete_mechanic();
	break;
	case 'delete_post':
		echo $Master->delete_post();
	break;
	case 'delete_vehicle':
		echo $Master->delete_vehicle();
	break;
	case 'delete_company':
		echo $Master->delete_company();
	break;
	case 'delete_expense':
		echo $Master->delete_expense();
	break;
	case 'delete_employee':
		echo $Master->delete_employee();
	break;
	case 'delete_account':
		echo $Master->delete_account();
	break;
	case 'delete_route':
		echo $Master->delete_route();
	break;
	case 'delete_comment':
		echo $Master->delete_comment();
	break;
	case 'delete_revenue':
		echo $Master->delete_revenue();
	break;
	case 'save_request':
		echo $Master->save_request();
	break;
	case 'save_revenue':
		echo $Master->save_revenue();
	break;
	case 'delete_request':
		echo $Master->delete_request();
	break;
	default:
		// echo $sysset->index();
		break;
}
