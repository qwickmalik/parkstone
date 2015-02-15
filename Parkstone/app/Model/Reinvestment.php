<?php

class Reinvestment extends AppModel{
    
    var $name = 'Reinvestment';
    var $usesTable = "reinvestments";
    
    
    var $belongsTo = array(
        /*'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' =>  array('Investor.fullname' => 'asc'),
            'limit' => '',
            'dependent' => true
        ),
        'Portfolio' => array(
            'className' => 'Portfolio',
            'foreignKey' => 'portfolio_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),*/
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
//        'EquitiesList' => array(
//            'className' => 'EquitiesList',
//            'foreignKey' => 'equity_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            )
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
