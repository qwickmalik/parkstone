<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentPayment
 *
 * @author Brain
 */
class InvestmentPayment extends AppModel {
    //put your code here
    
    var $name = "InvestmentPayment";
    var $usesTable = "investment_payments";
    var $actsAs = array('Containable');
    
     var $belongsTo = array(
         'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         ,'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Instruction' => array(
            'className' => 'Instruction',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'PaymentMode' => array(
            'className' => 'PaymentMode',
            'foreignKey' => 'payment_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
     
     
}

?>
