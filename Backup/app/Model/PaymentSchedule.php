<?php

class PaymentSchedule extends AppModel {
    var $name = "PaymentSchedule";
    var $usesTable = "payment_schedules";
    var $displayField = "payment_schedule_name";
    
    
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'payment_schedule_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
