<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expectedpayment
 *
 * @author Brain
 */
class Expectedpayment extends AppModel  {
    //put your code here
    var $name = "Expectedpayment";
    var $usesTable = "expectedpayments";
    
        var $belongsTo = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'order_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
        
        
    var $hasMany = array(
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'expectedpayment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
}

?>
