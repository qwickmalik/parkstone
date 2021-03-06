<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Currency extends AppModel {

    var $name = "Currency";
    var $usesTable = "currencies";
    var $displayField = "currency_name";

    
var $belongsTo = array(
        'Setting' => array(
            'className' => 'Setting',
            'foreignKey' => 'setting_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
    );

var $hasMany = array(
        'ExchangeRate' => array(
            'className' => 'ExchangeRate',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
//        'BankAccount' => array(
//            'className' => 'BankAccount',
//            'foreignKey' => 'currency_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestorDeposit' => array(
            'className' => 'ReinvestorDeposit',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
    'ReinvestmentsEquity' => array(
            'className' => 'ReinvestmentsEquity',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );

function getCurrency($currency_id = null){
        $result = $this->find('first',array('conditions' => array('Currency.id' => $currency_id)));
        return $result;
    }
    
    
}
?>
