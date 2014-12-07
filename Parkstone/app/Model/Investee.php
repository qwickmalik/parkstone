<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Investee extends AppModel {

    var $name = "Investee";
    var $usesTable = "investees";
    var $displayField = "company_name";
//     var $hasMany = array(
//        'Currency' => array(
//            'className' => 'Currency',
//            'foreignKey' => 'setting_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ));
    
    function getSetup(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('Investee.id' => 1)));
        return $result;
    }
    
    function getSettings(){
        $result = $this->find('first',array('conditions' => array('Investee.id' => 1)));
        return $result;
    }
     
    
}
?>
