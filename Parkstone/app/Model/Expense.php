<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Expense extends AppModel {

    var $name = "Expense";
    var $usesTable = "expenses";
     var $displayField = "payment_name";
     
    var $hasMany = array(
        'CashAccount' => array(
            'className' => 'CashAccount',
            'foreignKey' => 'expense_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'TempcashAccount' => array(
            'className' => 'TempcashAccount',
            'foreignKey' => 'expense_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    function getExpenses(){
        $result = $this->find('all');
        return $result;
    }
    
}
?>
