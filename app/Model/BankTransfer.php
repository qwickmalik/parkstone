<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Company Bank Accounts
 *
 * @author Malik 
 */
class BankTransfer extends AppModel {

    var $name = "BankTransfer";
    var $usesTable = "bank_transfers";
     var $displayField = "amount";
     
        var $hasMany = array(
        
        );
        
        var $belongsTo = array(
//        'Bank' => array(
//            'className' => 'Bank',
//            'foreignKey' => 'bank_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true),
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'source_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'dest_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
         'PaymentMode' => array(
            'className' => 'PaymentMode',
            'foreignKey' => 'payment_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)
        );
    
}
