<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TempcashAccount extends AppModel {

    var $name = "TempcashAccount";
    var $usesTable = "tempcash_accounts";
   
    
     var $belongsTo = array(
        'Expense' => array(
            'className' => 'Expense',
            'foreignKey' => 'expense_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         'Zone' => array(
            'className' => 'Zone',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         );
//            
//    var $hasMany = array(
//        'Loan' => array(
//            'className' => 'Loan',
//            'foreignKey' => 'tempcash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ), 
//        'Loanpayment' => array(
//            'className' => 'Loanpayment',
//            'foreignKey' => 'tempcash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        'LoanExpectedpayment' => array(
//            'className' => 'LoanExpectedpayment',
//            'foreignKey' => 'tempcash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        'BalanceSheet' => array(
//            'className' => 'BalanceSheet',
//            'foreignKey' => 'tempcash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        'IncomeStatement' => array(
//            'className' => 'IncomeStatement',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        
//        'Pettycash' => array(
//            'className' => 'Pettycash',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            )
//        );
 }
?>
