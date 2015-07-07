<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ReinvestInterestAccrual extends AppModel {

    var $name = "ReinvestInterestAccrual";
    var $usesTable = "reinvest_interest_accruals";
    
     var $belongsTo = array(
        'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
        'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestment_id',
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
