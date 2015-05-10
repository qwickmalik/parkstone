<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DebtPayment extends AppModel {

    var $name = "DebtPayment";
    var $usesTable = "debt_payments";
    
     var $belongsTo = array(
          'Debtor' => array(
            'className' => 'Debtor',
            'foreignKey' => 'debt_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
           'Sale' => array(
            'className' => 'Sale',
            'foreignKey' => 'sale_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ));
    
    
}
?>
