<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Formatted form of print_r() function
 */
if (!function_exists('printr')) {
	function printr()
	{
		$args = func_get_args();
		foreach ($args as $arg) {
			echo '<pre>' . print_r($arg, true) . '</pre>';
		}
	}
}

/**
 * send_json_response: Sending a json formatted string output by using array as an input
 *
 * @param array[$data] Input data
 */
if (!function_exists('send_json_response')) {
	function send_json_response($data)
	{
		header('Content-type: application/json');
		echo json_encode($data);
		exit;
	}
}
