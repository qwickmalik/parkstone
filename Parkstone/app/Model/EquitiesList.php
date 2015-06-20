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
        'InvestorEquity' => array(
            'className' => 'InvestorEquity',
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestorEquity' => array(
            'className' => 'ReinvestorEquity',
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'EquityOrder' => array(
            'className' => 'EquityOrder',
            'foreignKey' => 'equities_list_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );
    
    function getEquity(){
        $result = $this->find('all');
        return $result;
    }
    
}
?>
