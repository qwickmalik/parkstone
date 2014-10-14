<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class DefaultingRate extends AppModel {

    var $name = "DefaultingRate";
    var $usesTable = "defaulting_rates";
        
    function getDefaultingRate(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('DefaultingRate.id' => 1)));
        return $result;
    }
    
}
?>
