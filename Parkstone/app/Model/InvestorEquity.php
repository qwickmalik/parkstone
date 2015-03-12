<?php

class InvestorEquity extends AppModel{
    
    var $name = 'InvestorEquity';
    var $usesTable = "investor_equities";
    
    
    var $belongsTo = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
        'EquitiesList' => array(
            'className' => 'EquitiesList',
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
        );
    
    
    
    
}
?>
