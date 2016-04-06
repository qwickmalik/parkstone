<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ShellConsolesController extends AppController {

    public $components = array('RequestHandler', 'Session', 'Message');
    var $name = 'ShellConsole';
    var $uses = array('User', 'Usertype', 'Userdepartment', 'Setting', 'Currency', 
         'Equity',  'Customer','InvestmentCash','InterestAccrual','AggregateInterest','AggregateOutboundInterest',
        'ReinvestorCashaccount','DailyInterestStatement','Investment','Reinvestment','ReinvestInterestAccrual',
        'InvestmentTerm','ClientLedger','LedgerTransaction','DailyReinvestinterestStatement','ManagementFee','ReinvestmentTopup');

    function beforeFilter() {
//       ini_set('max_execution_time',300);       
       set_time_limit(0);
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
        $message = 'Inbound Investments Successfully Processed';
        $this->Session->write('smsg', $message);
         $this->redirect(array('controller' => 'Settings', 'action' => 'batchProcesses'));
    }
               
    public function reportJobs(){
       $this->autoRender = false;
        $this->__aggregateInboundInterests();
        $this->__aggregateOutboundInterests();
        
       $message = 'Report Jobs Ran Successfully';
        $this->Session->write('smsg', $message);
         $this->redirect(array('controller' => 'Settings', 'action' => 'batchProcesses'));
    }
    
    public function defaultJobs() {
        $this->autoRender = false;
        $this->__dailyInterests();
        $this->__processFees();
        $this->__dailyMatured();
        
        $message = 'Daily Inbound Jobs Ran Successfully';
        $this->Session->write('smsg', $message);
         $this->redirect(array('controller' => 'Settings', 'action' => 'batchProcesses'));
    }

    public function backendJobs(){
        $this->autoRender = false;
        $this->__dailyReinvestmentInterests();
        $this->__dailyReinvestmentMatured();
        $message = 'Daily Outbound Jobs Ran Successfully';
        $this->Session->write('smsg', $message);
         $this->redirect(array('controller' => 'Settings', 'action' => 'batchProcesses'));
    }
   
    public function miscJobs(){
        $this->autoRender = false;
        $this->__processFees();
        
        $message = 'Base Fees Processed Successfully';
        $this->Session->write('smsg', $message);
         $this->redirect(array('controller' => 'Settings', 'action' => 'batchProcesses'));
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
               
         $accrued_basefee = $each['Investment']['accrued_basefee'];
            $cash_athand = $ledger_data['ClientLedger']['available_cash'];
            $earned_balance = $each['Investment']['earned_balance'];
            $interest =  $each['Investment']['interest_accrued'];
//            $oldt_principal = $ledger_data['ClientLedger']['total_principal'];
            $oldt_interest = $ledger_data['ClientLedger']['total_interest'];
            $inv_principal = 0;
            if(!empty($data['Investment']['rollover_amount']) && $data['Investment']['rollover_amount'] > 0){
                $inv_principal = $each['Investment']['rollover_amount'];
            }else{
                $inv_principal = $each['Investment']['investment_amount'];
            }
//            $total_principal = $oldt_principal + $inv_principal;
            $total_interest = $oldt_interest + $interest;
            $new_cashathand = $cash_athand + $earned_balance;
//            $new_cashathand = $new_cashathand - $accrued_basefee;
            $total_invested = $ledger_data['ClientLedger']['invested_amount'] - $each['Investment']['investment_amount'];
           $old_tenure = $each['Investment']['total_tenure'];
           $period = $each['Investment']['investment_period'];
           $new_tenure = 0;
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
                'total_tenure' => $new_tenure);
            //'earned_balance' => 0.00,
            $this->Investment->save($each_array);
            //enter new ledger data for accrued fee deduction
            
            $cledger_id = $ledger_data['ClientLedger']['id'];  
//            if($accrued_basefee > 0){
//             $description = 'Debit on ' . $each['Investment']['investment_no'].' for settlement of accrued management fee';
//                                $ledger_transactions = array('client_ledger_id' => $cledger_id, 'debit' => $accrued_basefee, 'user_id' => $userid,
//                                    'date' => date('Y-m-d'), 'voucher_no' => $each['Investment']['investment_no']
//                                    , 'description' => $description);
//                                $this->LedgerTransaction->create();
//                                $ltresult = $this->LedgerTransaction->save($ledger_transactions);
//            }
            //Update Ledger data   
                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_cashathand,'total_interest' => $total_invested,
                    'invested_amount' => $total_invested);
               $this->ClientLedger->save($client_ledger);   
               
               //enter new ledger transaction
                $ledger_transactions = array( 'client_ledger_id' =>$cledger_id,'credit' => $earned_balance, 'user_id' => 0,
                    'date' => date('Y-m-d'),'voucher_no' =>$each['Investment']['investment_no'],'management_fee' => $accrued_basefee,'benchmark' => $each['Investment']['custom_rate'],
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
                $grand_total = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['total_balance'];
                $fixed_data = array('id' => $id,'reinvestor_id' => $reinvestor_id, 'fixed_inv_amount' => $new_total,
                'fixed_inv_balance' => $new_balance,'total_balance' => $grand_total);
                 $this->ReinvestorCashaccount->save($fixed_data);
            }else{
                $new_total = $data[0]['invested_amount'];
                $new_balance = $data[0]['invested_amount'];
                $grand_total = $data[0]['invested_amount'];
                $fixed_data = array('reinvestor_id' => $reinvestor_id, 'fixed_inv_amount' => $new_total,
                'fixed_inv_balance' => $new_balance,'total_balance' => $grand_total);
                $this->ReinvestorCashaccount->create();
                $this->ReinvestorCashaccount->save($fixed_data);
            }
            $this->InvestmentCash->save($updated_datafixed);
        }
//        $data_fixed2 = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
//        array('InvestmentCash.investment_type' => 'fixed',
//        'InvestmentCash.status' => 'available')));
//    if($data_fixed2){
//        foreach($data_fixed2 as $data){
//            $updated_datafixed = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
//            $this->InvestmentCash->save($updated_datafixed);
//        }
//        
//    }
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
                
                $grand_total = $data[0]['invested_amount'] + $result['ReinvestorCashaccount']['total_balance'];
                $equity_data = array('id' => $id,'reinvestor_id' => $reinvestor_id, 'equity_inv_amount' => $new_total,
                'equity_inv_balance' => $new_balance,'total_balance' => $grand_total);
                 $this->ReinvestorCashaccount->save($equity_data);
            }else{
                $new_total = $data[0]['invested_amount'];
                $new_balance = $data[0]['invested_amount'];
                $grand_total = $data[0]['invested_amount'];
                $equity_data = array('reinvestor_id' => $reinvestor_id, 'equity_inv_amount' => $new_total,
                'equity_inv_balance' => $new_balance,'total_balance' => $grand_total);
                $this->ReinvestorCashaccount->create();
                $this->ReinvestorCashaccount->save($equity_data);
            }
            $this->InvestmentCash->save($updated_dataequity);
        }
//         $data_equity2 = $this->InvestmentCash->find('all',array('recursive' => -1,'conditions' => 
//        array('InvestmentCash.investment_type' => 'equity',
//        'InvestmentCash.status' => 'available')));
//       if($data_equity2){
//        foreach($data_equity2 as $data){
//            $updated_dataequity = array('id' => $data['InvestmentCash']['id'],'status' => 'processed');
//            
//        }
//        
//    }
    }
    
}


function __dailyInterests(){
    
//    $investment_data = $this->Investment->find('all',['recursive' => -1,
//        'conditions' => ['Investment.status' => array('Rolled_over','Invested','Termination_Requested')]]);
     $investment_data = $this->Investment->find('all', array('conditions' =>
                array(
                    'Investment.investment_amount >' => 0,
                    'Investment.investment_product_id' => array(1, 3),
                    'Investment.status' => array('Rolled_over','Invested','Termination_Requested')
                    ),'contain' => array('Topup')
            ));
     
    if($investment_data){
        foreach($investment_data as $value){
            
        $status = $value['Investment']['status']; 
        $investment_amount1 = $value['Investment']['total_amount_earned'];
        $investment_amount = $value['Investment']['earned_balance'];
        $principal_amount  = $value['Investment']['investment_amount'];
         $afirst_date = $value['Investment']['investment_date'];
        $due_date = $value['Investment']['due_date'];
        $rate = $value['Investment']['custom_rate'];
        $period = $value['Investment']['investment_period']; 
        $topup_interestaccrued = 0;
        $topup_principal = 0;
        switch ($status){
            case 'Rolled_over':
               $principal_amount  = $value['Investment']['rollover_amount'];
                $afirst_date = $value['Investment']['rollover_date'];
         
                if(!empty($value['Topup'])){
                    foreach ($value['Topup'] as $val):
                        if($value['Investment']['rollover_date'] <= $val['investment_date']){
                           $principal_amount = $principal_amount -  $val['topup_amount'];
           
                           $tfirst_date = $val['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            if($due_date <= $date){
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $tprincipal = $val['topup_amount'];
                             $curr_date = date('Y-m-d');
                             $interest_amount1 = ($rate / 100) * $tprincipal;
                            $interest_amountt = $interest_amount1 * ($tduration / 365);
                            if($curr_date > $due_date ){
                            $tduration +=1;
                            }
                            
                            $topup_interestaccrued += $interest_amountt;
                            $topup_principal += $val['topup_amount'];   
                        }
            
                    endforeach;
                }
                break;
           default:
                  if(!empty($value['Topup'])){
                    foreach ($value['Topup'] as $val):
                    
                           $principal_amount = $principal_amount -  $val['topup_amount'];
                           $tfirst_date = $val['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            if($due_date <= $date){
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $tprincipal = $val['topup_amount'];
                            $curr_date = date('Y-m-d');
                            
                            $interest_amount1 = ($rate / 100) * $tprincipal;
                            $interest_amountt = $interest_amount1 * ($tduration / 365);
                            if($curr_date > $due_date ){
                            $tduration +=1;
                            }
                            $topup_interestaccrued += $interest_amountt;
                            $topup_principal += $val['topup_amount'];
            
                    endforeach;
                }  
                
                break;
        }
        
       
        $due_date = $value['Investment']['due_date'];
        $ainv_date = new DateTime($afirst_date);
        $aend_date = date('Y-m-d');
        if($due_date <= $aend_date){
            $aend_date = $due_date;
        }
        $ato_date = new DateTime($aend_date);
         $aduration = date_diff($ainv_date, $ato_date);
         $aduration = $aduration->format("%a");
         
        $yearly_interest = ($rate / 100) * $principal_amount;
        $daily_interest = $yearly_interest * ($aduration/365); 
         if($due_date <= $aend_date){
            $aduration = $aduration + 1;
        }
//         
        $date = date('Y-m-d');
        
//        $old_accrued_interest = $value['Investment']['interest_accrued'];
        $new_accrued_interest = $daily_interest + $topup_interestaccrued;
        $new_balanced_earned = $principal_amount + $topup_principal + $new_accrued_interest;
        $new_total_earned = $principal_amount+ $topup_principal + $new_accrued_interest;
        
//                            $statemt_array = array(
//                                'investment_id' => $value['Investment']['id'],
//                                'investor_id' => $value['Investment']['investor_id'],
//                                'principal' => round($principal_amount,2),
//                                'interest' => round($daily_interest,2),
//                                'date' => $date,
//                                'accrued_days' => $aduration,
//                                'total' => round($new_balanced_earned,2));
                            
                             $investment_array = array(
                                 'id' => $value['Investment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                                 'accrued_days' => $aduration,
                            'interest_accrued' => round($new_accrued_interest,2),
                                 'interest_earned' => round($new_accrued_interest,2)
                        );
                             
//                    $this->DailyInterestStatement->create();       
//                    $this->DailyInterestStatement->save($statemt_array);
                    
                     $this->Investment->save($investment_array);
                       $interest_accruals = array(
                        'investor_id' => $value['Investment']['investor_id'],
                           'investment_id' => $value['Investment']['id'],
                        'interest_amounts' => round($daily_interest,2),
                        'interest_date' => $date
                    );
                       $this->InterestAccrual->create();
               $this->InterestAccrual->save($interest_accruals);     
        }
                    
    }
    
}
function __dailyReinvestmentInterests(){
    
     $investment_data = $this->Reinvestment->find('all', array('conditions' =>
                array(
                    'Reinvestment.investment_amount >' => 0,
                    'Reinvestment.status' => array('Rolled_over','Invested','Termination_Requested')
                    ),  'contain' => array('ReinvestmentTopup')
            ));
    if($investment_data){
        foreach($investment_data as $value){
        $status = $value['Reinvestment']['status']; 
        $period = $value['Reinvestment']['investment_period']; 
        $investment_amount1 = $value['Reinvestment']['total_amount_earned'];
        $investment_amount = $value['Reinvestment']['earned_balance'];
        $principal_amount  = $value['Reinvestment']['investment_amount'];
        $due_date = $value['Reinvestment']['due_date'];
        $rate = $value['Reinvestment']['interest_rate'];
        $topup_interestaccrued = 0;
        $topup_principal = 0;
      switch ($status){
            case 'Rolled_over':
                if(!empty($value['ReinvestmentTopup'])){
                    foreach ($value['ReinvestmentTopup'] as $val):
                        if($value['Reinvestment']['rollover_date'] <= $val['investment_date']){
                           $principal_amount = $principal_amount -  $val['topup_amount'];
                           
                           $tfirst_date = $val['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            if($due_date <= $date){
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $tprincipal = $val['topup_amount'];
                             
                            $interest_amount1 = ($rate / 100) * $tprincipal;
                            $interest_amountt = $interest_amount1 * ($tduration / 365);
                             if($due_date <= $date){
                              $tduration = $tduration + 1;
                            }
                            $topup_interestaccrued += $interest_amountt;
                            $topup_principal += $val['topup_amount'];  
                        }
            
                    endforeach;
                }
                break;
           default:
                  if(!empty($value['ReinvestmentTopup'])){
                    foreach ($value['ReinvestmentTopup'] as $val):
                    
                           $principal_amount = $principal_amount -  $val['topup_amount'];
                           $tfirst_date = $val['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            if($due_date <= $date){
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $tprincipal = $val['topup_amount'];
                             
                            $interest_amount1 = ($rate / 100) * $tprincipal;
                            $interest_amountt = $interest_amount1 * ($tduration / 365);
                             if($due_date <= $date){
                              $tduration = $tduration + 1;
                            }
                            $topup_interestaccrued += $interest_amountt;
                            $topup_principal += $val['topup_amount'];
            
                    endforeach;
                }  
                
                break;
        }
          $afirst_date = $value['Reinvestment']['investment_date'];
        $due_date = $value['Reinvestment']['due_date'];
        $ainv_date = new DateTime($afirst_date);
        $aend_date = date('Y-m-d');
        if($due_date <= $aend_date){
            $aend_date = $due_date;
        }
        $ato_date = new DateTime($aend_date);
         $aduration = date_diff($ainv_date, $ato_date);
         $aduration = $aduration->format("%a");
         
        $yearly_interest = ($rate / 100) * $principal_amount;
        $daily_interest = $yearly_interest * ($aduration/365);
         if($due_date <= $aend_date){
            $aduration = $aduration + 1;
        }
        $date = date('Y-m-d');
//        $old_accrued_interest = $value['Investment']['interest_accrued'];
        $new_accrued_interest = $daily_interest + $topup_interestaccrued;
        $new_balanced_earned = $principal_amount + $topup_principal + $new_accrued_interest;
        $new_total_earned = $principal_amount + $topup_principal + $new_accrued_interest;
        
        
        
        
       
        
        
       
//                            $statemt_array = array(
//                                'reinvestment_id' => $value['Reinvestment']['id'],
//                                'reinvestor_id' => $value['Reinvestment']['reinvestor_id'],
//                                'principal' => $principal_amount,
//                                'interest' => round($daily_interest,2),
//                                'date' => $date,
//                                'accrued_days' => $aduration,
//                                'total' => round($new_balanced_earned,2));
                            
                             $investment_array = array(
                                 'id' => $value['Reinvestment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                                 'accrued_days' => $aduration,
                            'interest_earned' => round($new_accrued_interest,2)
                        );
                             
//                    $this->DailyReinvestinterestStatement->create();       
//                    $this->DailyReinvestinterestStatement->save($statemt_array);
                    
                     $this->Reinvestment->save($investment_array);
                      $interest_accruals = array(
                        'reinvestor_id' => $value['Reinvestment']['reinvestor_id'],
                           'reinvestment_id' => $value['Reinvestment']['id'],
                        'interest_amounts' => round($daily_interest,2),
                        'interest_date' => $date
                    );
                      $this->ReinvestInterestAccrual->create();
               $this->ReinvestInterestAccrual->save($interest_accruals);
        }
                    
    }
    
}

    function defaultersMail(){
        
    }
    
    function __processFees(){
       $data = $this->Investment->find('all',array('conditions' => array('Investment.status' => array('Rolled_over','Invested','Termination_Requested'),
            'Investment.basefee_duedate <=' => date('Y-m-d'),'OR' => array('Investment.basefee_lastprocess_date <=' => date('Y-m-d'),'Investment.basefee_lastprocess_date'  => null) 
        ),'recursive' => -1));
       $today = date('Y-m-d');
       if($data){
          
           foreach($data as $val){
               $id = $val['Investment']['id']; 
               $old_accrued = $val['Investment']['accrued_basefee'];
               $base_fee = $val['Investment']['base_fees'];
               $old_totalfees = $val['Investment']['total_fees'];
               $new_accrued = $old_accrued + $base_fee;
               $new_totalfees = $old_totalfees + $base_fee;
               $basefee_date =  $val['Investment']['basefee_duedate']; 
               $enewdate = strtotime($basefee_date);
               $end_date = date('Y-m-d', $enewdate);
               $basefee_duedate = new DateTime($end_date);
           
            $basefee_duedate->add(new DateInterval('P1M'));
            $basefee_nextdate = $basefee_duedate->format('Y-m-d');
               $fee_data = array('investment_id' => $id,'base_fee' => $base_fee,'accrued_basefee' => $new_accrued,'fee_date' => $today);
               $new_data = array('accrued_basefee' => $new_accrued,'total_fees' => $new_totalfees,'basefee_duedate' => $basefee_nextdate,'basefee_lastprocess_date' => date('Y-m-d'));
               $this->Investment->id = $id;
               $result = $this->Investment->save($new_data);
               if($result){
                   $this->ManagementFee->create();
                   $this->ManagementFee->save($fee_data);
               }
           }
       }
    }
    
    function __aggregateInboundInterests(){
        $this->autoLayout = $this->autoRender = false;
             $data = $this->Investment->find('all',array('fields' => array('Investment.investor_id'),'conditions' => array('Investment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                            'Termination_Approved', 'Payment_Approved', 'Matured')),'recursive' => -1,'group' => array('Investment.investor_id')));
             
      $yr_data = $this->Investment->find('all',array('fields' => array('YEAR(Investment.rollover_date) as yr' , 'YEAR(Investment.investment_date) as yr'),'conditions' => array('Investment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                            'Termination_Approved', 'Payment_Approved', 'Matured')),'recursive' => -1,'group' => array( 'YEAR(Investment.rollover_date)' , 'YEAR(Investment.investment_date)')));
      
        if($yr_data){
          
        if($data){
            foreach ($yr_data as $yr_val){
                  if(!empty($yr_val[0]['yr'])){
                $year = $yr_val[0]['yr'];
                }else{
                   $year = $yr_val[0]['inyr'];
   
                }
                if(!empty($year)){
           foreach($data as $val){
               
             $investor_id = $val['Investment']['investor_id'];
            $jdate_string = $year . "-01-01";
            $ejdate_string = $year . "-01-31";
            $this->InterestAccrual->virtualFields['Jan'] = '(select SUM(interest_accruals.interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where DATE(interest_date) BETWEEN CAST(\'' . $jdate_string . '\' AS DATE) AND CAST(\'' . $ejdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN ("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $fdate_string = $year . "-02-01";
            $efdate_string = $year . "-02-28";
            $this->InterestAccrual->virtualFields['Feb'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $fdate_string . '\' AS DATE) AND CAST(\'' . $efdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $mardate_string = $year . "-03-01";
            $emardate_string = $year . "-03-31";
            $this->InterestAccrual->virtualFields['Mar'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $mardate_string . '\' AS DATE) AND CAST(\'' . $emardate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $apdate_string = $year . "-04-01";
            $eaprdate_string = $year . "-04-30";
            $this->InterestAccrual->virtualFields['Apr'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $apdate_string . '\' AS DATE) AND CAST(\'' . $eaprdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $mdate_string = $year . "-05-01";
            $emdate_string = $year . "-05-30";
            $this->InterestAccrual->virtualFields['May'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $mdate_string . '\' AS DATE) AND CAST(\'' . $emdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $jundate_string = $year . "-06-01";
            $ejundate_string = $year . "-06-30";
            $this->InterestAccrual->virtualFields['Jun'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $jundate_string . '\' AS DATE) AND CAST(\'' . $ejundate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $juldate_string = $year . "-07-01";
            $ejuldate_string = $year . "-07-31";
            $this->InterestAccrual->virtualFields['Jul'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $juldate_string . '\' AS DATE) AND CAST(\'' . $ejuldate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';

            $augdate_string = $year . "-08-01";
            $eaugdate_string = $year . "-08-31";
            $this->InterestAccrual->virtualFields['Aug'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $augdate_string . '\' AS DATE) AND CAST(\'' . $eaugdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $sepdate_string = $year . "-09-01";
            $esepdate_string = $year . "-09-30";
            $this->InterestAccrual->virtualFields['Sep'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $sepdate_string . '\' AS DATE) AND CAST(\'' . $esepdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $octdate_string = $year . "-10-01";
            $eoctdate_string = $year . "-10-31";
            $this->InterestAccrual->virtualFields['Oct'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $octdate_string . '\' AS DATE) AND CAST(\'' . $eoctdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $novdate_string = $year . "-11-01";
            $enovdate_string = $year . "-11-30";
            $this->InterestAccrual->virtualFields['Nov'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id  '
                    . 'where interest_date BETWEEN CAST(\'' . $novdate_string . '\' AS DATE) AND CAST(\'' . $enovdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $decdate_string = $year . "-12-01";
            $edecdate_string = $year . "-12-31";
            $this->InterestAccrual->virtualFields['Dec'] = '(select SUM(interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where DATE(interest_date) BETWEEN CAST(\'' . $decdate_string . '\' AS DATE) AND CAST(\'' . $edecdate_string . '\' AS DATE) AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            
            $this->InterestAccrual->virtualFields['bbf'] = '(select SUM(interest_accruals.interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where YEAR(interest_date) < '. $year . ' AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            
             $this->InterestAccrual->virtualFields['total'] = '(select SUM(interest_accruals.interest_amounts) from interest_accruals INNER JOIN investments ON investments.id = interest_accruals.investment_id '
                    . 'where YEAR(interest_date) = '. $year . ' AND interest_accruals.investor_id ='. $investor_id.' AND investments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
             
             $datacount = $this->InterestAccrual->find('all', array('order' => array('Investor.in_trust_for' => 'asc', 'Investor.surname' => 'asc', 'Investor.comp_name' => 'asc'),
                    'conditions' => array('Investment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                            'Termination_Approved', 'Payment_Approved', 'Matured'), 'YEAR(InterestAccrual.interest_date)' => $year , 'InterestAccrual.investor_id' => $investor_id
                    ), 
                    'fields' => array('SUM(interest_amounts) as total_interests',
                        'InterestAccrual.total','InterestAccrual.bbf', 'InterestAccrual.Jan', 'InterestAccrual.Feb',
                        'InterestAccrual.Mar', 'InterestAccrual.Apr', 'InterestAccrual.May', 'InterestAccrual.Jul', 'InterestAccrual.Jun', 'InterestAccrual.Aug',
                        'InterestAccrual.Sep', 'InterestAccrual.Oct', 'InterestAccrual.Nov', 'InterestAccrual.Dec')

                    ));
          
              
             if($datacount){
                 
                 
                 
                 if(!empty($datacount)){
                     foreach($datacount as $var){
                   
                     
                     $agg_data = array('investor_id' => $investor_id,'bbf' => $var['InterestAccrual']['bbf'],'jan' => $var['InterestAccrual']['Jan'],
                         'feb' => $var['InterestAccrual']['Feb'],'march' => $var['InterestAccrual']['Mar'] ,
                         'april'=> $var['InterestAccrual']['Apr'],'may'=> $var['InterestAccrual']['May']
                             ,'june'=> $var['InterestAccrual']['Jun'],'july'=> $var['InterestAccrual']['Jul'],
                         'aug' => $var['InterestAccrual']['Aug'],'sept'=> $var['InterestAccrual']['Sep'],
                         'oct'=> $var['InterestAccrual']['Oct'],'nov'=> $var['InterestAccrual']['Nov']
                             ,'decem' => $var['InterestAccrual']['Dec']
                             ,'total'=> $var['InterestAccrual']['total'],'year'=> $year);
                 }
                 
                     $aggregate_data = $this->AggregateInterest->find('first',array('conditions' => array('AggregateInterest.investor_id' => $investor_id,
                         'AggregateInterest.year' => $year)));
                     
                     if($aggregate_data){
                         $agg_data['id'] = $aggregate_data['AggregateInterest']['id'];
                         $this->AggregateInterest->save($agg_data);
                     }else{
                         $this->AggregateInterest->create();
                         $this->AggregateInterest->save($agg_data);
                     }
                 }  
             }
             
            //                    'group' => array('InterestAccrual.investor_id'),
           }
            }
        }
        }
    }
    }
    
    function __aggregateOutboundInterests(){
        $this->autoLayout = $this->autoRender = false;
             $data = $this->Reinvestment->find('all',array('fields' => array('Reinvestment.inv_dest_product_id'),'conditions' => array('Reinvestment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                        'Termination_Approved', 'Payment_Approved', 'Matured')),'recursive' => -1,'group' => array('Reinvestment.inv_dest_product_id')));
             
      $yr_data = $this->Reinvestment->find('all',array('fields' => array('YEAR(Reinvestment.rollover_date) as yr', 'YEAR(Reinvestment.investment_date) as inyr'),'conditions' => array('Reinvestment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                            'Termination_Approved', 'Payment_Approved', 'Matured')),'recursive' => -1,'group' => array('YEAR(Reinvestment.rollover_date)' , 'YEAR(Reinvestment.investment_date)')));
     
        if($yr_data){
          
        if($data){
            
            foreach ($yr_data as $yr_val){
                if(!empty($yr_val[0]['yr'])){
                $year = $yr_val[0]['yr'];
                }else{
                   $year = $yr_val[0]['inyr'];
   
                }
                if(!empty($year)){
           foreach ($data as $var){
               $product_id = $var['Reinvestment']['inv_dest_product_id'];
               $jdate_string = $year . "-01-01";
            $ejdate_string = $year . "-01-31";
                $jdate_string = $year . "-01-01";
            $ejdate_string = $year . "-01-31";
                $this->ReinvestInterestAccrual->virtualFields['Jan'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $jdate_string . '\' AS DATE) AND CAST(\'' . $ejdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $fdate_string = $year . "-02-01";
            $efdate_string = $year . "-02-31";
            $this->ReinvestInterestAccrual->virtualFields['Feb'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $fdate_string . '\' AS DATE) AND CAST(\'' . $efdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $mardate_string = $year . "-03-01";
            $emardate_string = $year . "-03-31";
            $this->ReinvestInterestAccrual->virtualFields['Mar'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $mardate_string . '\' AS DATE) AND CAST(\'' . $emardate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $apdate_string = $year . "-04-01";
            $eaprdate_string = $year . "-04-30";
            $this->ReinvestInterestAccrual->virtualFields['Apr'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $apdate_string . '\' AS DATE) AND CAST(\'' . $eaprdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $mdate_string = $year . "-05-01";
            $emdate_string = $year . "-05-30";
            $this->ReinvestInterestAccrual->virtualFields['May'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $mdate_string . '\' AS DATE) AND CAST(\'' . $emdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $jundate_string = $year . "-06-01";
            $ejundate_string = $year . "-06-30";
            $this->ReinvestInterestAccrual->virtualFields['Jun'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $jundate_string . '\' AS DATE) AND CAST(\'' . $ejundate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $juldate_string = $year . "-07-01";
            $ejuldate_string = $year . "-07-31";
            $this->ReinvestInterestAccrual->virtualFields['Jul'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $juldate_string . '\' AS DATE) AND CAST(\'' . $ejuldate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';

            $augdate_string = $year . "-08-01";
            $eaugdate_string = $year . "-08-31";
            $this->ReinvestInterestAccrual->virtualFields['Aug'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $augdate_string . '\' AS DATE) AND CAST(\'' . $eaugdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $sepdate_string = $year . "-09-01";
            $esepdate_string = $year . "-09-30";
            $this->ReinvestInterestAccrual->virtualFields['Sep'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $sepdate_string . '\' AS DATE) AND CAST(\'' . $esepdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $octdate_string = $year . "-10-01";
            $eoctdate_string = $year . "-10-31";
            $this->ReinvestInterestAccrual->virtualFields['Oct'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $octdate_string . '\' AS DATE) AND CAST(\'' . $eoctdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $novdate_string = $year . "-11-01";
            $enovdate_string = $year . "-11-30";
            $this->ReinvestInterestAccrual->virtualFields['Nov'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $novdate_string . '\' AS DATE) AND CAST(\'' . $enovdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            $decdate_string = $year . "-12-01";
            $edecdate_string = $year . "-12-31";
            $this->ReinvestInterestAccrual->virtualFields['Dec'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON'
                    . ' reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . 'where interest_date BETWEEN CAST(\'' . $decdate_string . '\' AS DATE) AND CAST(\'' . $edecdate_string . '\' AS DATE) AND'
                    . ' reinvestments.inv_dest_product_id ='.$product_id .' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';

            $this->ReinvestInterestAccrual->virtualFields['bbf'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER JOIN reinvestments ON reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . ' where YEAR(interest_date) < '. $year . ' AND reinvestments.inv_dest_product_id  ='. $product_id.' AND reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
            
             $this->ReinvestInterestAccrual->virtualFields['total'] = '(select SUM(interest_amounts) from reinvest_interest_accruals INNER '
                     . 'JOIN reinvestments ON reinvestments.id = reinvest_interest_accruals.reinvestment_id '
                    . ' where YEAR(interest_date) = '. $year . ' AND  reinvestments.inv_dest_product_id ='. $product_id.' AND '
                     . 'reinvestments.status IN("Rolled_over","Invested","Termination_Requested","Payment_Requested",'
                    . '"Termination_Approved","Payment_Approved","Matured"))';
             
            
            
            $datacount = $this->ReinvestInterestAccrual->find('all', array('order' => array('Reinvestor.company_name' => 'asc'),
                'conditions' => array('Reinvestment.status' => array('Rolled_over', 'Invested', 'Termination_Requested', 'Payment_Requested',
                        'Termination_Approved', 'Payment_Approved', 'Matured'), 'YEAR(ReinvestInterestAccrual.interest_date)' => $year,
                    'Reinvestment.inv_dest_product_id' => $product_id,'Reinvestment.reinvestor_id' => 1,
                ),
                'fields' => array('Reinvestment.inv_dest_product_id','ReinvestInterestAccrual.bbf', 'ReinvestInterestAccrual.total',
                    'SUM(interest_amounts) as interests', 'ReinvestInterestAccrual.Jan', 'ReinvestInterestAccrual.Feb',
                    'ReinvestInterestAccrual.Mar','ReinvestInterestAccrual.Apr', 'ReinvestInterestAccrual.May', 'ReinvestInterestAccrual.Jul', 
                    'ReinvestInterestAccrual.Jun', 'ReinvestInterestAccrual.Aug',
                    'ReinvestInterestAccrual.Sep', 'ReinvestInterestAccrual.Oct', 'ReinvestInterestAccrual.Nov', 'ReinvestInterestAccrual.Dec')));
          

              
                 if(!empty($datacount)){
                     foreach($datacount as $var){
                   
                     $agg_data = array('inv_dest_product_id' => $product_id,'bbf' => $var['ReinvestInterestAccrual']['bbf'],'jan' => $var['ReinvestInterestAccrual']['Jan'],
                         'feb' => $var['ReinvestInterestAccrual']['Feb'],'march' => $var['ReinvestInterestAccrual']['Mar'] ,
                         'april'=> $var['ReinvestInterestAccrual']['Apr'],'may'=> $var['ReinvestInterestAccrual']['May']
                             ,'june'=> $var['ReinvestInterestAccrual']['Jun'],'july'=> $var['ReinvestInterestAccrual']['Jul'],
                         'aug' => $var['ReinvestInterestAccrual']['Aug'],'sept'=> $var['ReinvestInterestAccrual']['Sep'],
                         'oct'=> $var['ReinvestInterestAccrual']['Oct'],'nov'=> $var['ReinvestInterestAccrual']['Nov']
                             ,'decem' => $var['ReinvestInterestAccrual']['Dec']
                             ,'total'=> $var['ReinvestInterestAccrual']['total'],'year'=> $year);
                 
                     $aggregate_data = $this->AggregateOutboundInterest->find('first',array('conditions' => array('AggregateOutboundInterest.inv_dest_product_id' => $product_id,
                         'AggregateOutboundInterest.year' => $year)));
                     
                     if($aggregate_data){
                         $agg_data['id'] = $aggregate_data['AggregateOutboundInterest']['id'];
                         $this->AggregateOutboundInterest->save($agg_data);
                     }else{
                         $this->AggregateOutboundInterest->create();
                         $this->AggregateOutboundInterest->save($agg_data);
                     }
                 }  
                 }
           
           }
                     }
        }
        }
    }
    }
}

?>
