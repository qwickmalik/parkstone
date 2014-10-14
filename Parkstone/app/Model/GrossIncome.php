<?php

class GrossIncome extends AppModel{
	var $name = "GrossIncome";
	var $usesTable = "gross_incomes";
	var $displayField = "gross_income_name";
	
	var $hasMany = array(
		'Investor' => array(
			'className' => 'Investor',
            'foreignKey' => 'gross_income_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
		)
	);
}
?>