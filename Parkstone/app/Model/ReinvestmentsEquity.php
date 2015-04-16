<?php

class ReinvestmentsEquity extends AppModel{
    
    var $name = 'ReinvestmentsEquity';
    var $usesTable = "reinvestments_equities";
    
    
    var $belongsTo = array(
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
        'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
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
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'investment_cash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
//    var $hasMany = array(
//        'ReinvestmentEquityStatement' => array(
//            'className' => 'ReinvestmentEquityStatement',
//            'foreignKey' => 'reinvestment_equity_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            )
//         );
    
    
}
?>
