<?php

class ReinvestorEquity extends AppModel{
    
    var $name = 'ReinvestorEquity';
    var $usesTable = "reinvestor_equities";
    
    
    var $belongsTo = array(
        'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestment_id',
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
