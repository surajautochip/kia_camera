<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* MSG91 Library file
* Author: Anbuselvan Rocky (www.fb.me/anburocky3)
* No Licence bullshit! Use it according to your logic!
*/
class Msg91 {

	public function __construct ($data = array()) {
		$this->ci =& get_instance();
        $this->authKey  = "203306AqISUCTtODx5aac7c7e";
        $this->senderID = "OTPSHC";
        if(!empty($data)) {
            if(array_key_exists('senderID', $data)) {
                $this->senderID = $data['senderID'];
            }
            if(array_key_exists('authKey', $data)) {
                $this->authKey = $data['authKey'];
            }
        }
	}

    /**
     * This function helps to check the balance using the authentication key provided by MSG91.com
     * Function: checkSMSBalance()
     * Author: Anbuselvan Rocky
     */
    
    public function checkSMSBalance($type = 4)
    {
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://control.msg91.com/api/balance.php?type=".$type."&authkey=$this->authKey",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));

        $balance = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          return "cURL Error #:" . $err;
        } else {
          return $balance;
        }
    }    

    public function send($to, $message) 
    {
        // Check SMS Balance, if it has credit. It will send the message with $to, $message parameters.
        if (!$this->checkSMSBalance() >= 1) {
            return false;   
        }
        else
        {
            //Your message to send, Add URL encoding here.
            $message = urlencode($message);

            //Define route
            $route = "4";

            //Prepare you post parameters
            $postData = '{
                "sender": "'.$this->senderID.'",
                "route": "'.$route.'",
                "country": "91",
                "sms": [
                    {
                        "message": "'.$message.'",
                        "to": [
                            "'.$to.'"
                        ]
                    }
                ]
            }';


            //API URL
            $url="http://api.msg91.com/api/v2/sendsms";

            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "authkey: $this->authKey",
                "content-type: application/json"),
            ));

            //get response
            $response = curl_exec($ch);
            $err = curl_error($ch);
            
            curl_close($ch);

            if ($err) {
              echo "cURL Error #:" . $err;
            }
            else
            {
                $result = json_decode($response);

                if ($result->type === "success"){
                    return TRUE;
                }
                else{

                    return FALSE;
                }        
            }
        }
    }

    public function sendOTP($to)
    {
        // Check SMS Balance, if it has credit. It will send the message with $to, $message parameters.       
        if (!$this->checkSMSBalance(106) >= 1) {
            return json_encode(array('status' => false, 'message' => 'Balance Exhausted'));
        } else {
            //Your message to send, Add URL encoding here.
            $message = urlencode("##OTP## is the OTP for verification in Educadoo. OTP is valid for 5 mins");

            //Prepare you post parameters
            $postData = '{
                "sender": "'.$this->senderID.'",
                "otp_length" : 6,
                "otp_expiry" : 5,
                "message" : "'.$message.'",
                "mobile" : "91'.$to.'",
            }';
            //API URL
            $url="http://control.msg91.com/api/sendotp.php?otp_length=6&authkey=".$this->authKey."&message=".$message."&sender=".$this->senderID."&mobile=91".$to."&otp_expiry=5";

            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",

                // CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => "",
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
            ));

            //get response
            $response = curl_exec($ch);
            $err = curl_error($ch);
            
            curl_close($ch);

            if ($err) {
                return json_encode(array('status' => false, 'message' => $err));
            } else {
                $result = json_decode($response);
                if ($result->type === "success") {
                    return json_encode(array('status' => true, 'message' => 'OTP sent successfully!'));
                } else {
                    return json_encode(array('status' => false, 'message' => 'Unable to send OTP!'));
                }
            }
        }
    }

    public function verifyOTP($to, $otp) {

        $url="https://control.msg91.com/api/verifyRequestOTP.php?authkey=".$this->authKey."&mobile=91".$to."&otp=".$otp;

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        //get response
        $response = curl_exec($ch);
        $err = curl_error($ch);
        
        curl_close($ch);

        if ($err) {
          return json_encode(array('status' => false, 'message' => $err));
        } else {
            $result = json_decode($response);
            if ($result->type === "success") {
                return json_encode(array('status' => true, 'message' => 'OTP verified successfully!'));
            } else {
                if($result->message == 'already_verified') {
                    return json_encode(array('status' => true, 'message' => 'OTP already verified!'));
                }
                return json_encode(array('status' => false, 'message' => $result->message));
            }
        }
    }

    public function resendOTP($to) {

        $url="http://control.msg91.com/api/retryotp.php?authkey=".$this->authKey."&mobile=91".$to."&retrytype=text";

        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => "",
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ));

        //get response
        $response = curl_exec($ch);
        $err = curl_error($ch);
        
        curl_close($ch);

        if ($err) {
          return json_encode(array('status' => false, 'message' => $err));
        } else {
            $result = json_decode($response);
            if ($result->type === "success") {
                return json_encode(array('status' => true, 'message' => 'OTP resend successfully!'));
            } else {
                return json_encode(array('status' => false, 'message' => $result->message));
            }
        }
    }

}
?>