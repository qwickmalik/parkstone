<?php

class InvestmentProduct extends AppModel {
    var $name = "InvestmentProduct";
    var $usesTable = "investment_products";
    var $displayField = "product_name";
    
    
    var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'investment_product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'ReinvestorDeposit' => array(
            'className' => 'ReinvestorDeposit',
            'foreignKey' => 'investment_product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        );
}

?>
