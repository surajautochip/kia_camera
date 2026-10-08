<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('ripcord/ripcord.php');

class Educadoo {

	protected $host;
	protected $uid;
	protected $user;
	protected $database;
	protected $password;

	public function __construct($data)
	{
		$this->host 	= $data['host'];
		$this->database = $data['database'];
		$this->user 	= $data['user'];
		$this->password = $data['password'];
	}

	public function getParentDetails($company_id=null, $parent_id=null) {
		if(empty($company_id) or empty($parent_id)){
			return array('status' => false, 'message' => 'Unable to get the institute/parent details!');
		}
		$user_id = $this->authenticate();
		if ($user_id) {
			$models = ripcord::client($this->host."/xmlrpc/2/object");
			$res = $models->execute_kw($this->database, $user_id, $this->password,
		    'sb.parent', 'search_read',
		    array(array(array('id', '=', intval($parent_id)))),
		    array('fields'=>array('id', 'name', 'email', 'mobile', 'street', 'street2', 'city', 'country_id', 'state_id', 'zip')));
		    if (!$res) {
				return (array('status' => false, 'message' => 'Unable to find payment gateway details !'));
		    }
			return (array('status' => true, 'parent_details' => $res[0]));
		}
	}

	public function getPaymentGateway($company_id=null){
		if(empty($company_id)){
			return array('status' => false, 'message' => 'Unable to get the institute details!');
		}

		$user_id = $this->authenticate();
		if ($user_id) {
			$models = ripcord::client($this->host."/xmlrpc/2/object");
			$res = $models->execute_kw($this->database, $user_id, $this->password,
		    'res.company', 'search_read',
		    array(array(array('id', '=', intval($company_id)))),
		    array('fields'=>array('id', 'name', 'payment_gateway_id')));
		    if (!$res or !$res[0]['payment_gateway_id'])
				return (array('status' => false, 'message' => 'Unable to find payment gateway details !'));

			$gateway = $models->execute_kw($this->database, $user_id, $this->password,
		    'sb.payment.gateway', 'search_read',
		    array(array(array('id', '=', $res[0]['payment_gateway_id'][0]))),
		    array('fields'=>array('id', 'name', 'access_code', 'url', 'merchant_id', 'working_key')));
		    if (empty($gateway)) {
				return (array('status' => false, 'message' => 'Unable to get any payment gateway details, please contact admin!'));
		    }
			return (array('status' => true, 'payment_gateway' => $gateway[0]));
		}
	}

	public function checkInvoices($mobile, $school)
    {   
		$user_id = $this->authenticate();
		if ($user_id) {
			$models = ripcord::client($this->host."/xmlrpc/2/object");
			$res = $models->execute_kw($this->database, $user_id, $this->password,
		    'sb.student', 'search_read',
		    array(array(array('mobile', '=', $mobile), array('company_id', '=', intval($school)), array('active', '=', true))),
		    array('fields'=>array('id', 'name', 'partner_id', 'father_id', 'mother_id', 'mother_sms_alert')));
			if (!$res) {
				return (array('status' => false, 'message' => 'Unable to find the student details, please check the mobile number and school name entered !'));
			}
			$invoice_total 	= 0;
			$inv_paid_total = 0;
			$invoice_list 	= array();
			$inv_paid_list 	= array();
			$invoice_cnt	= 0;
			$paid_cnt		= 0;

			foreach($res as $ind => $rec){
				$parent_id = $rec['father_id'];
				if ($rec['mother_sms_alert'])
					$parent_id = $rec['mother_id'];

				foreach ($rec as $key => $vals) {
					if ($key == 'partner_id') {
						$partner_id = $vals[0];
						$student_name = $rec['name'];

						$roll_number = $models->execute_kw($this->database, $user_id, $this->password, 'sb.roll.number', 'search_read',
						    array(array(array('student_id', '=', $rec['id']), array('state', '=', 'active'))),
						    array('fields'=>array('id', 'course_id', 'batch_id', 'student_id')));
						
						$invoices = $models->execute_kw($this->database, $user_id, $this->password, 'account.invoice', 'search_read',
						    array(array(array('partner_id', '=', $partner_id), array('state', '=', 'open'))),
						    array('fields'=>array('id', 'name', 'number', 'residual', 'date_invoice')));

						$invoices_paid = $models->execute_kw($this->database, $user_id, $this->password, 'account.invoice', 'search_read',
						    array(array(array('partner_id', '=', $partner_id), array('state', '=', 'paid'))),
						    array('fields'=>array('id', 'name', 'number', 'amount_total', 'date_invoice')));

						if (!$invoices and !$invoices_paid)
							return (array('status' => false, 'message' => 'Unable to find any fee due for '.ucwords(strtolower($student_name))));
						if ($invoices) {
							foreach ($invoices as $num => $inv) {
								$invoice_list[$invoice_cnt] = array('invoice_id' => $inv['id'], 'name' => $inv['name'], 'invoice_date' => date("d-M-Y", strtotime($inv['date_invoice'])), 'number' => $inv['number'], 'amount' => number_format($inv['residual'], 2), 'amount_int' => $inv['residual'], 'student' => ucwords(strtolower($student_name)), 'student_id' => $rec['id'], 'parent_id' => $parent_id);
								if ($roll_number and array_key_exists("course_id", $roll_number[0])) {
									$invoice_list[$invoice_cnt]['class'] = $roll_number[0]['course_id'][1];
								}
								if ($roll_number and array_key_exists("batch_id", $roll_number[0])) {
									$invoice_list[$invoice_cnt]['batch'] = $roll_number[0]['batch_id'][1];
								}
								$invoice_total += $inv['residual'];
								$invoice_cnt++;
							}
						}
						if ($invoices_paid) {
							foreach ($invoices_paid as $num => $inv) {
								$inv_paid_list[$paid_cnt] = array('invoice_id' => $inv['id'], 'name' => $inv['name'], 'invoice_date' => date("d-M-Y", strtotime($inv['date_invoice'])), 'number' => $inv['number'], 'amount' => number_format($inv['amount_total'], 2), 'student' => ucwords(strtolower($student_name)));
								if ($roll_number and array_key_exists("course_id", $roll_number[0])) {
									$inv_paid_list[$paid_cnt]['class'] = $roll_number[0]['course_id'][1];
								}
								if ($roll_number and array_key_exists("batch_id", $roll_number[0])) {
									$inv_paid_list[$paid_cnt]['batch'] = $roll_number[0]['batch_id'][1];
								}
								$inv_paid_total += $inv['amount_total'];
								$paid_cnt++;
							}
						}
					}
				}
			}
			$invoice_list['amount_to_pay'] 	= number_format($invoice_total, 2);
			$inv_paid_list['amount_paid']	= number_format($inv_paid_total, 2);
			return array('status' => true, 'inv_open' => $invoice_list, 'inv_paid' => $inv_paid_list, 'company_id' => $school);
		}
    }

    public function authenticate() {
    	$common = $this->common();
		if ($common) {
			$uid = $common->authenticate($this->database, $this->user, $this->password, array());			
			return $uid;
		}
    }

    public function version() {
		$common = $this->common();
		if ($common) {
			return $common->version();
		}
    }

    public function common() {
    	try {
    		$common = ripcord::client($this->host."/xmlrpc/2/common");
			return $common;
    	} catch (Exception $e) {
			return false;//($e->getMessage());
		}
    }
}
?>