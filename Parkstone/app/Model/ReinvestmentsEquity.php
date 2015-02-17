<?php

class ReinvestmentsEquity extends AppModel{
    
    var $name = 'ReinvestmentsEquity';
    var $usesTable = "reinvestments_equities";
    
    
    var $belongsTo = array(
//        'InvestmentDestination' => array(
//            'className' => 'InvestmentDestination',
//            'foreignKey' => 'investment_destination_id',
//            'conditions' => '',
//            'order' =>  '',
//            'limit' => '',
//            'dependent' => true
//        ),
//        'InvDestProduct' => array(
//            'className' => 'InvDestProduct',
//            'foreignKey' => 'inv_dest_product_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'Currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'EquitiesList' => array(
            'className' => 'EquitiesList',
            'foreignKey' => 'equity_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    
     var $hasMany = array(
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
         /*   'Rollover' => array(
            'className' => 'Rollover',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'InvestmentStatement' => array(
            'className' => 'InvestmentStatement',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );*/
    
}
?>
