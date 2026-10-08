<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PaymentGateway {

	protected $host;
	protected $uid;
	protected $user;
	protected $database;
	protected $password;

	public function __construct()
	{

	}
	public function get_payment_gateway($company_id=null) {
		if(empty($company_id)){
			return send_json_response(array('status' => false, 'message' => 'Unable to get the institute details!'));
		}
	}
}
?>