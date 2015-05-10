<?php

class ReinvestmentTopup extends AppModel{
    
    var $name = 'ReinvestmentTopup';
    var $usesTable = "reinvestment_topups";
    
    
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'PaymentMode' => array(
            'className' => 'PaymentMode',
            'foreignKey' => 'payment_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    
     
    
}
?>
