<?php

//App::uses('AppController', 'Controller');


class CompanyAccountsController extends AppController {

    public $name = 'CompanyAccounts';
    public $uses = array();

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
            $this->redirect('/Settings/');
        }
    }

    function index() {
        //$this->__validateUserType();
    }

}
