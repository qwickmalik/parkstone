<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Portfolio
 *
 * @author Brain
 */
class Portfolio extends AppModel {

    var $name = "Portfolio";
    var $usesTable = "portfolios";
    var $virtualFields = array("monthly_rates"=>"CONCAT(payment_name, ' - ' ,interest_rate,'%')");
    var $displayField = 'payment_name';
        
     var $hasMany = array(
        'Investment' => array(
            'className' => 'Investment',
            'foreignKey' => 'portfolio_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ));
    }

?>
