<?php

class Investment extends AppModel{
    
    var $name = 'Investment';
    var $usesTable = "investments";
    
    
    var $belongsTo = array(
        'Investor' => array(
            'className' => 'Investor',
            'foreignKey' => 'investor_id',
            'conditions' => '',
            'order' =>  array('Investor.fullname' => 'asc'),
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
        'InvestmentTerm' => array(
            'className' => 'InvestmentTerm',
            'foreignKey' => 'investment_term_id',
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
            ),
        'Currency' => array(
            'className' => 'Currency',
            'foreignKey' => 'Currency_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'PaymentSchedule' => array(
            'className' => 'PaymentSchedule',
            'foreignKey' => 'payment_schedule_id',
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
	'Instruction' => array(
            'className' => 'Instruction',
            'foreignKey' => 'instruction_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
	'InvestmentProduct' => array(
            'className' => 'InvestmentProduct',
            'foreignKey' => 'investment_product_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
        );
    
    
     var $hasMany = array(
        'InvestmentPayment' => array(
            'className' => 'InvestmentPayment',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestorDeposit' => array(
            'className' => 'InvestorDeposit',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'EquityOrder' => array(
            'className' => 'EquityOrder',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Rollover' => array(
            'className' => 'Rollover',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentStatement' => array(
            'className' => 'InvestmentStatement',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentInvestor' => array(
            'className' => 'InvestmentInvestor',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestmentCash' => array(
            'className' => 'InvestmentCash',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'DailyInterestStatement' => array(
            'className' => 'DailyInterestStatement',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'InvestorEquity' => array(
            'className' => 'InvestorEquity',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            ),
        'Topup' => array(
            'className' => 'Topup',
            'foreignKey' => 'investment_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'dependent' => true
            )
         );
    
}
?>
