<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InterestAccrual extends AppModel {

    var $name = "InterestAccrual";
    var $usesTable = "interest_accruals";
    
     var $belongsTo = array(
        'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ));
    
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
