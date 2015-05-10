<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class PettycashDeposit extends AppModel {
    //put your code here
    
    var $name = "PettycashDeposit";
    var $usesTable = "pettycash_deposits";
    
    
     var $belongsTo = array(
         
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'PettyCash' => array(
            'className' => 'Pettycash',
            'foreignKey' => 'pettycash_id',
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
            'dependent' => true)
         );
}

?>
