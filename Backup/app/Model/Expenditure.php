<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Expenditure extends AppModel {

    var $name = "Expenditure";
    var $usesTable = "expenditures";
   
    
     var $belongsTo = array(
        'Expense' => array(
            'className' => 'Expense',
            'foreignKey' => 'expense_id',
            'conditions' => '',
            'order' => '',
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
         ),
         'Userdepartment' => array(
             'className' => 'Userdepartment',
             'foreignKey' => 'userdepartment_id',
             'conditions' => '',
             'order' => '',
             'limit' => '',
             'dependent' => true
         )
         );
            
    
 }
?>
