<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class ReinvestorCashaccount extends AppModel {

    var $name = "ReinvestorCashaccount";
    var $usesTable = "reinvestor_cashaccounts";
    var $displayField = "id";
    
     var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' =>  '',
            'limit' => '',
            'dependent' => true
        ),
         'Reinvestor' => array(
            'className' => 'Reinvestor',
            'foreignKey' => 'reinvestor_id',
            'conditions' => '',
            'order' =>  '',
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
