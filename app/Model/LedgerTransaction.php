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
class LedgerTransaction extends AppModel {

    var $name = "LedgerTransaction";
    var $usesTable = "ledger_transactions";
     
       var $belongsTo = array(
        'ClientLedger' => array(
            'className' => 'ClientLedger',
            'foreignKey' => 'client_ledger_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
            'CashReceiptMode' => array(
            'className' => 'CashReceiptMode',
            'foreignKey' => 'cash_receipt_mode_id',
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
            ));
       
       var $hasMany = array(
        'InvestorDeposit' => array(
            'className' => 'InvestorDeposit',
            'foreignKey' => 'ledger_transaction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
}
