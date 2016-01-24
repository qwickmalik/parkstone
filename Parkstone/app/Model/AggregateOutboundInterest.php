<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class AggregateOutboundInterest extends AppModel {

    var $name = "AggregateOutboundInterest";
    var $usesTable = "aggregate_outbound_interests";
    
     var $belongsTo = array(
        'InvDestProduct' => array(
            'className' => 'InvDestProduct',
            'foreignKey' => 'inv_dest_product_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ));
    
   
    
}
?>
