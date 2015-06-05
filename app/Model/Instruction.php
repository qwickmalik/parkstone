<?php

class Instruction extends AppModel {
    var $name = "Instruction";
    var $usesTable = "instructions";
    var $displayField = "instruction_name";
    
    
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentPayment' => array(
            'className' => 'InvestmentPayment',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentReturn' => array(
            'className' => 'InvestmentReturn',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
