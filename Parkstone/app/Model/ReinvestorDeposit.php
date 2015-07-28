<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ReinvestorDeposit extends AppModel {

    var $name = "ReinvestorDeposit";
    var $usesTable = "reinvestor_deposits";
    var $displayField = "id";
     var $belongsTo = array(
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'PaymentMode' => array(
            'className' => 'PaymentMode',
            'foreignKey' => 'payment_mode_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
         'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
     
      var $hasMany = array(
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'reinvestor_deposit_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    
//    function getSetup(){
//        $this->id = 1;
//        $result = $this->find('first',array('conditions' => array('Reinvestor.id' => 1)));
//        return $result;
//    }
//    
//    function getCompanies(){
//        $result = $this->find('all');
//        return $result;
//    }
     
    
}
?>
