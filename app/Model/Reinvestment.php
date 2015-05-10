<?php

class Reinvestment extends AppModel{
    
    var $name = 'Reinvestment';
    var $usesTable = "reinvestments";
    
    
    var $belongsTo = array(
        'InvestmentDestination' => array(
            'className' => 'InvestmentDestination',
            'foreignKey' => 'investment_destination_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
        'InvDestProduct' => array(
            'className' => 'InvDestProduct',
            'foreignKey' => 'inv_dest_product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
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
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'investment_cash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    
     var $hasMany = array(
        'ReinvestmentRollover' => array(
            'className' => 'ReinvestmentRollover',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestmentStatement' => array(
            'className' => 'ReinvestmentStatement',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestorEquity' => array(
            'className' => 'ReinvestorEquity',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'DailyReinvestinterestStatement' => array(
            'className' => 'DailyReinvestinterestStatement',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentReturn' => array(
            'className' => 'InvestmentReturn',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestmentTopup' => array(
            'className' => 'ReinvestmentTopup',
            'foreignKey' => 'reinvestment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
    
}
?>