<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Cash/Bank Balances from company transactions
 *
 * @author Malik 
 */
class ManagementFee extends AppModel {

    var $name = "ManagementFee";
    var $usesTable = "management_fees";
     
        
        var $belongsTo = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true)
        );
    
       
}
