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
class DailyReinvestinterestStatement extends AppModel {
    //put your code here
    
    var $name = "DailyReinvestinterestStatement";
    var $usesTable = "daily_reinvestinterest_statements";
    
    
     var $belongsTo = array(
         'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestment_id',
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
            )
         );
     
     
}

?>
