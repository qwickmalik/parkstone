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
class CashAccount extends AppModel {

    var $name = "CashAccount";
    var $usesTable = "cash_accounts";
     var $displayField = "account_no";
     
        var $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'BankTransfer' => array(
            'className' => 'BankTransfer',
            'foreignKey' => 'source_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'BankTransfer' => array(
            'className' => 'BankTransfer',
            'foreignKey' => 'dest_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'BankBalance' => array(
            'className' => 'BankBalance',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'StatedBankBalance' => array(
            'className' => 'StatedBankBalance',
            'foreignKey' => 'account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );
        
        var $belongsTo = array(
        'Bank' => array(
            'className' => 'Bank',
            'foreignKey' => 'bank_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'Zone' => array(
            'className' => 'Zone',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        );
    
       
}
