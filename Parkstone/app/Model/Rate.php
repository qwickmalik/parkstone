<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Rate extends AppModel {

    var $name = "Rate";
    var $usesTable = "rates";
    var $virtualFields = array("monthly_rates"=>"CONCAT(payment_name, ' - ' ,interest_rate,'%')");
    var $displayField = 'payment_name';
        
     var $hasMany = array(
        'Order' => array(
            'className' => 'Order',
            'foreignKey' => 'rate_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
          'InvoiceoldEdition' => array(
            'className' => 'InvoiceoldEdition',
            'foreignKey' => 'rate_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
}
?>
