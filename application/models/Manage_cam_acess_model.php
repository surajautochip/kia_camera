<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class Manage_cam_acess_model extends CI_Model{
		function __construct() {
			parent::__construct();
		}
		// Inserting JSON data in Table(admission) of Database(educadoo)
		function insert_vehicle($data){

			$this->db->insert('access_info', $data);
			return $this->db->insert_id();
		}

		function update_vehicle_info($token, $data)
		{
			$this->db->where('token', $token);
        	$this->db->update('access_info', $data);
        	return $this->db->affected_rows();
		}

		//Get JSON data from Table(admission) of Database(educadoo)
		public function get_dealership_details(){			
			$this->db->select("*");
			$this->db->from('dealer_details');
			$query = $this->db->get();
			if (!empty($query)) {
				return $query->result_array()[0];
			} else {
				return false;
			}
		}

		//get dealer data by name
		public function get_dealership_details_name($name){			
			$this->db->select("*");
			$this->db->from('dealer_details')
					 ->where('name', $name);
			$query = $this->db->get();
			if (!empty($query)) {
				return $query->result_array()[0];
			} else {
				return false;
			}
		}

		public function get_bay_acess_info($token) {
	        $this->db->select("*");
			$this->db->from('access_info');
			$this->db->where(array('active' => 1, 'token' => $token));
			$query = $this->db->get();
			if (!empty($query) && !empty($query->result_array())) {
				return $query->result_array()[0];
			} else {
				return false;
			}
	    }

	    public function unlink_access_info($token){
	    	$this->db->where('token', $token);
			$this->db->delete('access_info');
			return $this->db->affected_rows();
	    }
	   public function get_token_status($token) {
	    	$this->db->select("*");
		$this->db->from('access_info');
		$this->db->where(array('token' => $token));
		$query = $this->db->get();
		
		if (!empty($query) && !empty($query->result_array())) {
			return $query->result_array()[0];
		} else {
			return array();
		}
	    }
	}
?>
