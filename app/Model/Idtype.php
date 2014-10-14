<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Idtype
 *
 * @author Brain
 */
class Idtype extends AppModel {
     var $name = "Idtype";
    var $usesTable = "idtypes";
    var $displayField = "id_type";
    
    
    var $hasMany = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'idtype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
