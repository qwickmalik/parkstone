<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TransactionCategory extends AppModel {

    var $name = "TransactionCategory";
    var $usesTable = "transaction_categories";
     var $displayField = "category_name";
     
    var $hasMany = array(
        'Transaction' => array(
            'className' => 'Transaction',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        
        'TempcashAccount' => array(
            'className' => 'TempcashAccount',
            'foreignKey' => 'category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    var $belongsTo = array(
        'AccountingHead' => array(
            'className' => 'AccountingHead',
            'foreignKey' => 'head_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );
    
    function getTransactionCategories(){
        $result = $this->find('all');
        return $result;
    }
    
}
?>
