<?php

class InformationController extends AppController {
    public $components = array('RequestHandler', 'Session');
    var $name = 'Information';
    var $uses = array('Information');
    
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
            $this->redirect('/Information/');
        }
    }

    function index() {
        
    }
    
    function aboutUs() {
      $this->__validateUserType();
    }
    
    function myHelp() {
      $this->__validateUserType();
    }
}
?>
