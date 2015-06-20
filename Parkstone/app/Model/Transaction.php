<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Transaction extends AppModel {

    var $name = "Transaction";
    var $usesTable = "transactions";
   
    
     var $belongsTo = array(
        'TransactionCategory' => array(
            'className' => 'TransactionCategory',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         
         'AccountingHead' => array(
            'className' => 'AccountingHead',
            'foreignKey' => 'head_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         
         'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         'PaymentMode' => array(
            'className' => 'PaymentMode',
            'foreignKey' => 'paymentmode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)
         );
            
    var $hasMany = array(
//        'Loan' => array(
//            'className' => 'Loan',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ), 
//        'Loanpayment' => array(
//            'className' => 'Loanpayment',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        'LoanExpectedpayment' => array(
//            'className' => 'LoanExpectedpayment',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        'BalanceSheet' => array(
//            'className' => 'BalanceSheet',
//            'foreignKey' => 'cash_account_id',
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
//        'PettycashDeposit' => array(
//            'className' => 'PettycashDeposit',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),        
//        'PettycashWithdrawal' => array(
//            'className' => 'PettycashWithdrawal',
//            'foreignKey' => 'cash_account_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            )
        );
    
    
        
        
        
        
 }
?>
