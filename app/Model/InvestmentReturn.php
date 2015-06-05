<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class InvestmentReturn extends AppModel{
    
    var $name = 'InvestmentReturn';
    var $usesTable = "investment_returns";
    
    
     var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         
         'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         
         'CashReceiptMode' => array(
            'className' => 'CashReceiptMode',
            'foreignKey' => 'cash_receipt_mode_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         
         'Instruction' => array(
            'className' => 'Instruction',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ));
      
    
}



?>
