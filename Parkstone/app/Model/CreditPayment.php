<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class CreditPayment extends AppModel {

    var $name = "CreditPayment";
    var $usesTable = "credit_payments";
    
     var $belongsTo = array(
          'Creditor' => array(
            'className' => 'Creditor',
            'foreignKey' => 'creditor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
           'Supplier' => array(
            'className' => 'Supplier',
            'foreignKey' => 'supplier_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
         'Item' => array(
            'className' => 'Item',
            'foreignKey' => 'item_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
    
}
?>
