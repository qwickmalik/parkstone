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
//       var $hasMany = array(
//            'Investor' => array(
//            'className' => 'Investor',
//            'foreignKey' => 'bank_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//           'BankAccount' => array(
//            'className' => 'BankAccount',
//            'foreignKey' => 'bank_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
//        );
    
}
