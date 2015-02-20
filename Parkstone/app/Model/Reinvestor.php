<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class Reinvestor extends AppModel {

    var $name = "Reinvestor";
    var $usesTable = "reinvestors";
    var $displayField = "company_name";
     var $hasMany = array(
        'ReinvestorDeposit' => array(
            'className' => 'ReinvestorDeposit',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'ReinvestorCashaccount' => array(
            'className' => 'ReinvestorCashaccount',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Reinvestment' => array(
            'className' => 'Reinvestment',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'ReinvestmentsEquity' => array(
            'className' => 'ReinvestmentsEquity',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'ReinvestmentRollover' => array(
            'className' => 'ReinvestmentRollover',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'ReinvestmentStatement' => array(
            'className' => 'ReinvestmentStatement',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
    
    function getSetup(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('Reinvestor.id' => 1)));
        return $result;
    }
    
    function getCompanies(){
        $result = $this->find('all');
        return $result;
    }
     
    
}
?>
