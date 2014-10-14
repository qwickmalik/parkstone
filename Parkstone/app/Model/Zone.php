<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zone
 *
 * @author Brain
 */
class Zone extends AppModel {
    //put your code here
    var $name = "Zone";
    var $usesTable = "zones";
    var $displayField = "zone";
    
    var $hasMany = array(
        'Expectedinstallment' => array(
            'className' => 'Expectedinstallment',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Payment' => array(
            'className' => 'Payment',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Client' => array(
            'className' => 'Client',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Invoice' => array(
            'className' => 'Invoice',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'InvoiceoldEdition' => array(
            'className' => 'InvoiceoldEdition',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'PettycashWithdrawal' => array(
            'className' => 'PettycashWithdrawal',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'PettycashDeposit' => array(
            'className' => 'PettycashDeposit',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'TempcashAccount' => array(
            'className' => 'TempcashAccount',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Pettycash' => array(
            'className' => 'Pettycash',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        
        );
}

?>
