<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Stated Bank Balance according to bank statements
 *
 * @author Malik 
 */
class StatedBankBalance extends AppModel {

    var $name = "StatedBankBalance";
    var $usesTable = "stated_bank_balances";
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
