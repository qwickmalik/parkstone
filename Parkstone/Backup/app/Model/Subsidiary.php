<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Subsidiary extends AppModel {

    var $name = "Subsidiary";
    var $usesTable = "subsidiaries";
     var $hasMany = array(
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'setting_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
    function getSetup(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('Subsidiary.id' => 1)));
        return $result;
    }
    
    function getSettings(){
        $result = $this->find('first',array('conditions' => array('Subsidiary.id' => 1)));
        return $result;
    }
     
    
}
?>
