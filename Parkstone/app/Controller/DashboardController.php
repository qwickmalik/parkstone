<?php

class DashboardController extends AppController {

    var $name = 'Dashboard';
    var $uses = array('Dashboard');
    
/*
    function beforeFilter() {
        $this->__validateLoginStatus();
    }

    function __validateLoginStatus() {
        if ($this->action != 'login' && $this->action != 'logout') {
            if ($this->Session->check('userData') == false) {

                $this->redirect('/');
            }
        }
    }

    function __validateUserType() {

        $userType = $this->Session->read('userDetails.usertype_id');
        if ($userType != 1) {
            $message = 'Not enough privileges to view this resource!!';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }
    
    function __validateUserType2() {

        $userType = $this->Session->read('userDetails.usertype_id');
        switch($userType){
            case 1:
            case 7:
            case 8:
                
                break;
            default:
            $message = 'Not enough privileges to view this resource!!';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
                break;
        }
    }
*/
    function index() {
        // $this->__validateUserType();
        
    }

   

}

?>
