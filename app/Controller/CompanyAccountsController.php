<?php

//App::uses('AppController', 'Controller');


class CompanyAccountsController extends AppController {

    public $name = 'CompanyAccounts';
    public $uses = array('BankAccount', 'Bank', 'Currency');

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
        $this->__validateUserType();
    }
    
    function bankTransactions() {
        $this->__validateUserType();
        
    }
    
    function bankDeposits() {
        $this->__validateUserType();
        $this->set('bank_accounts', $this->BankAccount->find('list'));
    }
    
    function bankWithdrawals() {
        $this->__validateUserType();
        $this->set('bank_accounts', $this->BankAccount->find('list'));
    }

}
