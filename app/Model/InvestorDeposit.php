<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bank
 *
 * @author kwaku.afreh-nuamah
 */
class InvestorDeposit extends AppModel {

    var $name = "InvestorDeposit";
    var $usesTable = "investor_deposits";
     
       var $belongsTo = array(
        'LedgerTransaction' => array(
            'className' => 'LedgerTransaction',
            'foreignKey' => 'ledger_transaction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
            'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
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
	'Topup' => array(
            'className' => 'Topup',
            'foreignKey' => 'topup_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
       
       var $hasMany = array(
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'investor_deposit_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
}
