<?php

//App::uses('AppController', 'Controller');

class AccountingController extends AppController {

    public $name = 'Accounting';
    public $uses = array('CashAccount', 'CashAccount', 'User', 'Loan',
        'Zone', 'Userdepartment', 'TransactionCategory', 'Bank', 'Transaction',
        'AccountingHead', 'BankTransfer', 'BankBalance', 'StatedBankBalance','PaymentMode');
    var $paginate = array(
        'CashAccount' => array('limit' => 5, 'order' => array('CashAccount.id' => 'desc')),
        'BankTransfer' => array('limit' => 25, 'order' => array('BankTransfer.id' => 'desc')),
        'BankBalance' => array('limit' => 25, 'order' => array('BankBalance.id' => 'desc')),
        'Transaction' => array('limit' => 25, 'order' => array('Transaction.id' => 'desc')),
    );

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

    public function getLoggedInUser(){
        //set logged in user
                $user = null;
                if ($this->Session->check('userDetails.firstname')) {
                    $user_f = $this->Session->read('userDetails.firstname');
                    if ($this->Session->check('userDetails.lastname')) {
                        $user_l = $this->Session->read('userDetails.lastname');
                        $user = $user_f . ' ' . $user_l;
                        return $user;
                    } else {
                        $user = $user_f;
                        return $user;
                    }
                } elseif ($this->Session->check('userDetails.lastname')) {
                    $user = $this->Session->read('userDetails.lastname');
                    return $user;
                }
    }
    
    
    
    public function showRelevantRepository(){
        //Check user privilege and show relevant repository
        if ($this->Session->check('userDetails.usertype_id')) {

            $userType = $this->Session->read('userDetails.usertype_id');
            $zone_id = $this->Session->read('userDetails.zone_id');
            if ($userType == 1 || $userType == 7) {
                $this->set('zones', $this->Zone->find('list'));
                $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
                foreach ($accounts as $each_item) {
                    $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
                }
                $this->set('accounts', $list);
            } else {
                $this->set('zones', $this->Zone->find('list', ['conditions' => ['Zone.id' => $zone_id]]));
                $accounts = $this->CashAccount->find('all', array(
                    'fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone'),
                    'conditions' => array('CashAccount.zone_id' => $zone_id)));
                foreach ($accounts as $each_item) {
                    $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
                }
                $this->set('accounts', $list);
            }
        }
    }
    
    function index() {
        $this->__validateUserType();
    }
    function expenses($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 2, 'Transaction.delete' => 0));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 2))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 2), 'order' => 'TransactionCategory.category_name')));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
//        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                }
                
                
                
                $transact_type = $this->request->data['Transaction']['effect'];
                $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                if ($transact_type == 1){
                    $cash_asset_effect = 0;
                }elseif($transact_type == 0){//may never happen but useful for future purposes
                    $cash_asset_effect = 1;
                }
                
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit expenses request
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transaction_id = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal 
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase in expense = reduction in cash
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
//                                                $this->Transaction->delete($transaction_id, false);
//                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['credit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $cash_asset_effect;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }
                                        break;

                                    case '0': //Decrease which might never happen
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $cash_asset_effect;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new entry
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase in expense => reduction in cash
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                
                                                
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $cash_asset_effect;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    }
                                        break;

                                    case '0': //Decrease which might never happen 
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $cash_asset_effect;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

    public function delExpense($transaction_id = NULL) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
        $cash = $record['Transaction']['amount'];
         
        $transact_type = $record['Transaction']['effect'];
                
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transaction_id = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase in expense => give back the money
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        
                                        
//                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                        $trans_asset = $this->Transaction->find('first', array(
                                            'conditions' => array(
                                                'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                'Transaction.head_id' => 4, 
                                                'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                            ));
                                        $trans_asset_id = $trans_asset['Transaction']['id'];


                                        $main_data = array('id' => $transaction_id, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);

                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        }
                                break;

                            case '0': //Decrease in expense which might never happen
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $main_data = array('id' => $transaction_id, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
    
    function income($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 1, 'Transaction.delete' => 0));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 1))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 1), 'order' => 'TransactionCategory.category_name')));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
//        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                }
                
                
                
                $transact_type = $this->request->data['Transaction']['effect'];
                $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit income request
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transaction_id = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal 
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
//                                                $this->Transaction->delete($transaction_id, false);
//                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }
                                        break;

                                    case '0': //Decrease or withdrawal 
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['credit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new entry
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                
                                                
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    }
                                        break;

                                    case '0': //Decrease or withdrawal 
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['credit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

    public function delIncome($transaction_id = NULL) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
        $cash = $record['Transaction']['amount'];
         
        $transact_type = $record['Transaction']['effect'];
                
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transaction_id = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase or deposit
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        
                                        
//                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                        $trans_asset = $this->Transaction->find('first', array(
                                            'conditions' => array(
                                                'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                'Transaction.head_id' => 4, 
                                                'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                            ));
                                        $trans_asset_id = $trans_asset['Transaction']['id'];


                                        $main_data = array('id' => $transaction_id, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);

                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        }
                                break;

                            case '0': //Decrease or withdrawal
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $main_data = array('id' => $transaction_id, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
    
    function assets($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 4, 'Transaction.delete' => 0));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 4))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 4), 'order' => 'TransactionCategory.category_name')));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
//        $this->set('userdepartments', $this->Userdepartment->find('list'));
        
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        
        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['category_id'] == 101) & ($this->request->data['Transaction']['account_id'] == "" || $this->request->data['Transaction']['account_id'] == null || $this->request->data['Transaction']['paymentmode_id'] == "null" || $this->request->data['Transaction']['paymentmode_id'] == null)) {
                    $message = 'Please Select Cash Account/Repository and/or Payment Mode. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                }
                
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                }
                
                
                if($this->request->data['Transaction']['category_id'] == 101){ //cash asset
                    $transact_type = $this->request->data['Transaction']['effect']; 
                    $oldtransact_type = $this->request->data['Transaction']['old_effect'];;
                } else{
                    $transact_type = NULL;
                    $oldtransact_type = NULL;
                }
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit asset in progress
                    
                    //Do not allow change of Cash asset entry to non-cas and vice-versa
                    if ($this->request->data['Transaction']['old_category_id'] == 101 && $this->request->data['Transaction']['category_id'] != 101 ){
                        $message = 'The requested action is not allowed. Entry cannot be changed from Cash Asset to another category.';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                    }elseif ($this->request->data['Transaction']['old_category_id'] != 101 && $this->request->data['Transaction']['category_id'] == 101 ){
                        $message = 'The requested action is not allowed. Entry cannot be changed from another category to Cash Asset.';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                    }
                    
                    
                    if($this->request->data['Transaction']['category_id'] == 101){//cash asset
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transactionid = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                $this->Transaction->delete($transactionid, false);
                                                
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $this->request->data['Transaction']['credit'] = null;
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                }
                                        break;

                                    case '0': //Decrease or withdrawal
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->Transaction->delete($transactionid, false);
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $this->request->data['Transaction']['debit'] = NULL;
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                }
                                        break;
                                }
                            }
                        }
                    }
                     else{ //edit asset non-cash
                                
                                
                                if($this->request->data['Transaction']['effect'] ==1){
                                    $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                    $this->request->data['Transaction']['credit'] = NULL;
                                }else{
                                    $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                    $this->request->data['Transaction']['debit'] = NULL;
                                }
                                $this->Transaction->delete($transactionid, false);
                                $result = $this->Transaction->save($this->request->data);

                                if ($result){
                                    $this->request->data = null;

                                    $message = 'Transaction successfully added';
                                    $this->Session->write('smsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                } else{
                                    $message = 'Could not add new Transaction. Please report to System Administrator';
                                    $this->Session->write('emsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                }
                            }
                        
                        
                }
                elseif (empty($this->request->data['Transaction']['id']) && $this->request->data['Transaction']['category_id'] == 101) {//new entry but Cash
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $this->request->data['Transaction']['credit'] = null;
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                    }
                                        break;

                                    case '0': //Decrease or withdrawal. 
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                }else{

                                                    
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $this->request->data['Transaction']['debit'] = null;
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                } else{ //new entry not cash
                    if($this->request->data['Transaction']['effect'] ==1){
                        $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                        $this->request->data['Transaction']['credit'] = null;
                    }else{
                        $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                        $this->request->data['Transaction']['debit'] = NULL;
                    }
                    $result = $this->Transaction->save($this->request->data);

                        if ($result){
                            $this->request->data = null;

                            $message = 'Transaction successfully added';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                        } else{
                            $message = 'Could not add new Transaction. Please report to System Administrator';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                        }
                }
            }
        }
    }

    public function delAsset($transactionid = Null) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transactionid)));
        $cash = $record['Transaction']['amount'];
         
        if($record['Transaction']['category_id'] == 101 ){ // Cash asset 
            $transact_type = $record['Transaction']['effect'];
            $sacct_id = $record['Transaction']['account_id'];
            $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);

            if ($sbank_data) {
                $sbankBal = $this->BankBalance->find('first', array(
                    'conditions' => array('BankBalance.account_id' => $sacct_id),
                    'order' => array('BankBalance.id' => 'DESC')));
                $sbb_bal = $sbankBal['BankBalance']['amount'];
                   }  
                   if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];
                       switch ($transact_type){

                            case '1': //Increase or deposit
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                        $result = $this->Transaction->delete($transactionid, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        $main_data = array('id' => $transactionid, 'delete' => 1);
                                        $result = $this->Transaction->save($main_data);
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                        }
                                break;

                            case '0': //Decrease or withdrawal
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                        $result = $this->Transaction->delete($transactionid, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection

                                        $main_data = array('id' => $transactionid, 'delete' => 1);
                                        $result = $this->Transaction->save($main_data);
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                                        }
                                break;
                        }
   
                    }
        } else{
//            $transact_type = NULL;
//            $result = $this->Transaction->delete($transactionid, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
            
                $main_data = array('id' => $transactionid, 'delete' => 1);
                $result = $this->Transaction->save($main_data);


            if ($result) {
                $this->request->data = null;
                $message = 'Transaction successfully deleted';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
            } else {
                $message = 'Could not delete Transaction';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
            }
        } 
    }
   
    function liabilities($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 5));
        $this->set('data', $data);


        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 5))));
        $this->set('categoryids', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 5), 'order' => 'TransactionCategory.category_name')));

//        $this->set('account', $this->CashAccount->find('list'));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
        $this->set('loans', $this->Loan->find('list'));
        $this->set('zones', $this->Zone->find('list'));
        $this->set('userdepartments', $this->Userdepartment->find('list'));


        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['Transaction']['id'])) {
                    if ($this->request->data['Transaction']['category_id'] == "" || $this->request->data['Transaction']['category_id'] == null) {
                        $message = 'Please Enter Transaction Category';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }
//                    if ($this->request->data['Transaction']['account_id'] == "" || $this->request->data['Transaction']['account_id'] == null) {
//                        $message = 'Please Enter a Source Cash Account/Repository';
//                        $this->Session->write('emsg', $message);
//                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
//                    }
                    if ($this->request->data['Transaction']['amount'] == "" || $this->request->data['Transaction']['amount'] == null) {
                        $message = 'Please Enter Amount';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }


                    $transactionid = $this->request->data['Transaction']['id'];

                    $this->Transaction->delete($transactionid, false);
                    $result = $this->Transaction->save($this->request->data);


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Liability Successfully Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    } else {
                        $message = 'Could not Update Liability';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }
                } else {
                    if ($this->request->data['Transaction']['category_id'] == "" || $this->request->data['Transaction']['category_id'] == null) {
                        $message = 'Please Enter Transaction Category';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }
//                    if ($this->request->data['Transaction']['account_id'] == "" || $this->request->data['Transaction']['account_id'] == null) {
//                        $message = 'Please Enter a Source Cash Account/Repository';
//                        $this->Session->write('emsg', $message);
//                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
//                    }
                    if ($this->request->data['Transaction']['amount'] == "" || $this->request->data['Transaction']['amount'] == null) {
                        $message = 'Please Enter Amount';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }

                    $result = $this->Transaction->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Liability successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    } else {
                        $message = 'Could not add new Liability. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
                    }
                }
            }
        }
    }

    public function delLiability($transactionid = Null) {
        $this->autoRender = false;

        $result = $this->Transaction->delete($transactionid, false); //Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
        if ($result) {

            $message = 'Liability Successfully Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
        } else {
            $message = 'Could Not Delete Liability';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'liabilities'));
        }
    }
    
    function ownerEquity($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 3, 'Transaction.delete' => 0));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 3))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 3), 'order' => 'TransactionCategory.category_name')));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
//        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                }
                
                
                
                $transact_type = $this->request->data['Transaction']['effect'];
                $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit ownerEquity request
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transactionid = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal 
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
//                                                $this->Transaction->delete($transactionid, false);
//                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transactionid)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }
                                        break;

                                    case '0': //Decrease or withdrawal 
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                /*
                                                $this->Transaction->delete($transactionid, false);
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transactionid)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['credit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new entry
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                
                                                
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    }
                                        break;

                                    case '0': //Decrease or withdrawal 
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                /*
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                */
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $main_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $main_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $main_data['Transaction']['credit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($main_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

    public function delOwnerEquity($transactionid = NULL) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transactionid)));
        $cash = $record['Transaction']['amount'];
         
        $transact_type = $record['Transaction']['effect'];
                
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transactionid = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase or deposit
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        
                                        
//                                        $result = $this->Transaction->delete($transactionid, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transactionid)));
                                        $trans_asset = $this->Transaction->find('first', array(
                                            'conditions' => array(
                                                'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                'Transaction.head_id' => 4, 
                                                'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                            ));
                                        $trans_asset_id = $trans_asset['Transaction']['id'];


                                        $main_data = array('id' => $transactionid, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);

                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        }
                                break;

                            case '0': //Decrease or withdrawal
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                        $result = $this->Transaction->delete($transactionid, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $main_data = array('id' => $transactionid, 'delete' => 1);
                                        $cash_asset_data = array('id' => $trans_asset_id, 'delete' => 1);

                                        $save_data = array($main_data, $cash_asset_data);
                                        $result = $this->Transaction->saveMany($save_data);
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
    
/*
 * 
    function expenses($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 2));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 2))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 2))));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                }
                
                
                
                $transact_type = $this->request->data['Transaction']['effect'];
                $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit expenses request
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transaction_id = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase 
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;

                                    case '0': //Decrease which will virtually never happen
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase 
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }
                                        break;

                                    case '0': //Decrease which will virtually never happen
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new entry
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase 
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    }
                                        break;

                                    case '0': //Decrease which will virtually never happen
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

    public function delExpense($transaction_id = NULL) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
        $cash = $record['Transaction']['amount'];
         
        $transact_type = $record['Transaction']['effect'];
                
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transaction_id = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase 
                                        $sbb_bal = $sbb_bal + $cash; //put the money back
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        }
                                break;

                            case '0': //Decrease which will virtually never happen
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'expenses'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
    
 * function income($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 1));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 1))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 1))));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);


        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                }
                
                
                
                $transact_type = $this->request->data['Transaction']['effect'];
                $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //edit income request
                    $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transaction_id = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal which will virtually never happen
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }
                                        break;

                                    case '0': //Decrease or withdrawal which will virtually never happen
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->Transaction->delete($transaction_id, false);
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new entry
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    }
                                        break;

                                    case '0': //Decrease or withdrawal which will virtually never happen
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

    public function delIncome($transaction_id = NULL) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
        $cash = $record['Transaction']['amount'];
         
        $transact_type = $record['Transaction']['effect'];
                
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transaction_id = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase or deposit
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        }
                                break;

                            case '0': //Decrease or withdrawal
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'income'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
    
    function ownerEquity($transactionid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('Transaction', array('Transaction.head_id' => 3));
        $this->set('data', $data);

        $this->set('headids', $this->AccountingHead->find('list', array('conditions' => array('AccountingHead.id' => 3))));
        $this->set('categories', $this->TransactionCategory->find('list', array('conditions' => array('TransactionCategory.head_id' => 3))));
        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
//        $this->set('loans', $this->Loan->find('list'));
//        $this->set('zones', $this->Zone->find('list'));
//        $this->set('userdepartments', $this->Userdepartment->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        
//        
//        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
//        foreach ($accounts as $each_item) {
//            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
//        }
//        $this->set('accounts', $list);
//

        //Check user privilege and show relevant repository
        $this->showRelevantRepository();
        
        if ($transactionid != null && $transactionid != '') {
            $this->set('ex', $this->Transaction->find('first', ['conditions' => ['Transaction.id' => $transactionid]]));
        } else {
            if ($this->request->is('post')) {
                //set logged in user
                $user = $this->getLoggedInUser();
                
               
                if (($this->request->data['Transaction']['paymentmode_id'] == 2 || $this->request->data['Transaction']['paymentmode_id'] == 4)&& (trim($this->request->data['Transaction']['cheque_no']) == "" || trim($this->request->data['Transaction']['cheque_no']) == null)) {
                    $message = 'Please Enter Cheque Number. Unable to save entry.';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'assets'));
                }
                if ($this->request->data['Transaction']['cheque_cleared'] == 1 && ($this->request->data['Transaction']['cheque_no'] == "" || $this->request->data['Transaction']['cheque_no'] == null)) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                }
                
                
                if($this->request->data['Transaction']['category_id'] === '69'){
                    $transact_type = 0; // changed to decrease for the purpose of updating the bank balance
                    $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                } else{
                    $transact_type = $this->request->data['Transaction']['effect'];
                    $oldtransact_type = $this->request->data['Transaction']['old_effect'];
                }
                
                
                if (!empty($this->request->data['Transaction']['id'])) { //editing record
                     $cash = $this->request->data['Transaction']['amount'];
                    $sacct_id = $this->request->data['Transaction']['account_id'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                    $old_cash = $this->request->data['Transaction']['old_amount'];
                    $transaction_id = $this->request->data['Transaction']['id'];
                    
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC')));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                
                                
                                
                                switch($oldtransact_type){
                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $old_cash;
                                                
                                                break;

                                    case '0': //Decrease or withdrawal
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $old_cash;
                                                
                                                break;
                                }

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbb_bal + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
//                                                
//                                                $this->Transaction->delete($transaction_id, false);
//                                                
//                                                $this->request->data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $oe_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $oe_data['Transaction']['credit'] = $this->request->data['Transaction']['amount']; //OE investment is credit
                                                $oe_data['Transaction']['debit'] = null;
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = null;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($oe_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }
                                        break;

                                    case '0': //Decrease or withdrawal
                                                $sbb_bal = $sbb_bal - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
//                                                $this->Transaction->delete($transaction_id, false);
//                                                
//                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                $trans = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
                                                $trans_asset = $this->Transaction->find('first', array(
                                                    'conditions' => array(
                                                        'Transaction.random_salt' => $trans['Transaction']['random_salt'], 
                                                        'Transaction.head_id' => 4, 
                                                        'Transaction.transaction_date' => $trans['Transaction']['transaction_date'])
                                                    ));
                                                $trans_asset_id = $trans_asset['Transaction']['id'];
                                                
                                                
                                                $oe_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $oe_data['Transaction']['credit'] = null;
                                                $oe_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE withdrawal is debit
                                                
                                                        
                                                $cash_asset_data['Transaction']['id'] = $trans_asset_id;
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                $cash_asset_data['Transaction']['debit'] = null;
                                                
                                                $save_data = array($oe_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                if ($result && $result1) {
                                                    $this->request->data = null;
                                                    $message = 'Transaction Updated';
                                                    $this->Session->write('smsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                } else {
                                                    $message = 'Could not update Transaction';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }
                                        break;
                                }
                            }
                        }
                        
                        
                } else { //new record
                    $sacct_id = $sacct_id = $this->request->data['Transaction']['account_id'];
                    $cash = $this->request->data['Transaction']['amount'];
                    $sbank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $sacct_id]
                    ]);
                                      
                        if ($sbank_data) {
                            
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id),
                                'order' => array('BankBalance.id' => 'DESC'),
                                ));
                            
                            if ($sbankBal) {
                                $sbalance_id = $sbankBal['BankBalance']['id'];

                                 switch ($transact_type){

                                    case '1': //Increase or deposit
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] + $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $oe_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $oe_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($oe_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    }
                                        break;

                                    case '0': //Decrease or withdrawal. 
                                                if ($cash > $sbankBal['BankBalance']['amount']) {
                                                $message = 'Sorry withdrawal amount cannot be more than source account balance. Unable to save entry';
                                                    $this->Session->write('emsg', $message);
                                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                }else{
//                                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                                $sbb_bal = $sbankBal['BankBalance']['amount'] - $cash;
                                                $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                                    'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                                
//                                                $this->request->data['Transaction']['debit'] = $this->request->data['Transaction']['amount'];
//                                                $result = $this->Transaction->save($this->request->data);
//                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                $random_salt = uniqid(substr(str_replace(' ', '', $user), 0, 4));
                                                $this->request->data['Transaction']['random_salt'] = $random_salt;
                                                $oe_data = $this->request->data;
                                                $cash_asset_data = $this->request->data;
                                                
                                                $oe_data['Transaction']['debit'] = $this->request->data['Transaction']['amount']; //OE withdrawal is debit
                                                
                                                        
                                                $cash_asset_data['Transaction']['head_id'] = 4;
                                                $cash_asset_data['Transaction']['category_id'] = 101;
                                                $cash_asset_data['Transaction']['effect'] = $transact_type;
                                                $cash_asset_data['Transaction']['credit'] = $this->request->data['Transaction']['amount'];
                                                
                                                $save_data = array($oe_data, $cash_asset_data);
                                                $result = $this->Transaction->saveMany($save_data);
//                                                $result = $this->Transaction->save($this->request->data);
                                                $result1 = $this->BankBalance->save($sbankBal_array);
                                                
                                                    if ($result && $result1){
                                                        $this->request->data = null;

                                                        $message = 'Transaction successfully added';
                                                        $this->Session->write('smsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    } else{
                                                        $message = 'Could not add new Transaction. Please report to System Administrator';
                                                        $this->Session->write('emsg', $message);
                                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                                    }
                                                }
                                        break;
                                }
                            }
                        }
 
                }
            }
        }
    }

   
    public function delOwnerEq($transaction_id = Null) {
        $this->autoRender = false;
        $user = $this->getLoggedInUser();
        $record = $this->Transaction->find('first', array('conditions' => array('Transaction.id' => $transaction_id)));
        $cash = $record['Transaction']['amount'];
         if($record['Transaction']['category_id'] === '69'){
                    $transact_type = 0; // Owner Equity Withdrawal changed to decrease for the purpose of updating the bank balance 
                } else{
                    $transact_type = $record['Transaction']['effect'];
                }
        $sacct_id = $record['Transaction']['account_id'];
        $sbank_data = $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $sacct_id]]);
//            $old_cash = $this->request->data['Transaction']['old_amount'];
//            $transaction_id = $this->request->data['Transaction']['id'];

                if ($sbank_data) {

                    $sbankBal = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $sacct_id),
                        'order' => array('BankBalance.id' => 'DESC')));
                    $sbb_bal = $sbankBal['BankBalance']['amount'];
                            
                    if ($sbankBal) {
//                        $sbalance_id = $sbankBal['BankBalance']['id'];


                         switch ($transact_type){

                            case '1': //Increase or deposit
                                        $sbb_bal = $sbb_bal - $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        }
                                break;

                            case '0': //Decrease or withdrawal
                                        $sbb_bal = $sbb_bal + $cash;
                                        $sbankBal_array = array('id' => '', 'account_id' => $sacct_id,
                                            'amount' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                        $result = $this->Transaction->delete($transaction_id, false);//Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
                                        
                                        $result1 = $this->BankBalance->save($sbankBal_array);
                                        if ($result && $result1) {
                                            $this->request->data = null;
                                            $message = 'Transaction successfully deleted';
                                            $this->Session->write('smsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        } else {
                                            $message = 'Could not delete Transaction';
                                            $this->Session->write('emsg', $message);
                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'ownerEquity'));
                                        }
                                break;
                        }
                    }
                }
                        
    }
*/
    public function bankTransfers($transferid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('BankTransfer', array());
        $this->set('data', $data);


        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
        foreach ($accounts as $each_item) {
            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
        }
        $this->set('accounts', $list);
        $this->set('paymentmodes', $this->PaymentMode->find('list'));

        $this->set('banks', $this->Bank->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));


        if ($transferid != null && $transferid != '') { //request to edit record
            $this->set('ex', $this->BankTransfer->find('first', ['conditions' => ['BankTransfer.id' => $transferid]]));
        } else {//request to save new or edited record
            if ($this->request->is('post')) {
                /* input validations */
                $user = null;
                if ($this->Session->check('userDetails.firstname')) {
                    $user_f = $this->Session->read('userDetails.firstname');
                    if ($this->Session->check('userDetails.lastname')) {
                        $user_l = $this->Session->read('userDetails.lastname');
                        $user = $user_f . ' ' . $user_l;
                    } else {
                        $user = $user_f;
                    }
                } elseif ($this->Session->check('userDetails.lastname')) {
                    $user = $this->Session->read('userDetails.lastname');
                }

                if ($this->request->data['BankTransfer']['source_account_id'] == "" || $this->request->data['BankTransfer']['source_account_id'] == null) {
                    $message = 'Please Select a Source Account';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                }
                if ($this->request->data['BankTransfer']['dest_account_id'] == "" || $this->request->data['BankTransfer']['dest_account_id'] == null) {
                    $message = 'Please Select a Destination Account';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                }
                if ($this->request->data['BankTransfer']['amount'] == "" || $this->request->data['BankTransfer']['amount'] == null) {
                    $message = 'Please Enter Amount';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                }
                if ($this->request->data['BankTransfer']['cheque_cleared'] === 1) {
                    if ($this->request->data['BankTransfer']['cheque_no'] == "" || $this->request->data['BankTransfer']['cheque_no'] == null) {
                        $message = 'Please Enter Cheque Number. Unable to save';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                    }
                }
                /* input validations */
                 $this->request->data['BankTransfer']['payment_mode_id'] = $this->request->data['BankTransfer']['paymentmode_id'];
               
                if (!empty($this->request->data['BankTransfer']['id'])) { //save edited record
                    $transactionid = $this->request->data['BankTransfer']['id'];
                    $acct_id = $this->request->data['BankTransfer']['dest_account_id'];
                    $sacct_id = $this->request->data['BankTransfer']['source_account_id'];
                    $bank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $acct_id]
                    ]);
                    $old_transfer = $this->BankTransfer->find('first', array(
                        'conditions' => array('BankTransfer.id' => $transactionid)));
                    if ($old_transfer) {
                        $old_cash = $old_transfer['BankTransfer']['amount'];
                        if ($bank_data) {
                            $bank_id = $bank_data['CashAccount']['bank_id'];

                            // "Dispense Petty Cash";
                            $zone_id = $this->request->data['CashAccount']['zone_id'];
                            $cash = $this->request->data['BankTransfer']['amount'];
                            $sbank_data = $this->CashAccount->find('first', [
                                'conditions' => ['CashAccount.id' => $sacct_id]
                            ]);
                            if ($sbank_data) {
                                $sbankBal = $this->BankBalance->find('first', array(
                                    'conditions' => array('BankBalance.account_id' => $sacct_id)));
                                if ($sbankBal) {

                                    $sbalance_id = $sbankBal['BankBalance']['id'];
                                    $sbb_bal = $sbankBal['BankBalance']['balance'] + $old_cash;
                                    $sbb_bal = $sbb_bal - $cash;
                                    $sbankBal_array = array('id' => $sbalance_id,
                                        'balance' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                    $this->BankBalance->save($sbankBal_array);
                                }
                            }
                            $bankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $acct_id)));
                            if ($bankBal) {
                                $balanceid = $bankBal['BankBalance']['id'];
                                $bb_amt = $bankBal['BankBalance']['amount'] - $old_cash;
                                $bb_bal = $bankBal['BankBalance']['balance'] - $old_cash;
                                $bb_amt = $bb_amt + $cash;
                                $bb_bal = $bb_bal + $cash;
                                $bankBal_array = array('id' => $balanceid, 'amount' => $bb_amt,
                                    'balance' => $bb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                $bb_result = $this->BankBalance->save($bankBal_array);
                            }
                        }
                        $this->BankTransfer->delete($transactionid, false);
                        $result = $this->BankTransfer->save($this->request->data);

                        if ($result) {
                            $this->request->data = null;

                            $message = 'Bank Transfer Updated';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                        } else {
                            $message = 'Could not update Bank Transfer';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                        }
                    }
                } else { //save new record
                    $acct_id = $this->request->data['BankTransfer']['dest_account_id'];
                    $sacct_id = $this->request->data['BankTransfer']['source_account_id'];
                    $bank_data = $this->CashAccount->find('first', [
                        'conditions' => ['CashAccount.id' => $acct_id]
                    ]);

                    if ($bank_data) {
                        $bank_id = $bank_data['CashAccount']['bank_id'];

                        // "Dispense Petty Cash";
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $cash = $this->request->data['BankTransfer']['amount'];
                        $sbank_data = $this->CashAccount->find('first', [
                            'conditions' => ['CashAccount.id' => $sacct_id]
                        ]);
                        if ($sbank_data) {
                            $sbankBal = $this->BankBalance->find('first', array(
                                'conditions' => array('BankBalance.account_id' => $sacct_id)));
                            if ($sbankBal) {
                                if ($cash > $sbankBal['BankBalance']['balance']) {
                                    $message = 'Sorry transfer amount cannot be more than source account balance';
                                    $this->Session->write('bmsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                                }
                                $sbalance_id = $sbankBal['BankBalance']['id'];
                                $sbb_bal = $sbankBal['BankBalance']['balance'] - $cash;
                                $sbankBal_array = array('id' => $sbalance_id,
                                    'balance' => $sbb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                                $this->BankBalance->save($sbankBal_array);
                            }
                        }
                        $bankBal = $this->BankBalance->find('first', array(
                            'conditions' => array('BankBalance.account_id' => $acct_id)));
                        if ($bankBal) {
                            $balanceid = $bankBal['BankBalance']['id'];
                            $bb_amt = $bankBal['BankBalance']['amount'] + $cash;
                            $bb_bal = $bankBal['BankBalance']['balance'] + $cash;
                            $bankBal_array = array('id' => $balanceid, 'amount' => $bb_amt,
                                'balance' => $bb_bal, 'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'));
                            $bb_result = $this->BankBalance->save($bankBal_array);


                            if ($bb_result) {
                                $result = $this->BankTransfer->save($this->request->data);

                                if ($result) {
                                    $this->request->data = null;

                                    $message = 'Bank Transfer successfully added';
                                    $this->Session->write('smsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                                } else {
                                    $message = 'Could not add new Bank Transfer. Please report to System Administrator';
                                    $this->Session->write('emsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                                }
                            } else {
                                $message = 'Could not credit account. Please report to System Administrator';
                                $this->Session->write('emsg', $message);
                                $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                            }
                        } else {

                            $bankBal_array = array('amount' => $cash, 'balance' => $cash, 'account_id' => $acct_id,
                                'user' => $user, 'created' => date('Y-m-d H:i:s'), 'modified' => date('Y-m-d H:i:s'), 'bank_id' => $bank_id);
                            $bb_result = $this->BankBalance->save($bankBal_array);
                            if ($bb_result) {
                                $result = $this->BankTransfer->save($this->request->data);

                                if ($result) {
                                    $this->request->data = null;

                                    $message = 'Bank Transfer successfully added';
                                    $this->Session->write('smsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                                } else {
                                    $message = 'Could not add new Bank Transfer. Please report to System Administrator';
                                    $this->Session->write('emsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                                }
                            } else {
                                $message = 'Could not credit account. Please report to System Administrator';
                                $this->Session->write('emsg', $message);
                                $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
                            }
                        }
                    }
                }
            }
        }
    }

    function delBankTransfer($transferid = Null) {
        $this->autoRender = false;

        $result = $this->BankTransfer->delete($transferid, false); //Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
        if ($result) {

            $message = 'Bank Transfer Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
        } else {
            $message = 'Could Not Delete Bank Transfer';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankTransfers'));
        }
    }

    public function bankBalances($balanceid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('BankBalance');
        $this->set('data', $data);


        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));

        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
        foreach ($accounts as $each_item) {
            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
        }
        $this->set('accounts', $list);


        if ($balanceid != null && $balanceid != '') { //request to edit record
            $this->set('ex', $this->BankBalance->find('first', ['conditions' => ['BankBalance.id' => $balanceid]]));
        } else {//request to save new or edited record
            if ($this->request->is('post')) {
                /* input validations */
                if ($this->request->data['BankBalance']['statement_date'] == "" || $this->request->data['BankBalance']['statement_date'] == null) {
                    $message = 'Please enter Statement Date';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                }
                if ($this->request->data['BankBalance']['account_id'] == "" || $this->request->data['BankBalance']['account_id'] == null) {
                    $message = 'Please Select an Account';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                }
                if ($this->request->data['BankBalance']['balance'] == "" || $this->request->data['BankBalance']['balance'] == null) {
                    $message = 'Please Enter Balance';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                }
                /* end input validations */

                if (!empty($this->request->data['BankBalance']['id'])) { //save edited record
                    $balanceid = $this->request->data['BankBalance']['id'];

                    $this->BankBalance->delete($balanceid, false);
                    $result = $this->BankBalance->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Stated Bank Balance Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                    } else {
                        $message = 'Could not update Stated Bank Balance';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                    }
                } else { //save new record
                    $account_id = $this->request->data['BankBalance']['account_id'];
                    $acc_info = $this->BankBalance->find('first', array(
                        'conditions' => array('BankBalance.account_id' => $account_id), 'recursive' => -1));
                    if ($acc_info) {
//                        pr($acc_info);
//                        exit;
                        $this->request->data['BankBalance']['id'] = $acc_info['BankBalance']['id'];
                        $result = $this->BankBalance->save($this->request->data);
                    } else {
                        $result = $this->BankBalance->save($this->request->data);
                    }
//                    $result = $this->BankBalance->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Stated Bank Balance successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                    } else {
                        $message = 'Could not add new Stated Bank Balance. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
                    }
                }
            }
        }
    }

    function delBankBalance($balanceid = Null) {
        $this->autoRender = false;

        $result = $this->BankBalance->delete($balanceid, false); //Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
        if ($result) {

            $message = 'Stated Bank Balance Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
        } else {
            $message = 'Could Not Delete Stated Bank Balance';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'bankBalances'));
        }
    }

    public function statedBankBalances($balanceid = NULL) {
        $this->__validateUserType();
        $data = $this->paginate('StatedBankBalance');
        $this->set('data', $data);


        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));

        $accounts = $this->CashAccount->find('all', array('fields' => array('id', 'Bank.bank_name', 'account_no', 'Zone.zone')));
        foreach ($accounts as $each_item) {
            $list[$each_item['CashAccount']['id']] = $each_item['Zone']['zone'] . ' -- ' . $each_item['CashAccount']['account_no'] . ' (' . $each_item['Bank']['bank_name'] . ') ';
        }
        $this->set('accounts', $list);


        if ($balanceid != null && $balanceid != '') { //request to edit record
            $this->set('ex', $this->StatedBankBalance->find('first', ['conditions' => ['StatedBankBalance.id' => $balanceid]]));
        } else {//request to save new or edited record
            if ($this->request->is('post')) {
                /* input validations */
                if ($this->request->data['StatedBankBalance']['statement_date'] == "" || $this->request->data['StatedBankBalance']['statement_date'] == null) {
                    $message = 'Please enter Statement Date';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                }
                if ($this->request->data['StatedBankBalance']['account_id'] == "" || $this->request->data['StatedBankBalance']['account_id'] == null) {
                    $message = 'Please Select an Account';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                }
                if ($this->request->data['StatedBankBalance']['amount'] == "" || $this->request->data['StatedBankBalance']['amount'] == null) {
                    $message = 'Please Enter Balance';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                }
                /* end input validations */

                if (!empty($this->request->data['StatedBankBalance']['id'])) { //save edited record
                    $balanceid = $this->request->data['StatedBankBalance']['id'];

                    $this->StatedBankBalance->delete($balanceid, false);
                    $result = $this->StatedBankBalance->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Stated Bank Balance Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                    } else {
                        $message = 'Could not update Stated Bank Balance';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                    }
                } else { //save new record
                    $account_id = $this->request->data['StatedBankBalance']['account_id'];
                    $acc_info = $this->StatedBankBalance->find('first', array(
                        'conditions' => array('StatedBankBalance.account_id' => $account_id), 'recursive' => -1));
                    if ($acc_info) {
//                        pr($acc_info);
//                        exit;
                        $this->request->data['StatedBankBalance']['id'] = $acc_info['StatedBankBalance']['id'];
                        $result = $this->StatedBankBalance->save($this->request->data);
                    } else {
                        $result = $this->StatedBankBalance->save($this->request->data);
                    }
//                    $result = $this->StatedBankBalance->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Stated Bank Balance successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                    } else {
                        $message = 'Could not add new Stated Bank Balance. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
                    }
                }
            }
        }
    }

    function delStatedBankBalance($balanceid = Null) {
        $this->autoRender = false;

        $result = $this->StatedBankBalance->delete($balanceid, false); //Change this to update a "delete" field in the db so that no data is actually removed. for fraud protection
        if ($result) {

            $message = 'Stated Bank Balance Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
        } else {
            $message = 'Could Not Delete Stated Bank Balance';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Accounting', 'action' => 'statedBankBalances'));
        }
    }

    function imprest() {

        $this->set('data', $data);
        $this->set('expenses', $this->TransactionCategory->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
        $this->set('loans', $this->Loan->find('list'));
        $this->set('zones', $this->Zone->find('list'));

        $this->set('userdepartments', $this->Userdepartment->find('list'));
    }

    public function saveCash() {

        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data)) {

                $months = 0;
                $payment_day = $this->request->data['CashAccount']['expense_date']['day'];
                $payment_month = $this->request->data['CashAccount']['expense_date']['month'];
                $payment_year = $this->request->data['CashAccount']['expense_date']['year'];
                $fpayment_date = $payment_year . "-" . $payment_month . "-" . $payment_day;
                $spayment_date = strtotime($fpayment_date);
                $today = date('Y-m-d', $spayment_date);

                $this->request->data['CashAccount']['expense_date'] = $today;

                $usernn = "Unknown";
                if ($this->Session->check('userData')) {
                    $usernn = $this->Session->read('userData');
                    $usernn = ucwords(strtolower($usernn));
                } else {
                    $usernn = "Unknown";
                    $usernn = ucwords(strtolower($usernn));
                }
                $this->request->data['CashAccount']['prepared_by'] = $usernn;
                $expense_type = $this->request->data['CashAccount']['expense_type'];
                $dateSendday = date('d');
                $dateSendmonth = date('m');
                $dateSendyear = date('Y');
                switch ($expense_type) {

                    case 0:
                        $expensename = "Expense";
                        $amount = $this->request->data['CashAccount']['amount'];

                        $expense_id = $this->request->data['CashAccount']['expense_id'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $expense_desc = $this->request->data['CashAccount']['expense_desc'];
                        $source = $this->request->data['CashAccount']['source'];
                        $userType = $this->Session->read('userDetails.usertype_id');
                        $temp_entries = array('expense_id' => $expense_id, 'expense_type' => $expense_type, 'expense_desc' => $this->request->data['CashAccount']['expense_desc'], 'expense_date' => $today, 'source' => $source, 'zone_id' => $zone_id, 'amount' => $this->request->data['CashAccount']['amount'], 'prepared_by' => $this->request->data['CashAccount']['prepared_by'], 'paid_to' => $this->request->data['CashAccount']['paid_to'], 'remarks' => $this->request->data['CashAccount']['remarks']);

                        if ($userType != 1) {


                            $this->TempcashAccount->save($temp_entries);
                            $message = 'Cash Account Entry Successfully Added, Pending Approval!!';
                            $this->Session->write('smsg', $message);
                            $feedback = array("feedback" => "pending", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                            return json_encode($feedback);
                        }
                        switch ($source) {
                            case 0:

                                $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                if ($pettycash_search) {
                                    $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                    if ($pettycash_balance > 0 && $pettycash_balance >= $amount) {
                                        $pettycash_id = $pettycash_search['Pettycash']['id'];
                                        $newpc_balance = $pettycash_balance - $amount;
                                        $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if ($pc_result) {
                                            $resultt = $this->CashAccount->save($temp_entries);
                                            if ($resultt) {
                                                if (isset($pettycash_withdrawal)) {
                                                    $pettycash_withdrawal = array('pettycash_id' => $pettycash_id, 'amount' => $amount, 'expense_date' => $today, $pettycash_withdrawal['cash_account_id'] => $resultt['CashAccount']['id']);
                                                    $this->PettycashWithdrawal->save($pettycash_withdrawal);
                                                }
                                            }
                                            $message = 'Cash Account Entry Successfully Added!!';
                                            $this->Session->write('smsg', $message);
//
                                            $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                                            return json_encode($feedback);
                                        }
                                    } else {

                                        $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is Insufficient. Please Contact The CEO';
                                        $this->Session->write('bmsg', $message);
                                        $feedback = array("feedback" => "balzero");
                                        return json_encode($feedback);
                                    }
                                } else {

                                    $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';
                                    $this->Session->write('bmsg', $message);
                                    $feedback = array("feedback" => "balzero");
                                    return json_encode($feedback);
                                }

                                break;
                        }

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $result3 = $this->IncomeStatement->save($inStatement);

                        // $equity = array('description' => $description[Expense][payment_name], 'expenditure' => $amount, 'date' => $today);
                        break;

                    case 7:
                        $expensename = "Dispense Petty Cash";
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $cash = $this->request->data['CashAccount']['amount'];
                        $expense_desc = $this->request->data['CashAccount']['expense_desc'];

                        $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                        if ($pettycash_search) {
                            $pettycash_id = $pettycash_search['Pettycash']['id'];
                            $pettycash_amt = $pettycash_search['Pettycash']['amount'] + $cash;
                            $pettycash_bal = $pettycash_search['Pettycash']['balance'] + $cash;
                            $pettycash_array = array('id' => $pettycash_id, 'amount' => $pettycash_amt, 'balance' => $pettycash_bal);
                            $pc_result = $this->Pettycash->save($pettycash_array);
                            if ($pc_result) {
                                $pettydeposits_array = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $cash, 'expense_date' => $today);
                                //$pettycashdeposit_result =  $this->PettycashDeposit->save($pettydeposits_array);
//                                $message = 'Petty Cash Deposit Successfully Added!!';
//                                $this->Session->write('smsg', $message);

                                $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                            } else {

                                $message = 'Petty Cash Entry Unsuccessfully!!';
                                $this->Session->write('emsg', $message);

                                $feedback = array("feedback" => "unsuccessful");
                                return json_encode($feedback);
                            }
                        } else {
                            $pettycash_amt = $cash;
                            $pettycash_bal = $cash;
                            $pettycash_array = array('zone_id' => $zone_id, 'amount' => $pettycash_amt, 'balance' => $pettycash_bal);
                            $pc_result = $this->Pettycash->save($pettycash_array);
                            if ($pc_result) {
                                $pettycash_id = $pc_result['Pettycash']['id'];
                                $pettydeposits_array = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $cash);
                                //$pettycashdeposit_result = $this->PettycashDeposit->save($pettydeposits_array);
//                                $message = 'Petty Cash Deposit Successfully Added!!';
//                                $this->Session->write('smsg', $message);
                            } else {

                                $message = 'Cash Account Entry Unsuccessfully!!';
                                $this->Session->write('emsg', $message);

                                $feedback = array("feedback" => "unsuccessful");
                                return json_encode($feedback);
                            }
                        }

                        $amount = $this->request->data['CashAccount']['amount'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $result3 = $this->IncomeStatement->save($inStatement);


                        break;
                }

                $result = $this->CashAccount->save($this->request->data);
                $result2 = $this->BalanceSheet->save($balSheet);


                if ($result && $result2) {
                    $this->request->data = null;
                    if (isset($pettycash_withdrawal)) {
                        $pettycash_withdrawal['cash_account_id'] = $result['CashAccount']['id'];
                        $this->PettycashWithdrawal->save($pettycash_withdrawal);
                    }

                    if (isset($pettydeposits_array)) {
                        $pettydeposits_array['cash_account_id'] = $result['CashAccount']['id'];
                        $this->PettycashDeposit->save($pettydeposits_array);
                        $message = 'Petty Cash Deposit Successfully Added!!';
                        $this->Session->write('smsg', $message);
                    }
                    if (isset($lp_result)) {
                        $data = array('id' => $lp_result['Loanpayment']['id'], 'cash_account_id' => $result['CashAccount']['id']);
                        $this->Loanpayment->save($data);
                    }

                    $message = 'Cash Account Entry Successfully Added!!';
                    $this->Session->write('smsg', $message);

                    $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);

                    return json_encode($feedback);
                } else {

                    $message = 'Cash Account Entry Unsuccessfully!!';
                    $this->Session->write('emsg', $message);

                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
            } else {
                $message = 'No Data Entered, Check And Try Again!!';
                $this->Session->write('bmsg', $message);

                $feedback = array("feedback" => "No Data");
                return json_encode($feedback);
            }
        }
    }

    function redirectTOIndex() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/');
    }

    function redirectTOAuth() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/authoriseEntry/');
    }

    function redirectTOPettySummByZone() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/pettycashSummByZone/');
    }

    public function approveEntry($entryID = null, $status = Null) {
        $this->autoRender = false;
        if (($status != "" && !is_null($status)) && ($entryID != "" && !is_null($entryID))) {


            if ($status == "Approve") {


                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Pending')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Approved');
                    $amount = $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'];
                    $today = $entries['TempcashAccount']['expense_date'];

                    $temp_entries = array('expense_id' => $entries['TempcashAccount']['expense_id'], 'user_id' => $entries['TempcashAccount']['user_id'], 'expense_type' => $entries['TempcashAccount']['expense_type'], 'expense_desc' => $entries['TempcashAccount']['expense_desc'], 'expense_date' => $entries['TempcashAccount']['expense_date'], 'amount' => $entries['TempcashAccount']['amount'], 'zone_id' => $entries['TempcashAccount']['zone_id'], 'source' => $entries['TempcashAccount']['source'], 'prepared_by' => $entries['TempcashAccount']['prepared_by'], 'paid_to' => $entries['TempcashAccount']['paid_to'], 'remarks' => $entries['TempcashAccount']['remarks']);
                    $this->TempcashAccount->save($entry_array);
                    $result = $this->CashAccount->save($temp_entries);
                    $message = 'Cash Account Entry Successfully Approved';
                    $this->Session->write('smsg', $message);
                    if ($result) {

                        $zone_id = $entries['TempcashAccount']['zone_id'];
                        $source = $entries['TempcashAccount']['source'];

                        switch ($source) {
                            case 0:

                                $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                if ($pettycash_search) {
                                    $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                    if ($pettycash_balance > 0 && $pettycash_balance >= $amount) {
                                        $pettycash_id = $pettycash_search['Pettycash']['id'];
                                        $newpc_balance = $pettycash_balance - $amount;
                                        $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if ($pc_result) {
                                            $pettycash_withdrawal = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $amount, 'expense_date' => $entries['TempcashAccount']['expense_date'], 'cash_account_id' => $result['CashAccount']['id']);
                                            $this->PettycashWithdrawal->save($pettycash_withdrawal);

                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                                        }
                                    } else {

                                        $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';

                                        $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                                        $this->CashAccount->delete($result['CashAccount']['id']);
                                        $this->TempcashAccount->save($entry_array);
                                        $this->Session->write('bmsg', $message);
//                                    $feedback = array("feedback" => "balzero");
//                                    return json_encode($feedback);

                                        $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                                    }
                                } else {

                                    $message = 'Sorry, No Petty Cash Available';
                                    $this->Session->write('bmsg', $message);
                                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                                }
                                break;
                        }
                    }
                    $expense_desc = $entries['TempcashAccount']['expense_desc'];
                    $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $entries['TempcashAccount']['expense_id'])));

                    $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $entries['TempcashAccount']['amount'], 'date' => $today);
                    switch ($expense_desc) {
                        case 0:
                            $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                            break;
                        case 1:
                            $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                            break;
                        default:
                            $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                            break;
                    }
                    $this->IncomeStatement->save($inStatement);
                    $this->BalanceSheet->save($balSheet);

                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                } else {
                    $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Rejected')));

                    if ($entries) {

                        $entry_array = array('id' => $entryID, 'status' => 'Approved');

                        $amount = $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'];
                        $today = $entries['TempcashAccount']['expense_date'];

                        $temp_entries = array('expense_id' => $entries['TempcashAccount']['expense_id'], 'user_id' => $entries['TempcashAccount']['user_id'], 'expense_type' => $entries['TempcashAccount']['expense_type'], 'expense_desc' => $entries['TempcashAccount']['expense_desc'], 'expense_date' => $entries['TempcashAccount']['expense_date'], 'amount' => $entries['TempcashAccount']['amount'], 'zone_id' => $entries['TempcashAccount']['zone_id'], 'prepared_by' => $entries['TempcashAccount']['prepared_by'], 'paid_to' => $entries['TempcashAccount']['paid_to'], 'remarks' => $entries['TempcashAccount']['remarks']);

                        $this->TempcashAccount->save($entry_array);
                        $result = $this->CashAccount->save($temp_entries);
                        $message = 'Cash Account Entry Successfully Approved';
                        $this->Session->write('smsg', $message);
                        if ($result) {

                            $zone_id = $entries['TempcashAccount']['zone_id'];
                            $source = $entries['TempcashAccount']['source'];

                            switch ($source) {
                                case 0:

                                    $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                    if ($pettycash_search) {
                                        $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                        if ($pettycash_balance > 0 && $pettycash_balance >= $amount) {
                                            $pettycash_id = $pettycash_search['Pettycash']['id'];
                                            $newpc_balance = $pettycash_balance - $amount;
                                            $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                            $pc_result = $this->Pettycash->save($pettycash_array);
                                            if ($pc_result) {
                                                $pettycash_withdrawal = array('expense_date' => $entries['TempcashAccount']['expense_date'], 'pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $amount, 'cash_account_id' => $result['CashAccount']['id']);
                                                $this->PettycashWithdrawal->save($pettycash_withdrawal);

                                                $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                                            }
                                        } else {

                                            $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';

                                            $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                                            $this->CashAccount->delete($result['CashAccount']['id']);
                                            $this->TempcashAccount->save($entry_array);
                                            $this->Session->write('bmsg', $message);
//                                    $feedback = array("feedback" => "balzero");
//                                    return json_encode($feedback);

                                            $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                                        }
                                    }
                                    break;
                            }
                        }
                        $expense_desc = $entries['TempcashAccount']['expense_desc'];

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $entries['TempcashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $entries['TempcashAccount']['amount'], 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $this->IncomeStatement->save($inStatement);
                        $this->BalanceSheet->save($balSheet);

                        $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                    } else {

                        $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                        $this->Session->write('bmsg', $message);


                        $this->redirect(array('controller' => 'Accounting', 'action' => 'authoriseEntry'));
                    }
                }
            } elseif ($status == "Reject") {

                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Pending')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                    $this->TempcashAccount->save($entry_array);
                    $message = 'Cash Account Entry Successfully Disapproved';
                    $this->Session->write('smsg', $message);
                    if ($this->Session->check('isdata')) {
                        $this->Session->delete('isdata');
                    }

                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                } else {

                    $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                    $this->Session->write('bmsg', $message);


                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                }
            } elseif ($status == "Pend") {

                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Rejected')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Pending');
                    $this->TempcashAccount->save($entry_array);
                    $message = 'Cash Account Entry Set To Pending Successfully';
                    $this->Session->write('smsg', $message);
                    if ($this->Session->check('isdata')) {
                        $this->Session->delete('isdata');
                    }

                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                } else {

                    $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                    $this->Session->write('bmsg', $message);


                    $this->redirect(array('controller' => 'Accounting', 'action' => 'redirectTOAuth'));
                }
            }
        }
    }

    public function deleteEntry() {

        $this->__validateUserType();
        //$data = $this->paginate('CashAccount');
        if ($this->request->is('post')) {

            $sday = $this->request->data['CashAccount']['from']['day'];
            $smonth = $this->request->data['CashAccount']['from']['month'];
            $syear = $this->request->data['CashAccount']['from']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['CashAccount']['to']['day'];
            $emonth = $this->request->data['CashAccount']['to']['month'];
            $eyear = $this->request->data['CashAccount']['to']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            $date->add(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');

            $accounts = $this->CashAccount->find('count', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date)))));



            if ($accounts > 0) {
                $this->paginate = array(
                    'conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date))),
                    'order' => array('CashAccount.expense_date' => 'desc'));

                $order_details = $this->paginate('CashAccount');
//                pr($order_details);
//                exit;
                $this->set('data', $order_details);
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {

            //$order_details = $this->CashAccount->find('all');
            $this->paginate = array(
                'order' => array('CashAccount.expense_date' => 'desc'),
                'limit' => 50);

            $order_details = $this->paginate('CashAccount');
            $this->set('data', $order_details);
        }
    }

    public function authoriseEntry() {
        $this->__validateUserType();
        $data = $this->paginate('TempcashAccount');
        $this->set('zones', $this->Zone->find('list'));

        if ($this->request->is('post')) {

            $zoneid = $this->request->data['TempcashAccount']['zone_id'];
            $sday = $this->request->data['TempcashAccount']['begin_date']['day'];
            $smonth = $this->request->data['TempcashAccount']['begin_date']['month'];
            $syear = $this->request->data['TempcashAccount']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['TempcashAccount']['finish_date']['day'];
            $emonth = $this->request->data['TempcashAccount']['finish_date']['month'];
            $eyear = $this->request->data['TempcashAccount']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            $date->add(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');
            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }

            if ($zoneid != "" && $zoneid != null) {
                $accounts = $this->TempcashAccount->find('all', array('conditions' => array('AND' => array(array('TempcashAccount.expense_date >=' => $start_date), array('TempcashAccount.expense_date <=' => $end_date), array('TempcashAccount.zone_id' => $zoneid)))));



                if ($accounts) {

                    $this->set('data', $accounts);
                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata', true);

                    $this->redirect(array('controller' => 'Accounting', 'action' => 'authoriseEntry'));
                }
            } elseif ($zoneid == "") {

                $accounts = $this->TempcashAccount->find('all', array('conditions' => array('AND' => array(array('TempcashAccount.expense_date >=' => $start_date), array('TempcashAccount.expense_date <=' => $end_date)))));

                if ($accounts) {
                    $this->paginate = array(
                        'conditions' => array('conditions' => array('AND' => array(array('TempcashAccount.expense_date >=' => $start_date), array('TempcashAccount.expense_date <=' => $end_date)))),
                        'order' => array('TempcashAccount.id' => 'desc'),
                        'limit' => 50);

                    $accounts = $this->paginate('TempcashAccount');
                    $this->set('data', $accounts);
                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata', true);

                    $this->redirect(array('controller' => 'Accounting', 'action' => 'authoriseEntry'));
                }
            } else {
                $this->request->data = null;

                $message = 'Sorry, No Data Found For Selected Options';
                $this->Session->write('bmsg', $message);
                $this->Session->write('isdata', true);

                $this->redirect(array('controller' => 'Accounting', 'action' => 'authoriseEntry'));
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {

            if ($this->Session->check('isdata') == false) {
                $this->paginate = array(
                    'conditions' => array('TempcashAccount.status !=' => "Approved"),
                    'order' => array('TempcashAccount.id' => 'desc'),
                    'limit' => 25);

                $order_details = $this->paginate('TempcashAccount');

                // $order_details = $this->TempcashAccount->find('all', array('conditions' => array('TempcashAccount.status !=' => "Approved")));
                $this->set('data', $order_details);
            } else {
                
            }
        }
    }

}
