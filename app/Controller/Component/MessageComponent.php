<?php

App::uses('Component', 'Controller');
//App::import('Vendor', 'NuSOAP', array('file' => 'nusoap/nusoap.php'));
App::import('Vendor', 'Integrator', array('file' => 'MtbIntegrator2/Integrator.php'));


class MessageComponent extends Component {
     
    public function sendSMS($msg, $send_no) {
        
$username = "dzifaanyasor@yahoo.com";
$password="24112011";
$appId="1234";
$wsdl="http://go.mytxtbuddy.com/ws/mtbservice?wsdl";


        
$mtb = new Integrator($wsdl,$username,$password,$appId);
       // $mtb = new IntegratorImpl();
        if (trim($msg) == "") {
            return false;
        }
//        
//        $userDetail = $mtb->login();
//       
//        
//        if($userDetail != 1){
//            return false;
//        }
//        
        //check balance
//        $balance = $this->__checkBalance($userDetail->key);
//        if($balance->status != 1){
//            return false;
//        }
            
        $subject = 'UCSL';
        $from = 'UCSL';
      
            $result = $mtb->sendMessage($subject, $msg, $send_no, $from);
            
//            $client = new nusoap_client($wsdl_url,true);
//            $result = $client->call('sendMessage', array('params' => $params));
            //return $result;
        
        
    }
    
     public function sendSMS_old($msg, $send_no) {

        if (trim($msg) == "") {
            return false;
        }

        $msg = urlencode($msg);

        $url = "http://121.241.242.114:8080/bulksms/bulksms?username=sob-uscl&password=smylnb&type=0&dlr=0&destination=" . $send_no . "&source=USCL&message=" . $msg;


        $result = file_get_contents($url);
        return $result;
    }

}

?>
