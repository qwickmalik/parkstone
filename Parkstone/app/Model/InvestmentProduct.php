<?php

class InvestmentProduct extends AppModel {
    var $name = "InvestmentProduct";
    var $usesTable = "investment_products";
    var $displayField = "product_name";
    
    
    var $hasMany = array(
        'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investment_product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
