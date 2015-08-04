<?php

//CakePlugin::load('Uploader');
//App::import('Vendor', 'Uploader.Uploader');

class ReinvestmentsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Reinvestments';
    var $uses = array('Reinvestment', 'Reinvestor', 'ReinvestorDeposit', 'ReinvestorCashaccount', 'Investee', 'Currency',
        'InvestmentProduct', 'PaymentMode', 'PaymentSchedule', 'InvestmentTerm', 'InvestmentCash',
        'InvestmentDestination', 'InvDestProduct', 'EquitiesList', 'ReinvestmentsEquity', 'InvestorEquity',
        'ReinvestmentRollover', 'ReinvestmentStatement', /* 'ReinvestmentEquityStatement', */ 'Instruction',
        'LedgerTransaction', 'ClientLedger', 'ReinvestorEquity', 'InvestorEquity', 'CashReceiptMode',
        'PaymentMode', 'InvestmentReturn', 'ReinvestmentTopup', 'EquityOrder', 'Investment','ReinvestInterestAccrual');
    var $paginate = array(
        'Reinvestor' => array('limit' => 50, 'order' => array('Reinvestor.company_name' => 'asc')),
        'ReinvestorDeposit' => array('limit' => 50, 'order' => array('ReinvestorDeposit.id' => 'asc')),
        'InvestmentCash' => array('limit' => 50, 'order' => array('InvestmentCash.id' => 'asc')),
        'InvestmentDestination' => array('limit' => 50, 'order' => array('InvestmentDestination.id' => 'asc')),
        'InvDestProduct' => array('limit' => 50, 'order' => array('InvDestProduct.id' => 'asc')),
    );

//    var $helpers = array('AjaxMultiUpload.Upload');

    function beforeFilter() {
        $this->__validateLoginStatus();
//        $this->Uploader = new Uploader(array('tempDir' => TMP, 'ajaxField' => "qqfile"));
    }

    function __validateLoginStatus() {
        if ($this->action != 'login' && $this->action != 'logout') {
            if ($this->Session->check('userData') == false) {
                $this->redirect('/');
            }
        }
    }

    function __validateUserType() {

        $userType = $this->Session->read('userDetails.usertype_id');
//      if ($userType != 1) {
//      $this->redirect('/Information/');
//      }
    }

    function index() {
        
    }

    function addCashDeposit() {
        $this->autoRender = $this->autoRender = false;
        if ($this->request->is('post')) {

            $this->Session->write('newCashDeposit', $this->request->data['InvestmentCash']);
            $reinvestorid = $this->request->data['InvestmentCash']['reinvestor_id'];
            $investment_type = $this->request->data['InvestmentCash']['investmentproduct_id'];
            $investment_prod = '';
            $payment_name = '';

            $fixed_inv_amount = $this->request->data['InvestmentCash']['fixed_inv_amount'];
            $equity_inv_amount = $this->request->data['InvestmentCash']['equity_inv_amount'];
            $payment_name = '';
            $paymentmodeid = $this->request->data['InvestmentCash']['paymentmode_id'];
            $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
            if ($payment_mode) {
                $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
            }
            $userid = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $userid = $this->Session->read('userDetails.id');
            }
            $date = $this->request->data['InvestmentCash']['investment_date']['year'] . "-" . $this->request->data['InvestmentCash']['investment_date']['month'] . "-" . $this->request->data['InvestmentCash']['investment_date']['day'];
            $reinvestorDeposit_data = array('reinvestor_id' => $reinvestorid, 'investment_product_id' => $investment_type,
                'currency_id' => $this->request->data['InvestmentCash']['currency_id'],
                'payment_mode_id' => $paymentmodeid, 'investment_date' => $date, 'fixed_inv_amount' => $fixed_inv_amount,
                'equity_inv_amount' => $equity_inv_amount, 'notes' => $this->request->data['InvestmentCash']['notes']
                , 'user_id' => $userid);
            $result_deposit = $this->ReinvestorDeposit->save($reinvestorDeposit_data);
            if ($result_deposit) {
                $deposit_id = $result_deposit['ReinvestorDeposit']['id'];
                switch ($investment_type) {
                    case 1:
                        if ($fixed_inv_amount == '' || is_null($fixed_inv_amount)) {
                            $message = 'Please supply fixed investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        if ($equity_inv_amount != '' && !is_null($equity_inv_amount)) {
                            $message = 'Please supply ONLY fixed investment amount for this type of Investment product';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }

                        $cash_depositarray = array('reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                            $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                            $this->request->data['InvestmentCash']['currency_id'],
                            'amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                            'available_amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                            'investment_type' => 'fixed', 'investment_date' => $date, 'payment_mode' => $payment_name);
                        $result = $this->InvestmentCash->save($cash_depositarray);
                        if ($result) {

                            $message = 'Cash Deposit successfully added';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert', 'fixed', $result['InvestmentCash']['id']));
                        } else {

                            $message = 'Error adding Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        break;
                    case 2:
                        if ($equity_inv_amount == '' || is_null($equity_inv_amount)) {
                            $message = 'Please supply equity investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        if ($fixed_inv_amount != '' && !is_null($fixed_inv_amount)) {
                            $message = 'Please supply ONLY equity investment amount for this type of Investment product';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        $cash_depositarray = array('reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                            $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                            $this->request->data['InvestmentCash']['currency_id'],
                            'amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                            'available_amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                            'investment_type' => 'equity', 'investment_date' => $date, 'payment_mode' => $payment_name);

                        $result = $this->InvestmentCash->save($cash_depositarray);
                        if ($result) {
                            $message = 'Cash Deposit successfully added';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert', 'equity', $result['InvestmentCash']['id']));
                        } else {

                            $message = 'Error adding Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        break;
                    case 3:
                        if ($equity_inv_amount == '' || is_null($equity_inv_amount)) {
                            $message = 'Please supply equity investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        if ($fixed_inv_amount == '' && is_null($fixed_inv_amount)) {
                            $message = 'Please supply fixed investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        $cash_depositarray_equity = array('reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                            $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                            $this->request->data['InvestmentCash']['currency_id'],
                            'amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                            'available_amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                            'investment_type' => 'equity', 'investment_date' => $date, 'payment_mode' => $payment_name);
                        $this->InvestmentCash->create();
                        $result_equity = $this->InvestmentCash->save($cash_depositarray_equity);

                        $cash_depositarray_fixed = array('reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                            $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                            $this->request->data['InvestmentCash']['currency_id'],
                            'amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                            'available_amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                            'investment_type' => 'fixed', 'investment_date' => $date, 'payment_mode' => $payment_name);
                        $this->InvestmentCash->create();
                        $result_fixed = $this->InvestmentCash->save($cash_depositarray_fixed);

                        if ($result_equity && $result_fixed) {
                            $message = 'Cash Deposit successfully added';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert', 'both', $result_equity['InvestmentCash']['id'], $result_fixed['InvestmentCash']['id']));
                        } else {

                            $message = 'Error adding Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                        }
                        break;
                }
            } else {
                $message = 'Error adding Cash Deposit details. Please try again.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
            }
        }
    }

    public function proceed_check1() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investortype_id = $this->request->data['Investor']['investortype_id'];

            if ($investortype_id == 1) {
                $message = 'Please Select a Type of Investor';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            } elseif ($investortype_id == 2) {
                $this->redirect('newInvestorIndiv');
            } elseif ($investortype_id == 3) {
                $this->redirect('newInvestorIndiv');
            } elseif ($investortype_id == 4) {
                $this->redirect('newInvestorComp');
            } else {
                $message = 'Please Select a Valid Investor Type';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            }
        }
    }

    public function proceed_check2() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investortype_id = $this->request->data['Investor']['investortype_id'];

            if ($investortype_id == 1) {
                $message = 'Please Select a Type of Investor';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            } elseif ($investortype_id == 2) {
                $this->redirect('newInvestorIndiv');
            } elseif ($investortype_id == 3) {
                $this->redirect('newInvestorJoint');
            } elseif ($investortype_id == 4) {
                $this->redirect('newInvestorComp');
            } else {
                $message = 'Please Select a Valid Investor Type';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            }
        }
    }

    public function proceed_check3() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investortype_id = $this->request->data['Investor']['investortype_id'];

            if ($investortype_id == 1) {
                $message = 'Please Select a Type of Investor';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            } elseif ($investortype_id == 2) {
                $this->redirect('newInvestment1');
            } elseif ($investortype_id == 3) {
                $this->redirect('newInvestment1Joint');
            } elseif ($investortype_id == 4) {
                $this->redirect('newInvestment1');
            } else {
                $message = 'Please Select a Valid Investor Type';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            }
        }
    }

    public function commit_indv() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('ajax')) {
            return $this->request;

            $dob_day = $this->request->data['Investor']['dob']['day'];
            $dob_month = $this->request->data['Investor']['dob']['month'];
            $dob_year = $this->request->data['Investor']['dob']['year'];
            $issue_day = $this->request->data['Investor']['id_issue']['day'];
            $issue_month = $this->request->data['Investor']['id_issue']['month'];
            $issue_year = $this->request->data['Investor']['id_issue']['year'];
            $expiry_day = $this->request->data['Investor']['id_expiry']['day'];
            $expiry_month = $this->request->data['Investor']['id_expiry']['month'];
            $expiry_year = $this->request->data['Investor']['id_expiry']['year'];
            if ($this->Session->check('investortemp') == true) {
                $this->Session->delete('investortemp');
            }
            $issue = $issue_year . "-" . $issue_month . "-" . $issue_day;
            $issue_date = date('Y-m-d', strtotime($issue));
            $expiry = $expiry_year . "-" . $expiry_month . "-" . $expiry_day;
            $expiry_date = date('Y-m-d', strtotime($expiry));
            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));

            $this->Session->write('investortemp', $this->request->data['Investor']);
            $this->request->data['Investor']['dob'] = $dob_date;

            if ($dob == date('Y-m-d')) {
                $message = 'Please Supply The Investor\'s Date of Birth';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');

            if ($this->request->data['Investor']['other_names'] == "" || $this->request->data['Investor']['other_names'] == null) {
                $message = 'Please Supply The Investor\'s Other Names';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['surname'] == "" || $this->request->data['Investor']['surname'] == null) {
                $message = 'Please Supply The Investor\'s Surname';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            $fullname = $this->request->data['Investor']['other_names'] . " " . $this->request->data['Investor']['surname'];

            if ($this->request->data['Investor']['idtype_id'] == "" || $this->request->data['Investor']['idtype_id'] == null) {
                $message = 'Please Supply The Investor\'s ID-Type';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['id_number'] == "" || $this->request->data['Investor']['id_number'] == null) {
                $message = 'Please Supply The Investor\'s Number';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['nationality'] == "" || $this->request->data['Investor']['nationality'] == null) {
                $message = 'Please Supply The Investor\'s Nationality';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

            $this->request->data['Investor']['fullname'] = $fullname;
            $this->request->data['Investor']['dob'] = $dob_date;
            $this->request->data['Investor']['id_issue'] = $issue_date;
            $this->request->data['Investor']['id_expiry'] = $expiry_date;
            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['surname'] . "_" . "photo" . "_" . $dob_date;

//            if ($data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true))) {
//            $data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true, 'name' => $photo));
//            return json_encode($data);
//            if ($data) {
//
//                $this->request->data['Investor']['investor_photo'] = $data['path'];
////                header('Content-Type: application/json');
//                // Upload successful, do whatever
//            } else {
//                $message = 'Please Supply The Investor\'s Picture';
//                $this->Session->write('emsg', $message);
//                return json_encode(array('status' => 'error'));
//            }

            $userType = $this->Session->check('userDetails.usertype_id');
            if ($userType) {
                $userType = $this->Session->read('userDetails.usertype_id');
                $this->request->data['Investor']['user_id'] = $userType;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $result['Investor']['full_name'] = $result['Investor']['other_names'] . ' ' . $result['Investor']['surname'];
                $this->Session->write('investorID', $Investorid);
                $this->Session->write('investor', $result);
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $message = 'Investor Details Successfully Added';
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function clearSessions() {
        $check = $this->Session->check('int');
        if ($check) {
            $this->Session->delete('int');
        }
        $check = $this->Session->check('ints');
        if ($check) {
            $this->Session->delete('ints');
        }

        $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
    }

    function searchInvestorforDel($investorID = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")))));

            if ($investor) {
                $check = $this->Session->check('ints');
                if ($check) {
                    $this->Session->delete('ints');
                }
                $cust = $this->Session->write('ints', $investor);

//                $this->Session->write('custID', $Investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'deleteInvestor'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'deleteInvestor'));
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorID)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorID)));
            if ($investors) {
                $check = $this->Session->check('int');
                if ($check) {
                    $this->Session->delete('int');
                }
                $check = $this->Session->check('int');
                if ($check) {
                    $this->Session->delete('int');
                }
//                $check = $this->Session->check('custID');
//                if ($check) {
//                    $this->Session->delete('custID');
//                }
                $cust = $this->Session->write('ints', $investors);
                $this->Session->write('int', $investor);
//                $this->Session->write('custID', $custID);
                $this->redirect(array('controller' => 'Investments', 'action' => 'deleteInvestor'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'deleteInvestor'));
            }
        }
    }

    function searchInvestor($investorID = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")))));

            if ($investor) {
                $check = $this->Session->check('ints');
                if ($check) {
                    $this->Session->delete('ints');
                }
                $cust = $this->Session->write('ints', $investor);

//                $this->Session->write('custID', $Investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorID)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorID)));
            if ($investors) {
                $check = $this->Session->check('int');
                if ($check) {
                    $this->Session->delete('int');
                }
                $check = $this->Session->check('int');
                if ($check) {
                    $this->Session->delete('int');
                }
//                $check = $this->Session->check('custID');
//                if ($check) {
//                    $this->Session->delete('custID');
//                }
                $cust = $this->Session->write('ints', $investors);
                $this->Session->write('int', $investor);
//                $this->Session->write('custID', $custID);
                $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
            }
        }
    }

    function newReinvestor() {
        // $this->__validateUserType();
        $data = $this->paginate('Reinvestor');
        $this->set('data', $data);

        $setupResults = $this->Reinvestor->getCompanies();

        $this->set(compact('setupResults'));
    }

    function addReinvestor() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
//            Configure::write('debug', 0);

            if (!empty($this->request->data)) {
                $this->Session->write('newReinvestor', $this->request->data['Reinvestor']);
                if ($org_search_record = $this->Reinvestor->find('first', array(
                    'conditions' => array('Reinvestor.company_name' => $this->request->data['Reinvestor']['company_name']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Company is already registered in the system. Please check the Name of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
                } elseif ($org_search_record = $this->Reinvestor->find('first', array(
                    'conditions' => array('Reinvestor.email' => $this->request->data['Reinvestor']['email']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Email is already registered in the system. Please check the Email of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
                } elseif ($org_search_record = $this->Reinvestor->find('first', array(
                    'conditions' => array('Reinvestor.mobile' => $this->request->data['Reinvestor']['mobile']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Mobile Number is already registered in the system. Please check the Mobile Number of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
                }
                $result = $this->Reinvestor->save($this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $this->Session->delete('newReinvestor');

                    $message = 'Reinvestor Company Successfully Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
                } else {
                    $message = 'Company details saving unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
                }
            } else {


                $message = 'No data available to save';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
            }
        } else {
            $message = 'Wrong command issued.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
        }
    }

    function delReinvestor($sub_id = Null) {
        $this->autoRender = false;

        $result = $this->Reinvestor->delete($sub_id, false);
        if ($result) {

            $message = 'Reinvestor Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newReinvestor'));
        } else {
            $message = 'Could Not Delete Reinvestor';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reivestments', 'action' => 'newReinvestor'));
        }
    }

    function newCashDeposit() {
        /* $this->__validateUserType(); */

        $check = $this->Session->check('ivt');
        if ($check) {
            $cust = $this->Session->read('ivt');
//            pr($cust);
            $this->set('int', $cust);
            $this->Session->delete('ivt');
        }
        $check = $this->Session->check('ivts');
        if ($check) {
            $cust = $this->Session->read('ivts');
            $this->set('investor', $cust);
            $this->Session->delete('ivts');
        }

        $data = $this->paginate('Reinvestor');
        $this->set('data', $data);
    }

    function searchreinvestor4cash($investorid = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Reinvestor->find('all', array('conditions' => array('OR' => array(array('Reinvestor.company_name LIKE' => "%$investname%"), array('Reinvestor.manager_name LIKE' => "%$investname%")))));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit'));
            }
        } else {

            $investors = $this->Reinvestor->find('all', array('conditions' => array('Reinvestor.id' => $investorid)));
            $investor = $this->Reinvestor->find('first', array('conditions' => array('Reinvestor.id' => $investorid)));
            if ($investors) {

                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $check = $this->Session->check('ivt');
                if ($check) {
                    $this->Session->delete('ivt');
                }
                $cust = $this->Session->write('ivts', $investors);
                $this->Session->write('ivt', $investor);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit'));
            }
        }
    }

    function newCashDeposit2($reinvestorid = null) {
        /* $this->__validateUserType(); */
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('reinvestors', $this->Reinvestor->find('list'));

        $data = $this->Reinvestor->find('first', array('conditions' => array('Reinvestor.id' => $reinvestorid)));
        if ($data) {
            $this->set('data', $data);
        } else {
            $message = 'Re-Investor details missing. Please check Re-investor details.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newCashDeposit'));
        }
    }

    function listCashDeposits() {
        /* $this->__validateUserType(); */

        $check = $this->Session->check('ivt');
        if ($check) {
            $cust = $this->Session->read('ivt');
//            pr($cust);
            $this->set('int', $cust);
            $this->Session->delete('ivt');
        }
        $check = $this->Session->check('ivts');
        if ($check) {
            $cust = $this->Session->read('ivts');
            $this->set('investor', $cust);
            $this->Session->delete('ivts');
        }

        $data = $this->paginate('ReinvestorDeposit');
        $this->set('data', $data);
    }

    function searchreinvestor4list($investorid = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Reinvestor->find('all', array('conditions' => array('OR' => array(array('Reinvestor.company_name LIKE' => "%$investname%"), array('Reinvestor.manager_name LIKE' => "%$investname%")))));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
            } else {
                $message = 'Sorry, Reinvestor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
            }
        } else {

            $investors = $this->Reinvestor->find('all', array('conditions' => array('Reinvestor.id' => $investorid)));
            $investor = $this->Reinvestor->find('first', array('conditions' => array('Reinvestor.id' => $investorid)));
            if ($investors) {

                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $check = $this->Session->check('ivt');
                if ($check) {
                    $this->Session->delete('ivt');
                }
                $cust = $this->Session->write('ivts', $investors);
                $this->Session->write('ivt', $investor);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
            } else {

                $message = 'Sorry, Reinvestor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
            }
        }
    }

    function delCashDeposit($sub_id = Null) {
        $this->autoRender = false;

        $result = $this->ReinvestorDeposit->delete($sub_id, false);
        if ($result) {
            $this->InvestmentCash->deleteAll();
            $message = 'Cash Deposit Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
        } else {
            $message = 'Could Not Delete Cash Deposit';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reivestments', 'action' => 'listCashDeposits'));
        }
    }

    function newDepositCert($product_type = null, $fixed_id = null, $equity_id = null) {
        /* $this->__validateUserType(); */
        $data_fixed = array();
        $data_equity = array();
        $company_name = '';
        $date = date('d F, Y');
        $payment_mode = '';
        $issued = '';
        $total_invested = 0.00;
        $total_equity_invested = 0.00;
        $total_fixed_invested = 0.00;
        $check = $this->Session->check('newCashDeposit');
        if ($check) {
            $this->Session->delete('newCashDeposit');
        }
        switch ($product_type) {
            case null:
                $message = 'Invalid product type selected';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reivestments', 'action' => 'newCashDeposit'));
                break;
            case 'fixed':
                $data_fixed = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.id' => $fixed_id)));
                if ($data_fixed) {
                    $company_name = $data_fixed['Reinvestor']['company_name'];
                    $date = date('d F, Y', strtotime($data_fixed['InvestmentCash']['investment_date']));
                    $payment_mode = $data_fixed['InvestmentCash']['payment_mode'];
                    $total_invested = $data_fixed['InvestmentCash']['amount'];
                }
                break;
            case 'equity':
                $data_equity = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.id' => $equity_id)));
                if ($data_equity) {
                    $company_name = $data_equity['Reinvestor']['company_name'];
                    $date = date('d F, Y', strtotime($data_equity['InvestmentCash']['investment_date']));
                    $payment_mode = $data_equity['InvestmentCash']['payment_mode'];
                    $total_invested = $data_equity['InvestmentCash']['amount'];
                }
                break;
            case 'both':

                $data_fixed = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.id' => $fixed_id)));
                $data_equity = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.id' => $equity_id)));
                if ($data_equity) {
                    $company_name = $data_equity['Reinvestor']['company_name'];
                    $date = date('d F, Y', strtotime($data_equity['InvestmentCash']['investment_date']));
                    $payment_mode = $data_equity['InvestmentCash']['payment_mode'];
                    $total_equity_invested = $data_equity['InvestmentCash']['amount'];
                }
                if ($data_fixed) {
                    $total_fixed_invested = $data_fixed['InvestmentCash']['amount'];
                }
                $total_invested = $total_fixed_invested + $total_equity_invested;
                break;
            default:
                $message = 'Invalid product type selected';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reivestments', 'action' => 'newCashDeposit'));

                break;
        }
        $check = $this->Session->check('userData');
        if ($check) {
            $issued = $this->Session->read('userData');
        }
        $this->set(compact('issued', 'product_type', 'data_fixed', 'data_equity', 'company_name', 'payment_mode', 'date', 'total_invested'));
    }

    function editCashDeposit($deposit_id = null) {
        /* $this->__validateUserType(); */
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('reinvestors', $this->Reinvestor->find('list'));

        //Edit Cash Deposit
        if (($this->request->is('post'))) {
            $this->Session->write('newCashDeposit', $this->request->data['ReinvestorDeposit']);
            $reinvestorid = $this->request->data['ReinvestorDeposit']['reinvestor_id'];
            $investment_type = $this->request->data['ReinvestorDeposit']['investmentproduct_id'];
            $deposit_id = $this->request->data['ReinvestorDeposit']['id'];
            $investment_prod = '';
            $payment_name = '';
            $userid = null;
            $fixed_inv_amount = $this->request->data['ReinvestorDeposit']['fixed_inv_amount'];
            $equity_inv_amount = $this->request->data['ReinvestorDeposit']['equity_inv_amount'];
            $paymentmodeid = $this->request->data['ReinvestorDeposit']['paymentmode_id'];
            $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));

            if ($payment_mode) {
                $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
            }
            $check = $this->Session->check('userDetails');
            if ($check) {
                $userid = $this->Session->read('userDetails.id');
            }
            $date = $this->request->data['ReinvestorDeposit']['investment_date']['year'] . "-" . $this->request->data['ReinvestorDeposit']['investment_date']['month'] . "-" . $this->request->data['ReinvestorDeposit']['investment_date']['day'];
            $reinvestorDeposit_data = array('id' => $deposit_id, 'reinvestor_id' => $reinvestorid,
                'currency_id' => $this->request->data['ReinvestorDeposit']['currency_id'],
                'payment_mode_id' => $paymentmodeid, 'investment_date' => $date, 'fixed_inv_amount' => $fixed_inv_amount,
                'equity_inv_amount' => $equity_inv_amount, 'notes' => $this->request->data['ReinvestorDeposit']['notes']
                , 'user_id' => $userid);
            $result_deposit = $this->ReinvestorDeposit->save($reinvestorDeposit_data);
            if ($result_deposit) {

                switch ($investment_type) {
                    case 1:
                        if ($fixed_inv_amount == '' || is_null($fixed_inv_amount)) {
                            $message = 'Please supply fixed investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        if ($equity_inv_amount != '' && !is_null($equity_inv_amount)) {
                            $message = 'Please supply ONLY fixed investment amount for this type of Investment product';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        $fixed_data = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id, 'InvestmentCash.investment_type' => 'fixed')));
                        if ($fixed_data) {
                            $investmentcash_id = $fixed_data['InvestmentCash']['id'];

                            $cash_depositarray = array('id' => $investmentcash_id, 'reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid,
                                'user_id' => $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                                $this->request->data['ReinvestorDeposit']['currency_id'],
                                'amount' => $this->request->data['ReinvestorDeposit']['fixed_inv_amount'],
                                'investment_date' => $date, 'payment_mode' => $payment_name);
                            $result = $this->InvestmentCash->save($cash_depositarray);
                            if ($result) {
                                $message = 'Cash Deposit successfully added';
                                $this->Session->write('smsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
                            } else {

                                $message = 'Error adding Cash Deposit details. Please try again.';
                                $this->Session->write('emsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                            }
                        } else {

                            $message = 'Error adding Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }

                        break;
                    case 2:
                        if ($equity_inv_amount == '' || is_null($equity_inv_amount)) {
                            $message = 'Please supply equity investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        if ($fixed_inv_amount != '' && !is_null($fixed_inv_amount)) {
                            $message = 'Please supply ONLY equity investment amount for this type of Investment product';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        $fixed_data = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id, 'InvestmentCash.investment_type' => 'equity')));
                        if ($fixed_data) {
                            $investmentcash_id = $fixed_data['InvestmentCash']['id'];

                            $cash_depositarray = array('id' => $investmentcash_id, 'reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                                $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                                $this->request->data['ReinvestorDeposit']['currency_id'],
                                'amount' => $this->request->data['ReinvestorDeposit']['equity_inv_amount'],
                                'investment_date' => $date, 'payment_mode' => $payment_name);

                            $result = $this->InvestmentCash->save($cash_depositarray);
                            if ($result) {
                                $message = 'Cash Deposit successfully added';
                                $this->Session->write('smsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
                            } else {

                                $message = 'Error adding Cash Deposit details. Please try again.';
                                $this->Session->write('emsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                            }
                        } else {

                            $message = 'Error adding Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        break;
                    case 3:
                        if ($equity_inv_amount == '' || is_null($equity_inv_amount)) {
                            $message = 'Please supply equity investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        if ($fixed_inv_amount == '' && is_null($fixed_inv_amount)) {
                            $message = 'Please supply fixed investment amount';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        $equity_data = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id, 'InvestmentCash.investment_type' => 'equity')));
                        if ($equity_data) {
                            $investmentcash_id = $equity_data['InvestmentCash']['id'];

                            $cash_depositarray_equity = array('id' => $investmentcash_id, 'reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                                $this->request->data['ReinvestorDeposit']['user_id'],
                                'currency_id' => $this->request->data['ReinvestorDeposit']['currency_id'],
                                'amount' => $this->request->data['ReinvestorDeposit']['equity_inv_amount'],
                                'investment_date' => $date, 'payment_mode' => $payment_name);

                            $result_equity = $this->InvestmentCash->save($cash_depositarray_equity);
                        }

                        $fixed_data = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id, 'InvestmentCash.investment_type' => 'fixed')));
                        if ($fixed_data) {
                            $investmentcash_id = $fixed_data['InvestmentCash']['id'];

                            $cash_depositarray_fixed = array('id' => $investmentcash_id, 'reinvestor_deposit_id' => $deposit_id, 'reinvestor_id' => $reinvestorid, 'user_id' =>
                                $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                                $this->request->data['ReinvestorDeposit']['currency_id'],
                                'amount' => $this->request->data['ReinvestorDeposit']['fixed_inv_amount'],
                                'investment_date' => $date, 'payment_mode' => $payment_name);

                            $result_fixed = $this->InvestmentCash->save($cash_depositarray_fixed);
                        }
                        if (isset($result_equity) && isset($result_fixed)) {
                            if ($result_equity && $result_fixed) {
                                $message = 'Cash Deposit successfully added';
                                $this->Session->write('smsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
                            } else {

                                $message = 'Error editing Cash Deposit details. Please try again.';
                                $this->Session->write('emsg', $message);
                                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                            }
                        } else {

                            $message = 'Error editing Cash Deposit details. Please try again.';
                            $this->Session->write('emsg', $message);
                            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                        }
                        break;
                }
            } else {
                $message = 'Error adding Cash Deposit details. Please try again.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
            }
        }
        $data = $this->ReinvestorDeposit->find('first', array('conditions' => array('ReinvestorDeposit.id' =>
                $deposit_id)));

        if ($data) {
            $this->set('data', $data);
        } else {
            $message = 'Invalid Selection. Please try again';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
        }
    }

    function newInvestmentDestination() {
        // $this->__validateUserType();
        $data = $this->paginate('InvestmentDestination');
        $this->set('data', $data);

        $setupResults = $this->InvestmentDestination->getCompanies();

        $this->set(compact('setupResults'));
    }

    function getInvProd() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $dest_id = $_POST['destination_id'];
            if (!empty($dest_id)) {
                $data = $this->InvDestProduct->find('all', ['conditions' =>
                    ['InvDestProduct.investment_destination_id' => $dest_id]]);
                if ($data) {
                    return json_encode(array('status' => 'ok', 'data' => $data));
                } else {
                    return json_encode(array('status' => 'fail', 'data' => 'No Data Found'));
                }
            } else {
                return json_encode(array('status' => 'fail', 'data' => 'Invalid Selection'));
            }
        } else {
            return json_encode(array('status' => 'fail', 'data' => 'Invalid Access Method'));
        }
    }

    function addInvestmentDestination() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
//            Configure::write('debug', 0);

            if (!empty($this->request->data)) {
                $this->Session->write('newInvestmentDestination', $this->request->data['InvestmentDestination']);
                if ($org_search_record = $this->InvestmentDestination->find('first', array(
                    'conditions' => array('InvestmentDestination.company_name' => $this->request->data['InvestmentDestination']['company_name']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Company is already registered in the system. Please check the Name of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'InvestmentDestination', 'action' => 'newInvestmentDestination'));
                } elseif ($org_search_record = $this->InvestmentDestination->find('first', array(
                    'conditions' => array('InvestmentDestination.email' => $this->request->data['InvestmentDestination']['email']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Email is already registered in the system. Please check the Email of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
                } elseif ($org_search_record = $this->InvestmentDestination->find('first', array(
                    'conditions' => array('InvestmentDestination.telephone' => $this->request->data['InvestmentDestination']['telephone']),
                    'recursive' => -1
                        ))) {
                    $message = 'This Telephone Number is already registered in the system. Please check the Telephone Number of the Company.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
                }
                $result = $this->InvestmentDestination->save($this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $this->Session->delete('newInvestmentDestination');

                    $message = 'Investment destination successfully added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
                } else {
                    $message = 'Investment destination saving unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
                }
            } else {


                $message = 'No data available to save';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
            }
        } else {
            $message = 'Wrong command issued.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
        }
    }

    function delInvestmentDestination($sub_id = Null) {
        $this->autoRender = false;

        $result = $this->InvestmentDestination->delete($sub_id, false);
        if ($result) {

            $message = 'Investment Destination Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestmentDestination'));
        } else {
            $message = 'Could Not Delete Investment Destination';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reivestments', 'action' => 'newInvestmentDestination'));
        }
    }

    function invDestProduct($company_id = null, $product_id = null) {
        // $this->__validateUserType();
        if ($company_id != null || $company_id != "") {
            $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
            $this->set('invdestproducts', $this->InvDestProduct->find('list'));
        } else {
            $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
            $this->set('invdestproducts', $this->InvDestProduct->find('list'));
        }


//        $setupResults = $this->InvDestProduct->getCompanies();
//        $this->set(compact('setupResults'));
        $data = $this->paginate('InvDestProduct');
        $this->set('data', $data);
    }

    function addInvDestProduct() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
//            Configure::write('debug', 0);

            if (!empty($this->request->data)) {
                $this->Session->write('InvDestProduct', $this->request->data['InvDestProduct']);
                $this->request->data['InvDestProduct']['investment_destination_id'] = $this->request->data['InvDestProduct']['investmentdestination_id'];
                $result = $this->InvDestProduct->save($this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $this->Session->delete('InvDestProduct');

                    $message = 'Investment destination product successfully added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'InvDestProduct'));
                } else {
                    $message = 'Investment destination product saving unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'InvDestProduct'));
                }
            } else {


                $message = 'No data available to save';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'InvDestProduct'));
            }
        } else {
            $message = 'Wrong command issued.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'InvDestProduct'));
        }
    }

    function delInvDestProduct($sub_id = Null) {
        $this->autoRender = false;

        $result = $this->InvDestProduct->delete($sub_id, false);
        if ($result) {

            $message = 'Investment Destination Product Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'InvDestProduct'));
        } else {
            $message = 'Could Not Delete Investment Destination Product';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reivestments', 'action' => 'InvDestProduct'));
        }
    }

    function newInvestment() {
        /* $this->__validateUserType(); */
        $this->set('reinvestors', $this->Reinvestor->find('list'));
        $check = $this->Session->check('reinvesttemp');
        if ($check) {
            $this->Session->delete('reinvesttemp');
        }
        $check = $this->Session->check('variabless_refixed');
        if ($check) {
            $this->Session->delete('variabless_refixed');
        }

        if ($this->request->is('post')) {
            $reinvestor_id = 1;
            $investment_type = $this->request->data['Reinvestment']['investment_type'];

            if ($reinvestor_id == '' || $reinvestor_id == NULL) {
                $message = 'Please Select Investment Company';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment'));
            } elseif ($investment_type == '' || $investment_type == NULL) {
                $message = 'Please Select Investment Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment'));
            } else {
                if ($investment_type == 1) {
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed/' . $reinvestor_id));
                } elseif ($investment_type == 2) {
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment0Equity/' . $reinvestor_id));
                }
            }
        }
    }

    function getfunds() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $investee_id = $_POST['investee_id'];
            $result = $this->Investee->find('first', array('conditions' => array('Investee.id' => $investee_id)));
            if ($result) {
                return json_encode(array('status' => 'ok', 'data' => $result['Investee']));
            } else {
                return json_encode(array('status' => 'failed'));
            }
        }
    }

    function getAvailableAmount() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $amount = $_POST['amount'];
            $reinvestor_id = $_POST['reinvestor_id'];
            $result = $this->ReinvestorCashaccount->find('first', array('conditions' =>
                array('ReinvestorCashaccount.reinvestor_id' => $reinvestor_id)));
            if ($result) {
                if ($result['ReinvestorCashaccount']['fixed_inv_balance'] < $amount) {
                    return json_encode(array('status' => 'ok', 'data' => 'prompt'));
                } else {
                    return json_encode(array('status' => 'ok', 'data' => 'proceed'));
                }
            } else {
                return json_encode(array('status' => 'failed'));
            }
        }
    }

    function newInvestment0Fixed($reinvestor_id = NULL) {
        /* $this->__validateUserType(); */

        $this->set('reinvestors', $this->Reinvestor->find('first', ['conditions' => ['Reinvestor.id' => $reinvestor_id]]));

        $this->paginate = array(
            'conditions' => array('InvestmentCash.investment_type' => 'fixed', 'InvestmentCash.reinvestor_id' => $reinvestor_id, 'InvestmentCash.status' => 'processed'),
            'limit' => 30, 'order' => array('InvestmentCash.id' => 'asc'));
        $data = $this->paginate('InvestmentCash');
        $this->set('data', $data);
    }

    function newInvestment0Equity($reinvestor_id = NULL) {
        /* $this->__validateUserType(); */

        $this->set('reinvestors', $this->Reinvestor->find('first', ['conditions' => ['Reinvestor.id' => $reinvestor_id]]));
        if ($this->Session->check('reinvesttemp') == true) {
            $this->Session->delete('reinvesttemp');
        }
        $check = $this->Session->check('variabless_reequity');
        if ($check) {
            $this->Session->delete('variabless_reequity');
        }
        $check = $this->Session->check('investment_array_reequity');
        if ($check) {
            $this->Session->delete('investment_array_reequity');
        }
        $check = $this->Session->check('ledger_transactions');
        if ($check) {
            $this->Session->delete('ledger_transactions');
        }
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }

        $this->paginate = array(
            'conditions' => array('InvestmentCash.investment_type' => 'equity',
                'InvestmentCash.reinvestor_id' => $reinvestor_id, 'InvestmentCash.status' => array('processed', 'part_investment')),
            'limit' => 30, 'order' => array('InvestmentCash.id' => 'asc'));
        $data = $this->paginate('InvestmentCash');
        $this->set('data', $data);
    }

    function newInvestment1Fixed($reinvestor_id = NULL) {
        /* $this->__validateUserType(); */
        $this->set('reinvestorcashaccounts', $this->ReinvestorCashaccount->find('first', ['conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
        $check = $this->Session->check('variabless_refixed');
        if ($check) {
            $check = $this->Session->check('variabless_refixed.duedate');
            if ($check) {
                $this->set('duedate', $this->Session->read('variabless_refixed.duedate'));
            }
            $check = $this->Session->check('variabless_refixed.interest');
            if ($check) {
                $this->set('interest', $this->Session->read('variabless_refixed.interest'));
            }
            $check = $this->Session->check('variabless_refixed.totaldue');
            if ($check) {
                $this->set('totaldue', $this->Session->read('variabless_refixed.totaldue'));
            }
        }
    }

    function process_fixd() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $amount = $this->request->data['Reinvestment']['investment_amount'];
            $currency_id = $this->request->data['Reinvestment']['currency_id'];
            $custom_rate = $this->request->data['Reinvestment']['interest_rate'];
            $investcash_id = $this->request->data['Reinvestment']['reinvestorcashaccount_id'];
            $reinvestor_id = $this->request->data['Reinvestment']['reinvestor_id'];
            $investmentproduct_id = $this->request->data['Reinvestment']['inv_dest_product_id'];
            $inv_day = $this->request->data['Reinvestment']['investment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['Reinvestment']['investment_date']['month'];
                $inv_year = $this->request->data['Reinvestment']['investment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $this->request->data['Reinvestment']['investment_date'] = $inv_date;

            if (isset($currency_id) && !empty($currency_id)) {
                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => $currency_id)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }
            }
            if ($this->Session->check('reinvesttemp') == true) {
                $this->Session->delete('reinvesttemp');
            }
            $this->Session->write('reinvesttemp', $this->request->data['Reinvestment']);
            if ($this->request->data['Reinvestment']['investmentdestination_id'] == "" || $this->request->data['Reinvestment']['investmentdestination_id'] == null) {
                $message = 'Please Select an Investment Destication Company/Fund';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            }

            if ($this->request->data['Reinvestment']['inv_dest_product_id'] == "" || $this->request->data['Reinvestment']['inv_dest_product_id'] == null) {
                $message = 'Please Select an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            }

            if ($this->request->data['Reinvestment']['investment_amount'] == "" || $this->request->data['Reinvestment']['investment_amount'] == null) {
                $message = 'Please Supply an Investment Amount';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            } else {
                $invamount = $this->request->data['Reinvestment']['investment_amount'];
                $result = $this->ReinvestorCashaccount->find('first', array('conditions' =>
                    array('ReinvestorCashaccount.reinvestor_id' => $reinvestor_id)));
                if ($result) {
                    if ($result['ReinvestorCashaccount']['fixed_inv_balance'] < $invamount) {
                        $message = 'Investment amount cannot be more than available amount';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
                    }
                }
            }

            if ($this->request->data['Reinvestment']['duration'] == "" || $this->request->data['Reinvestment']['duration'] == null) {
                $message = 'Please Supply  an Investment Duration';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            }

            if ($this->request->data['Reinvestment']['investment_period'] == "" || $this->request->data['Reinvestment']['investment_period'] == null) {
                $message = 'Please Select an Investment Period';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            }
            if (($this->request->data['Reinvestment']['interest_rate'] == "") || is_null($this->request->data['Reinvestment']['interest_rate'])) {
                $message = 'Please State Interest Rate';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
            }

            $investment_amount = $this->request->data['Reinvestment']['investment_amount'];
            $first_date = $inv_date;
          $inv_deposit = array('user_id' => $this->request->data['Reinvestment']['user_id'],
                    'amount' => $investment_amount, 'deposit_date' => $first_date);


                $this->Session->write('reinv_deposit', $inv_deposit);
            $date = new DateTime($first_date);
            $period = $this->request->data['Reinvestment']['investment_period'];
            $duration = $this->request->data['Reinvestment']['duration'];
            $year = $duration;
            $adate = date('Y-m-d');
            $to_date = new DateTime($adate);
            $ainv_date = new DateTime($inv_date);
            $aduration = date_diff($ainv_date, $to_date);
            $aduration = $aduration->format("%a");
            switch ($period) {
                case 'Day(s)':

                    $date->add(new DateInterval('P' . $duration . 'D'));
                    $date_statemt = new DateTime($first_date);
                    $principal = $investment_amount;
                    $statemt_array = array();
                    $rate = $custom_rate;

                    $interest_amount1 = ($rate / 100) * $investment_amount;
                    $interest_amount = $interest_amount1 * ($duration / 365);
                    $amount_due = $interest_amount + $investment_amount;
                    $ainterest_amount = $interest_amount1 * ($aduration / 365);
                    $aamount_due = $ainterest_amount + $investment_amount;
                    for ($n = 1; $n <= $duration; $n++) {
                        $date_statemt->add(new DateInterval('P1D'));
                        $interest_amount2 = $interest_amount1 * (1 / 365);
                        $total = $interest_amount2 + $principal;
                        $statemt_array[] = array('user_id' => $this->request->data['Reinvestment']['user_id'],
                            'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
                            'principal' => $principal,
                            'interest' => $interest_amount2,
                            'maturity_date' => $date_statemt->format('Y-m-d'),
                            'total' => $total);
//                        $principal = $total;
                    }

                    break;
//
//                case 'Month(s)':
//
//                    $date->add(new DateInterval('P' . $duration . 'M'));
//                    $date_statemt = new DateTime($first_date);
//                    $principal = $investment_amount;
//                    $statemt_array = array();
//                    $rate = $custom_rate;
//
//                    $interest_amount1 = ($rate / 100) * $investment_amount;
//                    $interest_amount = $interest_amount1;
//                    $amount_due = $interest_amount + $investment_amount;
//                    for ($n = 1; $n <= $duration; $n++) {
//                        $date_statemt->add(new DateInterval('P1M'));
//
//                        $interest_amount2 = $interest_amount1 *(30/365);
//                                $total = $interest_amount2 + $principal;
//                        $statemt_array[] = array('user_id' => $this->request->data['Reinvestment']['user_id'],
//                            'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
//                            'principal' => $principal,
//                            'interest' => $interest_amount2,
//                            'maturity_date' => $date_statemt->format('Y-m-d'),
//                            'total' => $total);
////                        $principal = $total;
//                    }
//
//                    break;

                case 'Year(s)':
                    $date->add(new DateInterval('P' . $duration . 'Y'));
                    $date_statemt = new DateTime($first_date);
                    $principal = $investment_amount;
                    $statemt_array = array();
                    $rate = $custom_rate;

                    $YEAR2DAYS = 365 * $duration;
                    
                    $interest_amount1 = ($rate / 100) * $investment_amount;
                    $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                    $amount_due = $interest_amount + $investment_amount;
                     $aYEAR2DAYS = 365 * $aduration;
                    $ainterest_amount = $interest_amount1 * ($aYEAR2DAYS / 365);
                    $aamount_due = $ainterest_amount + $investment_amount;
                    for ($n = 1; $n <= $duration; $n++) {
                        $date_statemt->add(new DateInterval('P1Y'));

                        $interest_amount2 = $interest_amount1 * (365 / 365);
                        $total = $interest_amount2 + $principal;
                        $statemt_array[] = array('user_id' => $this->request->data['Reinvestment']['user_id'],
                            'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
                            'principal' => $principal,
                            'interest' => $interest_amount2,
                            'maturity_date' => $date_statemt->format('Y-m-d'),
                            'total' => $total);
//                        $principal = $total;
                    }


                    break;
            }



            $reinvestment_array = array('user_id' => $this->request->data['Reinvestment']['user_id'],
                'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
                'investment_amount' => $this->request->data['Reinvestment']['investment_amount'],
                'inv_dest_product_id' => $this->request->data['Reinvestment']['inv_dest_product_id'],
                'interest_rate' => $rate,
                'investment_destination_id' => $this->request->data['Reinvestment']['investmentdestination_id'],
                'currency_id' => $this->request->data['Reinvestment']['currency_id'],
                'duration' => $this->request->data['Reinvestment']['duration'],
                'investment_period' => $this->request->data['Reinvestment']['investment_period'],
                'expected_interest' => $interest_amount,
                'investment_date' => $inv_date,
                'investment_type' => 'fixed',
                        'total_amount_earned' => $aamount_due,
                        'earned_balance' => $aamount_due,
                        'accrued_days' => $aduration,
                        'accrued_interest' => $ainterest_amount,
                'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'),
                'balance' => $amount_due,
                'created_by' => $this->request->data['Reinvestment']['user_id'],
                'modified_by' => $this->request->data['Reinvestment']['user_id']
            );
             $interest_accruals = array(
                        'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
                        'interest_amounts' => $ainterest_amount,
                        'interest_date' => $inv_date
                    );
                    
                    $check = $this->Session->check('reinterest_accrual');
                    if ($check) {
                        $this->Session->delete('reinterest_accrual');
                    }
                    $check = $this->Session->write('reinterest_accrual',$interest_accruals);
            $check = $this->Session->check('statemt_array_refixed');
            if ($check) {
                $this->Session->delete('statemt_array_refixed');
            }
            $this->Session->write('statemt_array_refixed', $statemt_array);
            $check = $this->Session->check('investment_array_refixed');
            if ($check) {
                $this->Session->delete('investment_array_refixed');
            }

            $this->Session->write('investment_array_refixed', $reinvestment_array);

            $check = $this->Session->check('variabless_refixed');
            if ($check) {
                $this->Session->delete('variabless_refixed');
            }

            $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
            $this->Session->write('variabless_refixed', $variables);

            if ($this->Session->check('reinvesttemp') == true) {
                $this->Session->delete('reinvesttemp');
            }
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
        }
    }

    function newInvestment1Fixed1($reinvestor_id = null) {
        /* $this->__validateUserType(); */
        $check = $this->Session->check('investment_array_refixed');
        if (!$check) {
            $message = 'Process before submitting';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
        }
        $read = $this->Session->read('investment_array_refixed');
        $result = $this->Reinvestment->save($read);
        $reinvestment_id = $this->Reinvestment->id;
        if ($result) {
            $invested_amount = $result['Reinvestment']['investment_amount'];
            $this->set('reinvestments', $this->Reinvestment->find('first', ['conditions' =>
                        ['Reinvestment.id' => $reinvestment_id]]));
            $check = $this->Session->check('reinterest_accrual');
                    if ($check) {
                         $interest_accruals = $this->Session->read('reinterest_accrual');
                         $interest_accruals['reinvestment_id'] = $reinvestment_id;
                        $this->ReinvestInterestAccrual->save($interest_accruals);
                        $this->Session->delete('reinterest_accrual');
                    }
            $check = $this->Session->check('reinvesttemp');
            if ($check) {
                $this->Session->delete('reinvesttemp');
            }
            $statemt_array = $this->Session->check('statemt_array_fixed');
            if ($statemt_array) {
                $statemt_array = $this->Session->read('statemt_array_fixed');


                foreach ($statemt_array as $key => $val) {
                    $val['reinvestment_id'] = $reinvestment_id;

                    $this->ReinvestmentStatement->create();
                    $this->ReinvestmentStatement->save($val);
                }
                $this->Session->delete('statemt_array_fixed');
            }
            //subtract from reinvestoraacount fixed balance and probably deposit
            $reinvestment_data = $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]);
            if ($reinvestment_data) {
                $id = $reinvestment_data['ReinvestorCashaccount']['id'];
                $old_balance = $reinvestment_data['ReinvestorCashaccount']['fixed_inv_balance'];
                $new_balance = $old_balance - $invested_amount;
                $new_grand = $reinvestment_data['ReinvestorCashaccount']['total_balance'] - $invested_amount;
                $fixed_data = array('id' => $id, 'fixed_inv_balance' => $new_balance, 'total_balance' => $new_grand);
                $this->ReinvestorCashaccount->save($fixed_data);
            }


            $this->Session->delete('investment_array_refixed');
        } else {
            $message = 'Error saving new re-investment details. Please try again';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Fixed', $reinvestor_id));
        }
    }

    function newInvestment1Equity($reinvestor_id = null, $investmentcash_id = null) {
        /* $this->__validateUserType(); */
        $check = $this->Session->check('variabless_reequity');
        if ($check) {
            $check = $this->Session->check('variabless_reequity.totalamt');
            if ($check) {
                $this->set('totalamt', $this->Session->read('variabless_reequity.totalamt'));
            }
            $check = $this->Session->check('variabless_reequity.share_price');
            if ($check) {
                $this->set('share_price', $this->Session->read('variabless_reequity.share_price'));
            }
            $check = $this->Session->check('variabless_reequity.total_fees');
            if ($check) {
                $this->set('total_fees', $this->Session->read('variabless_reequity.total_fees'));
            }
            $check = $this->Session->check('variabless_reequity.equity');
            if ($check) {
                $this->set('equity', $this->Session->read('variabless_reequity.equity'));
            }
        }
        $this->set('reinvestorcashaccount', $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' =>
                    ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
        $this->set('equitieslists', $this->EquitiesList->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('reinvestors', $this->Reinvestor->find('list'));


        $data = $this->InvestmentCash->find('first', ['conditions' => ['InvestmentCash.id' => $investmentcash_id]]);
        if ($data) {
            $this->set('equitydetails', $data);
            $investment_id = $data['InvestmentCash']['investment_id'];
            $equity = $this->InvestorEquity->find('all', ['conditions' => ['InvestorEquity.investment_id'
                    => $investment_id]]);
            if ($equity) {
                $x = 1;
                $equity_array = array();
                foreach ($equity as $val) {
                    $equity_array[$x] = $val;
                    $x++;
                }
                $this->set('equity_array', $equity_array);
            }
        }
    }

    function process_equity() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
//            $amount = $this->request->data['Reinvestment']['investment_amount'];
            $currency_id = $this->request->data['Reinvestment']['currency_id'];
            $reinvestcash_id = $this->request->data['Reinvestment']['reinvestorcashaccount_id'];
            $investcash_id = $this->request->data['Reinvestment']['investment_cash_id'];
            $reinvestor_id = $this->request->data['Reinvestment']['reinvestor_id'];
            $investor_id = $this->request->data['Reinvestment']['investor_id'];
            $inv_day = $this->request->data['Reinvestment']['reinvestment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['Reinvestment']['reinvestment_date']['month'];
                $inv_year = $this->request->data['Reinvestment']['reinvestment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $this->request->data['Reinvestment']['reinvestment_date'] = $inv_date;
            if ($this->Session->check('reinvesttemp') == true) {
                $this->Session->delete('reinvesttemp');
            }
            if (isset($currency_id) && !empty($currency_id)) {
                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => $currency_id)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }
            }

            $this->Session->write('reeinvesttemp', $this->request->data['Reinvestment']);

            $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

            if ($ledger_data) {

                $ledger_id = $ledger_data['ClientLedger']['id'];
                $ledger_available = $ledger_data['ClientLedger']['available_cash'];

                $cashinvested = $ledger_data['ClientLedger']['invested_amount'];
                $new_cashinvested = $cashinvested;
            }




            if ($this->request->data['Reinvestment']['equities_list_id'] == "" || $this->request->data['Reinvestment']['equities_list_id'] == null) {
                $message = 'Please Select Equity Purchased';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }

            if ($this->request->data['Reinvestment']['purchase_price'] == "" || $this->request->data['Reinvestment']['purchase_price'] == null) {
                $message = 'Please State Equity Purchase Price';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }

            if ($this->request->data['Reinvestment']['numb_shares'] == "" || $this->request->data['Reinvestment']['numb_shares'] == null) {
                $message = 'Please State number of Shares';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }
//                if (($this->request->data['Investment']['total_fees'] == "") || is_null($this->request->data['Investment']['total_fees'])) {
//                    $message = 'Please State Total Fees';
//                    $this->Session->write('bmsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Equity',$reinvestor_id,$investcash_id));
//                }
//            $numb0fshares = $this->request->data['Reinvestment']['numb_shares'];
//            $equity_price = $this->request->data['Reinvestment']['share_price'];
            /*             * **Restore old estimated total amount during deposit* */
            $base_fees = $this->request->data['Reinvestment']['base_fees'];
            $oldtotal_amount = $this->request->data['Reinvestment']['oldtotal_amount'];
            $ledger_available = $ledger_available + $oldtotal_amount;
            $cashinvested = $cashinvested - $oldtotal_amount;
            $new_cashinvested = $cashinvested;

            /*             * ******************************************************* */
            $total_fees = $this->request->data['Reinvestment']['total_fees'];
            $available_amount = $this->request->data['Reinvestment']['available_amount'];
            $equity_name = '';
            $totalamt = 0;
            $total_shares = 0;
            $equities_list_id = $this->request->data['Reinvestment']['equities_list_id'];
            $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id)));
            if ($equity) {
                $equity_name = $equity['EquitiesList']['equity_abbrev'];
            }
//                    $check = $this->Session->check('variabless_equity');
//                    if ($check) {
//                        $this->Session->delete('variabless_equity');
//                    }



            $equities = $this->get_equity();
            $equity_data = array($equities_list_id => array(
                    'equities_list_id' => $equities_list_id,
                    'purchase_date' => $inv_date,
                    'purchase_price' => $this->request->data['Reinvestment']['purchase_price'],
                    'min_share_price' => $this->request->data['Reinvestment']['min_share_price'],
                    'max_share_price' => $this->request->data['Reinvestment']['max_share_price'],
                    'numb_shares' => $this->request->data['Reinvestment']['numb_shares'],
                    'numb_shares_left' => $this->request->data['Reinvestment']['numb_shares'],
                    'created_by' => $this->request->data['Reinvestment']['user_id'],
                    'modified_by' => $this->request->data['Reinvestment']['user_id']
            ));
            $equities+=$equity_data;
            $this->set_equity($equities);
            $numb0fshares = $this->request->data['Reinvestment']['numb_shares'];
            $equity_price = $this->request->data['Reinvestment']['purchase_price'];

            $totalamt += ($numb0fshares * $equity_price) + $total_fees;
            $this->request->data['Reinvestment']['total_amount'] = $totalamt;
            $total_shares += $numb0fshares;
            if ($totalamt > $available_amount) {
                //RESET CASH INPUTS AND RETURN
//                        $this->Session->write('investtemp1.amount_deposited', $this->request->data['Investment']['amount_deposited']);
//                        $this->Session->write('investtemp1.cash_athand', $this->request->data['Investment']['cash_athand']);
//                        $this->Session->write('investtemp1.total_invested', $this->request->data['Investment']['total_invested']);

                $variables = array('totalamt' => $totalamt);

                $this->Session->write('variabless_reequity', $variables);
                $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }
            $x = 2;
            while ($x <= 5) {
                $equities = $this->get_equity();

                //equity already exists, add to equity_details
                if (isset($this->request->data['Reinvestment']['equities_list_id' . $x]) &&
                        !empty($this->request->data['Reinvestment']['equities_list_id' . $x])) {
                    $newequities_list_id = $this->request->data['Reinvestment']['equities_list_id' . $x];
                    $equity_data = array($newequities_list_id => array(
                            'equities_list_id' => $newequities_list_id,
                            'purchase_date' => $inv_date,
                            'purchase_price' => $this->request->data['Reinvestment']['purchase_price' . $x],
                            'min_share_price' => $this->request->data['Reinvestment']['min_share_price' . $x],
                            'max_share_price' => $this->request->data['Reinvestment']['max_share_price' . $x],
                            'numb_shares' => $this->request->data['Reinvestment']['numb_shares' . $x],
                            'numb_shares_left' => $this->request->data['Reinvestment']['numb_shares' . $x],
                            'created_by' => $this->request->data['Reinvestment']['user_id'],
                            'modified_by' => $this->request->data['Reinvestment']['user_id']
                    ));

                    $equities+=$equity_data;
                    $this->set_equity($equities);
                    $numb0fshares = $this->request->data['Reinvestment']['numb_shares' . $x];
                    $equity_price = $this->request->data['Reinvestment']['purchase_price' . $x];
                    $total_shares += $numb0fshares;
                    $totalamt += ($numb0fshares * $equity_price);
                    $this->request->data['Reinvestment']['total_amount'] = $totalamt;
                }
                $x++;
            }
            $new_cashathand = $ledger_available - $totalamt;
            $new_cashinvested = $cashinvested + $totalamt;
            if ($totalamt > $available_amount) {
                //RESET CASH INPUTS AND RETURN
//                        $this->Session->write('investtemp1.amount_deposited', $this->request->data['Investment']['amount_deposited']);
//                        $this->Session->write('investtemp1.cash_athand', $this->request->data['Investment']['cash_athand']);
//                        $this->Session->write('investtemp1.total_invested', $this->request->data['Investment']['total_invested']);
                $variables = array('totalamt' => $totalamt);

                $this->Session->write('variabless_reequity', $variables);
                $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }

//                'cheque_no' => $cheque_no,     
//            $totalamt = ($numb0fshares * $equity_price) + $total_fees;
//            $inv_amount = $numb0fshares * $equity_price;
            $result = $this->ReinvestorCashaccount->find('first', array('conditions' =>
                array('ReinvestorCashaccount.reinvestor_id' => $reinvestor_id)));
            if ($result) {
                if ($result['ReinvestorCashaccount']['equity_inv_balance'] < $totalamt) {
                    $message = 'Investment amount cannot be more than available Parkstone balance';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
                }
            }
            if ($available_amount < $totalamt) {
                $message = 'Investment amount cannot be more than investors deposit';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }

            $equity_name = '';
            $equities_list_id = $this->request->data['Reinvestment']['equities_list_id'];
            $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id)));
            if ($equity) {
                $equity_name = $equity['EquitiesList']['equity_abbrev'];
            }
            $check = $this->Session->check('variabless_reequity');
            if ($check) {
                $this->Session->delete('variabless_reequity');
            }

            $variables = array('totalamt' => $totalamt, 'share_price' => $this->request->data['Reinvestment']['share_price'], 'total_fees' => $this->request->data['Reinvestment']['total_fees'], 'equity' => $equity_name);

            $this->Session->write('variabless_reequity', $variables);

            $investment_array = array('user_id' => $this->request->data['Reinvestment']['user_id'],
                'reinvestor_id' => $this->request->data['Reinvestment']['reinvestor_id'],
                'investor_id' => $this->request->data['Reinvestment']['investor_id'],
                'investment_type' => 'equity',
                'investment_no' => $this->request->data['Reinvestment']['investment_no'],
                'investment_cash_id' => $this->request->data['Reinvestment']['investment_cash_id'],
                'currency_id' => $this->request->data['Reinvestment']['currency_id'],
                'investment_amount' => $totalamt,
                'investment_date' => $this->request->data['Reinvestment']['investment_date'],
                'reinvestment_date' => $inv_date,
                'purchase_date' => $inv_date,
                'total_fees' => $this->request->data['Reinvestment']['total_fees'],
                'total_amount' => $totalamt,
                'numb_shares' => $total_shares,
                'numb_shares_left' => $total_shares,
                'details' => $this->request->data['Reinvestment']['details'],
                'created_by' => $this->request->data['Reinvestment']['user_id'],
                'modified_by' => $this->request->data['Reinvestment']['user_id']
            );


            $description = 'Deposit for investment';
            //move to summary contract function and store in client ledger
            if (isset($ledger_data)) {
                $client_ledger = array('id' => $ledger_id, 'investor_id' => $investor_id, 'available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested);
                //Ledger transaction entry
                $description = 'Equity investment';
                $ledger_transactions = array('client_ledger_id' => $ledger_id, 'cash_receipt_mode_id' =>
                    $this->request->data['Reinvestment']['cash_receipt_mode_id'],
                    'debit' => $totalamt, 'user_id' => $this->request->data['Reinvestment']['user_id'],
                    'date' => $inv_date, 'description' => $description);

                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
            }

            $check = $this->Session->check('investment_array_reequity');
            if ($check) {
                $this->Session->delete('investment_array_reequity');
            }
            $this->Session->write('investment_array_reequity', $investment_array);
            if ($available_amount > $totalamt) {
                $message = 'Investment amount is less than investor\'s deposit. Consider increasing number of purchased shares. <br/> Click on Submit to ignore and continue';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
            }


            $message = 'Investment Successfully Processed. Click on submit to save and proceed';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
        }
    }

    function get_equity() {
        if (!$this->Session->read('reinvestmt_equities')) {
            $this->set_equity(array());
        }


        return $this->Session->read('reinvestmt_equities');
    }

    //Kwaku Multiple Equities
    function set_equity($equity_data) {
        $this->Session->write('reinvestmt_equities', $equity_data);
    }

    function newInvestment1Equity1($reinvestor_id = null, $investcash_id = null) {
        /* $this->__validateUserType(); */
        $this->set('reinvestments', $this->Reinvestment->find('list'));
        if ($this->Session->check('reinvesttemp') == true) {
            $this->Session->delete('reinvesttemp');
        }
        $check = $this->Session->check('variabless_reequity');
        if ($check) {
            $this->Session->delete('variabless_reequity');
        }

        $check = $this->Session->check('investment_array_reequity');
        if (!$check) {
            $message = 'Process before submitting';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
        }
        $read = $this->Session->read('investment_array_reequity');
        $ic_result = $this->InvestmentCash->find('first', ['conditions' => ['InvestmentCash.id' => $investcash_id]]);
        $result = $this->ReinvestmentsEquity->save($read);
        $reinvestment_id = $this->ReinvestmentsEquity->id;
        $equity_listarray = array();
        if ($result) {
            $equities = $this->get_equity();
            if (!empty($equities)) {
                foreach ($equities as $key => $var) {
                    $var['reinvestment_id'] = $reinvestment_id;
                    $this->ReinvestorEquity->create();
                    $this->ReinvestorEquity->save($var);
                }
            }
            $invested_amount = $result['ReinvestmentsEquity']['total_amount'];
            if ($ic_result) {
                $balance = $ic_result['InvestmentCash']['available_amount'] - $result['ReinvestmentsEquity']['total_amount'];
                if ($balance > 0) {
                    $investmencash_array = array('id' => $ic_result['InvestmentCash']['id'], 'status' => 'part_investment',
                        'modified_by' => ($this->Session->check('userDetails.id') == true ?
                                $this->Session->read('userDetails.id') : '' ));
                } else {

                    $investmencash_array = array('id' => $ic_result['InvestmentCash']['id'], 'status' => 'invested',
                        'modified_by' => ($this->Session->check('userDetails.id') == true ?
                                $this->Session->read('userDetails.id') : '' ));
                }
                $this->InvestmentCash->save($investmencash_array);
            }
//            $statemt_array = $this->Session->check('statemt_array_equity');
//            if ($statemt_array) {
//                $statemt_array = $this->Session->read('statemt_array_equity');
//
//
//                foreach ($statemt_array as $key => $val) {
//                    $val['reinvestment_equity_id'] = $reinvestment_id;
//
//                    $this->ReinvestmentEquityStatement->create();
//                    $this->ReinvestmentEquityStatement->save($val);
//                }
//                $this->Session->delete('statemt_array_equity');
//            }
            //delete from reinvestor_cashaccounts
            //subtract from reinvestoraacount equity balance and probably deposit
            $reinvestment_data = $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]);
            if ($reinvestment_data) {
                $id = $reinvestment_data['ReinvestorCashaccount']['id'];
                $old_balance = $reinvestment_data['ReinvestorCashaccount']['equity_inv_balance'];
                $new_balance = $old_balance - $invested_amount;

                $new_grand = $reinvestment_data['ReinvestorCashaccount']['total_balance'] - $invested_amount;
                $equity_data = array('id' => $id, 'equity_inv_balance' => $new_balance, 'total_balance' => $new_grand);
                $this->ReinvestorCashaccount->save($equity_data);
            }
            $check = $this->Session->check('investment_array_reequity');
            if ($check) {
                $this->Session->delete('investment_array_reequity');
            }

            if ($this->Session->check('ledger_data')) {



                $ledger_data = $this->Session->read('ledger_data');
                $this->ClientLedger->save($ledger_data);
                $cledger_id = $this->ClientLedger->id;


                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }
                //if clientledger save successful get id,update transaction and save
                if ($this->Session->check('ledger_transactions')) {
                    $ledger_transactions = $this->Session->read('ledger_transactions');
                    if (!empty($ledger_transactions)) {
                        $this->LedgerTransaction->create();
                        $this->LedgerTransaction->save($ledger_transactions);
                    }
                }
            }
            $this->set('reinvestments', $this->ReinvestmentsEquity->find('first', ['conditions' =>
                        ['ReinvestmentsEquity.id' => $reinvestment_id]]));
        } else {
            $message = 'Error saving new re-investment details. Please try again';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newInvestment1Equity', $reinvestor_id, $investcash_id));
        }
    }

    public function getPurchasePrice() {
        $this->autoRender = false;
        $this->autoLayout = false;

        if ($this->request->is('ajax')) {


            if (!empty($_POST['ID'])) {
                $ID = $_POST['ID'];
                $catLst = $this->EquitiesList->find('first', array('fields' => array('EquitiesList.ID', 'EquitiesList.share_price'), 'conditions' => array('EquitiesList.id' => $ID), 'recursive' => -1));
                if ($catLst) {
                    $itemLsts = json_encode($catLst);
                    return $itemLsts;
                } else {
                    $error = json_encode(array("error" => "No Data For Sub-Type"));
                    return $error;
                }
            } else {
                $error = json_encode(array("error" => "INVALID SELECTION"));
                return $error;
            }
        }
    }

    public function disposalList() {
        $this->paginate = array(
            'conditions' => array('Investment.status' => 'Disposal_Approved'),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    public function disposalRequest($id = null) {

        $this->set('equitieslists', $this->EquitiesList->find('list'));
        if (!empty($id) && !is_null($id)) {
            $data['eq'] = $this->EquityOrder->find('all', array('conditions'=>
                array('EquityOrder.investment_id' => $id,'EquityOrder.status' => 'ordered')));
          

            if ($data['eq']) {
                $investment_no = $data['eq'][0]['Investment']['investment_no'];
                $data['inv'] = $data['eq'][0];
                $data['in'] = $this->Investor->find('first', ['recursive' => -1, 'conditions' => ['Investor.id' =>
                        $data['inv']['Investment']['investor_id']]]);
                $data['reinv'] = $this->ReinvestmentsEquity->find('first', array('conditions' =>
                    array('ReinvestmentsEquity.investment_no' => $investment_no)));
                $x = 1;
                $equity_array = array();

                foreach ($data['eq'] as $val) {
                    $equity_array[$x] = $val;
                    $x++;
                }
                $this->set('equity_array', $equity_array);
            }

            $this->set('data', $data);
        }
    }

    function process() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $amount = $this->request->data['Investment']['investment_amount'];

            $inv_day = $this->request->data['Investment']['investment_date']['day'];
            $inv_month = $this->request->data['Investment']['investment_date']['month'];
            $inv_year = $this->request->data['Investment']['investment_date']['year'];
            $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
            $sinv_date = strtotime($finv_date);
            $inv_date = date('Y-m-d', $sinv_date);
            $this->request->data['Investment']['investment_date'] = $inv_date;
            if ($this->Session->check('investtemp') == true) {
                $this->Session->delete('investtemp');
            }

            $this->Session->write('investtemp', $this->request->data['Investment']);


            $portfolio_id = $this->request->data['Investment']['portfolio_id'];

            if ($this->request->data['Investment']['portfolio_id'] == "" || $this->request->data['Investment']['portfolio_id'] == null) {
                $message = 'Please Select a Portfolio';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment2'));
            }


            if ($this->request->data['Investment']['investment_amount'] == "" || $this->request->data['Investment']['investment_amount'] == null) {
                $message = 'Please Supply Investment Amount';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment2'));
            }

            $portfolio = $this->Portfolio->find('first', array('conditions' => array('Portfolio.id' => $portfolio_id), 'recursive' => -1));

            if ($portfolio) {
                $rate = $portfolio['Portfolio']['interest_rate'];
                $months = $portfolio['Portfolio']['period_months'];
                $investment_amount = $this->request->data['Investment']['investment_amount'];
                $interest_amount1 = ($rate / 100) * $investment_amount;
                $interest_amount = $interest_amount1 * $months;
                $amount_due = $interest_amount + $investment_amount;

                $first_date = $inv_date;

                $date = new DateTime($first_date);
                $date->add(new DateInterval('P' . $months . 'M'));

                $date_statemt = new DateTime($first_date);
                $principal = $investment_amount;
                $statemt_array = array();

                for ($n = 1; $n <= $months; $n++) {
                    $date_statemt->add(new DateInterval('P1M'));

                    $total = $interest_amount1 + $principal;
                    $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'], 'investor_id' => $this->request->data['Investment']['investor_id'], 'principal' => $principal, 'interest' => $interest_amount1, 'maturity_date' => $date_statemt->format('Y-m-d'), 'total' => $total);
                    $principal = $total;
                }

                $investment_array = array('user_id' => $this->request->data['Investment']['user_id'], 'investor_id' => $this->request->data['Investment']['investor_id'], 'investment_amount' => $this->request->data['Investment']['investment_amount'], 'portfolio_id' => $this->request->data['Investment']['portfolio_id'], 'interest_earned' => $interest_amount, 'investment_date' => $inv_date, 'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'));



                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);

                $check = $this->Session->check('variabless');
                if ($check) {
                    $this->Session->delete('variabless');
                }

                $check = $this->Session->check('investment_array');
                if ($check) {
                    $this->Session->delete('investment_array');
                }

                $check = $this->Session->check('statemt_array');
                if ($check) {
                    $this->Session->delete('statemt_array');
                }

                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                $this->Session->write('variabless', $variables);

                $this->Session->write('investment_array', $investment_array);

                $this->Session->write('statemt_array', $statemt_array);

                $this->Session->delete('investtemp');
                $message = 'Investment details successfully saved';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment2'));

//                $result = $this->Investment->save($investment_array);
//                if($result){
//                    $check = $this->Session->check('variabless');
//                    if($check){
//                        $this->Session->delete('variabless');
//                    }
//                    
//                    $variables = array('duedate' => $date->format('jS F,Y'),'interest' =>$interest_amount,'totaldue' =>$amount_due);
//                    $this->Session->write('variabless',$variables);
//                    
//                    $this->Session->delete('investtemp');
//                    $message = 'Investment details successfully saved';
//                   $this->Session->write('smsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'newInvestment2'));
//            
//                }else{
//                    $message = 'Investment save unsuccessful,please try again';
//                   $this->Session->write('bmsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'newInvestment2'));
//            
//                }
            }
        }
    }

    function searchInvest4Invest($investorID = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")))));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorID)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorID)));
            if ($investors) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $check = $this->Session->check('ivt');
                if ($check) {
                    $this->Session->delete('ivt');
                }
                $cust = $this->Session->write('ivts', $investors);
                $this->Session->write('ivt', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            }
        }
    }

    function searchInvest4mInvest($investorID = null, $condition = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investors = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")))));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorID)));

            $condition = $this->request->data['conditions'];
            if ($investors) {
                $check = $this->Session->check('mivts');
                if ($check) {
                    $this->Session->delete('mivts');
                }

                $cust = $this->Session->write('mivts', $investors);
                switch ($condition) {
                    case "manage":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
                        break;
                    case "payments":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'processPayments'));
                        break;
                }
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                switch ($condition) {
                    case "manage":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
                        break;
                    case "payments":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'processPayments'));
                        break;
                }
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorID)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorID)));
            if ($investors) {
                $check = $this->Session->check('mivts');
                if ($check) {
                    $this->Session->delete('mivts');
                }
                $check = $this->Session->check('mivt');
                if ($check) {
                    $this->Session->delete('mivt');
                }
                $cust = $this->Session->write('mivts', $investors);
                if ($investor) {
                    $check = $this->Session->check('mivt');
                    if ($check) {
                        $this->Session->delete('mivt');
                    }
                    $this->Session->write('mivt', $investor);
                }
                switch ($condition) {
                    case "manage":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
                        break;
                    case "payments":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'processPayments'));
                        break;
                }
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('bmsg', $message);
                switch ($condition) {
                    case "manage":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
                        break;
                    case "payments":
                        $this->redirect(array('controller' => 'Investments', 'action' => 'processPayments'));
                        break;
                }
            }
        }
    }

    function manageInv() {
        /* $this->__validateUserType(); */
        $this->set('reinvestors', $this->Reinvestor->find('list'));

        if ($this->request->is('post')) {
            $reinvestor_id = 1;
            $investment_type = $this->request->data['ManageInvestments']['investment_type'];

            if ($reinvestor_id == '' || $reinvestor_id == NULL) {
                $message = 'Please Select Investment Company';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
            } elseif ($investment_type == '' || $investment_type == NULL) {
                $message = 'Please Select Investment Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
            } else {
                if ($investment_type == 1) {
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed/' . $reinvestor_id));
                } elseif ($investment_type == 2) {
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvEquity/' . $reinvestor_id));
                }
            }
        }
    }

    function manageInvFixed($reinvestor_id = NULL) {
        /* $this->__validateUserType(); */
        if (!is_null($reinvestor_id) && !empty($reinvestor_id)) {
//        $this->set('reinvestors', $this->Reinvestor->find('first', ['conditions' => ['Reinvestor.id' => $reinvestor_id]]));
            $this->set('reinvestors', $this->ReinvestorCashaccount->find('first', ['conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
             $this->set('reinvestor_id', $reinvestor_id);
            $this->set('paymentmodes', $this->PaymentMode->find('list'));
//        $this->set('reinvestments', $this->Reinvestment->find('list', ['conditions' => ['Reinvestment.reinvestor_id' => $reinvestor_id]]));
//'Reinvestment.payment_status' => 'unpaid'
            $this->paginate = array(
                'conditions' => array('Reinvestment.investment_type' => 'fixed', 'Reinvestment.reinvestor_id' => $reinvestor_id),
                'limit' => 30, 'order' => array('Reinvestment.id' => 'asc'));
            $data = $this->paginate('Reinvestment');
            $this->set('data', $data);
        } else {
            $message = 'Could not retrieve investment details. Please try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
        }
    }

    function manageInvEquity($reinvestor_id = NULL) {
        /* $this->__validateUserType(); */
        $this->set('reinvestors', $this->Reinvestor->find('first', ['conditions' => ['Reinvestor.id' => $reinvestor_id]]));
//        $this->set('reinvestments', $this->Reinvestment->find('list', ['conditions' => ['Reinvestment.reinvestor_id' => $reinvestor_id]]));

        $this->paginate = array(
            'conditions' => array('Reinvestment.investment_type' => 'equity', 'Reinvestment.reinvestor_id' => $reinvestor_id, 'Reinvestment.payment_status' => 'unpaid'),
            'limit' => 30, 'order' => array('Reinvestment.id' => 'asc'));
        $data = $this->paginate('Reinvestment');
        $this->set('data', $data);
    }

    function manageInvFixedDetails($reinvestment_id = NULL) {
        /* $this->__validateUserType(); */

        $this->set('reinvestments', $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list', []));
        $this->set('invdestproducts', $this->InvDestProduct->find('list', []));
    }

    function manageInvEquityDetails($reinvestment_id = NULL) {
        /* $this->__validateUserType(); */

        $this->set('reinvestments', $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list', []));
        $this->set('invdestproducts', $this->InvDestProduct->find('list', []));
    }

    function manageInvFixedCancel($reinvestment_id = null, $reinvestor_id = null) {
        if ($this->Session->check('ter_array_refixed')) {
            $reinvest_array = $this->Session->read('ter_array_refixed');
            $result = $this->Reinvestment->save($reinvest_array);
            if ($result) {
                if ($this->Session->check('cashaccts')) {
                    $cashdata = $this->Session->read('cashaccts');
                    $this->ReinvestorCashaccount->save($cashdata);
                }
                if ($this->Session->check('return_data')) {
                    $returns = $this->Session->read('return_data');
                    $this->InvestmentReturn->create();
                    $this->InvestmentReturn->save($returns);
                }
                $message = 'Termination details successfully saved';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
            } else {
                $message = 'Termination request unsuccessful. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'terminateFixedInvestment', $reinvestment_id, $reinvestor_id));
            }
        } else {
            $message = 'Invalid Selection Made. Try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'terminateFixedInvestment', $reinvestment_id, $reinvestor_id));
        }
    }

    function manageInvFixedPayRequest($reinvestment_id = null, $reinvestor_id = null) {
        if (!is_null($reinvestment_id)) {
            $reinvest_array = array('id' => $reinvestment_id, 'status' => 'Payment_Requested', 'old_status' => 'Invested');
            $result = $this->Reinvestment->save($reinvest_array);
            if ($result) {

                $message = 'Payment request successfully sent';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
            } else {
                $message = 'Payment request unsuccessful. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
            }
        } else {
            $message = 'Invalid Selection Made. Try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
        }
    }

    function manageInvEquityCancel() {
        
    }

    function topupInvestment() {
      
        $this->autoRender = $this->autoLayout = false;
        if ($this->request->is('post')) {
             
            if (!empty($this->request->data)) {
//               pr($this->request->data);exit;
                $source = $this->request->data['Topup']['paymentmode_id'];
                $available_cash = $this->request->data['Topup']['topupavailable_cash'];
                $investment_id = $this->request->data['Topup']['topupinvestment_id'];
                $investor_id = $this->request->data['Topup']['topupinvestor_id'];
                $investor_name = $this->request->data['Topup']['topupinvestor_name'];
                $userid = null;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
                $amount = 0;
                $cheque_no = '';
                $payment_name = '';
                $inv_day = $this->request->data['Topup']['investment_date']['day'];
                if (!empty($inv_day)) {
                    $inv_month = $this->request->data['Topup']['investment_date']['month'];
                    $inv_year = $this->request->data['Topup']['investment_date']['year'];
                    $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                    $sinv_date = strtotime($finv_date);
                    $inv_date = date('Y-m-d', $sinv_date);
                } else {
                    $inv_date = date('Y-m-d');
                }

                $investment_data = $this->Reinvestment->find('first', ['conditions' =>
                    ['Reinvestment.id' => $investment_id]]);

                if ($investment_data) {

//                    $inv_no = $investment_data['Reinvestment']['investment_no'];
                    $reinvestment_data = $this->ReinvestorCashaccount->find('first', ['recursive' => -1,
                        'conditions' => ['ReinvestorCashaccount.reinvestor_id' => $investor_id]]);

                    if ($reinvestment_data) {
                        
                       
                                $amount = $this->request->data['Topup']['topup_amount'];
//                                print_r($this->request->data);
                                $cheque_no =null;
                               
                                if(!empty($this->request->data['Topup']['cheque_no'])){
                               
                                $cheque_no = $this->request->data['Topup']['cheque_no'];
                                }
                       
                        
                        
                        $id = $reinvestment_data['ReinvestorCashaccount']['id'];
                        $old_balance = $reinvestment_data['ReinvestorCashaccount']['fixed_inv_balance'];
                        $grand_total = $reinvestment_data['ReinvestorCashaccount']['total_balance'] - $amount;
                    } else {
                        
                        $message = 'Unable to access Company account. Please try again.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $investor_id));
                    }

                    $custom_rate = $investment_data['Reinvestment']['interest_rate'];
                    $period = $investment_data['Reinvestment']['investment_period'];
                    $end_date = $investment_data['Reinvestment']['due_date'];
                    $first_date = $inv_date;
                    $inv_date = new DateTime($first_date);
                    $to_date = new DateTime($end_date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");

                    $year = $duration;
                    $investment_amount = $amount;

                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1D'));
                                $interest_amount2 = $interest_amount1 * (1 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $userid,
                                    'reinvestor_id' => $investor_id,
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $end_date,
                                    'total' => $total);
//                                $principal = $total;
                            }

                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'Y'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;

                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1Y'));
                                $interest_amount2 = $interest_amount1 * (365 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $userid,
                                    'reinvestor_id' => $investor_id,
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $end_date,
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $new_investmentamt = $investment_data['Reinvestment']['investment_amount'] + $amount;
                    $newinterest_amt = $investment_data['Reinvestment']['expected_interest'] + $interest_amount;
                    $newtotal_amount_earned = $investment_data['Reinvestment']['total_amount_earned'] + $amount;
                    $new_earnedbalance = $investment_data['Reinvestment']['earned_balance'] + $amount;
                    $newamount_due = $investment_data['Reinvestment']['amount_due'] + $amount_due;
                    $investment_array = array(
                        'id' => $investment_data['Reinvestment']['id'],
                        'investment_amount' => $new_investmentamt,
                        'interest_earned' => $newinterest_amt,
                        'total_amount_earned' => $newtotal_amount_earned,
                        'earned_balance' => $new_earnedbalance,
                        'amount_due' => $newamount_due,
                    );

                    $topup_data = array('old_investmentamt' => $investment_data['Reinvestment']['investment_amount'],
                        'oldinterest_earned' => $investment_data['Reinvestment']['interest_earned'],
                        'oldtotal_amount_earned' => $investment_data['Reinvestment']['total_amount_earned'],
                        'oldearned_balance' => $investment_data['Reinvestment']['earned_balance'],
                        'oldamount_due' => $investment_data['Reinvestment']['amount_due'],
                        'topup_amount' => $amount,
                        'payment_mode_id' => $source,
                        'reinvestment_id' => $investment_data['Reinvestment']['id'],
                        'user_id' => $userid,
                        'investment_date' => $first_date);

                    $result = $this->Reinvestment->save($investment_array);
//                    print_r($amount);exit;
                    if ($result) {
                        //subtract from reinvestoraacount fixed balance and probably deposit

                        $new_balance = $old_balance - $amount;
                        $fixed_data = array('id' => $id, 'fixed_inv_balance' => $new_balance, 'total_balance' => $grand_total);
                        $this->ReinvestorCashaccount->save($fixed_data);


                        $this->ReinvestmentTopup->create();
                        $this->ReinvestmentTopup->save($topup_data);
                        foreach ($statemt_array as $key => $val) {
                            $val['reinvestment_id'] = $investment_id;

                            $this->ReinvestmentStatement->create();
                            $this->ReinvestmentStatement->save($val);
                        }
                        $message = 'Topup successful.';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $investor_id));
                    } else {
                        $message = 'Error Saving Topup Details.Please Try again.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $investor_id));
                    }
                } else {
                    $message = 'Investment details not found. Please try again.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $investor_id));
                }
            }
        }
    }

    function rolloverReinvestorFixed() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $reinvestment_id = $this->request->data['Reinvestment']['id'];
            $reinvestor_id = $this->request->data['Reinvestment']['reinvestor_id'];
            $reinvest_data = $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]);
            if ($reinvest_data) {
                $inv_day = $this->request->data['Reinvestment']['investment_date']['day'];
                if (!empty($inv_day)) {
                    $inv_month = $this->request->data['Reinvestment']['investment_date']['month'];
                    $inv_year = $this->request->data['Reinvestment']['investment_date']['year'];
                    $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                    $sinv_date = strtotime($finv_date);
                    $inv_date = date('Y-m-d', $sinv_date);
                } else {
                    $inv_date = date('Y-m-d');
                }
                $this->request->data['Reinvestment']['investment_date'] = $inv_date;
                if ($this->Session->check('rollreinvesttemp') == true) {
                    $this->Session->delete('rollreinvesttemp');
                }
                $this->Session->write('rollovertemp', $this->request->data['Reinvestment']);
                $amount_available = $reinvest_data['Reinvestment']['earned_balance'];
                $investment_amount = $this->request->data['Reinvestment']['investment_amount'];

                if ($investment_amount > $amount_available) {
                    $message = 'Rollover Amount cannot be more than amount due';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'rollover', $reinvestment_id, $reinvestor_id));
                } 
                
//                elseif ($investment_amount < $amount_available) {
//                    $message = 'Please record cash returned before rollover';
//                    $this->Session->write('bmsg', $message);
//                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'rollover', $reinvestment_id, $reinvestor_id));
//                }
                $first_date = $inv_date;
                $custom_rate = $this->request->data['Reinvestment']['interest_rate'];
                $date = new DateTime($first_date);
                $period = $reinvest_data['Reinvestment']['investment_period'];
                $duration = $reinvest_data['Reinvestment']['duration'];
                $year = $duration;
            $adate = date('Y-m-d');
            $to_date = new DateTime($adate);
            $ainv_date = new DateTime($inv_date);
            $aduration = date_diff($ainv_date, $to_date);
            $aduration = $aduration->format("%a");
                switch ($period) {
                    case 'Day(s)':

                        $date->add(new DateInterval('P' . $duration . 'D'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($duration / 365);
                        $amount_due = $interest_amount + $investment_amount;
                    $ainterest_amount = $interest_amount1 * ($aduration / 365);
                    $aamount_due = $ainterest_amount + $investment_amount;
                        for ($n = 1; $n <= $duration; $n++) {
                            $date_statemt->add(new DateInterval('P1D'));

                            $interest_amount2 = $interest_amount1 * (1 / 365);
                            $total = $interest_amount2 + $principal;
                            $statemt_array[] = array('user_id' => ($this->Session->check('userDetails.id') == true ?
                                        $this->Session->read('userDetails.id') : '' ),
                                'reinvestment_id' => $reinvest_data['Reinvestment']['id'],
                                'reinvestor_id' => $reinvest_data['Reinvestment']['reinvestor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                        $principal = $total;
                        }



                        break;

                    case 'Year(s)':
                        $date->add(new DateInterval('P' . $duration . 'Y'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $YEAR2DAYS = 365 * $duration;
                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                        $amount_due = $interest_amount + $investment_amount;
                     $aYEAR2DAYS = 365 * $aduration;
                    $ainterest_amount = $interest_amount1 * ($aYEAR2DAYS / 365);
                    $aamount_due = $ainterest_amount + $investment_amount;
                        for ($n = 1; $n <= $duration; $n++) {
                            $date_statemt->add(new DateInterval('P1Y'));
                            $interest_amount2 = $interest_amount1 * (1 / 365);
                            $total = $interest_amount2 + $principal;
                            $statemt_array[] = array('user_id' => ($this->Session->check('userDetails.id') == true ?
                                        $this->Session->read('userDetails.id') : '' ),
                                'reinvestment_id' => $reinvest_data['Reinvestment']['id'],
                                'reinvestor_id' => $reinvest_data['Reinvestment']['reinvestor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                        $principal = $total;
                        }



                        break;
                }

                $current_accountbalance = 0;
                if ($investment_amount < $amount_available) {
                    $current_accountbalance = $amount_available - $investment_amount;
                }
                //$this->ReinvestmentStatement->saveAll(ReinvestmentStatement);

                $reinvestment_array = array(
                    'id' => $reinvest_data['Reinvestment']['id'],
                    'expected_interest' => $interest_amount, 'total_amount_earned' => $aamount_due,
                    'earned_balance' => $aamount_due,
                    'accrued_interest' => $ainterest_amount,
                    'interest_rate' => $custom_rate, 'investment_amount' => $investment_amount,
                    'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'),
                    'balance' => $amount_due, 'earned_balance' => $investment_amount,
                    'modified_by' => ($this->Session->check('userDetails.id') == true ?
                            $this->Session->read('userDetails.id') : '' ),
                    'status' => 'Rolled_over'
                );

                $interest_accruals = array(
                    'reinvestment_id' => $reinvest_data['Reinvestment']['id'],
                        'reinvestor_id' => $reinvest_data['Reinvestment']['reinvestor_id'],
                        'interest_amounts' => $ainterest_amount,
                        'interest_date' => $inv_date
                    );
                    
                   $this->ReinvestInterestAccrual->save($interest_accruals);
                $rollover_details = array('user_id' => ($this->Session->check('userDetails.id') == true ?
                            $this->Session->read('userDetails.id') : '' ),
                    'reinvestment_id' => $reinvest_data['Reinvestment']['id'],
                    'reinvestor_id' => $reinvest_data['Reinvestment']['reinvestor_id'],'old_accrued_interest' =>$reinvest_data["Reinvestment"]["accrued_interest"], 
                    'interest_rate' => $custom_rate, 'old_interest_rate' => $reinvest_data["Reinvestment"]["interest_rate"],
                    'amount' => $investment_amount, 'rollover_date' => $date->format('Y-m-d'));


                $result = $this->Reinvestment->save($reinvestment_array);
                if ($result) {
                     $this->ReinvestInterestAccrual->save($interest_accruals);
                    $this->ReinvestmentRollover->save($rollover_details);
                    $this->ReinvestmentStatement->saveAll($statemt_array);
                    $message = 'Roll-over successful';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
                } else {
                    $message = 'Roll-over unsuccessful. Try again';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
                }
                $message = 'Rollover successfully processed, select save to submit';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'rollover', $reinvestment_id, $reinvestor_id));
            } else {
                $message = 'Roll-over unsuccessful. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
            }
        } else {
            $message = 'Invalid Selection Made. Try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
        }
    }

    function payReinvestorFixed($reinvestment_id = NULL) {
        $this->set('reinvestments', $this->Reinvestment->find('first', ['conditions' =>
                    ['Reinvestment.id' => $reinvestment_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list', []));
        $this->set('invdestproducts', $this->InvDestProduct->find('list', []));
        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list', []));
        $this->set('instructions', $this->Instruction->find('list', array('conditions' => array('Instruction.id' => array('1', '2', '3')))));

        $this->set('paymentmodes', $this->PaymentMode->find('list'));
    }

    function payReinvestorEquity() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if ($this->Session->check('reinvestmt_equities')) {
                $this->Session->delete('reinvestmt_equities');
            }
            $userid = null;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
            $total_shares_sold = 0;
            $total_sale = 0;
            $reinvestment_id = $this->request->data['EquityOrder']['reinvestment_id'];
            $investment_id = $_POST['hid_investid'];
            $equities_list_id = $this->request->data['EquityOrder']['equities_list_id'];
            $order_id = $this->request->data['EquityOrder']['order_id'];
            $fees = $this->request->data['EquityOrder']['other_fees'];
            $shares_ordered = $this->request->data['EquityOrder']['numb_shares_sold'];
            $total_shares_sold += $shares_ordered;
            $sale_price = $this->request->data['EquityOrder']['sale_price'];
            $total_price = $sale_price * $shares_ordered;
            $total_sale += $total_price;
            $reinv_data = $this->ReinvestmentsEquity->find('first', ['conditions' =>
                ['ReinvestmentsEquity.id' => $reinvestment_id], 'recursive' => -1]);

            $inv_data = $this->Investment->find('first', ['conditions' =>
                ['Investment.id' => $investment_id], 'recursive' => -1]);

            $equities = $this->get_equity();
            $equity_data = array($equities_list_id => array(
                    'id' => $order_id,
                    'numb_shares_sold' => $shares_ordered,
                    'sale_price' => $sale_price,
                    'total_price' => $total_price,
                'status' => 'processed'
            ));

            $equities+=$equity_data;
            $this->set_equity($equities);
            $x = 2;
            while ($x <= 5) {
                $equities = $this->get_equity();

                //equity already exists, add to equity_details
                if (isset($this->request->data['EquityOrder']['equities_list_id' . $x]) &&
                        !empty($this->request->data['EquityOrder']['equities_list_id' . $x])) {

                    $shares_ordered = $this->request->data['EquityOrder']['numb_shares_sold' . $x];
                    $newequities_list_id = $this->request->data['EquityOrder']['equities_list_id' . $x];
                    $order_id = $this->request->data['EquityOrder']['order_id' . $x];
                    $total_shares_sold += $shares_ordered;
                    $sale_price = $this->request->data['EquityOrder']['sale_price' . $x];
                    $total_price = $sale_price * $shares_ordered;
                    $total_sale += $total_price;
                    $equity_data = array($newequities_list_id => array(
                            'id' => $order_id,
                            'numb_shares_sold' => $shares_ordered,
                            'sale_price' => $sale_price,
                            'total_price' => $total_price,
                            'status' => 'processed'
                    ));

                    $equities+=$equity_data;
                    $this->set_equity($equities);
                }
                $x++;
            }
            $total_sale = $total_sale - $fees;
            $equities = $this->get_equity();
            if (!empty($equities)) {
                foreach ($equities as $key => $var) {

                    $this->EquityOrder->save($var);
                }
                $this->Session->delete('reinvestmt_equities');
            $returns = 0;
            if ($inv_data) {
                $numb_shares_sold = $inv_data['Investment']['numb_shares_sold'];
                $numb_shares_left = $inv_data['Investment']['numb_shares_left'];
                $accrued_basefee = $inv_data['Investment']['accrued_basefee'];
                $total_earned = $inv_data['Investment']['total_amount_earned'];
                $old_status = $inv_data['Investment']['status'];
                
                
                if($total_sale >= $accrued_basefee){
                    $returns = $accrued_basefee;
                    $total_sale = $total_sale - $accrued_basefee;
                    $new_accrued = 0;
                    $new_totearned = $total_earned + $total_sale;
                }elseif($total_sale < $accrued_basefee){
                    $new_accrued = $accrued_basefee - $total_sale;
                     $returns = $total_sale;
                    $total_sale = 0;
                    $new_totearned = $total_earned + $total_sale;
                }
                $new_share_sold = $numb_shares_sold + $total_shares_sold;
                $new_shares_left = $numb_shares_left - $total_shares_sold;
                if($new_shares_left <= 0){
                    $status = 'Paid';
                }else{
                    $status = 'Invested';
                }
                //set and update investor investment record
                $inv_array = array('id' => $investment_id,'total_amount_earned' => $new_totearned,
                    'accrued_basefee' => $new_accrued,'numb_shares_sold' => $new_share_sold,'numb_shares_left' => $numb_shares_left,
                    'old_status' => $old_status,'status' => $status,'modified_by' => $userid);
                $result = $this->Investment->save($inv_array);
                
                if($result){
                    //find and update investor equity records
                    $inv_eq = $this->InvestorEquity->find('all',['recursive' => -1,
                        'conditions' => ['InvestorEquity.investment_id' => $investment_id]]);
                    if($inv_eq){
                     $x = 2;   
               foreach($inv_eq as $val){
                   if($x > 5){
                       break;
                   }
                   if($val['InvestorEquity']['equities_list_id'] == 
                           $this->request->data['EquityOrder']['equities_list_id']){
                       $shares_sold = $val['InvestorEquity']['numb_shares_sold'] + $this->request->data['EquityOrder']['numb_shares_sold'];
                       $numb_shares_left = $val['InvestorEquity']['numb_shares_left'] - $this->request->data['EquityOrder']['numb_shares_sold'];
                   }
                   if($val['InvestorEquity']['equities_list_id'] == 
                           $this->request->data['EquityOrder']['equities_list_id' . $x]){
                       $shares_sold = $val['InvestorEquity']['numb_shares_sold'] +
                               $this->request->data['EquityOrder']['numb_shares_sold'. $x];
                       
                       $numb_shares_left = $val['InvestorEquity']['numb_shares_left'] - 
                               $this->request->data['EquityOrder']['numb_shares_sold'. $x];
                   
                           }
                           $x++;
                           $inveq_array = array('id' => $val['InvestorEquity']['id'],'numb_shares_sold' => $shares_sold,
                               'numb_shares_left' => $numb_shares_left,'modified_by' => $userid);
                           $this->InvestorEquity->save($inveq_array);
               }
                        
                    }
                     if($reinv_data){
            //collect data for reinvestor returns
            $reinvestor_cash = $this->ReinvestorCashaccount->find('first',['recursive' => -1,
                'conditions' => ['ReinvestorCashaccount.reinvestor_id' => 
                    $reinv_data['ReinvestmentsEquity']['reinvestor_id']]]);
            
            if($reinvestor_cash){
                //$equity_balance = $reinvestor_cash['ReinvestorCashaccount']['equity_inv_balance'] + $total_sale;
                $equity_returns = $reinvestor_cash['ReinvestorCashaccount']['equity_inv_returns'] + $returns;
                $total_balance = $reinvestor_cash['ReinvestorCashaccount']['total_balance'] + $returns;
                
                $reinvestor_array = array('id' => $reinvestor_cash['ReinvestorCashaccount']['id'],
                    'equity_inv_returns' => $equity_returns,'total_balance' => $total_balance);
                $this->ReinvestorCashaccount->save($reinvestor_array);
            }
            
            //subtract shares from reinvestment equity and update status
            //make sure when investments are mature - accruedbasefeecash is deducted and added to
            // reinvestor fixed cash returns and total balance
            //above will probably happen in shell and also during terminations
            $reshares_left = $reinv_data['ReinvestmentsEquity']['numb_shares_left'] - $total_shares_sold;
            $reshares_sold = $reinv_data['ReinvestmentsEquity']['numb_shares_sold'] + $total_shares_sold;
            $reold_status = $reinv_data['ReinvestmentsEquity']['status'];
            $reother_fees = $fees + $reinv_data['ReinvestmentsEquity']['other_fees'];
            if($reshares_left <= 0){
                    $restatus = 'Paid';
                    $repayment_status = 'paid';
                }else{
                    $restatus = 'Invested';
                    $repayment_status = 'unpaid';
                }
                
            $relastpaidout_date = date('Y-m-d');
            
            $reinv_array = array('id' => $reinvestment_id,'numb_shares_left' => $reshares_left,
                'numb_shares_sold' => $reshares_sold,'status' => $restatus,'old_status' => $reold_status,
                'payment_status' => $repayment_status,'lastpaidout_date' => $relastpaidout_date,'other_fees' => $reother_fees,
                'modified_by' => $userid);
            
            $re_result = $this->ReinvestmentsEquity->save($reinv_array);
              if($re_result){
               $message = 'Equity Sale Processed Successfully. Try again';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'disposalList'));
              }    else {
                $message = 'Could not process equity sale. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'disposalList'));
            }     
            }   else {
                $message = 'Could not process equity sale. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'disposalList'));
            }
                }   else {
                $message = 'Could not process equity sale. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'disposalList'));
            }
                
            }
           
        }
        }
    }

    function payReinvestorFixedReceipt($reinvestment_id = NULL) {
        $this->set('reinvestments', $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]));
        $this->set('returns', $this->InvestmentReturn->find('first', ['conditions' => ['InvestmentReturn.reinvestment_id' => $reinvestment_id],
                    'order' => ['InvestmentReturn.id' => 'DESC']]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list', []));
        $this->set('invdestproducts', $this->InvDestProduct->find('list', []));
    }

    function payReinvestorEquityReceipt($reinvestment_id = NULL) {
        
    }

    function processPayments() {
        /* $this->__validateUserType(); */

        $data = $this->paginate('Investment');

        $this->set('data', $data);
        $check = $this->Session->check('mivt');
        if ($check) {
            $cust = $this->Session->read('mivt');
//            pr($cust);
            $this->set('int', $cust);
            $this->Session->delete('mivt');
        }
        $check = $this->Session->check('mivts');
        if ($check) {
            $cust = $this->Session->read('mivts');
            $this->set('data', $cust);

            $this->Session->delete('mivts');
        }
    }

    function makePayment() {
        // subtract from reinvestor deposits and cash accounts and add to amount paidout in reinvestor_cashaccounts


        $this->autoRender = false;
        if ($this->request->is('post')) {

            $userid = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $userid = $this->Session->read('userDetails.id');
            }


            $new_cheque_numbers = "";
            $payment = 0;
            $investment_id = $this->request->data['Reinvestment']['id'];


            if ($this->request->data['Reinvestment']['cashreceiptmode_id'] == "" || $this->request->data['Reinvestment']['cashreceiptmode_id'] == null) {
                $message = 'Please Select A Mode of Payment.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'payReinvestorFixed', $investment_id));
            }

            if ($this->request->data['Reinvestment']['amount_paidout'] == "" || $this->request->data['Reinvestment']['amount_paidout'] == null || $this->request->data['Reinvestment']['amount_paidout'] == 0) {
                $message = 'Amount Not Entered.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'payReinvestorFixed', $investment_id));
            }
            if ($this->request->data['Reinvestment']['cashreceiptmode_id'] == "2" && ($this->request->data['Reinvestment']['cheque_nos'] == "" || $this->request->data['Reinvestment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'payReinvestorFixed', $investment_id));
            }



            $cheque_numbers = "";
            if (isset($this->request->data['Reinvestment']['cheque_nos'])) {
                if ($this->request->data['Reinvestment']['cheque_nos'] != "" || $this->request->data['Reinvestment']['cheque_nos'] != null) {
                    $cheque_numbers = $this->request->data['Reinvestment']['cheque_nos'];
                }
            }


            $instruction_id = $this->request->data['Reinvestment']['instruction_id'];
            $payment_day = $this->request->data['Reinvestment']['investment_date']['day'];
            $payment_month = $this->request->data['Reinvestment']['investment_date']['month'];
            $payment_year = $this->request->data['Reinvestment']['investment_date']['year'];
            $fpayment_date = $payment_year . "-" . $payment_month . "-" . $payment_day;
            $spayment_date = strtotime($fpayment_date);
            $payment_date = date('Y-m-d', $spayment_date);
            $session_date = date('d-m-Y', $spayment_date);
            //$this->request->data['InvestmentPayment']['payment_date'] = $payment_date;
            $check = $this->Session->check('payment_date');
            if ($check) {
                $this->Session->delete('payment_date');
            }
            $this->Session->write('payment_date', $session_date);

            $payment += $this->request->data['Reinvestment']['amount_paidout'];
//            $sms_amount = $this->request->data['Reinvestment']['amount_paidout'];
//            $payment_mode = $this->request->data['Reinvestment']['payment_mode'];

            $balance = 0;
            $total_paid = 0;
            $hp_price = 0;
            $old_total_paid = 0;
            $old_balance = 0;


            $date = date('Y-m-d H:i:s');
            $to_date = new DateTime($payment_date);
            //use id to retrieve Investment info
            $investment_details = $this->Reinvestment->find('first', array('conditions' =>
                array('Reinvestment.id' => $investment_id)));
            if ($investment_details) {
                $reinvestor_id = $investment_details['Reinvestment']['reinvestor_id'];
                $cashacct_data = $this->ReinvestorCashaccount->find('first', ['conditions' =>
                    ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]);

                $status = $investment_details['Reinvestment']['status'];
                $old_balance = $investment_details['Reinvestment']['balance'];
                $old_earnedbalance = $investment_details['Reinvestment']['earned_balance'];
                $old_total_paid = $investment_details['Reinvestment']['amount_paidout'];
                $amount_due = $investment_details['Reinvestment']['amount_due'];
                $reinvestor = $investment_details['Reinvestment']['reinvestor_id'];
//                $investment_no = $investment_details['Reinvestment']['investment_no'];
                $investor_name = $investment_details['Reinvestor']['company_name'];
                if ($status != 'Matured' && $status != 'Paid' && $status != 'Part_payment') {


                    $message = 'Investment is yet to mature';


                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor));
                }
                if ($status == 'Paid') {
                    $message = 'Full payment made for investment';
                }

                $total_paid = $old_total_paid + $payment;
                $balance = $amount_due - $total_paid;
                $earned_balance = $old_earnedbalance - $payment;
//print_r('balance: '.$balance.'--'.'amount_due: '.$amount_due.'--'.'totalpaid: '.$total_paid);
//exit;
                if ($earned_balance <= 0) {
                    $status = 'Paid';
                    $old_status = $investment_details['Reinvestment']['status'];
                } elseif ($earned_balance > 0 && $earned_balance < $old_earnedbalance) {
                    $status = "Part_payment";
                    $old_status = $investment_details['Reinvestment']['status'];
                } elseif ($earned_balance == $old_earnedbalance) {
                    $status = $investment_details['Reinvestment']['status'];
                    $old_status = $investment_details['Reinvestment']['old_status'];
                }

                if ($balance <= 0) {
                    $payment_status = "paid";
                } elseif ($balance > 0 && $balance < $amount_due) {

                    $payment_status = "part_payment";
                } elseif ($balance == $amount_due) {

                    $payment_status = "unpaid";
                }

                $new_investmentdetails = array('id' => $investment_id, 'balance' => $balance, 'earned_balance' => $earned_balance,
                    'amount_paidout' => $total_paid, 'status' => $status, 'payment_status' => $payment_status, 'lastpaidout_date' => $payment_date);

                $result = $this->Reinvestment->save($new_investmentdetails);
                if ($result) {
//                      print_r($result);
//            exit;
                    if ($cashacct_data) {
                        $cash_athand = $cashacct_data['ReinvestorCashaccount']['fixed_inv_returns'];
                        $new_cashathand = $cash_athand + $payment;
                        $cashacct_id = $cashacct_data['ReinvestorCashaccount']['id'];
                        $cashacct_array = array('id' => $cashacct_id, 'fixed_inv_returns' => $new_cashathand);
                    }

                    $return_array = array('user_id' => $userid, 'reinvestment_id' => $investment_id, 'returns' => $payment,
                        'return_type' => 'Matured', 'date' => $payment_date, 'cheque_nos' => $cheque_numbers,
                        'instruction_id' => $instruction_id, 'cash_receipt_mode_id' => $this->request->data['Reinvestment']['cashreceiptmode_id']);

                    $result2 = $this->InvestmentReturn->save($return_array);
                    if ($result2) {
                        $this->ReinvestorCashaccount->save($cashacct_array);
                        $check = $this->Session->check('ipayment_receipt');
                        if ($check) {
                            $this->Session->delete('ipayment_receipt');
                        }
                        $check = $this->Session->check('ireceipt_items');
                        if ($check) {
                            $this->Session->delete('ireceipt_items');
                        }

                        $message = 'Investment Payout Successful';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'payReinvestorFixedReceipt', $investment_id));

                        //$this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments',$investor,$investor_name));
                    } else {

                        $message = 'Investment Returns Saved With Errors';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor));
                    }
                } else {

                    $message = 'Investment Payout Unsuccessful. Please Try Again';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor));
                }
            } else {

                $message = 'Investment details not found. Please check and try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
            }
        } else {

            $message = 'Invalid selection';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInv'));
        }
    }

    function maturityList() {
//        $this->__validateUserType3();
        $this->paginate = array(
            'conditions' => array(
                'Reinvestment.status' => array('Matured', 'Payment_Requested'), 'Reinvestment.investment_type' => array('fixed')),
            'limit' => 30,
            'order' => array('Reinvestment.id' => 'asc'));
        $data = $this->paginate('Reinvestment');
        $this->set('data', $data);
    }

    function monthlyMaturityList() {
//        $this->__validateUserType3();
        $first_date = date('Y-m-d');
        $date = new DateTime($first_date);
        $date->add(new DateInterval('P1M'));
        $date_end = $date->format('Y-m-d');
        $this->paginate = array(
            'conditions' => array(
                'Reinvestment.status' => array('Invested', 'Rolled_over'),
                'Reinvestment.investment_type' => array('fixed'),
                'AND' => array(array('Reinvestment.due_date >=' => $first_date), array('Reinvestment.due_date <=' => $date_end))),
            'limit' => 30,
            'order' => array('Reinvestment.id' => 'asc'));
        $data = $this->paginate('Reinvestment');
        $this->set('data', $data);
    }

    function manageClientInvestments(/* $investor_id = null, $investor_name = null */) {
        /* $this->__validateUserType(); */
        if (!is_null($investor_id) && !is_null($investor_name) && $investor_id != '' && $investor_name != '') {
            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id), 'order' => array('Investment.id')));
            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);

            if ($data) {
                $this->set('data', $data);
            }
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function cancelInvestment($investment_id = null, $investor = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Cancelled', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Investment Cancelled Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
        }
    }

    function ReinstateInvestment($investment_id = null, $investor = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => $data['Investment']['old_status'], 'old_status' => 'Cancelled');

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Investment Re-instated Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
        }
    }

    function payInvestor($investment_id = null) {
        /* $this->__validateUserType(); */
        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        }
    }

    public function paymentReceipt($investment_id = null, $payment_amt = null) {
        /* $this->__validateUserType(); */
        $Investment_data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
        //  $check = $this->Session->check('payment_receipt');
        if ($Investment_data) {
            // $payment = $this->Session->read('payment_receipt');
            $this->set('payment', $Investment_data);
            $this->set('payment_amt', $payment_amt);
        } else {
            $message = "Payment successful But Investment Details not found";
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
        $issuedcheck = $this->Session->check('userData');
        if ($issuedcheck) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
    }

    public function listPayments() {
        /* $this->__validateUserType(); */
    }

    public function editPayment() {
        /* $this->__validateUserType(); */
    }

//    public function rollover($invesmentID = null, $investor_id = null, $investor_name = null) {
//        /* $this->__validateUserType(); */
//        if (!is_null($invesmentID)) {
//            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
//            if ($data) {
//                $portfolio_id = $data['Investment']['portfolio_id'];
//                $portfolio = $this->Portfolio->find('first', array('conditions' => array('Portfolio.id' => $portfolio_id), 'recursive' => -1));
//
//                if ($portfolio) {
//                    $rate = $portfolio['Portfolio']['interest_rate'];
//                    $months = $portfolio['Portfolio']['period_months'];
//                    $investment_amount = $data['Investment']['amount_due'];
//                    $interest_amount1 = ($rate / 100) * $investment_amount;
//                    $interest_amount = $interest_amount1 * $months;
//                    $amount_due = $interest_amount + $investment_amount;
//                    $finv_date = $data['Investment']['due_date'];
//                    $sinv_date = strtotime($finv_date);
//                    $inv_date = date('Y-m-d', $sinv_date);
//                    $first_date = $inv_date;
//                    $date = new DateTime($first_date);
//                    $date->add(new DateInterval('P' . $months . 'M'));
//
//
//                    $date_statemt = new DateTime($first_date);
//                    $principal = $investment_amount;
//                    $statemt_array = array();
//
//                    for ($n = 1; $n <= $months; $n++) {
//                        $date_statemt->add(new DateInterval('P1M'));
//
//                        $total = $interest_amount1 + $principal;
//                        $statemt_array[] = array('investment_id' => $data['Investment']['id'], 'user_id' => $data['Investment']['user_id'], 'investor_id' => $data['Investment']['investor_id'], 'principal' => $principal, 'interest' => $interest_amount1, 'maturity_date' => $date_statemt->format('Y-m-d'), 'total' => $total);
//                        $principal = $total;
//                    }
//
//                    $investment_array = array('id' => $data['Investment']['id'], 'interest_earned' => $interest_amount, 'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'), 'status' => 'Rolled_over');
//
//                    $rollover_details = array('user_id' => $data['Investment']['user_id'], 'id' => $data['Investment']['id'], 'investor_id' => $data['Investment']['investor_id'], 'amount' => $investment_amount, 'rollover_date' => $date->format('Y-m-d'));
//                    $check = $this->Session->check('variabless');
//                    if ($check) {
//                        $this->Session->delete('variabless');
//                    }
//
//                    $check = $this->Session->check('investment_array');
//                    if ($check) {
//                        $this->Session->delete('investment_array');
//                    }
//
//                    $check = $this->Session->check('rollover_details');
//                    if ($check) {
//                        $this->Session->delete('rollover_details');
//                    }
//                    $check = $this->Session->check('statemt_array');
//                    if ($check) {
//                        $this->Session->delete('statemt_array');
//                    }
//
//
//                    $this->Session->write('statemt_array', $statemt_array);
//                    $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
//                    $this->Session->write('variabless', $variables);
//                    $this->Session->write('rollover_details', $rollover_details);
//                    $this->Session->write('investment_array', $investment_array);
//
//                    $message = 'Investment details successfully saved';
//                    $this->Session->write('smsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestmentCert'));
//                }
//            } else {
//
//                $message = 'Sorry, Investment Details Not Found';
//                $this->Session->write('bmsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
//            }
//        } else {
//
//            $message = 'Sorry, Investment Not Found';
//            $this->Session->write('bmsg', $message);
//            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
//        }
////        $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestmentCert'));
//    }

    function newInvestmentCert() {
        
    }

    public function statementActiveInv() {
        /* $this->__validateUserType(); */
        $issued = $this->Session->check('userData');
        if ($issued) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
    }

    public function statementAllInv() {
        /* $this->__validateUserType(); */

        $issued = $this->Session->check('userData');
        if ($issued) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
    }

    public function statementInvDetail($invesmentID = null, $investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        if (!is_null($invesmentID)) {
            $data = $this->InvestmentStatement->find('all', array('conditions' => array('InvestmentStatement.investment_id' => $invesmentID)));
            $issued = $this->Session->check('userData');
            if ($issued) {
                $issued = $this->Session->read('userData');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data2 = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));

                if ($data2) {
                    $this->set('data2', $data2);
                }
                $this->set('data', $data);
                $this->set('investor_id', $investor_id);
                $this->set('invesmentID', $invesmentID);
                $this->set('investor_name', $investor_name);
            } else {

                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
        }
    }

    public function payments() {
        /* $this->__validateUserType(); */
    }

    function terminateFixedInvestment($reinvestmt_id = null, $reinvestor_id = null) {
        /* $this->__validateUserType(); */
        $data = $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestmt_id]]);
        if ($data) {
            $this->set('data', $data);
        }
        $this->set('reinvestorcashaccounts', $this->ReinvestorCashaccount->find('first', ['conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
        $this->set('invdestproducts', $this->InvDestProduct->find('list'));

        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list', []));

        $check = $this->Session->check('variabless_terminated');
        if ($check) {
            $check = $this->Session->check('variabless_terminated.receivedamt');
            if ($check) {
                $this->set('receivedamt', $this->Session->read('variabless_terminated.receivedamt'));
            }
            $check = $this->Session->check('variabless_terminated.expected_interest');
            if ($check) {
                $this->set('expected_interest', $this->Session->read('variabless_terminated.expected_interest'));
            }
            $check = $this->Session->check('variabless_terminated.expecteddue');
            if ($check) {
                $this->set('expecteddue', $this->Session->read('variabless_terminated.expecteddue'));
            }
            $check = $this->Session->check('variabless_terminated.penalty');
            if ($check) {
                $this->set('penalty', $this->Session->read('variabless_terminated.penalty'));
            }
            $this->Session->delete('variabless_terminated');
        }
    }

    public function processTermination() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {

                $investment_id = $this->request->data['Reinvestment']['id'];
                $investor_id = $this->request->data['Reinvestment']['reinvestor_id'];
                $penalty = $this->request->data['Reinvestment']['penalty'];
                $received_amt = $this->request->data['Reinvestment']['investment_amount'];
                $userid = null;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
                $inv_day = $this->request->data['Reinvestment']['investment_date']['day'];
                if (!empty($inv_day)) {
                    $inv_month = $this->request->data['Reinvestment']['investment_date']['month'];
                    $inv_year = $this->request->data['Reinvestment']['investment_date']['year'];
                    $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                    $sinv_date = strtotime($finv_date);
                    $date = date('Y-m-d', $sinv_date);
                    $termdate = date('Y-m-d', $sinv_date);
                } else {
                    $date = date('Y-m-d');
                }
                if ($this->Session->check('reinvesttemp') == true) {
                    $this->Session->delete('reinvesttemp');
                }
                if ($this->request->data['Reinvestment']['cashreceiptmode_id'] == "2" && ($this->request->data['Reinvestment']['cheque_nos'] == "" || $this->request->data['Reinvestment']['cheque_nos'] == null )) {
                    $message = 'Please Supply a Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'terminateFixedInvestment', $investment_id, $investor_id));
                }
                $cheque_numbers = "";
                if (isset($this->request->data['Reinvestment']['cheque_nos'])) {
                    if ($this->request->data['Reinvestment']['cheque_nos'] != "" || $this->request->data['Reinvestment']['cheque_nos'] != null) {
                        $cheque_numbers = $this->request->data['Reinvestment']['cheque_nos'];
                    }
                }

                $data = $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $investment_id]]);
                
                
                if ($data) {
                   $ledger_data = $this->ReinvestorCashaccount->find('first', ['conditions' =>
                        ['ReinvestorCashaccount.reinvestor_id' => $investor_id]]); 

                    $to_date = new DateTime($date);
                    $period = $data['Reinvestment']['investment_period'];
                    $first_date = $data['Reinvestment']['investment_date'];
                    $inv_date = new DateTime($first_date);


                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
                    $custom_rate = $data['Reinvestment']['interest_rate'] - $penalty;
                    $investment_amount = $data['Reinvestment']['investment_amount'];

                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1D'));
                                $interest_amount2 = $interest_amount1 * (1 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $userid,
                                    'reinvestor_id' => $this->request->data['Reinvestment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                                $principal = $total;
                            }

                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            //$YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1D'));
                                $interest_amount2 = $interest_amount1 * (365 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $userid,
                                    'reinvestor_id' => $this->request->data['Reinvestment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $payment_status = "unpaid";
                    if (isset($received_amt) && $received_amt >= $amount_due) {
                        $payment_status = "paid";
                    } elseif (isset($received_amt) && $received_amt < $amount_due && $received_amt > 0) {
                        $payment_status = "part_payment";
                    }
                    $amount_due2 = $amount_due - $received_amt;
                    $update_array = array('id' => $investment_id, 'earned_balance' => $amount_due2,
                        'interest_earned' => $interest_amount, 'penalty' => $penalty, 'total_amount_earned' => $amount_due2, 'duration' => $duration,
                        'status' => "Terminated", 'payment_status' => $payment_status);
                    if ($ledger_data) {
                        $cash_athand = $ledger_data['ReinvestorCashaccount']['fixed_inv_returns'];
                        $new_cashathand = $cash_athand + $received_amt;
                        $cledger_id = $ledger_data['ReinvestorCashaccount']['id'];

                        $grand_total = $reinvestment_data['ReinvestorCashaccount']['total_balance'] - $amount;
                        $client_ledger = array('id' => $cledger_id, 'fixed_inv_returns' => $new_cashathand, 'total_balance' => $grand_total);
                    }
                    $return_array = array('user_id' => $userid, 'reinvestment_id' => $investment_id,
                        'principal' => $investment_amount, 'rate' => $custom_rate, 'returns' => $received_amt, 'interest' => $interest_amount,
                        'penalty' => $penalty, 'return_type' => 'Terminated', 'date' => $termdate, 'cheque_nos' => $cheque_numbers,
                        'cash_receipt_mode_id' => $this->request->data['Reinvestment']['cashreceiptmode_id']);
                    $check = $this->Session->check('cashaccts');
                    if ($check) {
                        $this->Session->delete('cashaccts');
                    }
                    $check = $this->Session->check('ter_array_refixed');
                    if ($check) {
                        $this->Session->delete('ter_array_refixed');
                    }
                    $check = $this->Session->check('return_data');
                    if ($check) {
                        $this->Session->delete('return_data');
                    }
                    $this->Session->write('ter_array_refixed', $update_array);
                    $this->Session->write('cashaccts', $client_ledger);
                    $this->Session->write('return_data', $return_array);
                    $check = $this->Session->check('variabless_terminated');
                    if ($check) {
                        $this->Session->delete('variabless_terminated');
                    }

                    $variables = array('receivedamt' => $received_amt, 'expected_interest' => $interest_amount,
                        'expecteddue' => $amount_due, 'penalty' => $penalty);
                    $this->Session->write('variabless_terminated', $variables);


                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'terminateFixedInvestment', $investment_id, $investor_id));
                } else {
                    $message = 'Termination request processing failure. Try again';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reinvestments', 'action' => 'terminateFixedInvestment', $investment_id, $investor_id));
                }
            }
        }
    }

    public function rollover($reinvestment_id = null, $reinvestor_id = null) {
        /* $this->__validateUserType(); */
        $this->set('reinvestorcashaccounts', $this->ReinvestorCashaccount->find('first', ['conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
        $this->set('invdestproducts', $this->InvDestProduct->find('list'));


        if (!is_null($reinvestment_id) && !is_null($reinvestor_id)) {
            $this->set('data', $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]));
        } else {
            $message = 'Invalid Selection Made. Try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
        }
    }
    public function topup($reinvestment_id = null, $reinvestor_id = null) {
        /* $this->__validateUserType(); */
        $this->set('reinvestorcashaccounts', $this->ReinvestorCashaccount->find('first', ['conditions' => ['ReinvestorCashaccount.reinvestor_id' => $reinvestor_id]]));
        $this->set('investmentdestinations', $this->InvestmentDestination->find('list'));
        $this->set('invdestproducts', $this->InvDestProduct->find('list'));
          $this->set('paymentmodes', $this->PaymentMode->find('list'));

        if (!is_null($reinvestment_id) && !is_null($reinvestor_id)) {
            $this->set('data', $this->Reinvestment->find('first', ['conditions' => ['Reinvestment.id' => $reinvestment_id]]));
        } else {
            $message = 'Invalid Selection Made. Try again.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reinvestments', 'action' => 'manageInvFixed', $reinvestor_id));
        }
    }
    
    function delFixedInvestmentDeposits($reinvestor_id = null, $reinvestment_id = null){
        $this->__validateUserType();
        $this->set('reinvestor_id', $reinvestor_id);
        $this->set('reinvestment_id', $reinvestment_id);
        $investor = $this->Reinvestor->find('first', array('conditions' => array('Reinvestor.id' => $reinvestor_id)));
        $this->set('investor_name', $investor['Reinvestor']['company_name']);
        
        $data2 = $this->paginate('ReinvestorDeposit', array('ReinvestorDeposit.reinvestment_id' => $reinvestment_id));
        $this->set('data', $data2);        
        
    }
    
    function delFixedInvestmentPayments($investor_id = null, $investment_id = null){
        $this->__validateUserType();
        $this->set('investor_id', $investor_id);
        $this->set('investment_id', $investment_id);
        $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        $this->set('investor_name', $investor['Investor']['fullname']);
        
        $data2 = $this->paginate('InvestmentPayment', array('InvestmentPayment.investment_id' => $investment_id));
        $this->set('data', $data2);        
        
    }

}

?>
