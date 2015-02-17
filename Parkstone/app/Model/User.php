<?php

class User extends AppModel {

    var $name = "User";
    var $usesTable = "users";
    var $displayField = "username";
    
    var $hasMany = array(
        'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'TempSale' => array(
            'className' => 'TempSale',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Expectedinstallment' => array(
            'className' => 'Expectedinstallment',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        
        'SupplyPayment' => array(
            'className' => 'SupplyPayment',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            
         'CashAccount' => array(
             'className' => 'CashAccount',
             'foreignKey' => 'user_id',
             'conditions' => '',
             'order' => '',
             'limit' => '',
             'dependent' => true
         ),
        'SalesItem' => array(
            'className' => 'SalesItem',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentPayment' => array(
            'className' => 'InvestmentPayment',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'Rollover' => array(
            'className' => 'Rollover',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'InvestmentStatement' => array(
            'className' => 'InvestmentStatement',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestorDeposit' => array(
            'className' => 'ReinvestorDeposit',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'ReinvestorCashaccount' => array(
            'className' => 'ReinvestorCashaccount',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestmentsEquity' => array(
            'className' => 'ReinvestmentsEquity',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );
    
    var $belongsTo = array(
        'Usertype' => array(
            'className' => 'Usertype',
            'foreignKey' => 'usertype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Userdepartment' => array(
            'className' => 'Userdepartment',
            'foreignKey' => 'userdepartment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    

    
    function getUserByUsername($username=null) {
        $condition = array('User.username' => $username);
        $results = $this->find('first',array('conditions' => $condition));
        return $results;
    }

    
    
}
?>