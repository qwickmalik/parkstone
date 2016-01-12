<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class AggregateInterest extends AppModel {

    var $name = "AggregateInterest";
    var $usesTable = "aggregate_interests";
    
     var $belongsTo = array(
        'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ));
    
   
    
}
?>
