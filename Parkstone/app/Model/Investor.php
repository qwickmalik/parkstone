<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Investor
 *
 * @author Brain
 */
class Investor extends AppModel{
    
    var $name = 'Investor';
    var $usesTable = "investors";
    
    var $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
          ),
      
        'CustomerCategory' => array(
            'className' => 'CustomerCategory',
            'foreignKey' => 'customer_category_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
		'GrossIncome' => array(
            'className' => 'GrossIncome',
            'foreignKey' => 'gross_income_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
		'PaymentTerm' => array(
            'className' => 'PaymentTerm',
            'foreignKey' => 'payment_term_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
		'PaymentSchedule' => array(
            'className' => 'PaymentSchedule',
            'foreignKey' => 'payment_shedule_id',
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
	);
    
    
        var $hasMany = array(
            'InvestmentPayment' => array(
            'className' => 'InvestmentPayment',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'Rollover' => array(
            'className' => 'Rollover',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'InvestmentStatement' => array(
            'className' => 'InvestmentStatement',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
            );
}

?>
