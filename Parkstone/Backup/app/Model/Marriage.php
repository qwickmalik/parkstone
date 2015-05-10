<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubMaritalStatus
 *
 * @author Brain
 */
class Marriage extends AppModel {
    var $name = "Marriage";
    var $usesTable = "marriages";
    var $displayField = "marital_status";
    
    
    var $hasMany = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'marriage_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
