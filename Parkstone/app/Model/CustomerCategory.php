<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerCategory
 *
 * @author INESS
 */
class CustomerCategory extends AppModel {
    var $name = "CustomerCategory";
    var $usesTable = "customer_categories";
    var $displayField = "customer_category";
    
    
    var $hasMany = array(
//        'Customer' => array(
//            'className' => 'Customer',
//            'foreignKey' => 'customer_category_id',
//            'conditions' => '',
//            'order' => '',
//            'limit' => '',
//            'dependent' => true
//            ),
         'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'customer_category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
}

?>
