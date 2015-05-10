<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ClosingBalance extends AppModel {

    var $name = "ClosingBalance";
    var $usesTable = "closing_balances";
    
    var $belongsTo = array(
         'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
         'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
    
    
//    function saveDailyDefaulters($today){
//        
//        $this->
//    }
//    
}
?>
