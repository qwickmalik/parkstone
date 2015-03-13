<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class ExchangeRate extends AppModel {

    var $name = "ExchangeRate";
    var $usesTable = "exchange_rates";
    
   
    var $belongsTo = array(
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ));
}
?>

