<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoanExpectedpayment
 *
 * @author Brain
 */
class LoanExpectedpayment  extends AppModel{
    //put your code here
    var $name = "LoanExpectedpayment";
    var $usesTable = "loan_expectedpayments";
        
          var $belongsTo = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         'Loan' => array(
            'className' => 'Loan',
            'foreignKey' => 'loan_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)    
              
              );
        
        
}

?>
