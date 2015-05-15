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
        'ReinvestorCashaccount','DailyInterestStatement','Investment','Reinvestment',
        'InvestmentTerm','ClientLedger','LedgerTransaction','DailyReinvestinterestStatement');

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
        $this->__invEOD();
    }

    public function defaultJobs() {
        $this->autoRender = false;
        $this->__dailyInterests();
        $this->__dailyMatured();
    }

    public function backendJobs(){
        $this->autoRender = false;
        $this->__dailyReinvestmentInterests();
        $this->__dailyReinvestmentMatured();
    }
   
    public function miscJobs(){
        $this->autoRender = false;
        $this->__processFees();
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
            $ledger_data = $this->ClientLedger->find('first',array('conditions' => array('ClientLedger.investor_id' => 
                $each['Investment']['investor_id'])));
            if($ledger_data){
            $cash_athand = $ledger_data['ClientLedger']['available_cash'];
            $earned_balance = $each['Investment']['earned_balance'];
            $new_cashathand = $cash_athand + $earned_balance;
            $total_invested = $ledger_data['ClientLedger']['invested_amount'] - $each['Investment']['investment_amount'];
           $old_tenure = $each['Investment']['total_tenure'];
           $period = $each['Investment']['investment_period'];
           switch ($period){
               case 'Year(s)':
                   $new_tenure = $old_tenure - 1;
                   break;
               case 'Day(s)':
               default:
                   $new_tenure = 0;
                   break;
               
               
           }
            $each_array = array('id' => $each['Investment']['id'],
                'status' => 'Matured','old_status' => $each['Investment']['status'],
                'earned_balance' => 0.00,'total_tenure' => $new_tenure);
            $this->Investment->save($each_array);
            //Update Ledger data
            $cledger_id = $ledger_data['ClientLedger']['id'];     
                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_cashathand,
                    'invested_amount' => $total_invested);
               $this->ClientLedger->save($client_ledger);   
               
               //enter new ledger transaction
                $ledger_transactions = array( 'client_ledger_id' =>$cledger_id,'credit' => $earned_balance, 'user_id' => 0,
                    'date' => date('Y-m-d'),'voucher_no' =>$each['Investment']['investment_no'],
                    'description' => 'Matured Investment Proceeds for investment no:'.$each['Investment']['investment_no']);
                    $this->LedgerTransaction->create();
                     $this->LedgerTransaction->save($ledger_transactions);
           }
        }
    }
}
function __dailyReinvestmentMatured(){
    $this->autoRender = false;
    $data = $this->Reinvestment->find('all',['recursive' => -1,
        'conditions' => ['status' => array('Invested','Rolled_over'),'due_date <=' => date('Y-m-d')]]);
    
    if($data){
        foreach($data as $each){
            $reinvestor_id = $each['Reinvestment']['reinvestor_id']; 
            //subtract from reinvestoraacount fixed balance and probably deposit
            $reinvestment_data = $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]);
            if ($reinvestment_data) {
//                $id = $reinvestment_data['ReinvestorCashaccount']['id'];
//                $old_balance = $reinvestment_data['ReinvestorCashaccount']['fixed_inv_returns'];
//                $earned_balance = $each['Reinvestment']['earned_balance'];
//                $new_balance = $old_balance + $earned_balance;
//
//                $fixed_data = array('id' => $id, 'fixed_inv_returns' => $new_balance);
//                $this->ReinvestorCashaccount->save($fixed_data);
            }
           $each_array = array('id' => $each['Reinvestment']['id'],
                'status' => 'Matured','old_status' => $each['Reinvestment']['status']);
            $this->Reinvestment->save($each_array);
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
        'conditions' => ['Investment.status' => array('Rolled_over','Invested','Termination_Requested')]]);
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
                                'principal' => round($principal_amount,2),
                                'interest' => round($daily_interest,2),
                                'date' => $date,
                                'total' => round($new_balanced_earned,2));
                            
                             $investment_array = array(
                                 'id' => $value['Investment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                            'interest_accrued' => round($new_accrued_interest,2)
                        );
                    $this->DailyInterestStatement->create();       
                    $this->DailyInterestStatement->save($statemt_array);
                    
                     $this->Investment->save($investment_array);
                    
        }
                    
    }
    
}
function __dailyReinvestmentInterests(){
    
    $investment_data = $this->Reinvestment->find('all',['recursive' => -1,
        'conditions' => ['Reinvestment.status' => array('Rolled_over','Invested','Termination_Requested')]]);
    if($investment_data){
        foreach($investment_data as $value){
//        $term_id = $value['Reinvestment']['investment_term_id'];
        
        
        $investment_amount1 = $value['Reinvestment']['total_amount_earned'];
        $investment_amount = $value['Reinvestment']['earned_balance'];
        $principal_amount  = $value['Reinvestment']['investment_amount'];
        $rate = $value['Reinvestment']['interest_rate'];
        $date = date('Y-m-d');
        $yearly_interest = ($rate / 100) * $principal_amount;
        $daily_interest = $yearly_interest/365;
        $old_accrued_interest = $value['Reinvestment']['interest_earned'];
        $new_accrued_interest = $old_accrued_interest + $daily_interest;
        $new_balanced_earned = $investment_amount + $daily_interest;
        $new_total_earned = $investment_amount1 + $daily_interest;

       
                            $statemt_array = array(
                                'reinvestment_id' => $value['Reinvestment']['id'],
                                'reinvestor_id' => $value['Reinvestment']['reinvestor_id'],
                                'principal' => $principal_amount,
                                'interest' => $daily_interest,
                                'date' => $date,
                                'total' => $new_balanced_earned);
                            
                             $investment_array = array(
                                 'id' => $value['Reinvestment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                            'interest_earned' => round($new_accrued_interest,2)
                        );
                             
                    $this->DailyReinvestinterestStatement->create();       
                    $this->DailyReinvestinterestStatement->save($statemt_array);
                    
                     $this->Reinvestment->save($investment_array);
                    
        }
                    
    }
    
}

    function defaultersMail(){
        
    }
    
    function __processFees(){
       $data = $this->Investment->find('all',array('conditions' => array(
            'Investment.basefee_duedate <=' => date('Y-m-d')
        ),'recursive' => -1));
       
       if($data){
           foreach($data as $val){
               $id = $val['Investment']['id']; 
               $old_accrued = $val['Investment']['accrued_basefee'];
               $base_fee = $val['Investment']['base_fees'];
               $old_totalfees = $val['Investment']['total_fees'];
               $new_accrued = $old_accrued + $base_fee;
               $new_totalfees = $old_totalfees + $base_fee;
               
               $new_data = array('accrued_basefee' => $new_accrued,'total_fees' => $new_totalfees);
               $this->Investment->id = $id;
               $this->Investment->save($new_data);
           }
       }
    }
}

?>
