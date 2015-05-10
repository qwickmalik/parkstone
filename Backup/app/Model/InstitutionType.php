<?php

class InstitutionType extends AppModel{
	var $name = "InstitutionType";
	var $usesTable = "institution_types";
	var $displayField = "inst_type_name";
	
	var $hasMany = array(
		'Investor' => array(
			'className' => 'Investor',
            'foreignKey' => 'institution_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
		));
}
?>