<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function fileupload() {
        // $filename = $_FILES['file']['name']; 
        // $data = file_get_contents($_FILES["file"]["tmp_name"]);
        // $encoded_data = base64_encode($data); 
        // https://hyundailivestreaming.com/web/binary/upload_attachment

        // $url = 'https://hyundailivestreaming.com/api/index/upload_audio?session_id=a6f265f02ecde01772db0715239dd4c190938e2f';
        // $data = array('rec_id' => 'value1', 'ufile' => $encoded_data);

        // // use key 'http' even if you send the request to https://...
        // $options = array(
        //     'http' => array(
        //         'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        //         'method'  => 'POST',
        //         'content' => http_build_query($data)
        //     )
        // );
        // $context  = stream_context_create($options);
        // $result = file_get_contents($url, false, $context);
        // if ($result === FALSE) { /* Handle error */ }

        // var_dump($result); 
 

        $data = array('args' => array(154), 'model' => "mail.channel", 'method' => "message_post", "kwargs" => array("attachment_ids"=> array(), "body" => 'sdsd', 'content_subtype'=> 'html', "message_type" => "comment", "partner_ids" => array(), "subtype" => "mail.mt_comment"));

        // $url = 'https://hyundailivestreaming.com/web/dataset/call_kw/mail.channel/message_post?session_id=a6f265f02ecde01772db0715239dd4c190938e2f';
        $data = array("uuid" => "23e32604-1697-4f51-97cb-5a72a8835f34","message_content" => "sdv");
        $data = json_encode($data);
 
        $url = 'https://hyundailivestreaming.com/mail/chat_post?session_id=a6f265f02ecde01772db0715239dd4c190938e2f';

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER,
                array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        $json_response = curl_exec($curl);
        
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ( $status != 201 ) {
            die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
        }
        
        
        curl_close($curl);
        var_dump($status); 
        var_dump($json_response);
    }
}