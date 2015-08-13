<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ShellConsolesController extends AppController {

    public $components = array('RequestHandler', 'Session', 'Message');
    var $name = 'ShellConsole';
    var $uses = array('User', 'Usertype', 'Userdepartment', 'Setting', 'Currency', 
         'Equity',  'Customer','InvestmentCash','InterestAccrual',
        'ReinvestorCashaccount','DailyInterestStatement','Investment','Reinvestment','ReinvestInterestAccrual',
        'InvestmentTerm','ClientLedger','LedgerTransaction','DailyReinvestinterestStatement','ManagementFee');

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
                
         $accrued_basefee = $each['Investment']['accrued_basefee'];
            $cash_athand = $ledger_data['ClientLedger']['available_cash'];
            $earned_balance = $each['Investment']['earned_balance'];
            $new_cashathand = $cash_athand + $earned_balance;
//            $new_cashathand = $new_cashathand - $accrued_basefee;
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
                'total_tenure' => $new_tenure);
            //'earned_balance' => 0.00,
            $this->Investment->save($each_array);
            //enter new ledger data for accrued fee deduction
            
            $cledger_id = $ledger_data['ClientLedger']['id'];  
            if($accrued_basefee > 0){
             $description = 'Debit on ' . $each['Investment']['investment_no'].' for settlement of accrued management fee';
                                $ledger_transactions = array('client_ledger_id' => $cledger_id, 'debit' => $accrued_basefee, 'user_id' => $userid,
                                    'date' => date('Y-m-d'), 'voucher_no' => $each['Investment']['investment_no']
                                    , 'description' => $description);
                                $this->LedgerTransaction->create();
                                $ltresult = $this->LedgerTransaction->save($ledger_transactions);
            }
            //Update Ledger data   
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
        $afirst_date = $value['Investment']['investment_date'];
        $ainv_date = new DateTime($afirst_date);
        $aend_date = date('Y-m-d');
        $ato_date = new DateTime($aend_date);
         $aduration = date_diff($ainv_date, $ato_date);
         $aduration = $aduration->format("%a");
                            $statemt_array = array(
                                'investment_id' => $value['Investment']['id'],
                                'investor_id' => $value['Investment']['investor_id'],
                                'principal' => round($principal_amount,2),
                                'interest' => round($daily_interest,2),
                                'date' => $date,
                                'accrued_days' => $aduration,
                                'total' => round($new_balanced_earned,2));
                            
                             $investment_array = array(
                                 'id' => $value['Investment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                                 'accrued_days' => $aduration,
                            'interest_accrued' => round($new_accrued_interest,2)
                        );
                    $this->DailyInterestStatement->create();       
                    $this->DailyInterestStatement->save($statemt_array);
                    
                     $this->Investment->save($investment_array);
                       $interest_accruals = array(
                        'investor_id' => $value['Investment']['investor_id'],
                           'investment_id' => $value['Investment']['id'],
                        'interest_amounts' => round($daily_interest,2),
                        'interest_date' => $aend_date
                    );
                       $this->InterestAccrual->create();
               $this->InterestAccrual->save($interest_accruals);     
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
        $afirst_date = $value['Reinvestment']['investment_date'];
        $ainv_date = new DateTime($afirst_date);
        $aend_date = date('Y-m-d');
        $ato_date = new DateTime($aend_date);
         $aduration = date_diff($ainv_date, $ato_date);
         $aduration = $aduration->format("%a");
       
                            $statemt_array = array(
                                'reinvestment_id' => $value['Reinvestment']['id'],
                                'reinvestor_id' => $value['Reinvestment']['reinvestor_id'],
                                'principal' => $principal_amount,
                                'interest' => round($daily_interest,2),
                                'date' => $date,
                                'accrued_days' => $aduration,
                                'total' => round($new_balanced_earned,2));
                            
                             $investment_array = array(
                                 'id' => $value['Reinvestment']['id'],
                                 'earned_balance' => round($new_balanced_earned,2),
                             'total_amount_earned' => round($new_total_earned,2),
                                 'accrued_days' => $aduration,
                            'interest_earned' => round($new_accrued_interest,2)
                        );
                             
                    $this->DailyReinvestinterestStatement->create();       
                    $this->DailyReinvestinterestStatement->save($statemt_array);
                    
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
       $data = $this->Investment->find('all',array('conditions' => array(
            'Investment.basefee_duedate <=' => date('Y-m-d')
        ),'recursive' => -1));
       $today = date('Y-m-d');
       if($data){
//           pr($data);exit;
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
               $fee_data = array('investment_id' => $id,'base_fee' => $base_fee,'accrued_fee' => $new_accrued,'fee_date' => $today);
               $new_data = array('accrued_basefee' => $new_accrued,'total_fees' => $new_totalfees,'basefee_duedate' => $basefee_nextdate);
               $this->Investment->id = $id;
               $result = $this->Investment->save($new_data);
               if($result){
                   $this->ManagementFee->create();
                   $this->ManagementFee->save($fee_data);
               }
           }
       }
    }
}

?>
