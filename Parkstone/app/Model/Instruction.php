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
            ));
}

?>
