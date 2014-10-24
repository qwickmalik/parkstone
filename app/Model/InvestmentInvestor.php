<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderItem
 *
 * @author Brain
 */
class InvestmentInvestor extends AppModel {

    var $name = "InvestmentInvestor";
    var $usesTable = "investment_investors";
    //var $virtualFields = array("total_cost"=>"(OrdersItem.cost_price * OrdersItem.quantity)","profit" => "(OrdersItem.hp_price - (OrdersItem.cost_price * OrdersItem.quantity))");
    
     var $belongsTo = array(
          'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
         'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ));
  
   

}

?>
