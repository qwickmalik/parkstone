<?php

class CashAccountsController extends AppController {

    var $name = 'CashAccount';
    var $uses = array('CashAccount', 'TempcashAccount', 'BalanceSheet', 'IncomeStatement', 'Expense', 'Equity', 'User', 'Loan', 'Loanpayment', 'LoanExpectedpayment', 'Userdepartment', 'Zone', 'Pettycash', 'PettycashDeposit', 'PettycashWithdrawal');
    var $paginate = array(
        'CashAccount' => array('limit' => 5, 'order' => array('CashAccount.id' => 'desc')),
        'TempcashAccount' => array('limit' => 25, 'order' => array('TempcashAccount.id' => 'desc'))
    );

//    function beforeFilter() {
//        $this->__validateLoginStatus();
//    }
//
//    function __validateLoginStatus() {
//        if ($this->action != 'login' && $this->action != 'logout') {
//            if ($this->Session->check('userData') == false) {
//
//                $this->redirect('/');
//            }
//        }
//    }
//
//    function __validateUserType() {
//
//        $userType = $this->Session->read('userDetails.usertype_id');
//        if ($userType != 1) {
//            $message = 'Not enough privileges to view this resource!!';
//            $this->Session->write('bmsg', $message);
//            $this->redirect('/Dashboard/');
//        }
//    }
//    
//    function __validateUserType2() {
//
//        $userType = $this->Session->read('userDetails.usertype_id');
//        switch($userType){
//            case 1:
//            case 7:
//            case 8:
//                
//                break;
//            default:
//            $message = 'Not enough privileges to view this resource!!';
//            $this->Session->write('bmsg', $message);
//            $this->redirect('/Dashboard/');
//                break;
//        }
//    }

    function index() {
        // $this->__validateUserType();
        $data = $this->paginate('CashAccount');

        $this->set('data', $data);
        $this->set('expenses', $this->Expense->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id IN (1,7,8)'))));
        $this->set('loans', $this->Loan->find('list'));
        $this->set('zones', $this->Zone->find('list'));

        $this->set('userdepartments', $this->Userdepartment->find('list'));
    }

    function delCash($cashID = null) {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data)) {
                $cashID = $_POST['cashId'];
                $result = $this->CashAccount->delete($cashID, true);



                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        } else {

            $data = $this->CashAccount->find('first', array('conditions' => array('CashAccount.id' => $cashID)));
            if ($data) {

                $expense_type = $data['CashAccount']['expense_type'];
                $predate = strtotime($data['CashAccount']['expense_date']);
                $date = date('Y-m-d', $predate);

                $today = $date;
                switch ($expense_type) {
                    case 0:
                        $expensename = "Expense";
                        $today = date('Y-m-d');
                        $amount = "-" . $data['CashAccount']['amount'];
                        $cash = $data['CashAccount']['amount'];
                        //$data['CashAccount']['amount'] = $cash;
                        $expense_desc = $data['CashAccount']['expense_desc'];
                        //$payment_dt = $data['CashAccount']['expense_date'];
                        $description = "Account Deletion";

                        $balSheet = array('description' => $description, 'cash' => $cash, 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $date);
                                break;
                            case 1:
                                $inStatement = array('description' => $description, 'expenditure' => $amount, 'date' => $date);
                                break;
                            default:
                                $inStatement = array('description' => $description, 'expenditure' => $amount, 'date' => $date);
                                break;
                        }
                        $result3 = $this->IncomeStatement->save($inStatement);

                        break;
                    case 1:
                        $expensename = "Loans";
                        $description = "Account Deletion";

                        $loandata = $this->Loan->find('first', array('conditions' => array('Loan.cash_account_id' => $cashID)));
                        if ($loandata) {

                            $expectedids = array();
                            $first_payment = $loandata['Loan']['first_payment'];

                            $months = 0;
                            $cash = 0.00;
                            $principal = 0.00;

                            $cash += $data['CashAccount']['amount'];
                            $months += $data['CashAccount']['ln_months'];
                            $principal += $data['CashAccount']['principal'];
                            $shed_type = $data['CashAccount']['scd_type'];
                            $expense_name = "Loan Deletion";
                            $loan_date = new DateTime($today);
                            $last_paymt = new DateTime($first_payment);



                            switch ($shed_type) {


                                case 0:
                                    $total_payment = $cash * $months;
                                    $interest = $total_payment - $principal;
                                    $total_payment = round($total_payment, 2);
                                    $interest = round($interest, 2);

                                    $monthly_principal = $principal / $months;
                                    $monthly_interest = $interest / $months;
                                    $yearly_principal = $monthly_principal * 365;
                                    $yearly_interest = $monthly_interest * 365;
                                    $n = 0;
                                    $last_paymt->add(new DateInterval('P' . $months . 'D'));
                                    $last_payment = $last_paymt->format('Y-m-d');


                                    while ($months > 0) {
                                        if ($months > 365) {

                                            $n++;

                                            $amt_due = 0;

                                            $balSheet = array('description' => "Loan Deletion", 'cash' => "-" . round($principal, 2), 'lgloans' => "-" . round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $inStatement = array('description' => 'interest deletion', 'interest' => "-" . round($yearly_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $amt_due += round($m_interest, 2) + round($principal, 2);


                                            //$loan_data = array()
                                            // $principal
                                            $months -= 365;
                                            $principal = $principal - $yearly_principal;
                                            $loan_date->add(new DateInterval('P12D'));
                                            $this->IncomeStatement->saveAll($inStatement);
                                            $result2 = $this->BalanceSheet->saveAll($balSheet);
                                        } else {
                                            $amt_due = 0;
                                            $m_interest = $monthly_interest * $months;
                                            $loan_date->add(new DateInterval('P' . $months . 'D'));
                                            $balSheet = array('description' => 'Loan Deletion', 'cash' => "-" . round($principal, 2), 'interest' => "-" . round($m_interest, 2), 'sloans' => "-" . round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $inStatement = array('description' => 'interest deletion', 'interest' => "-" . round($m_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $amt_due += round($m_interest, 2) + round($principal, 2);




                                            $months -= $months;
                                            $result2 = $this->BalanceSheet->save($balSheet);
                                            $this->IncomeStatement->save($inStatement);
                                        }
                                    }

                                    break;
                                case 1:
                                    $total_payment = $cash * $months;
                                    $interest = $total_payment - $principal;
                                    $total_payment = round($total_payment, 2);
                                    $interest = round($interest, 2);
                                    $payment_date = $today('Y-m-d');
                                    $last_payment = null;
                                    $amt_due = 0;

                                    $balSheet = array('description' => 'Loan Deletion', 'cash' => "-" . round($principal, 2), 'interest' => "-" . round($interest, 2), 'sloans' => "-" . round($principal, 2), 'date' => $payment_date);
                                    $inStatement = array('description' => 'interest deletion', 'interest' => "-" . round($interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                    $amt_due += round($m_interest, 2) + round($principal, 2);


                                    $result2 = $this->BalanceSheet->save($balSheet);
                                    $this->IncomeStatement->save($inStatement);

                                    break;

                                case 2:

                                    $total_payment = $cash * $months;
                                    $interest = $total_payment - $principal;
                                    $total_payment = round($total_payment, 2);
                                    $interest = round($interest, 2);
                                    $last_paymt->add(new DateInterval('P' . $months . 'M'));
                                    $last_payment = $last_paymt->format('Y-m-d');

                                    //monthly loan and interest
                                    $monthly_principal = $principal / $months;
                                    $monthly_interest = $interest / $months;
                                    $yearly_principal = $monthly_principal * 12;
                                    $yearly_interest = $monthly_interest * 12;
                                    $n = 0;
//                                $feedback = array("feedback" => "success","data" => array("total_payment" => $total_payment,"interest" => $interest,"monthly_principal" => $monthly_principal,"monthly_interest" =>$monthly_interest,"yearly_principal" => $yearly_principal,"yearly_interest" => $yearly_interest,"principal" => $principal));
//                            return json_encode($feedback);
                                    while ($months > 0) {
                                        if ($months > 12) {
//                                if($n == 0){
//                                    $balSheet = array('description' => $description[Expense][payment_name], 'cash' => $cash, 'lgloans' => $cash, 'date' => $today);
//                                    $result2 = $this->BalanceSheet->saveAll($balSheet);
//                                }
                                            $n++;


                                            $amt_due = 0;
                                            $balSheet = array('description' => 'Loan Deletion', 'cash' => "-" . round($principal, 2), 'lgloans' => "-" . round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $inStatement = array('description' => 'interest deletion', 'interest' => "-" . round($yearly_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $amt_due += round($yearly_interest, 2) + round($principal, 2);



                                            // $principal
                                            $months -= 12;
                                            $principal = $principal - $yearly_principal;
                                            $loan_date->add(new DateInterval('P12M'));
                                            $this->IncomeStatement->saveAll($inStatement);
                                            $result2 = $this->BalanceSheet->saveAll($balSheet);
                                        } else {
                                            $amt_due = 0;
                                            $m_interest = $monthly_interest * $months;
                                            $loan_date->add(new DateInterval('P' . $months . 'M'));
                                            $balSheet = array('description' => 'Loan Deletion', 'cash' => "-" . round($principal, 2), 'sloans' => "-" . round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $inStatement = array('description' => 'interest deletion', 'interest' => "-" . round($m_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                            $amt_due += round($m_interest, 2) + round($principal, 2);


                                            $months -= $months;
                                            $this->BalanceSheet->saveAll($balSheet);

                                            $this->IncomeStatement->saveAll($inStatement);
                                        }
                                    }
                                    break;
                            }


                            $result_loan = $this->Loan->deleteAll(array('Loan.cash_account_id' => $cashID), true);
                            if ($result_loan) {

                                $message = 'Delete successful!!';
                                $this->Session->write('smsg', $message);
                            } else {

                                $message = 'Delete Unsuccessful!!';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'CashAccounts', 'action' => 'deleteEntry'));
                            }
                        }
                        break;
                    case 2:
                        $expensename = "Owner_Injections";
                        $today = date('Y-m-d');

                        $cash = "-" . $data['CashAccount']['amount'];

                        //today = date('Y-m-d');
                        //                $total_stock = $quantity * $item_price[0]['Item']['selling_price'];
                        $balSheet = array('description' => 'Owner Injection Delete', 'cash' => $cash, 'owner_equity' => $cash, 'date' => $today, 'injections' => $cash);

                        break;
                    case 3:
                        $expensename = "Owner_Withdrawal";
                        $today = date('Y-m-d');

                        $amount = "-" . $data['CashAccount']['amount'];
                        $cash = $data['CashAccount']['amount'];


                        $balSheet = array('description' => 'Withdrawal Delete', 'cash' => $cash, 'drawings' => $amount, 'date' => $today);

                        break;
                    case 4:
                        $expensename = "Loan_Repayment";
                        $today = date('Y-m-d');
                        $totalpaid = 0;

                        $loan_paymentdata = $this->Loanpayment->find('first', array('conditions' => array('Loanpayment.cash_account_id' => $cashID)));
                        if ($loan_paymentdata) {
                            $principal = $loan_paymentdata['Loanpayment']['principal'];
                            $principal2 = $loan_paymentdata['Loanpayment']['principal'];
                            $interest = $loan_paymentdata['Loanpayment']['interest'];
                            $interest2 = $loan_paymentdata['Loanpayment']['interest'];
                            $loan_id = $loan_paymentdata['Loanpayment']['loan_id'];
                            $payment_date = $loan_paymentdata['Loanpayment']['payment_date'];

                            if ($principal == null || $principal == "") {
                                $principal = 0;
                            }

                            if ($interest == null || $interest == "") {
                                $interest = 0;
                            }
                            if ($principal2 == null || $principal2 == "") {
                                $principal2 = 0;
                            }

                            if ($interest2 == null || $interest2 == "") {
                                $interest2 = 0;
                            }


                            $totalpaid = $principal + $interest;
                            $totalpaid2 = $principal2 + $interest2;

                            $loan_data = $this->Loan->find('first', array('conditions' => array('Loan.id' => $loan_id)));
                            if ($loan_data) {
                                $old_principalbal = $loan_data['Loan']['principal_balance'];
                                $old_interestbal = $loan_data['Loan']['interest_balance'];
                                $old_totaldue = $loan_data['Loan']['amount_balance'];
                                $old_principalpaid = $loan_data['Loan']['principal_paid'];
                                $old_interestpaid = $loan_data['Loan']['interest_paid'];
                                $old_totalpaid = $loan_data['Loan']['totalpayment'];


                                $new_principalbal = $old_principalbal + $principal;
                                $new_interestbal = $old_interestbal + $interest;
                                $new_totaldue = $old_totaldue + $totalpaid;


                                $new_principalpaid = $old_principalpaid - $principal;
                                $new_interestpaid = $old_interestpaid - $interest;
                                $new_totalpaid = $old_totalpaid - $totalpaid;


                                $loan_arry = array('id' => $loan_id, 'principal_balance' => $new_principalbal, 'interest_balance' => $new_interestbal, 'totalpayment' => $new_totalpaid, 'amount_balance' => $new_totaldue, 'principal_paid' => $new_principalpaid, 'interest_paid' => $new_interestpaid);

                                $result = $this->Loan->save($loan_arry);
                            }



                            $balSheet = array('description' => "Loan Repayment Delete", 'cash' => "-" . round($principal2, 2), 'interest' => "-" . round($interest2, 2), 'sloans' => round($principal2, 2), 'date' => $today);
                            $inStatement = array('description' => 'actual interest delete', 'interest' => "-" . round($interest2, 2), 'date' => $payment_date, 'actualinterest' => "-" . round($interest2, 2));

                            $this->IncomeStatement->save($inStatement);

                            $this->BalanceSheet->save($balSheet);
                        } else {
                            $message = 'Delete Unsuccessful!!';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'CashAccounts', 'action' => 'deleteEntry'));
                        }
                        break;
                    case 5:
                        $expensename = "Tax";
                        $today = date('Y-m-d');


                        $amount = "-" . $data['CashAccount']['amount'];
                        $cash = $data['CashAccount']['amount'];

                        $balSheet = array('description' => "Tax Delete", 'cash' => $cash, 'date' => $today, 'taxation' => $cash); //'owner_equity' => $cash, 
                        $inStatement = array('description' => "Tax Delete", 'taxpaid' => $amount, 'date' => $date);

                        $result3 = $this->IncomeStatement->save($inStatement);

                        break;
                    case 6:
                        $expensename = "Deposit";
                        $today = date('Y-m-d');


                        $cash = "-" . $oI_data['CashAccount']['amount'];

                        $balSheet = array('description' => "Deposit Delete", 'cash' => $cash, 'date' => $today, 'deposit' => $cash);


                        break;
                }
//                        $baldata = array('id' => $res['BalanceSheet']['id'], 'fixedasset_status' => 'not');
//                        $this->BalanceSheet->saveAll($baldata);
//                    
                $result = $this->CashAccount->delete($cashID, true);

                if ($result) {
                    $this->request->data = null;
                    $message = 'Delete success!!';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'deleteEntry'));
                } else {

                    $message = 'Delete Unsuccessful!!';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'deleteEntry'));
                }
            } else {

                $message = 'Delete Unsuccessful!!';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'CashAccounts', 'action' => 'deleteEntry'));
            }
        }
    }

    public function saveCash() {

        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            if (!empty($this->request->data)) {

                $months = 0;
                $payment_day = $this->request->data['CashAccount']['expense_date']['day'];
                $payment_month = $this->request->data['CashAccount']['expense_date']['month'];
                $payment_year = $this->request->data['CashAccount']['expense_date']['year'];
                $fpayment_date = $payment_year . "-" . $payment_month . "-" . $payment_day;
                $spayment_date = strtotime($fpayment_date);
                $today = date('Y-m-d', $spayment_date);

                $this->request->data['CashAccount']['expense_date'] = $today;

                $usernn = "Unknown";
                if ($this->Session->check('userData')) {
                    $usernn = $this->Session->read('userData');
                    $usernn = ucwords(strtolower($usernn));
                } else {
                    $usernn = "Unknown";
                    $usernn = ucwords(strtolower($usernn));
                }
                $this->request->data['CashAccount']['prepared_by'] = $usernn;
                $expense_type = $this->request->data['CashAccount']['expense_type'];
                $dateSendday = date('d');
                $dateSendmonth = date('m');
                $dateSendyear = date('Y');
                switch ($expense_type) {

                    case 0:
                        $expensename = "Expense";
                        $amount = $this->request->data['CashAccount']['amount'];
                        
                            $expense_id = $this->request->data['CashAccount']['expense_id'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $expense_desc = $this->request->data['CashAccount']['expense_desc'];
                        $source = $this->request->data['CashAccount']['source'];
                        $userType = $this->Session->read('userDetails.usertype_id');
                              $temp_entries = array('expense_id' => $expense_id, 'expense_type' => $expense_type, 'expense_desc' => $this->request->data['CashAccount']['expense_desc'], 'expense_date' => $today, 'source' => $source,'zone_id' => $zone_id,'amount' => $this->request->data['CashAccount']['amount'], 'prepared_by' => $this->request->data['CashAccount']['prepared_by'], 'paid_to' => $this->request->data['CashAccount']['paid_to'], 'remarks' => $this->request->data['CashAccount']['remarks']);
 
                        if ($userType != 1) {

                     
                            $this->TempcashAccount->save($temp_entries);
                            $message = 'Cash Account Entry Successfully Added, Pending Approval!!';
                            $this->Session->write('smsg', $message);
                            $feedback = array("feedback" => "pending", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                            return json_encode($feedback);
                        }
                        switch ($source) {
                            case 0:

                                $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                if ($pettycash_search) {
                                    $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                    if($pettycash_balance > 0 && $pettycash_balance >= $amount){
                                    $pettycash_id = $pettycash_search['Pettycash']['id'];
                                    $newpc_balance = $pettycash_balance - $amount;
                                     $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if($pc_result){
                                     $resultt = $this->CashAccount->save($temp_entries);
                    if($resultt){
                       if(isset($pettycash_withdrawal)){
                        $pettycash_withdrawal = array('pettycash_id' => $pettycash_id, 'amount' => $amount,$pettycash_withdrawal['cash_account_id'] => $resultt['CashAccount']['id']);
                                    $this->PettycashWithdrawal->save($pettycash_withdrawal);
                    }
                    }
                                    $message = 'Cash Account Entry Successfully Added!!';
                    $this->Session->write('smsg', $message);
//
                    $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                    return json_encode($feedback);
                                        }
                                        
                                    }else {

                                    $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is Insufficient. Please Contact The CEO';
                                    $this->Session->write('bmsg', $message);
                                    $feedback = array("feedback" => "balzero");
                                    return json_encode($feedback);
                                }
                                } else {

                                    $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';
                                    $this->Session->write('bmsg', $message);
                                    $feedback = array("feedback" => "balzero");
                                    return json_encode($feedback);
                                }
                                
                                break;
                        }

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $result3 = $this->IncomeStatement->save($inStatement);

                        // $equity = array('description' => $description[Expense][payment_name], 'expenditure' => $amount, 'date' => $today);
                        break;
                    case 1:
                        $expensename = "Loans";
                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $expectedids = array();
                        $loan_day = $this->request->data['CashAccount']['first_payment']['day'];
                        $loan_month = $this->request->data['CashAccount']['first_payment']['month'];
                        $loan_year = $this->request->data['CashAccount']['first_payment']['year'];
                        $floan_date = $loan_year . "-" . $loan_month . "-" . $loan_day;
                        $sloan_date = strtotime($floan_date);
                        $first_payment = date('Y-m-d', $sloan_date);

                        $months = 0;
                        $cash = 0.00;
                        $principal = 0.00;

                        $cash += $this->request->data['CashAccount']['amount'];
                        $months += $this->request->data['CashAccount']['ln_months'];
                        $principal += $this->request->data['CashAccount']['principal'];
                        $shed_type = $this->request->data['CashAccount']['scd_type'];
                        $expense_name = $description['Expense']['payment_name'];
                        $loan_date = new DateTime($today);
                        $last_paymt = new DateTime($first_payment);



                        switch ($shed_type) {

                            //today = date('Y-m-d');
                            //                $total_stock = $quantity * $item_price[0]['Item']['selling_price'];

                            case 0:
                                $total_payment = $cash * $months;
                                $interest = $total_payment - $principal;
                                $total_payment = round($total_payment, 2);
                                $interest = round($interest, 2);

                                $monthly_principal = $principal / $months;
                                $monthly_interest = $interest / $months;
                                $yearly_principal = $monthly_principal * 365;
                                $yearly_interest = $monthly_interest * 365;
                                $n = 0;
                                $last_paymt->add(new DateInterval('P' . $months . 'D'));
                                $last_payment = $last_paymt->format('Y-m-d');


                                while ($months > 0) {
                                    if ($months > 365) {
//                                if($n == 0){
//                                    $balSheet = array('description' => $description[Expense][payment_name], 'cash' => $cash, 'lgloans' => $cash, 'date' => $today);
//                                    $result2 = $this->BalanceSheet->saveAll($balSheet);
//                                }
                                        $n++;

                                        $amt_due = 0;

                                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal, 2), 'lgloans' => round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $inStatement = array('description' => 'interest', 'interest' => round($yearly_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $amt_due += round($m_interest, 2) + round($principal, 2);
                                        $expected = array('principal_due' => round($principal, 2), 'interest_due' => round($yearly_interest, 2), 'amount_due' => round($amt_due, 2), 'due_date' => $loan_date->format('Y-m-d'), 'principal_balance' => round($principal, 2), 'interest_balance' => round($yearly_interest, 2), 'amount_balance' => round($amt_due, 2));

                                        //$loan_data = array()
                                        // $principal
                                        $months -= 365;
                                        $principal = $principal - $yearly_principal;
                                        $loan_date->add(new DateInterval('P12D'));
                                        $this->IncomeStatement->saveAll($inStatement);
                                        $result2 = $this->BalanceSheet->saveAll($balSheet);
                                        $this->LoanExpectedpayment->create();
                                        $resultb = $this->LoanExpectedpayment->save($expected);
                                        if ($resultb) {
                                            $expectedids[] = $resultb['LoanExpectedpayment']['id'];
                                        }
                                    } else {
                                        $amt_due = 0;
                                        $m_interest = $monthly_interest * $months;
                                        $loan_date->add(new DateInterval('P' . $months . 'D'));
                                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal, 2), 'interest' => round($m_interest, 2), 'sloans' => round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $inStatement = array('description' => 'interest', 'interest' => round($m_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $amt_due += round($m_interest, 2) + round($principal, 2);
                                        $expected = array('principal_due' => round($principal, 2), 'interest_due' => round($m_interest, 2), 'amount_due' => round($amt_due, 2), 'due_date' => $loan_date->format('Y-m-d'), 'principal_balance' => round($principal, 2), 'interest_balance' => round($m_interest, 2), 'amount_balance' => round($amt_due, 2));



                                        $months -= $months;
                                        $result2 = $this->BalanceSheet->save($balSheet);
                                        $this->IncomeStatement->save($inStatement);
                                        $this->LoanExpectedpayment->create();
                                        $resultb = $this->LoanExpectedpayment->save($expected);
                                        if ($resultb) {
                                            $expectedids[] = $resultb['LoanExpectedpayment']['id'];
                                        }
                                    }
                                }

                                break;
                            case 1:
                                $total_payment = $cash * $months;
                                $interest = $total_payment - $principal;
                                $total_payment = round($total_payment, 2);
                                $interest = round($interest, 2);
                                $last_payment = null;
                                $amt_due = 0;

                                $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal, 2), 'interest' => round($interest, 2), 'sloans' => round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                $inStatement = array('description' => 'interest', 'interest' => round($interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                $amt_due += round($m_interest, 2) + round($principal, 2);
                                $expected = array('principal_due' => round($principal, 2), 'interest_due' => round($interest, 2), 'amount_due' => round($amt_due, 2), 'due_date' => $loan_date->format('Y-m-d'), 'principal_balance' => round($principal, 2), 'interest_balance' => round($interest, 2), 'amount_balance' => round($amt_due, 2));

                                $result2 = $this->BalanceSheet->save($balSheet);
                                $this->IncomeStatement->save($inStatement);
                                $this->LoanExpectedpayment->create();
                                $resultb = $this->LoanExpectedpayment->save($expected);
                                if ($resultb) {
                                    $expectedids[] = $resultb['LoanExpectedpayment']['id'];
                                }
                                break;

                            case 2:

                                $total_payment = $cash * $months;
                                $interest = $total_payment - $principal;
                                $total_payment = round($total_payment, 2);
                                $interest = round($interest, 2);
                                $last_paymt->add(new DateInterval('P' . $months . 'M'));
                                $last_payment = $last_paymt->format('Y-m-d');

                                //monthly loan and interest
                                $monthly_principal = $principal / $months;
                                $monthly_interest = $interest / $months;
                                $yearly_principal = $monthly_principal * 12;
                                $yearly_interest = $monthly_interest * 12;
                                $n = 0;
//                                $feedback = array("feedback" => "success","data" => array("total_payment" => $total_payment,"interest" => $interest,"monthly_principal" => $monthly_principal,"monthly_interest" =>$monthly_interest,"yearly_principal" => $yearly_principal,"yearly_interest" => $yearly_interest,"principal" => $principal));
//                            return json_encode($feedback);
                                while ($months > 0) {
                                    if ($months > 12) {
//                                if($n == 0){
//                                    $balSheet = array('description' => $description[Expense][payment_name], 'cash' => $cash, 'lgloans' => $cash, 'date' => $today);
//                                    $result2 = $this->BalanceSheet->saveAll($balSheet);
//                                }
                                        $n++;


                                        $amt_due = 0;
                                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal, 2), 'lgloans' => round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $inStatement = array('description' => 'interest', 'interest' => round($yearly_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $amt_due += round($yearly_interest, 2) + round($principal, 2);
                                        $expected = array('principal_due' => round($principal, 2), 'interest_due' => round($yearly_interest, 2), 'amount_due' => round($amt_due, 2), 'due_date' => $loan_date->format('Y-m-d'), 'principal_balance' => round($principal, 2), 'interest_balance' => round($yearly_interest, 2), 'amount_balance' => round($amt_due, 2));


                                        // $principal
                                        $months -= 12;
                                        $principal = $principal - $yearly_principal;
                                        $loan_date->add(new DateInterval('P12M'));
                                        $this->IncomeStatement->saveAll($inStatement);
                                        $this->LoanExpectedpayment->create();
                                        $resultb = $this->LoanExpectedpayment->save($expected);
                                        if ($resultb) {
                                            $expectedids[] = $resultb['LoanExpectedpayment']['id'];
                                        }
                                        $result2 = $this->BalanceSheet->saveAll($balSheet);
                                    } else {
                                        $amt_due = 0;
                                        $m_interest = $monthly_interest * $months;
                                        $loan_date->add(new DateInterval('P' . $months . 'M'));
                                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal, 2), 'sloans' => round($principal, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $inStatement = array('description' => 'interest', 'interest' => round($m_interest, 2), 'date' => $loan_date->format('Y-m-d'));
                                        $amt_due += round($m_interest, 2) + round($principal, 2);
                                        $expected = array('principal_due' => round($principal, 2), 'interest_due' => round($m_interest, 2), 'amount_due' => round($amt_due, 2), 'due_date' => $loan_date->format('Y-m-d'), 'principal_balance' => round($principal, 2), 'interest_balance' => round($m_interest, 2), 'amount_balance' => round($amt_due, 2));

                                        $months -= $months;
                                        $this->BalanceSheet->saveAll($balSheet);
                                        $this->LoanExpectedpayment->create();
                                        $resultb = $this->LoanExpectedpayment->save($expected);
                                        if ($resultb) {
                                            $expectedids[] = $resultb['LoanExpectedpayment']['id'];
                                        }
                                        $this->IncomeStatement->saveAll($inStatement);
                                    }
                                }
                                break;
                        }


                        $result = $this->CashAccount->save($this->request->data);
                        if ($result && $result2) {
                            $this->request->data = null;
                            $cash_account_id = $result['CashAccount']['id'];
                            $loan_data = array('cash_account_id' => $result['CashAccount']['id'], 'loan_name' => $expense_name, 'principal' => $result['CashAccount']['principal'], 'principal_balance' => $result['CashAccount']['principal'], 'interest' => $interest, 'interest_balance' => $interest, 'totalpayment' => $total_payment, 'schedule_type' => $result['CashAccount']['scd_type'], 'schedule_duration' => $result['CashAccount']['ln_months'], 'first_payment' => $first_payment, 'expected_finish' => $last_payment);
                            $result3 = $this->Loan->save($loan_data);
                            if ($result3) {
                                if (!empty($expectedids)) {
                                    $result4 = $this->LoanExpectedpayment->find('all', array('conditions' => array('LoanExpectedpayment.id' => $expectedids)));
                                    if ($result4) {

                                        foreach ($result4 as $res) {
                                            $data = array('id' => $res['LoanExpectedpayment']['id'], 'loan_id' => $result3['Loan']['id'], 'cash_account_id' => $cash_account_id);
                                            $this->LoanExpectedpayment->save($data);
                                        }
                                    }
                                }
                            }
                            $feedback = array("feedback" => "success");
                            return json_encode($feedback);
                        } else {

                            $feedback = array("feedback" => "unsuccessful");
                            return json_encode($feedback);
                        }

                        break;
                    case 2:
                        $expensename = "Owner_Injections";
                        $cash = $this->request->data['CashAccount']['amount'];
                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));
                        //today = date('Y-m-d');
                        //                $total_stock = $quantity * $item_price[0]['Item']['selling_price'];
                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'owner_equity' => $cash, 'date' => $today, 'injections' => $cash);

                        // $equity = array('description' => 'Investment by owner', 'Owner_Investment' => $cash, 'date' => $today);

                        break;
                    case 3:
                        $expensename = "Owner_Withdrawal";

                        $amount = $this->request->data['CashAccount']['amount'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));
                        //$today = date('Y-m-d');
                        //                $total_stock = $quantity * $item_price[0]['Item']['selling_price'];

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'drawings' => $amount, 'date' => $today);
                        // $equity = array('description' => 'Withdrawal by owner', 'withdrawal' => $amount, 'date' => $today);
                        break;
                    case 4:
                        $expensename = "Loan_Repayment";
                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));
                        $totalpaid = 0;
                        $principal = $this->request->data['CashAccount']['amount'];
                        $principal2 = $this->request->data['CashAccount']['amount'];
                        $interest = $this->request->data['CashAccount']['interest_payment'];
                        $interest2 = $this->request->data['CashAccount']['interest_payment'];
                        $loan_id = $this->request->data['CashAccount']['loan_id'];

                        if ($principal == null || $principal == "") {
                            $principal = 0;
                        }

                        if ($interest == null || $interest == "") {
                            $interest = 0;
                        }
                        if ($principal2 == null || $principal2 == "") {
                            $principal2 = 0;
                        }

                        if ($interest2 == null || $interest2 == "") {
                            $interest2 = 0;
                        }

                        $totalpaid = $principal + $interest;
                        $totalpaid2 = $principal2 + $interest2;

                        $loan_data = $this->Loan->find('first', array('conditions' => array('Loan.id' => $loan_id)));
                        if ($loan_data) {
                            $old_principalbal = $loan_data['Loan']['principal_balance'];
                            $old_interestbal = $loan_data['Loan']['interest_balance'];
                            $old_totaldue = $loan_data['Loan']['amount_balance'];
                            $old_principalpaid = $loan_data['Loan']['principal_paid'];
                            $old_interestpaid = $loan_data['Loan']['interest_paid'];
                            $old_totalpaid = $loan_data['Loan']['totalpayment'];


                            $new_principalbal = $old_principalbal - $principal;
                            $new_interestbal = $old_interestbal - $interest;
                            $new_totaldue = $old_totaldue - $totalpaid;


                            $new_principalpaid = $old_principalpaid + $principal;
                            $new_interestpaid = $old_interestpaid + $interest;
                            $new_totalpaid = $old_totalpaid + $totalpaid;


                            $loan_arry = array('id' => $loan_id, 'principal_balance' => $new_principalbal, 'interest_balance' => $new_interestbal, 'totalpayment' => $new_totalpaid, 'amount_balance' => $new_totaldue, 'principal_paid' => $new_principalpaid, 'interest_paid' => $new_interestpaid);

                            $payment_data = array('loan_id' => $loan_id, 'interest' => $interest, 'principal' => $principal, 'payment_date' => $today);

                            $result = $this->Loan->save($loan_arry);
                            if ($result) {
                                $lp_result = $this->Loanpayment->save($payment_data);
                            }
                        }

                        $expted_data = $this->LoanExpectedpayment->find('all', array('order' => array('LoanExpectedpayment.id' => 'ASC'), 'conditions' => array('LoanExpectedpayment.loan_id' => $loan_id, 'LoanExpectedpayment.amount_balance >' => 0), 'recursive' => -1));

                        if ($expted_data) {
                            foreach ($expted_data as $exp) {

                                $old_principalbal = $exp['LoanExpectedpayment']['principal_balance'];
                                $old_interestbal = $exp['LoanExpectedpayment']['interest_balance'];
                                $old_totaldue = $exp['LoanExpectedpayment']['amount_balance'];
                                $old_principalpaid = $exp['LoanExpectedpayment']['principal_paid'];
                                $old_interestpaid = $exp['LoanExpectedpayment']['interest_paid'];
                                $old_totalpaid = $exp['LoanExpectedpayment']['amount_paid'];

                                if ($principal > 0) {
                                    $new_principalbal = $old_principalbal - $principal;
                                    $new_principalpaid = $old_principalpaid + $principal;
                                    $principal = $principal - $new_principalbal;
                                }

                                if ($interest > 0) {
                                    $new_interestbal = $old_interestbal - $interest;
                                    $new_interestpaid = $old_interestpaid + $interest;
                                    $interest = $interest - $old_interestbal;
                                }

                                if ($totalpaid > 0) {
                                    $new_totaldue = $old_totaldue - $totalpaid;
                                    $new_totalpaid = $old_totalpaid + $totalpaid;
                                    $totalpaid = $totalpaid - $new_totaldue;
                                }

                                $exp_array = array('id' => $exp['LoanExpectedpayment']['id'], 'principal_paid' => $new_principalpaid, 'interest_paid' => $new_interestpaid, 'amount_paid' => $new_totalpaid, 'principal_balance' => $new_principalbal, 'interest_balance' => $new_interestbal);

                                $this->LoanExpectedpayment->save($exp_array);
                            }
                        }

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => round($principal2, 2), 'interest' => round($interest2, 2), 'sloans' => "-" . round($principal2, 2), 'date' => $today);
                        $inStatement = array('description' => 'actual interest', 'interest' => "-" . round($interest2, 2), 'date' => $today, 'actualinterest' => round($interest2, 2));

                        $this->IncomeStatement->save($inStatement);

                        $this->BalanceSheet->save($balSheet);
                        break;
                    case 5:
                        $expensename = "Tax";

                        $amount = $this->request->data['CashAccount']['amount'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));
                        // $today = date('Y-m-d');
                        //                $total_stock = $quantity * $item_price[0]['Item']['selling_price'];
                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today, 'taxation' => $cash); //'owner_equity' => $cash, 
                        $inStatement = array('description' => $description['Expense']['payment_name'], 'taxpaid' => $amount, 'date' => $today);

                        $result3 = $this->IncomeStatement->save($inStatement);

                        break;
                    case 6:
                        $expensename = "Deposit";
                        
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $cash = $this->request->data['CashAccount']['amount'];
                        
                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today, 'deposit' => $cash);



                        break;
                    case 7:
                        $expensename = "Dispense Petty Cash";
                        $zone_id = $this->request->data['CashAccount']['zone_id'];
                        $cash = $this->request->data['CashAccount']['amount'];
                        $expense_desc = $this->request->data['CashAccount']['expense_desc'];
                        
                                    $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                    if ($pettycash_search) {
                                        $pettycash_id = $pettycash_search['Pettycash']['id'];
                                        $pettycash_amt = $pettycash_search['Pettycash']['amount'] + $cash;
                                        $pettycash_bal = $pettycash_search['Pettycash']['balance'] + $cash;
                                        $pettycash_array = array('id' => $pettycash_id, 'amount' => $pettycash_amt, 'balance' => $pettycash_bal);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if ($pc_result) {
                                            $pettydeposits_array = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $cash);
                                            $this->PettycashDeposit->save($pettydeposits_array);
                                            $message = 'Petty Cash Deposit Successfully Added!!';
                            $this->Session->write('smsg', $message);

                            $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                                        }else {

                    $message = 'Petty Cash Entry Unsuccessfully!!';
                    $this->Session->write('emsg', $message);

                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
                                    } else {
                                        $pettycash_amt = $cash;
                                        $pettycash_bal = $cash;
                                        $pettycash_array = array('zone_id' => $zone_id, 'amount' => $pettycash_amt, 'balance' => $pettycash_bal);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if ($pc_result) {
                                            $pettycash_id = $pc_result['Pettycash']['id'];
                                            $pettydeposits_array = array('pettycash_id' => $pettycash_id,'zone_id' => $zone_id, 'amount' => $cash);
                                            $this->PettycashDeposit->save($pettydeposits_array);
                                            $message = 'Petty Cash Deposit Successfully Added!!';
                            $this->Session->write('smsg', $message);

                        
                                        }else {

                    $message = 'Cash Account Entry Unsuccessfully!!';
                    $this->Session->write('emsg', $message);

                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
                                    }
                                    
                        $amount = $this->request->data['CashAccount']['amount'];
                        $cash = "-" . $this->request->data['CashAccount']['amount'];
                        $this->request->data['CashAccount']['amount'] = $cash;
                    
                            $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $this->request->data['CashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $cash, 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $result3 = $this->IncomeStatement->save($inStatement);

                            
                        break;
                }

                $result = $this->CashAccount->save($this->request->data);
                $result2 = $this->BalanceSheet->save($balSheet);


                if ($result && $result2) {
                    $this->request->data = null;
                    if(isset($pettycash_withdrawal)){
                        $pettycash_withdrawal['cash_account_id'] = $result['CashAccount']['id'];
                                    $this->PettycashWithdrawal->save($pettycash_withdrawal);
                    }
                    if (isset($lp_result)) {
                        $data = array('id' => $lp_result['Loanpayment']['id'], 'cash_account_id' => $result['CashAccount']['id']);
                        $this->Loanpayment->save($data);
                    }

                    $message = 'Cash Account Entry Successfully Added!!';
                    $this->Session->write('smsg', $message);

                    $feedback = array("feedback" => "success", "dateSendday" => $dateSendday, 'dateSendmonth' => $dateSendmonth, 'dateSendyear' => $dateSendyear);
                    
                    return json_encode($feedback);
                } else {

                    $message = 'Cash Account Entry Unsuccessfully!!';
                    $this->Session->write('emsg', $message);

                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
            } else {
                $message = 'No Data Entered, Check And Try Again!!';
                $this->Session->write('bmsg', $message);

                $feedback = array("feedback" => "No Data");
                return json_encode($feedback);
            }
        }
    }

    function redirectTOIndex() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/');
    }
    
    function redirectTOAuth() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/authoriseEntry/');
    }

    
    function redirectTOPettySummByZone() {

        $this->autoRender = false;
        $this->redirect('/cashAccounts/pettycashSummByZone/');
    }
    function getloanInfo() {

        $this->autoRender = false;

        if ($this->request->is('ajax')) {

            if (!empty($_POST['loanId'])) {
                //$currency = $this->Session->read('shopCurrency');
                $accday = $this->Session->read('accYear');
                $day = date('d', strtotime($accday)); //get from session. using temporay value
                $month = date('m', strtotime($accday));
                $year = date('Y');
                $year = $year + 1;
                $start_date = $year . "-" . $month . "-" . $day;
                $snewdate = strtotime($start_date);
                $start_date = date('Y-m-d', $snewdate);

                $loanId = $_POST['loanId'];
                $loanResult = $this->Loan->find('first', array('conditions' => array('Loan.id' => $loanId), 'recursive' => -1));
                if ($loanResult) {
                    $loanExtra = $this->LoanExpectedpayment->find('all', array('fields' => ('SUM(LoanExpectedpayment.interest_balance) as interest_bal'), 'conditions' => array('LoanExpectedpayment.loan_id' => $loanId, 'LoanExpectedpayment.due_date <=' => $start_date, 'LoanExpectedpayment.interest_balance >' => 0), 'recursive' => -1));
                    if ($loanExtra) {
                        $interest_bal = 0;
                        foreach ($loanExtra as $key => $value) {
                            $interest_bal += $value[0]['interest_bal'];
                        }
                        $feedback = array('loanResult' => $loanResult, 'loanexp' => $interest_bal, 'status' => 'ok', 'status2' => 'sok');
                    } else {
                        $feedback = array('loanResult' => $loanResult, 'status' => 'ok', 'status2' => 'fok');
                    }
                } else {
                    $feedback = array('status' => 'fail');
                    $loan = json_encode($feedback);
                }

                $loan = json_encode($feedback);
                return $loan;
            } else {
                $feedback = array('status' => 'fail');
                $loan = json_encode($feedback);
                return $loan;
            }
        } else {
            $feedback = array('status' => 'fail');
            $loan = json_encode($feedback);
            return $loan;
        }
    }

    public function findEntry() {

       // $this->__validateUserType();
        $data = $this->paginate('CashAccount');
        if ($this->request->is('post')) {

            $sday = $this->request->data['CashAccount']['begin_date']['day'];
            $smonth = $this->request->data['CashAccount']['begin_date']['month'];
            $syear = $this->request->data['CashAccount']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['CashAccount']['finish_date']['day'];
            $emonth = $this->request->data['CashAccount']['finish_date']['month'];
            $eyear = $this->request->data['CashAccount']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            $date->add(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');

            $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date)))));



            if ($accounts) {

                $this->set('data', $accounts);
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {

            $order_details = $this->CashAccount->find('all');
            $this->set('data', $order_details);
        }
    }

   
    public function authoriseEntry() {
       // $this->__validateUserType();
        $data = $this->paginate('TempcashAccount');
        $this->set('zones', $this->Zone->find('list'));

        if ($this->request->is('post')) {

            $zoneid = $this->request->data['TempcashAccount']['zone_id'];
            $sday = $this->request->data['TempcashAccount']['begin_date']['day'];
            $smonth = $this->request->data['TempcashAccount']['begin_date']['month'];
            $syear = $this->request->data['TempcashAccount']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['TempcashAccount']['finish_date']['day'];
            $emonth = $this->request->data['TempcashAccount']['finish_date']['month'];
            $eyear = $this->request->data['TempcashAccount']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            $date->add(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');
            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }

            if ($zoneid != "" && $zoneid != null) {
                $accounts = $this->TempcashAccount->find('all', array('conditions' => array('AND' => array(array('TempcashAccount.expense_date >=' => $start_date), array('TempcashAccount.expense_date <=' => $end_date), array('TempcashAccount.zone_id' => $zoneid)))));



                if ($accounts) {

                    $this->set('data', $accounts);
                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'authoriseEntry'));
                }
            } elseif ($zoneid == "") {

                $accounts = $this->TempcashAccount->find('all', array('conditions' => array('AND' => array(array('TempcashAccount.expense_date >=' => $start_date), array('TempcashAccount.expense_date <=' => $end_date)))));

                if ($accounts) {

                    $this->set('data', $accounts);
                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'authoriseEntry'));
                }
            }else{
                    $this->request->data = null;
                
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'authoriseEntry'));
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {

             if ($this->Session->check('isdata') == false) {
                 
            $order_details = $this->TempcashAccount->find('all', array('conditions' => array('TempcashAccount.status !=' => "Approved")));
            $this->set('data', $order_details);
                
            }else{
            }
        }
    }

    public function approveEntry($entryID = null, $status = Null) {
        $this->autoRender = false;
        if (($status != "" && !is_null($status)) && ($entryID != "" && !is_null($entryID))) {

            
            if ($status == "Approve") {
                

                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Pending')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Approved');
                    $amount = $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'] ;
                    $today = $entries['TempcashAccount']['expense_date'];

                    $temp_entries = array('expense_id' => $entries['TempcashAccount']['expense_id'], 'user_id' => $entries['TempcashAccount']['user_id'], 'expense_type' => $entries['TempcashAccount']['expense_type'], 'expense_desc' => $entries['TempcashAccount']['expense_desc'], 'expense_date' => $entries['TempcashAccount']['expense_date'], 'amount' => $entries['TempcashAccount']['amount'],'zone_id' => $entries['TempcashAccount']['zone_id'],'source' => $entries['TempcashAccount']['source'], 'prepared_by' => $entries['TempcashAccount']['prepared_by'], 'paid_to' => $entries['TempcashAccount']['paid_to'], 'remarks' => $entries['TempcashAccount']['remarks']);
                    $this->TempcashAccount->save($entry_array);
                    $result = $this->CashAccount->save($temp_entries);
                    $message = 'Cash Account Entry Successfully Approved';
                    $this->Session->write('smsg', $message);
                    if($result){
                    
                    $zone_id = $entries['TempcashAccount']['zone_id'];
                    $source = $entries['TempcashAccount']['source'];

                                            switch ($source) {
                            case 0:

                                $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                if ($pettycash_search) {
                                    $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                    if($pettycash_balance > 0 && $pettycash_balance >= $amount){
                                    $pettycash_id = $pettycash_search['Pettycash']['id'];
                                    $newpc_balance = $pettycash_balance - $amount;
                                     $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if($pc_result){
                                    $pettycash_withdrawal = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $amount,'cash_account_id' => $result['CashAccount']['id']);
                                    $this->PettycashWithdrawal->save($pettycash_withdrawal);
                                    
                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                                        }
                                } else {

                                    $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';
                                    
                    $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                                    $this->CashAccount->delete($result['CashAccount']['id']);
                                    $this->TempcashAccount->save($entry_array);
                                    $this->Session->write('bmsg', $message);
//                                    $feedback = array("feedback" => "balzero");
//                                    return json_encode($feedback);
                                    
                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                                }
                              
                        }else {

                                    $message = 'Sorry, No Petty Cash Available';
                                     $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                        }
                          break;
                                            }
                    }
                    $expense_desc = $entries['TempcashAccount']['expense_desc'];
                    $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $entries['TempcashAccount']['expense_id'])));

                    $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $entries['TempcashAccount']['amount'], 'date' => $today);
                    switch ($expense_desc) {
                        case 0:
                            $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                            break;
                        case 1:
                            $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                            break;
                        default:
                            $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                            break;
                    }
                    $this->IncomeStatement->save($inStatement);
                    $this->BalanceSheet->save($balSheet);

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                } else {
                    $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Rejected')));

                    if ($entries) {

                        $entry_array = array('id' => $entryID, 'status' => 'Approved');

                        $amount = $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'] - $entries['TempcashAccount']['amount'];
                        $today = $entries['TempcashAccount']['expense_date'];

                        $temp_entries = array('expense_id' => $entries['TempcashAccount']['expense_id'], 'user_id' => $entries['TempcashAccount']['user_id'], 'expense_type' => $entries['TempcashAccount']['expense_type'], 'expense_desc' => $entries['TempcashAccount']['expense_desc'], 'expense_date' => $entries['TempcashAccount']['expense_date'], 'amount' => $entries['TempcashAccount']['amount'],'zone_id' => $entries['TempcashAccount']['zone_id'], 'prepared_by' => $entries['TempcashAccount']['prepared_by'], 'paid_to' => $entries['TempcashAccount']['paid_to'], 'remarks' => $entries['TempcashAccount']['remarks']);

                        $this->TempcashAccount->save($entry_array);
                        $result = $this->CashAccount->save($temp_entries);
                        $message = 'Cash Account Entry Successfully Approved';
                        $this->Session->write('smsg', $message);
                        if($result){
                    
                    $zone_id = $entries['TempcashAccount']['zone_id'];
                    $source = $entries['TempcashAccount']['source'];

                                            switch ($source) {
                            case 0:

                                $pettycash_search = $this->Pettycash->find('first', array('conditions' => array('Pettycash.zone_id' => $zone_id)));
                                if ($pettycash_search) {
                                    $pettycash_balance = $pettycash_search['Pettycash']['balance'];
                                    if($pettycash_balance > 0 && $pettycash_balance >= $amount){
                                    $pettycash_id = $pettycash_search['Pettycash']['id'];
                                    $newpc_balance = $pettycash_balance - $amount;
                                     $pettycash_array = array('id' => $pettycash_id, 'balance' => $newpc_balance);
                                        $pc_result = $this->Pettycash->save($pettycash_array);
                                        if($pc_result){
                                    $pettycash_withdrawal = array('pettycash_id' => $pettycash_id, 'zone_id' => $zone_id, 'amount' => $amount,'cash_account_id' => $result['CashAccount']['id']);
                                    $this->PettycashWithdrawal->save($pettycash_withdrawal);
                                    
                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                                        }
                                } else {

                                    $message = 'Sorry, Petty Cash Balance For Your Selected Zone Is 0. Please Contact The CEO';
                                    
                                    $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                                    $this->CashAccount->delete($result['CashAccount']['id']);
                                    $this->TempcashAccount->save($entry_array);
                                    $this->Session->write('bmsg', $message);
//                                    $feedback = array("feedback" => "balzero");
//                                    return json_encode($feedback);
                                    
                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                                }
                                
                        }
                        break;
                                            }
                    }
                        $expense_desc = $entries['TempcashAccount']['expense_desc'];

                        $description = $this->Expense->find('first', array('conditions' => array('Expense.id' => $entries['TempcashAccount']['expense_id'])));

                        $balSheet = array('description' => $description['Expense']['payment_name'], 'cash' => $entries['TempcashAccount']['amount'], 'date' => $today);
                        switch ($expense_desc) {
                            case 0:
                                $inStatement = array('description' => 'Cost of Sales', 'expenditure' => $amount, 'date' => $today);
                                break;
                            case 1:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                            default:
                                $inStatement = array('description' => $description['Expense']['payment_name'], 'expenditure' => $amount, 'date' => $today);
                                break;
                        }
                        $this->IncomeStatement->save($inStatement);
                        $this->BalanceSheet->save($balSheet);

                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                    } else {

                        $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                        $this->Session->write('bmsg', $message);


                        $this->redirect(array('controller' => 'CashAccounts', 'action' => 'authoriseEntry'));
                    }
                }
            } elseif ($status == "Reject") {

                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Pending')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Rejected');
                    $this->TempcashAccount->save($entry_array);
                    $message = 'Cash Account Entry Successfully Disapproved';
                    $this->Session->write('smsg', $message);
                    if($this->Session->check('isdata')){
                        $this->Session->delete('isdata');
                    }

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                } else {

                    $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                    $this->Session->write('bmsg', $message);


                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                }
            }
             elseif ($status == "Pend") {

                $entries = $this->TempcashAccount->find('first', array('conditions' => array('TempcashAccount.id' => $entryID, 'status' => 'Rejected')));

                if ($entries) {
                    $entry_array = array('id' => $entryID, 'status' => 'Pending');
                    $this->TempcashAccount->save($entry_array);
                    $message = 'Cash Account Entry Set To Pending Successfully';
                    $this->Session->write('smsg', $message);
                    if($this->Session->check('isdata')){
                        $this->Session->delete('isdata');
                    }

                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                } else {

                    $message = 'Unable to Retrieve Cash Account Entry Details;Reload Page And Try Again';
                    $this->Session->write('bmsg', $message);


                    $this->redirect(array('controller' => 'CashAccounts', 'action' => 'redirectTOAuth'));
                }
            }
        }
    }

    public function authorizeEntry(){
        
    }
    
    public function deleteEntry() {

      //  $this->__validateUserType();
        $data = $this->paginate('CashAccount');
        if ($this->request->is('post')) {

            $sday = $this->request->data['CashAccounts']['begin_date']['day'];
            $smonth = $this->request->data['CashAccounts']['begin_date']['month'];
            $syear = $this->request->data['CashAccounts']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['CashAccounts']['finish_date']['day'];
            $emonth = $this->request->data['CashAccounts']['finish_date']['month'];
            $eyear = $this->request->data['CashAccounts']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            $date->add(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');

            $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date)))));



            if ($accounts) {

                $this->set('data', $accounts);
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {

            $order_details = $this->CashAccount->find('all');
            $this->set('data', $order_details);
        }
    }

}

?>
