<?php

class Topup extends AppModel{
    
    var $name = 'Topup';
    var $usesTable = "topups";
    
    
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'CashReceiptMode' => array(
            'className' => 'CashReceiptMode',
            'foreignKey' => 'cash_receipt_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    
     
    
}
?>
