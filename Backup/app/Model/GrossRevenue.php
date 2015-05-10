<?php

class GrossRevenue extends AppModel{
	var $name = "GrossRevenue";
	var $usesTable = "gross_revenues";
	var $displayField = "gross_revenue_name";
	
	var $hasMany = array(
		'Investor' => array(
			'className' => 'Investor',
            'foreignKey' => 'gross_revenue_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
		)
	);
}
?>