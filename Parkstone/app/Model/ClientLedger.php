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
class ClientLedger extends AppModel {

    var $name = "ClientLedger";
    var $usesTable = "client_ledgers";
     var $displayField = "voucher_no";
     
       var $belongsTo = array(
            'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
       
        var $hasMany = array(
        'LedgerTransaction' => array(
            'className' => 'LedgerTransaction',
            'foreignKey' => 'client_ledger_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
}
