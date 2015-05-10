<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentStatement
 *
 * @author Brain
 */
class DailyInterestStatement extends AppModel {
    //put your code here
    
    var $name = "DailyInterestStatement";
    var $usesTable = "daily_interest_statements";
    
    
     var $belongsTo = array(
         'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
     
     
}

?>
