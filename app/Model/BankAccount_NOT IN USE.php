<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Company Bank Accounts
 *
 * @author Abdul Malik Sulley
 */
class BankAccount extends AppModel {

    var $name = "BankAccount";
    var $usesTable = "bank_accounts";
     var $displayField = "account_no";
       var $belongsTo = array(

        'Bank' => array(
            'className' => 'Bank',
            'foreignKey' => 'bank_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
           
           );
    
}
