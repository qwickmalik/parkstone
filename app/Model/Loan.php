<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loan
 *
 * @author Brain
 */
class Loan extends AppModel {

    var $name = "Loan";
    var $usesTable = "loans";
    var $displayField = "loan_name";
   
    var $belongsTo = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true));
    
    var $hasMany = array(
        'Loanpayment' => array(
            'className' => 'Loanpayment',
            'foreignKey' => 'loan_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'LoanExpectedpayment' => array(
            'className' => 'LoanExpectedpayment',
            'foreignKey' => 'loan_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
}

?>
