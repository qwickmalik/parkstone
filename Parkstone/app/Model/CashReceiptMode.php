<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Company Bank Accounts
 *
 * @author Abdul Malik Sulley
 */
class CashReceiptMode extends AppModel {
    var $name = "CashReceiptMode";
    var $usesTable = "cash_receipt_modes";
    var $displayField = "cash_receipt_mode";
    
    
    var $hasMany = array(
        'LedgerTransaction' => array(
            'className' => 'LedgerTransaction',
            'foreignKey' => 'cash_receipt_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Topup' => array(
            'className' => 'Topup',
            'foreignKey' => 'cash_receipt_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentReturn' => array(
            'className' => 'InvestmentReturn',
            'foreignKey' => 'cash_receipt_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
}

?>
