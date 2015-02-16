<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InvestmentDestination extends AppModel {

    var $name = "InvestmentDestination";
    var $usesTable = "investment_destinations";
    var $displayField = "company_name";
     var $hasMany = array(
         'InvDestProduct' => array(
            'className' => 'InvDestProduct',
            'foreignKey' => 'investment_destination_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true),
         'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'investment_destination_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true),
         );
    
    function getSetup(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('InvestmentDestination.id' => 1)));
        return $result;
    }
    
    function getCompanies(){
        $result = $this->find('all');
        return $result;
    }
     
    
}
?>
