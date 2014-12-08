<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bank
 *
 * @author kwaku.afreh-nuamah
 */
class Bank extends AppModel {

    var $name = "Bank";
    var $usesTable = "banks";
     var $displayField = "bank_name";
       var $hasMany = array(
            'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'bank_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
);
    
}
