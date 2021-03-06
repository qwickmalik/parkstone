<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class InvestmentCash extends AppModel{
    
    var $name = 'InvestmentCash';
    var $usesTable = "investment_cashes";
    
    
     var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         'ReinvestorDeposit' => array(
            'className' => 'ReinvestorDeposit',
            'foreignKey' => 'reinvestor_deposit_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
	'InvestorDeposit' => array(
            'className' => 'InvestorDeposit',
            'foreignKey' => 'investor_deposit_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
      var $hasMany = array(
        'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'investment_cash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestmentsEquity' => array(
            'className' => 'ReinvestmentsEquity',
            'foreignKey' => 'investment_cash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
}



?>
