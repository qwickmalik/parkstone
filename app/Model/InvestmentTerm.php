<?php

class InvestmentTerm extends AppModel {
    var $name = "InvestmentTerm";
    var $usesTable = "investment_terms";
    var $displayField = "term_name";
    
    
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_term_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
