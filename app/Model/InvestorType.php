<?php
/**
 * Description of Investor Type subtable
 */
class InvestorType extends AppModel {
    var $name = "InvestorType";
    var $usesTable = "investor_types";
    var $displayField = "investor_type";
    
    
    var $hasMany = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'investor_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
