<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Setting extends AppModel {

    var $name = "Setting";
    var $usesTable = "settings";
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
        $result = $this->find('first',array('conditions' => array('Setting.id' => 1)));
        return $result;
    }
    
    function getSettings(){
        $result = $this->find('first',array('conditions' => array('Setting.id' => 1)));
        return $result;
    }
     
    
}
?>
