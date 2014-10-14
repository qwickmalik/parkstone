<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Pettycash extends AppModel {

    var $name = "Pettycash";
    var $usesTable = "pettycashes";
   
    
     var $belongsTo = array(
        'Zone' => array(
            'className' => 'Zone',
            'foreignKey' => 'zone_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)
         );
            
     
    var $hasMany = array(
        'PettycashWithdrawal' => array(
            'className' => 'PettycashWithdrawal',
            'foreignKey' => 'pettycash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'PettycashDeposit' => array(
            'className' => 'PettycashDeposit',
            'foreignKey' => 'pettycash_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        
        );
 }
?>
