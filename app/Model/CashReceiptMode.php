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
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'cashreceiptmode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
//        'ReinvestorDeposit' => array(
//            'className' => 'ReinvestorDeposit',
//            'foreignKey' => 'cashreceiptmode_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
        );
}

?>
