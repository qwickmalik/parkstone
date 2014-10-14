<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Expectedinstallment
 *
 * @author Brain
 */
class Expectedinstallment extends AppModel {
    //put your code here
    var $name = "Expectedinstallment";
    var $usesTable = "expectedinstallments";

    var $belongsTo = array(
    'Zone' => array(
    'className' => 'Zone',
    'foreignKey' => 'zone_id',
    'conditions' => '',
    'order' => '',
    'limit' => '',
    'dependent' => true
    ),
    'Customer' => array(
    'className' => 'Customer',
    'foreignKey' => 'customer_id',
    'conditions' => '',
    'order' =>  array('Customer.fullname' => 'asc'),
    'limit' => '',
    'dependent' => true
    ),
    'Order' => array(
    'className' => 'Order',
    'foreignKey' => 'order_id',
    'conditions' => '',
    'order' => '',
    'limit' => '',
    'dependent' => true
    ),
    'Payment' => array(
    'className' => 'Payment',
    'foreignKey' => 'payment_id',
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
    ));


    
}

?>
