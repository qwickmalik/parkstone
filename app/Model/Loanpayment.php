<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loanpayment
 *
 * @author Brain
 */
class Loanpayment extends AppModel {
    //put your code here
    var $name = "Loanpayment";
    var $usesTable = "loanpayments";
    
    var $belongsTo = array(
        'Loan' => array(
            'className' => 'Loan',
            'foreignKey' => 'loan_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true));
}

?>
