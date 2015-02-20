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
class ReinvestmentEquityStatement extends AppModel {
    //put your code here
    
    var $name = "ReinvestmentEquityStatement";
    var $usesTable = "reinvestment_equity_statements";
    
    
     var $belongsTo = array(
         'Reinvestment' => array(
            'className' => 'ReinvestmentEquity',
            'foreignKey' => 'reinvestment_equity_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
     
     
}

?>
