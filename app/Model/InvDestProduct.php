<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class InvDestProduct extends AppModel {

    var $name = "InvDestProduct";
    var $usesTable = "inv_dest_products";
    var $displayField = "inv_dest_product";
     
     var $belongsTo = array(
         'InvestmentDestination' => array(
            'className' => 'InvestmentDestination',
            'foreignKey' => 'investment_destination_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true),
     );
    
    function getSetup(){
        $this->id = 1;
        $result = $this->find('first',array('conditions' => array('InvDestProduct.id' => 1)));
        return $result;
    }
    
    function getCompanies(){
        $result = $this->find('all');
        return $result;
    }
     
    
}
?>
