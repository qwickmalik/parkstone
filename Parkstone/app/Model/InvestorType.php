<?php
/**
 * Description of Investor Type subtable
 */
class InvestorType extends AppModel {
    var $name = "InvestorType";
    var $usesTable = "investor_types";
    var $displayField = "investor_type";
    
    
    var $hasMany = array(
	'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investor_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
