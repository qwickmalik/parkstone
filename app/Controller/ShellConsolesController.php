<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ShellConsolesController extends AppController {

    public $components = array('RequestHandler', 'Session', 'Message');
    var $name = 'ShellConsole';
    var $uses = array('User', 'Usertype', 'Userdepartment', 'Setting', 'Currency', 
         'Equity',  'Customer','InvestmentCash',
        'ReinvestorCashaccount','DailyInterestStatement','Investment','InvestmentTerm');

    function beforeFilter() {
        
    }

    function index() {
        $this->autoRender = false;
    }

    /**
     * Authenticate user
     * @return array() 
     */
    public function cronJobs() {
        $this->autoRender = false;
//        $this->__runDailyDefaulters();
        $this->__invEOD();
    }

    public function defaultJobs() {
        $this->autoRender = false;
        //$this->__defaultDaily();
        $this->__dailyInterests();
        $this->__dailyMatured();
    }

   

    public function sms() {
        $this->autoRender = false;
        $this->__runduedateSMS();
        $this->__birthdaySMS();
        $this->__xmasSMS();
    }

function __dailyMatured(){
    $this->autoRender = false;
    $data = $this->Investment->find('all',['recursive' => -1,
        'conditions' => ['status' => array('Invested','Rolled_over'),'due_date <=' => date('Y-m-d')]]);
    
    if($data){
        foreach($data as $each){
            $cash_athand = $each['Investment']['cash_athand'];
            $earned_balance = $each['Investment']['earned_balance'];
            $new_cashathand = $cash_athand + $earned_balance;
            $total_invested = $each['Investment']['total_invested'] - $each['Investment']['investment_amount'];
            $each_array = array('id' => $each['Investment']['id'],
                'status' => 'Matured','old_status' => $each['Investment']['status'],'cash_athand' => $new_cashathand,
                'earned_balance' => 0.00,'total_invested' => $total_invested);
            $this->Investment->save($each_array);
        }
    }
}

function __invEOD(){
    $this->autoRender = false;
    $fixed_total = 0.00;
    $data_fixed = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
        array('InvestmentCash.investment_type' => 'fixed',
        'InvestmentCash.status' => 'available'),'fields' => array("SUM(InvestmentCash.amount) as 'invested_amount'","InvestmentCash.id","InvestmentCash.reinvestor_id"),
        'group' => array('InvestmentCash.reinvestor_id')));
    
    $data_equity = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
        array('InvestmentCash.investment_type' => 'equity',
        'InvestmentCash.status' => 'available'),'fields' => array("SUM(InvestmentCash.amount) as 'invested_amount'","InvestmentCash.id","InvestmentCash.reinvestor_id"),
        'group' => array('InvestmentCash.reinvestor_id')));
    
    
    if($data_fixed){
        foreach($data_fixed as $data){
            $updated_datafixed = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
            $reinvestor_id = $data['InvestmentCash']['reinvestor_id'];
            $result = $this->ReinvestorCashaccount->find('first',array('recursive' => -1,'conditions' =>
                array('ReinvestorCashaccount.reinvestor_id' => $reinvestor_id)));
            if($result){
                $id = $result['ReinvestorCashaccount']['id'];
                $old_total = $result['ReinvestorCashaccount']['fixed_inv_amount'];
                $old_balance = $result['ReinvestorCashaccount']['fixed_inv_balance'];
                $new_total = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['fixed_inv_amount'];
                $new_balance = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['fixed_inv_balance'];
                
                $fixed_data = array('id' => $id,'reinvestor_id' => $reinvestor_id, 'fixed_inv_amount' => $new_total,
                'fixed_inv_balance' => $new_balance);
                 $this->ReinvestorCashaccount->save($fixed_data);
            }else{
                $new_total = $data[0]['invested_amount'];
                $new_balance = $data[0]['invested_amount'];
                
                $fixed_data = array('reinvestor_id' => $reinvestor_id, 'fixed_inv_amount' => $new_total,
                'fixed_inv_balance' => $new_balance);
                $this->ReinvestorCashaccount->create();
                $this->ReinvestorCashaccount->save($fixed_data);
            }
            
        }
        $data_fixed2 = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
        array('InvestmentCash.investment_type' => 'fixed',
        'InvestmentCash.status' => 'available')));
    if($data_fixed2){
        foreach($data_fixed2 as $data){
            $updated_datafixed = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
            $this->InvestmentCash->save($updated_datafixed);
        }
        
    }
    }
    
    
    
    if($data_equity){
        foreach($data_equity as $data){
            $updated_dataequity = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
            $reinvestor_id = $data['InvestmentCash']['reinvestor_id'];
            $result = $this->ReinvestorCashaccount->find('first',array('recursive' => -1,'conditions' =>
                array('ReinvestorCashaccount.reinvestor_id' => $reinvestor_id)));
            if($result){
                $id = $result['ReinvestorCashaccount']['id'];
                $old_total = $result['ReinvestorCashaccount']['equity_inv_amount'];
                $old_balance = $result['ReinvestorCashaccount']['equity_inv_balance'];
                $new_total = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['equity_inv_amount'];
                $new_balance = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['equity_inv_balance'];
                
                $equity_data = array('id' => $id,'reinvestor_id' => $reinvestor_id, 'equity_inv_amount' => $new_total,
                'equity_inv_balance' => $new_balance);
                 $this->ReinvestorCashaccount->save($equity_data);
            }else{
                $new_total = $data[0]['invested_amount'];
                $new_balance = $data[0]['invested_amount'];
                
                $equity_data = array('reinvestor_id' => $reinvestor_id, 'equity_inv_amount' => $new_total,
                'equity_inv_balance' => $new_balance);
                $this->ReinvestorCashaccount->create();
                $this->ReinvestorCashaccount->save($equity_data);
            }
        }
         $data_equity2 = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
        array('InvestmentCash.investment_type' => 'equity',
        'InvestmentCash.status' => 'available')));
       if($data_equity2){
        foreach($data_equity2 as $data){
            $updated_dataequity = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
            $this->InvestmentCash->save($updated_dataequity);
        }
        
    }
    }
    
}


function __dailyInterests(){
    
    $investment_data = $this->Investment->find('all',['recursive' => -1,
        'conditions' => ['Investment.status' => array('Rolled_over','Invested')]]);
    if($investment_data){
        foreach($investment_data as $value){
        $term_id = $value['Investment']['investment_term_id'];
        

        $investment_amount1 = $value['Investment']['total_amount_earned'];
        $investment_amount = $value['Investment']['earned_balance'];
        $principal_amount  = $value['Investment']['investment_amount'];
        $rate = $value['Investment']['custom_rate'];
        $date = date('Y-m-d');
        $yearly_interest = ($rate / 100) * $principal_amount;
        $daily_interest = $yearly_interest/365;
        $old_accrued_interest = $value['Investment']['interest_accrued'];
        $new_accrued_interest = $old_accrued_interest + $daily_interest;
        $new_balanced_earned = $investment_amount + $daily_interest;
        $new_total_earned = $investment_amount1 + $daily_interest;
        
                            $statemt_array = array(
                                'investment_id' => $value['Investment']['id'],
                                'investor_id' => $value['Investment']['investor_id'],
                                'principal' => $principal_amount,
                                'interest' => $daily_interest,
                                'date' => $date,
                                'total' => $new_balanced_earned);
                            
                             $investment_array = array(
                                 'id' => $value['Investment']['id'],
                                 'earned_balance' => $new_balanced_earned,
                             'total_amount_earned' => $new_total_earned,
                            'interest_accrued' => $new_accrued_interest
                        );
                    $this->DailyInterestStatement->create();       
                    $this->DailyInterestStatement->save($statemt_array);
                    
                     $this->Investment->save($investment_array);
                    
        }
                    
    }
    
}


    function defaultersMail(){
        
    }
}

?>
