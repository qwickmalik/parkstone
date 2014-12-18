<?php

class PaymentMode extends AppModel {
    var $name = "PaymentMode";
    var $usesTable = "payment_modes";
    var $displayField = "payment_mode_name";
    
    
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'payment_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>