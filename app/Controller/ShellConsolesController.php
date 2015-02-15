<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ShellConsolesController extends AppController {

    public $components = array('RequestHandler', 'Session', 'Message');
    var $name = 'ShellConsole';
    var $uses = array('User', 'Usertype', 'Userdepartment', 'Setting', 'Currency', 
        'Eod', 'Eom', 'BalanceSheet', 'IncomeStatement', 'Equity', 'DailyDefault', 
        'ClosingBalance', 'Order', 'Expectedinstallment', 'Customer','InvestmentCash','ReinvestorCashaccount');

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
        $this->__defaultDaily();
    }

    public function endOFDAY() {
        $this->autoRender = false;
        $this->__EOD();
        $this->__EOM();
    }

    public function sms() {
        $this->autoRender = false;
        $this->__runduedateSMS();
        $this->__birthdaySMS();
        $this->__xmasSMS();
    }

    function __defaultDaily() {

        $total = $this->DailyDefault->find('count');
//        
        if ($total > 0) {
            $set = $this->DailyDefault->find('first', array('order' => 'DailyDefault.id DESC'));
            $today = date('Y-m-d');


            if (($today != $set['DailyDefault']['date']) && ($set['DailyDefault']['flag'] == 0)) {

                $EOD_date = $set['DailyDefault']['date'];

                $this->__saveClosingBalance($EOD_date);
//                $this->__balEOD($EOD_date);
//
//                $this->__incomestatementEOD($EOD_date);
//            $this->__ownerequityEOD($EOD_date);


                $DDdata = array('id' => $set['DailyDefault']['id'], 'flag' => 1);
                $result = $this->DailyDefault->save($DDdata);

                if ($result) {

                    $DDdata2 = array('date' => $today);
                    $this->DailyDefault->create();
                    $result = $this->DailyDefault->save($DDdata2);
                }
            }
        } else {
            $today = date('Y-m-d');
            $DDdata3 = array('date' => $today);
            $this->DailyDefault->save($DDdata3);
        }
    }

    function __checkDailyDefaulters($ddDate) {
        $this->__runDailyDefaulters($ddDate);
    }

    function __birthdaySMS() {
       // set_time_limit(0);
        $birth_date = date('m-d');


        $customers = $this->Customer->find('all', array('conditions' => array(array('MONTH(Customer.dob)' => date('m'), 'DAY(Customer.dob)' => date('d')))));

        if ($customers) {
            $c_number ="";
            foreach ($customers as $cust) {

                $cell_number = $cust['Customer']['mobile_no'];
                $fullname = $cust['Customer']['first_name'];
                if ($cell_number != "" && $cell_number != null) {
                    
                        $c_number = $cell_number;
             $msg = "Dear " . $fullname . ", UCSL appreciates your partnership and on your birthday,we want to wish you many more years of fulfillment. HAPPY BIRTHDAY.";
                    $msgresult = $this->Message->sendSMS($msg, $c_number);
            
                   
                }
            }
            
        }
    }

    function __xmasSMS() {
       // set_time_limit(0);
        $eyear = date('Y');
        $ends_date = $eyear . "-" . "12-25";
        $enewdate = strtotime($ends_date);
        $xmas = date('Y-m-d', $enewdate);
        $today = date('Y-m-d');

        if ($today == $xmas) {
            $customers = $this->Customer->find('all');
            $c_number = "";
            if ($customers) {
                foreach ($customers as $cust) {

                    $cell_number = $cust['Customer']['mobile_no'];
                    $fullname = $cust['Customer']['first_name'];
                    if ($cell_number != "" && $cell_number != null) {
                        
                            $c_number = $cell_number;
                        
//                        $msg = "Dear " . $fullname . ", UCSL wishes you a merry X'mas and a Happy new year. Thank you for your support throughout the year. We value your partnership.";
//                        $msgresult = $this->Message->sendSMS($msg, "233" . $cell_number);
                               
             $msg = "Dear " . $fullname . ", UCSL wishes you a merry X'mas and a Happy new year. Thank you for your support throughout the year. We value your partnership.";
                    $msgresult = $this->Message->sendSMS($msg, $c_number);
            
                    }
                }
             
            }
        }
    }

    function __runduedateSMS() {
        //set_time_limit(0);
        $sms_date = date('Y-m-d');
        $dueorders = $this->Order->find('all', array('conditions' => array('Order.payment_status !=' => 'full_payment', 'Order.delivery' => 'Delivered', 'Order.balance >' => 0)));
        $c_number = "";
        foreach ($dueorders as $dueorder) {

            $text_date = new DateTime($sms_date);
            $next_due = $dueorder['Order']['due_date'];
            $order_id = $dueorder['Order']['id'];

            $todate = new DateTime($next_due);
            $todate->sub(new DateInterval('P2D'));

            if ($text_date->format('Y-m-d') == $todate->format('Y-m-d')) {


                $sms_installments = $this->Expectedinstallment->find('first', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.balance >' => 0, 'Order.balance >' => 0), 'order' => array('Expectedinstallment.id DESC')));

                if ($sms_installments) {
                    $cell_number = $dueorder['Customer']['mobile_no'];
                    $fullname = $dueorder['Customer']['first_name'];
                    $invoice_no = $dueorder['Order']['invoice_no'];
                    $expbalance = $sms_installments['Expectedinstallment']['balance'];

                    if ($cell_number != "" && $cell_number != null) {
                       
                            $c_number = $cell_number;
                        
//                        $msg = "Dear " . $fullname . ", please be reminded that your next payment of " . "GHC" . round($expbalance) . " for your order " . $invoice_no . " will be due in two days. Contact 0202088128 enquiries. Thanks.";
//
//                        $msgresult = $this->Message->sendSMS($msg, "233" . $cell_number);
                            
              $msg = "Dear " . $fullname . ", please be reminded that your next payment of " . "GHC" . round($expbalance) . " for your order " . $invoice_no . " will be due in two days. Contact 0202088124 enquiries. Thanks.";
                    $msgresult = $this->Message->sendSMS($msg, $c_number);
            
                    }
                }
            }
        }
    }

    function __runDailyDefaulters() {
        //set_time_limit(0);
        //$default_date1 = date('Y-m-d');
        $default_date = date('Y-m-d');
        $previous_day = new DateTime($default_date);
        //print_r($previous_day->format('Y-m-d'));
        //$previous_day->sub(new DateInterval('P1D'));
        //$this->Order->recursive = -1; 
        //,'YEAR(Order.due_date) >' => date('Y',strtotime('2011'))
        $orders = $this->Order->find('all', array('conditions' => array('Order.payment_status !=' => 'full_payment', 'Order.delivery' => 'Delivered', 'Order.approved' => 1, 'Order.status' => 'Approved', 'Order.due_date <=' => $previous_day->format('Y-m-d')), 'recursive' => -1));
        if ($orders) {

            foreach ($orders as $order) {
                $next_due = $order['Order']['due_date'];
                $order_id = $order['Order']['id'];
                $last_paymt = $order['Order']['last_date'];



                $todate = new DateTime($next_due);
                $todate->add(new DateInterval('P15D'));
                $expire_date = new DateTime($next_due);
                $expire_date->add(new DateInterval('P30D'));

                $due_date = new DateTime($next_due);
                $payment_status = $order['Order']['payment_status'];
                $balance = $order['Order']['balance'];
                $old_accrued = $order['Order']['interest_accrued'];
                $order_details = array();
                //check if the last payment and then add 30days to next due..if 30days+nextdue == previous day..then expired
                //get expected installments for order
                // $this->Expectedinstallment->recursive = -1; 
                $installments = $this->Expectedinstallment->find('first', array('conditions' => array('Expectedinstallment.order_id' => $order_id), 'order' => array('Expectedinstallment.id DESC'), 'recursive' => -1));


                if ($next_due > $last_paymt) {
                    if ($payment_status != 'expired') {


                        if ($previous_day->format('Y-m-d') >= $expire_date->format('Y-m-d')) {
                            //($this->Session->check('interest') != false){$interest_rate = $this->Session->read('interest');}else{$interest_rate = 0;}

                            $balance = $order['Order']['balance'];
                            $old_accrued = $order['Order']['interest_accrued'];
                            $installment_no = $installments['Expectedinstallment']['newinstallment_no'];
                            while ($previous_day->format('Y-m-d') >= $due_date->format('Y-m-d')) {
                                $interest_rate = 10;

                                $installment_no = $installment_no + 1;
                                $calc_interest = $balance * ($interest_rate / 100);
                                $new_balance = $balance + $calc_interest;
                                $new_accrued = $old_accrued + $calc_interest;

                                $due_date->add(new DateInterval('P1M'));
                                $order_details = array('id' => $order_id, 'balance' => round($new_balance, 0), 'interest_accrued' => round($new_accrued, 0), 'payment_status' => 'expired', 'due_date' => $due_date->format('Y-m-d'));
                                $order_sv = $this->Order->save($order_details);

                                if ($order_sv) {
                                    $next_due = $order_sv['Order']['due_date'];
                                    $order_id = $order_sv['Order']['id'];
                                    $balance = $order_sv['Order']['balance'];
                                    $old_accrued = $order_sv['Order']['interest_accrued'];
                                    // $order_sv = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id, 'Order.payment_status !=' => "full_payment")));
                                    // $this->Expectedinstallment->recursive = -1; 
                                    $installmentsall = $this->Expectedinstallment->find('all', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.payment_status !=' => "full_payment"), 'recursive' => -1));

                                    if ($installmentsall) {
                                        foreach ($installmentsall as $value) {
                                            $install_data = array('id' => $value['Expectedinstallment']['id'], 'payment_status' => "full_payment");
                                            $this->Expectedinstallment->save($install_data);
                                        }
                                    }
                                    $pastdue_expected_installment = $order_sv['Order']['balance'];
                                    $next_duebalance = $order_sv['Order']['balance'];
                                    //$next_duepaid = $order['Order']['amount_paid'];


                                    $expectedinstall2 = array('order_id' => $order_id, 'expected_installment' => $pastdue_expected_installment, 'paid_install' => 0, 'balance' => round($next_duebalance, 0), 'due_date' => $due_date->format('Y-m-d'), 'user_id' => $installments['Expectedinstallment']['user_id'], 'customer_id' => $order['Order']['customer_id'], 'zone_id' => $order['Order']['zone_id'], 'newinstallment_no' => $installment_no, 'default_interest' => $new_accrued);

                                    $this->Expectedinstallment->create();
                                    $saveInstll2 = $this->Expectedinstallment->save($expectedinstall2);
                                }
                            }
                        }
                    } elseif ($payment_status == 'expired') {
                        if (($previous_day->format('Y-m-d') >= $expire_date->format('Y-m-d'))) {

                            $balance = $order['Order']['balance'];
                            $old_accrued = $order['Order']['interest_accrued'];
                            $installment_no = $installments['Expectedinstallment']['newinstallment_no'];

                            while ($previous_day->format('Y-m-d') >= $due_date->format('Y-m-d')) {
                                $interest_rate = 10;

                                $installment_no = $installment_no + 1;
                                $calc_interest = $balance * ($interest_rate / 100);
                                $new_balance = $balance + $calc_interest;
                                $new_accrued = $old_accrued + $calc_interest;
                                $due_date->add(new DateInterval('P1M'));
                                $order_details = array('id' => $order_id, 'balance' => round($new_balance, 0), 'interest_accrued' => round($new_accrued, 0), 'due_date' => $due_date->format('Y-m-d'));
                                //$this->Order->create();
                                $order_sv = $this->Order->save($order_details);

                                if ($order_sv) {
                                    $next_due = $order_sv['Order']['due_date'];
                                    $order_id = $order_sv['Order']['id'];
                                    $balance = $order_sv['Order']['balance'];
                                    $old_accrued = $order_sv['Order']['interest_accrued'];
                                    // $order_sv = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id, 'Order.payment_status !=' => "full_payment")));
                                    //$this->Expectedinstallment->recursive = -1; 
                                    $installmentsall = $this->Expectedinstallment->find('all', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.payment_status !=' => "full_payment"), 'recursive' => -1));

                                    if ($installmentsall) {
                                        foreach ($installmentsall as $value) {
                                            $install_data = array('id' => $value['Expectedinstallment']['id'], 'payment_status' => "full_payment");
                                            $this->Expectedinstallment->save($install_data);
                                        }
                                    }
                                    $pastdue_expected_installment = $order_sv['Order']['balance'];
                                    $next_duebalance = $order_sv['Order']['balance'];
                                    //$next_duepaid = $order['Order']['amount_paid'];


                                    $expectedinstall2 = array('order_id' => $order_id, 'expected_installment' => $pastdue_expected_installment, 'paid_install' => 0, 'balance' => round($next_duebalance, 0), 'due_date' => $due_date->format('Y-m-d'), 'user_id' => $installments['Expectedinstallment']['user_id'], 'customer_id' => $order['Order']['customer_id'], 'zone_id' => $order['Order']['zone_id'], 'newinstallment_no' => $installment_no, 'default_interest' => $new_accrued);

                                    $this->Expectedinstallment->create();

                                    $this->Expectedinstallment->save($expectedinstall2);
                                }
                            }
                        }
                    }
                } elseif ($next_due <= $last_paymt) {
                    if ($previous_day->format('Y-m-d') >= $todate->format('Y-m-d')) {
                        if ($payment_status != 'expired') {
                            //($this->Session->check('interest') != false){$interest_rate = $this->Session->read('interest');}else{$interest_rate = 0;}
                            // $this->Expectedinstallment->recursive = -1; 

                            $installments = $this->Expectedinstallment->find('first', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.payment_status !=' => "full_payment"), 'order' => array('Expectedinstallment.id DESC'), 'recursive' => -1));
                            if ($installments) {
                                $next_due = $order['Order']['due_date'];
                                $order_id = $order['Order']['id'];
                                $last_paymt = $order['Order']['last_date'];
                                $installment = $order['Order']['mthly_install'];
                                $balance = $order['Order']['balance'];
                                $old_accrued = $order['Order']['interest_accrued'];
                                $last_duedate1 = $order['Order']['last_date'];
                                $installment_no = $installments['Expectedinstallment']['newinstallment_no'];
                                while ($previous_day->format('Y-m-d') >= $due_date->format('Y-m-d')) {
                                    //   $order = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id),'recursive' => -1));                           
                                    //$this->Expectedinstallment->recursive = -1; 
                                    $installments = $this->Expectedinstallment->find('first', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.payment_status !=' => "full_payment"), 'order' => array('Expectedinstallment.id DESC'), 'recursive' => -1));
                                    $interest_rate = 10;

//                                $previous_day = new DateTime($default_date);
//                                $previous_day->sub(new DateInterval('P1D'));
                                    $todate = new DateTime($next_due);
                                    $todate->add(new DateInterval('P15D'));
                                    $due_date = new DateTime($next_due);

                                    $last_duedate = new DateTime($last_duedate1);
                                    $calc_interest = $installment * ($interest_rate / 100);
                                    $new_balance = $balance + $calc_interest;
                                    $new_accrued = $old_accrued + $calc_interest;
                                    $due_date->add(new DateInterval('P1M'));



                                    $order_details = array('id' => $order_id, 'balance' => round($new_balance, 0), 'due_date' => $due_date->format('Y-m-d'), 'interest_accrued' => round($new_accrued, 0));
                                    //$this->Order->create();
                                    $order_sv = $this->Order->save($order_details);

                                    $next_due = $order_sv['Order']['due_date'];
                                    $order_id = $order_sv['Order']['id'];
                                    $balance = $order_sv['Order']['balance'];
                                    $old_accrued = $order_sv['Order']['interest_accrued'];
                                    $last_duedate1 = $order['Order']['last_date'];
                                    $installment_no = $installment_no + 1;
                                    $old_inst_interest = $calc_interest;
                                    $paid_install = $installments['Expectedinstallment']['paid_install'];
                                    $next_duebalance = $installments['Expectedinstallment']['balance'] + $calc_interest;
                                    if ($next_due != $last_paymt && $next_due < $last_paymt) {
                                        
                                    }

                                    if ($paid_install > 0) {
                                        $install_paymt_status = "part_payment";
                                    } elseif ($paid_install <= 0) {
                                        $install_paymt_status = "no_payment";
                                    }


                                    $expectedinstall = array('id' => $installments['Expectedinstallment']['id'], 'order_id' => $order_id, 'payment_status' => $install_paymt_status, 'balance' => round($next_duebalance, 0), 'user_id' => $installments['Expectedinstallment']['user_id'], 'default_interest' => round($old_inst_interest, 0), 'customer_id' => $order['Order']['customer_id'], 'zone_id' => $order['Order']['zone_id'], 'defaulter' => 1);

                                    $saveInstll = $this->Expectedinstallment->save($expectedinstall);

                                    if ($saveInstll) {

                                        if ($due_date->format('Y-m-d') >= $last_duedate->format('Y-m-d')) {
                                            if ($order_sv) {
                                                //$order_sv = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id, 'Order.payment_status !=' => "full_payment")));
                                                // $this->Expectedinstallment->recursive = -1; 
                                                $installmentsall = $this->Expectedinstallment->find('all', array('conditions' => array('Expectedinstallment.order_id' => $order_id, 'Expectedinstallment.payment_status !=' => "full_payment"), 'recursive' => -1));

                                                if ($installmentsall) {
                                                    foreach ($installmentsall as $value) {
                                                        $install_data = array('id' => $value['Expectedinstallment']['id'], 'payment_status' => "full_payment");
                                                        $this->Expectedinstallment->save($install_data);
                                                    }
                                                }
                                                $pastdue_expected_installment = $order_sv['Order']['balance'];
                                                $next_duebalance = $order_sv['Order']['balance'];
                                                //$next_duepaid = $order['Order']['amount_paid'];


                                                $expectedinstall2 = array('order_id' => $order_id, 'expected_installment' => $pastdue_expected_installment, 'paid_install' => 0, 'balance' => round($next_duebalance, 0), 'due_date' => $due_date->format('Y-m-d'), 'user_id' => $installments['Expectedinstallment']['user_id'], 'customer_id' => $order['Order']['customer_id'], 'zone_id' => $order['Order']['zone_id'], 'newinstallment_no' => $installment_no);
                                            }
                                        } else {
                                            $install_paymt_status = "no_payment";
                                            $expectedinstall2 = array('order_id' => $order_id, 'expected_installment' => $order['Order']['mthly_install'], 'balance' => $order['Order']['mthly_install'], 'due_date' => $due_date->format('Y-m-d'), 'user_id' => $installments['Expectedinstallment']['user_id'], 'customer_id' => $order['Order']['customer_id'], 'zone_id' => $order['Order']['zone_id'], 'newinstallment_no' => $installment_no, 'payment_status' => $install_paymt_status);
                                        }



                                        $this->Expectedinstallment->create();
                                        $this->Expectedinstallment->save($expectedinstall2);
                                        
                                    }
                                }
                            } else {
                                // $this->Order->recursive = -1; 
                                $order = $this->Order->find('first', array('conditions' => array('Order.id' => $order_id), 'recursive' => -1));

                                $interest_rate = 10;
                                $installment = $order['Order']['mthly_install'];
                                $balance = $order['Order']['balance'];


                                $calc_interest = $installment * ($interest_rate / 100);
                                $new_balance = $balance + $calc_interest;
                                $new_accrued = $old_accrued + $calc_interest;
                                if ($last_paymt != $default_date) {
                                    $due_date->add(new DateInterval('P1M'));
                                }
                                $order_details = array('id' => $order_id, 'balance' => round($new_balance, 0), 'due_date' => $due_date->format('Y-m-d'), 'interest_accrued' => $new_accrued);
                                $this->Order->save($order_details);
                            }
                        }
                    }
                }
            }
        }
    }

    function __saveClosingBalance($ddDate) {
        $closing_balance = $this->Order->find('all', array('conditions' => array('Order.balance >' => 0, 'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.delivery_date' => $ddDate)));

        if ($closing_balance) {
            foreach ($closing_balance as $closing_bal) {
                $balance_details = array('order_id' => $closing_bal['Order']['id'], 'customer_id' => $closing_bal['Order']['customer_id'], 'balance' => $closing_bal['Order']['balance'], 'date' => $ddDate);
                $result = $this->ClosingBalance->saveAll($balance_details);
            }
        }
    }
        function __EOD() {

        $total = $this->Eod->find('count');
//        
        if ($total > 0) {
            $set = $this->Eod->find('first', array('order' => 'Eod.id DESC'));
            $today = date('Y-m-d');

//if($today =='2013-10-15'){
//    return 'trial End';
//}

            if (($today != $set['Eod']['eod_date']) && ($set['Eod']['flag'] == 0)) {

                $EOD_date = $set['Eod']['eod_date'];
                $this->__balEOD($EOD_date);

                $this->__incomestatementEOD($EOD_date);

//            $this->__ownerequityEOD($EOD_date);


                $EODdata = array('id' => $set['Eod']['id'], 'flag' => 1);
                $result = $this->Eod->save($EODdata);

                if ($result) {

                    $EODdata2 = array('eod_date' => $today);
                    $this->Eod->create();
                    $result = $this->Eod->save($EODdata2);
                }
            }
        } else {
            $today = date('Y-m-d');
            $EODdata3 = array('eod_date' => $today);
            $result = $this->Eod->save($EODdata3);
        }
    }

    function __EOM() {

        $total = $this->Eom->find('count');
//        
        if ($total > 0) {
            $set = $this->Eom->find('first', array('order' => 'Eom.id DESC'));
            $today = date('Y-m-d');



            if (($today != $set['Eom']['year']) && ($set['Eom']['flag'] == 0)) {

                $EOM_date = $set['Eom']['year'];
//                $this->__balEOD($EOD_date);
//
//                $this->__incomestatementEOD($EOD_date);

                $data = $this->__ownerequityEOM($EOM_date,$set);
                
               return $data;
            }
        } else {
            $today = $this->Session->read('accYear');
            $date = new DateTime($today);
            $date->add(new DateInterval('P1M1D'));
            
            $EOMdata3 = array('year' => $date->format('Y-m-d'));
            $result = $this->Eom->save($EOMdata3);
        }
    }

function __invEOD(){
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


    function __balEOD($bDate) {


        $this->BalanceSheet->runBalEOD($bDate);
    }

    function __incomestatementEOD($isDate) {
        $this->IncomeStatement->runISEOD($isDate);
    }

//
//    function __EOM() {
//
//        $total = $this->Eom->find('count');
////        
//        if ($total > 0) {
//            $set = $this->Eom->find('first', array('order' => 'Eom.id DESC'));
//            $today = date('Y-m-d');
//
//
//
//            if (($today != $set['Eom']['year']) && ($set['Eom']['flag'] == 0)) {
//
//                $EOM_date = $set['Eom']['year'];
////                $this->__balEOD($EOD_date);
////
////                $this->__incomestatementEOD($EOD_date);
//
//                $this->__ownerequityEOM($EOM_date, $set);
//            }
//        } else {
//            $today = $this->Session->read('accYear');
//            $date = new DateTime($today);
//            $date->add(new DateInterval('P1M1D'));
//
//            $EOMdata3 = array('year' => $date->format('Y-m-d'));
//            $this->Eom->save($EOMdata3);
//        }
//    }
//    
    function __ownerequityEOM($oeqDate,$set) {
      
        $data = $this->runEQEOM($oeqDate,$set);
        return $data;
    }
    
    
    function runEQEOM($ismonth,$set) {
        
        $eomCheck = $this->Session->read('accYear');
        $eomCheck2 = date('d-m', strtotime($eomCheck));

//        return $eomCheck;
      $today = date('Y-m-d');
      $thisDay = date('Y-m-d', strtotime($set['Eom']['year']));
       $thisYear = date('Y-m');
        $eomYear = date('Y-m', strtotime($eomCheck));
      
        //check if EOM
        $is_EOM = $this->isEOM($ismonth,$eomCheck);
       
        if ($is_EOM) {
             
            if ($thisYear == $eomYear) {
            
                $data = $this->Equity->runEQEOM($eomCheck, 'first');
                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
                $result = $this->Eom->save($EOMdata);
 
                if ($result) {
                    $next_oem_dt = $data['next_eom_date'];
                    
                    $EOMdata2 = array('year' => $next_oem_dt);
                    $this->Eom->create();
                    $result = $this->Eom->save($EOMdata2);
                    return $result;
                }
                return $data;
            } elseif ($today >= $thisDay) {
                 
                $data = $this->Equity->runEQEOM($ismonth, 'other');
                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
                $result = $this->Eom->save($EOMdata);

                if ($result) {
                    $next_oem_dt = $data['next_eom_date'];
                    
                    $EOMdata2 = array('year' => $next_oem_dt);
                    $this->Eom->create();
                    $result = $this->Eom->save($EOMdata2);
                    return $result;
                }
                return $data;
            }
             
        }
    }

    function isEOM($next_eom,$acc_year){
        $today = date('Y-m-d');
        $eomCheck3 = date('Y-m-d', strtotime($acc_year));
        $eomCheck4 = date('Y-m-d', strtotime($next_eom));
        $acc_day = date('d', strtotime($acc_year));
        $day = date('d');

        if ($today == $eomCheck3){
            return false;
        }

        if ($today >= $eomCheck4) {
            return true;
        } else {
            return false;
        }
    }
//
//    function runEQEOM($ismonth, $set) {
//
//        $eomCheck = $this->Session->read('accYear');
//        $eomCheck2 = date('d-m', strtotime($eomCheck));
//
////        return $eomCheck;
//        $today = date('Y-m-d');
//        $thisDay = date('Y-m-d', strtotime($set['Eom']['year']));
//        $thisYear = date('Y-m');
//        $eomYear = date('Y-m', strtotime($eomCheck));
//
//        //check if EOM
//        $is_EOM = $this->isEOM($ismonth, $eomCheck);
//
//        if ($is_EOM) {
//
//            if ($thisYear == $eomYear) {
//
//                $data = $this->Equity->runEQEOM($eomCheck, 'first');
//                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
//                $result = $this->Eom->save($EOMdata);
//
//                if ($result) {
//                    $next_oem_dt = $data['next_eom_date'];
//
//                    $EOMdata2 = array('year' => $next_oem_dt);
//                    $this->Eom->create();
//                    $result = $this->Eom->save($EOMdata2);
////                    return $result;
//                }
//            } elseif ($today >= $thisDay) {
//
//                $data = $this->Equity->runEQEOM($ismonth, 'other');
//                $EOMdata = array('id' => $set['Eom']['id'], 'flag' => 1);
//                $result = $this->Eom->save($EOMdata);
//
//                if ($result) {
//                    $next_oem_dt = $data['next_eom_date'];
//
//                    $EOMdata2 = array('year' => $next_oem_dt);
//                    $this->Eom->create();
//                    $this->Eom->save($EOMdata2);
////                    return $result;
//                }
//            }
//        }
//    }
//
//    function isEOM($next_eom, $acc_year) {
//        $today = date('Y-m-d');
//        $eomCheck3 = date('Y-m-d', strtotime($acc_year));
//        $eomCheck4 = date('Y-m-d', strtotime($next_eom));
//        $acc_day = date('d', strtotime($acc_year));
//        $day = date('d');
//
//        if ($today == $eomCheck3) {
//            return false;
//        }
//
//        if ($today >= $eomCheck4) {
//            return true;
//        } else {
//            return false;
//        }
//    }

    function defaultersMail(){
        
    }
}

?>
