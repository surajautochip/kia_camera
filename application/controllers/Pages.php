<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function index() {
		// printr($token);
		$data['title'] = "Track Your Vehicle : Any where, Any Time";
		$data['active'] = "home";
		$this->load->view('pages/home', $data);
	}

	public function track($token_param = null) { 
		$data['is_mobile'] = false;
			if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
		   $data['is_mobile'] = true;
		}
        $token 	= $this->uri->segment(2); 
        $data['error'] = '';
        if(!empty($token)) {
	        $this->load->model('manage_cam_acess_model');
			$data['dealer'] 	= $this->manage_cam_acess_model->get_dealership_details();
			$data['vehicle'] 	= $this->manage_cam_acess_model->get_bay_acess_info($token);
			$total_camera = 0;
			if (!empty($data['vehicle']['ip1'])){
				$total_camera += 1;
			}
			if (!empty($data['vehicle']['ip2'])){
				$total_camera += 1;
			}
			if (!empty($data['vehicle']['ip3'])){
				$total_camera += 1;
			}
			if($total_camera == 0){ $total_camera = 2; }
				if($total_camera > 0){
				$data['split_cnt'] = 12/$total_camera;
			} else{
				$data['split_cnt'] = 12;
			}
			$data['total_camera'] = $total_camera;

			$data['token'] 	= $token; 
			if(!empty($data['vehicle'])){
				$data['dealer'] 	= $this->manage_cam_acess_model->get_dealership_details_name($data['vehicle']['company_name']);
			}

			if (empty($data['vehicle'])) {
				$data['error'] = 'Thank You';
			}
		} else {
			$data['error'] = 'Thank You';
		}
		$data['title'] = "Track Your Vehicle : Any where, Any Time";
		$data['active'] = "home";
		$this->load->view('pages/home', $data);
	}

	public function geturl() {

		try {
			$bay_info 	= $this->input->get();
			if (array_key_exists('customer_name', $bay_info) && empty($bay_info['customer_name'])) {
				$bay_info['customer_name'] = 'Customer';
			} 
			$bay_info['token'] = uniqid();

			if (empty($bay_info['ip1']) && empty($bay_info['ip2']) && empty($bay_info['ip3'])){
				return send_json_response(array("status" => false, "message" => "Unable to get any camera IP address"));
			}
			if (!empty($bay_info['ip1']) && (empty($bay_info['username1']) || empty($bay_info['password1']))) {
				return send_json_response(array("status" => false, "message" => "Unable to get any camera 1 Username/Password"));
			}
			if (!empty($bay_info['ip2']) && (empty($bay_info['username2']) || empty($bay_info['password2']))) {
				return send_json_response(array("status" => false, "message" => "Unable to get any camera 2 Username/Password"));
			}
			if (!empty($bay_info['ip3']) && (empty($bay_info['username3']) || empty($bay_info['password3']))) {
				return send_json_response(array("status" => false, "message" => "Unable to get any camera 3 Username/Password"));
			}
			if (!empty($bay_info['comany_name']) && (empty($bay_info['comany_name']) || empty($bay_info['comany_name']))) {
				return send_json_response(array("status" => false, "message" => "Unable to get any company name"));
			}

			if (!empty($bay_info['bay_name']) && (empty($bay_info['bay_name']) || empty($bay_info['bay_name']))) {
				return send_json_response(array("status" => false, "message" => "Unable to get any bay name"));
			}
			// echo '<pre>'; print_r($bay_info); exit;
		    $this->load->model('manage_cam_acess_model');
		    $insert_id = $this->manage_cam_acess_model->insert_vehicle($bay_info);
		    $dealer = $this->manage_cam_acess_model->get_dealership_details();

		   	if (!$insert_id) {
		   		return send_json_response(array("status" => false, "message" => "Unable to insert details, please try again"));
		   	} else {
		   		return send_json_response(array("status" => true, "message" => "Vehicle details added successfully!", "token" => $bay_info['token'], "url" => urlencode('http://'.$dealer['web_server_ip'].'/index.php/track/'.$bay_info['token'])));
		   	}
		} catch(Exception $e) {
		  	return send_json_response(array("status" => false, "message" => $e->getMessage()));
		}
	}

	public function update_vehicle_info($args) {

		$vechile_info = json_decode($args);
		if (empty($vechile_info['customer_name'])) {
			$vechile_info['customer_name'] = 'Customer';
		} 
		if (empty($vechile_info['token'])) {
			return send_json_response(array("status" => false, "message" => "Unable to get token"));
		}
		$token = $vechile_info['token'];
		unset($vechile_info['token']);

	    $this->load->model('manage_cam_acess_model');
		$vehicle = $this->manage_cam_acess_model->get_bay_acess_info($token);

		if (empty($vehicle)) {
			return send_json_response(array("status" => false, "message" => "Unable to get vehicle details with the provided token"));
		}
		$update = $this->manage_cam_acess_model->update_vehicle_info($token, $vechile_info);
		if ($update != -1){
			return send_json_response(array("status" => true, "message" => "Vehicle details updated successfully!"));
		} else {
			return send_json_response(array("status" => false, "message" => "Unable to update vehicle details, please try later!"));
		}
	}

	public function stop() {

		try {
			$data 	= $this->input->get();
			if (empty($data['token'])) {
				return send_json_response(array("status" => false, "message" => "Unable to get token"));
			}
			$this->load->model('manage_cam_acess_model');
			$delete = $this->manage_cam_acess_model->unlink_access_info($data['token']);

			if ($delete != -1) {
				return send_json_response(array("status" => true, "message" => "Updated the record successfully!"));
			}
		} catch(Exception $e) {
		  	return send_json_response(array("status" => false, "message" => $e->getMessage()));
		}
	}

	public function getFeedback(){
		$curl = curl_init();
		$token 	= $this->input->get('token', TRUE);
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/live/customer/review',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"params": {"token":"'.$token.'"} }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "message" => $response));
	}

	public function updateFeedback(){
		$curl = curl_init();
		$token 	= $this->input->get('token', TRUE);
		$count 	= $this->input->get('count', TRUE);
		$fdbk 	= $this->input->get('feedback', TRUE);
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT (e.g., 'http://localhost:8079')
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/live/customer/review',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"params": {"token":"'.$token.'", "review":"'.$count.'", "feedback":"'.$fdbk.'"} }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "message" => $response));
	}

	public function getStages(){
		$curl = curl_init();
		$token 	= $this->input->get('token', TRUE);
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/live/token/stages',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"params": {"token":"'.$token.'"} }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "message" => $response));
	}

	public function stopStreaming(){
		$curl = curl_init();
		$token 	= $this->input->get('token', TRUE); 
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/dms/live/stream/stop',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"params": {"token":"'.$token.'"}}',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));

		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "message" => $response));
	}

	public function no_view_receive(){
		$start_time = $this->input->post('start_time', TRUE);
		$token = $this->input->post('token', TRUE);
		if(!$token){
			$token = $this->uri->segment(2);
		}
		$data = [
			"db" => "camera_db",
			"user" => "kia@gmail.com",
			"password" => "kia",
			"start_time" => $start_time,
			"token" => $token,
		];
		$curl = curl_init(); 
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/api/no_view_receive',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "result" => $response));
	}


	public function no_view_receive_update(){
		$start_time = $this->input->post('start_time', TRUE);
		$token = $this->input->post('token', TRUE);
		$session_id = $this->input->post('session_id', TRUE);
		$end_time = $this->input->post('end_time', TRUE);

		if(!$token){
			$token = $this->uri->segment(2);
		}
		$data = [
			"db" => "KIA_ARS",
			"user" => "admin",
			"password" => "Autochip@812",
			"start_time" => $start_time,
			"end_time" => $end_time,
			"token" => $token,
			"session_id" => $session_id,
		];
		$curl = curl_init(); 
		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/api/no_view_receive',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));
		$response = curl_exec($curl);
		curl_close($curl); 
		return send_json_response(array("status" => true, "result" => $response));
	}

	public function getComponents(){
		$curl = curl_init();
		$token 	= $this->input->get('token', TRUE);

		$odoo_url = 'http://192.168.101.111:8079'; // CHANGE THIS TO YOUR SERVER ODOO URL IF DIFFERENT
		curl_setopt_array($curl, array(
			CURLOPT_URL => $odoo_url . '/live/token/product/components',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS =>'{"params": {"token":"'.$token.'"} }',
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				'Cookie: frontend_lang=en_US; session_id=9518f673b93d2e3aa18e52282ee4c65c76b1f2f1'
			),
		));

		$response = curl_exec($curl); 
		curl_close($curl); 
		return send_json_response(array("status" => true, "message" => $response));

	}

	public function getCameraInfo() {

		try {
			$data = $this->input->get();
			if (empty($data['token'])) {
				return send_json_response(array('status' => false, 'message' => 'Unable to get token'));				
			}
			$camera = substr($data['token'], -1);
			$token  = substr($data['token'], 0, (strlen($data['token']) - 2));
			$this->load->model('manage_cam_acess_model');
			$bay_info = $this->manage_cam_acess_model->get_bay_acess_info($token);
			if($bay_info) {
				return send_json_response(array("status" => true, "camera_info" => array("ip" => $bay_info['ip'.$camera], "username" => $bay_info['username'.$camera], "password" => $bay_info['password'.$camera])));
			} else {
				return send_json_response(array("status" => false, "message" => "Unable to get camera details"));
			}

		} catch(Exception $e) {
		  	return send_json_response(array("status" => false, "message" => $e->getMessage()));
		}

	}
	
	public function getTokenStatus() {	
		try {
			$data 	= $this->input->get();
			if (empty($data['token'])) {
				return send_json_response(array('status' => false, 'message' => 'Unable to get token'));
			}
			$this->load->model('manage_cam_acess_model');
			$token_info = $this->manage_cam_acess_model->get_token_status($data['token']);			
			if (array_key_exists("active", $token_info)) {
				if ($token_info['active'] == 1) {
					send_json_response(array('status' => true, 'state' => 1, 'message' => 'Token is active'));
				} else {
					send_json_response(array('status' => false, 'state' => 0, 'message' => 'Token is not active'));
				}
			} else {
				send_json_response(array('status' => true, 'state' => 2, 'message' => 'Token is not available'));
			}		
		} catch(Exception $e) {
		  	return send_json_response(array('status' => false, 'message' => $e->getMessage()));
		}
	}
}


