<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class EquitiesList extends AppModel {

    var $name = "EquitiesList";
    var $usesTable = "equities_lists";
     var $displayField = "equity_abbrev";
     
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
//        'Reinvestment' => array(
//            'className' => 'Reinvestment',
//            'foreignKey' => 'equity_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            )
        );
    
    function getEquity(){
        $result = $this->find('all');
        return $result;
    }
    
}
?>
