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
        'Bank' => array(
            'className' => 'Bank',
            'foreignKey' => 'bank_id',
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
        'InstitutionType' => array(
            'className' => 'InstitutionType',
            'foreignKey' => 'institution_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'GrossRevenue' => array(
            'className' => 'GrossRevenue',
            'foreignKey' => 'gross_revenue_id',
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
        'InvestorType' => array(
            'className' => 'InvestorType',
            'foreignKey' => 'investor_type_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        ),
        'Idtype' => array(
            'className' => 'Idtype',
            'foreignKey' => 'idtype_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
        )
	);
    
    
        var $hasMany = array(
            'AggregateInterest' => array(
            'className' => 'AggregateInterest',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'InvestmentPayment' => array(
            'className' => 'InvestmentPayment',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'InterestAccrual' => array(
            'className' => 'InterestAccrual',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'ReinvestmentsEquity' => array(
            'className' => 'ReinvestmentsEquity',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'Investment' => array(
            'className' => 'Investment',
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
            ),
            'InvestmentInvestor' => array(
            'className' => 'InvestmentInvestor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'DailyInterestStatement' => array(
            'className' => 'DailyInterestStatement',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
            'ClientLedger' => array(
            'className' => 'ClientLedger',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
            );
        
        
        
}

?>
