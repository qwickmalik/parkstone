<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Cash/Bank Balances from company transactions
 *
 * @author Malik 
 */
class BankBalance extends AppModel {

    var $name = "BankBalance";
    var $usesTable = "bank_balances";
     var $displayField = "amount";
     
        var $hasMany = array(
        );
        
        var $belongsTo = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
//        'Bank' => array(
//            'className' => 'Bank',
//            'foreignKey' => 'bank_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true),
        );
    
       
}
