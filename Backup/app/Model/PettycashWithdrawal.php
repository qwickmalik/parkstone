<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PettycashWithdrawal
 *
 * @author Brain
 */
class PettycashWithdrawal extends AppModel {
    //put your code here
    
    var $name = "PettycashWithdrawal";
    var $usesTable = "pettycash_withdrawals";
    
    
     var $belongsTo = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'cash_account_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'Pettycash' => array(
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
