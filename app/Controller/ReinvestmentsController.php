<?php

CakePlugin::load('Uploader');
App::import('Vendor', 'Uploader.Uploader');

class ReinvestmentsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Reinvestments';
    var $uses = array('Reinvestment', 'Reinvestor', 'ReinvestorDeposit', 'Investee', 'Currency',
        'InvestmentProduct', 'PaymentMode', 'PaymentSchedule', 'InvestmentTerm', 'InvestmentCash', 'InvestmentDestination', 'InvDestProduct');
    var $paginate = array(
        'Reinvestor' => array('limit' => 50, 'order' => array('Reinvestor.company_name' => 'asc')),
        'ReinvestorDeposit' => array('limit' => 50, 'order' => array('ReinvestorDeposit.id' => 'asc')),
    );

//    var $helpers = array('AjaxMultiUpload.Upload');

    function beforeFilter() {
        //$this->__validateLoginStatus();
        $this->Uploader = new Uploader(array('tempDir' => TMP, 'ajaxField' => "qqfile"));
    }

    /*
      function __validateLoginStatus() {
      if ($this->action != 'login' && $this->action != 'logout') {
      if ($this->Session->check('userData') == false) {
      $this->redirect('/');
      }
      }
      }

      function __validateUserType() {

      $userType = $this->Session->read('userDetails.usertype_id');
      if ($userType != 1) {
      $this->redirect('/Information/');
      }
      }
     */

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
            $userid = null;
            $fixed_inv_amount = $this->request->data['InvestmentCash']['fixed_inv_amount'];
            $equity_inv_amount = $this->request->data['InvestmentCash']['equity_inv_amount'];
            $paymentmodeid = $this->request->data['InvestmentCash']['paymentmode_id'];
            $payment_mode = $this->PaymentMode->find('first',array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
            if($payment_mode){
                $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
            }
            $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }
            $date = $this->request->data['InvestmentCash']['investment_date']['year'] . "-" . $this->request->data['InvestmentCash']['investment_date']['month'] . "-" . $this->request->data['InvestmentCash']['investment_date']['day'];
           $reinvestorDeposit_data = array('reinvestor_id' => $reinvestorid,'investment_product_id' => $investment_type,
                        'currency_id' => $this->request->data['InvestmentCash']['currency_id'],
               'payment_mode_id' => $paymentmodeid,'investment_date' => $date,'fixed_inv_amount' => $fixed_inv_amount,
                        'equity_inv_amount' => $equity_inv_amount,'notes' => $this->request->data['InvestmentCash']['notes']
                   ,'user_id' => $userid);
           $result_deposit = $this->ReinvestorDeposit->save($reinvestorDeposit_data);
           if($result_deposit){
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
                    
                    $cash_depositarray = array('reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                        $this->request->data['InvestmentCash']['currency_id'],
                        'amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                        'investment_type' => 'fixed', 'investment_date' => $date,'payment_mode' => $payment_name);
                    $result = $this->InvestmentCash->save($cash_depositarray);
                    if ($result) {
                        
                        $message = 'Cash Deposit successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert','fixed',$result['InvestmentCash']['id']));
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
                    $cash_depositarray = array('reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                        $this->request->data['InvestmentCash']['currency_id'],
                        'amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                        'investment_type' => 'equity', 'investment_date' => $date,'payment_mode' => $payment_name);

                    $result = $this->InvestmentCash->save($cash_depositarray);
                    if ($result) {
                        $message = 'Cash Deposit successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert','equity',$result['InvestmentCash']['id']));
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
                    $cash_depositarray_equity = array('reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                        $this->request->data['InvestmentCash']['currency_id'],
                        'amount' => $this->request->data['InvestmentCash']['equity_inv_amount'],
                        'investment_type' => 'equity', 'investment_date' => $date,'payment_mode' => $payment_name);
                    $this->InvestmentCash->create();
                    $result_equity = $this->InvestmentCash->save($cash_depositarray_equity);

                    $cash_depositarray_fixed = array('reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['InvestmentCash']['user_id'], 'currency_id' =>
                        $this->request->data['InvestmentCash']['currency_id'],
                        'amount' => $this->request->data['InvestmentCash']['fixed_inv_amount'],
                        'investment_type' => 'fixed', 'investment_date' => $date,'payment_mode' => $payment_name);
                     $this->InvestmentCash->create();
                    $result_fixed = $this->InvestmentCash->save($cash_depositarray_fixed);
                    
                    if ($result_equity && $result_fixed) {
                        $message = 'Cash Deposit successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newDepositCert','both',$result_equity['InvestmentCash']['id'],$result_fixed['InvestmentCash']['id']));
                    } else {

                        $message = 'Error adding Cash Deposit details. Please try again.';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'newCashDeposit2', $reinvestorid));
                    }
                    break;
            }
        }else{
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
            $data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true, 'name' => $photo));
            return json_encode($data);
            if ($data) {

                $this->request->data['Investor']['investor_photo'] = $data['path'];
//                header('Content-Type: application/json');
                // Upload successful, do whatever
            } else {
                $message = 'Please Supply The Investor\'s Picture';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

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

    function newDepositCert($product_type = null,$fixed_id = null,$equity_id = null) {
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
        if($check){
        $this->Session->delete('newCashDeposit');
        }
        switch ($product_type){
            case null:
            $message = 'Invalid product type selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Reivestments', 'action' => 'newCashDeposit'));
                break;
            case 'fixed':
                $data_fixed = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.id'=> $fixed_id)));
               if($data_fixed){
                   $company_name = $data_fixed['Reinvestor']['company_name'];
                   $date = date('d F, Y',strtotime($data_fixed['InvestmentCash']['investment_date']));
                   $payment_mode = $data_fixed['InvestmentCash']['payment_mode'];
                   $total_invested = $data_fixed['InvestmentCash']['amount'];
               }
                break;
            case 'equity':
                $data_equity = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.id'=> $equity_id)));
                if($data_equity){
                   $company_name = $data_equity['Reinvestor']['company_name'];
                   $date = date('d F, Y',strtotime($data_equity['InvestmentCash']['investment_date']));
                   $payment_mode = $data_equity['InvestmentCash']['payment_mode'];
                   $total_invested = $data_equity['InvestmentCash']['amount'];
               }
                break;
            case 'both':
                
                $data_fixed = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.id'=> $fixed_id)));
                $data_equity = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.id'=> $equity_id)));
               if($data_equity){
                   $company_name = $data_equity['Reinvestor']['company_name'];
                   $date = date('d F, Y',strtotime($data_equity['InvestmentCash']['investment_date']));
                   $payment_mode = $data_equity['InvestmentCash']['payment_mode'];
                   $total_equity_invested = $data_equity['InvestmentCash']['amount'];
               }
               if($data_fixed){
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
         $this->set(compact('issued','product_type','data_fixed','data_equity','company_name','payment_mode','date','total_invested'));
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
        if(($this->request->is('post'))){
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
            $payment_mode = $this->PaymentMode->find('first',array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
           
            if($payment_mode){
                $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
            }
            $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }
            $date = $this->request->data['ReinvestorDeposit']['investment_date']['year'] . "-" . $this->request->data['ReinvestorDeposit']['investment_date']['month'] . "-" . $this->request->data['ReinvestorDeposit']['investment_date']['day'];
           $reinvestorDeposit_data = array('id' =>$deposit_id,'reinvestor_id' => $reinvestorid,
                        'currency_id' => $this->request->data['ReinvestorDeposit']['currency_id'],
               'payment_mode_id' => $paymentmodeid,'investment_date' => $date,'fixed_inv_amount' => $fixed_inv_amount,
                        'equity_inv_amount' => $equity_inv_amount,'notes' => $this->request->data['ReinvestorDeposit']['notes']
                   ,'user_id' => $userid);
           $result_deposit = $this->ReinvestorDeposit->save($reinvestorDeposit_data);
           if($result_deposit){
               
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
                    $fixed_data = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id,'InvestmentCash.investment_type' => 'fixed')));
                    if($fixed_data){
                        $investmentcash_id = $fixed_data['InvestmentCash']['id'];
                        
                        $cash_depositarray = array('id' => $investmentcash_id,'reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 
                            'user_id' => $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                        $this->request->data['ReinvestorDeposit']['currency_id'],
                        'amount' => $this->request->data['ReinvestorDeposit']['fixed_inv_amount'],
                         'investment_date' => $date,'payment_mode' => $payment_name);
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
                    }else {

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
                     $fixed_data = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id,'InvestmentCash.investment_type' => 'equity')));
                    if($fixed_data){
                        $investmentcash_id = $fixed_data['InvestmentCash']['id'];
                        
                    $cash_depositarray = array('id' =>$investmentcash_id,'reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                        $this->request->data['ReinvestorDeposit']['currency_id'],
                        'amount' => $this->request->data['ReinvestorDeposit']['equity_inv_amount'],
                         'investment_date' => $date,'payment_mode' => $payment_name);

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
                    $equity_data = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id,'InvestmentCash.investment_type' => 'equity')));
                    if($equity_data){
                        $investmentcash_id = $equity_data['InvestmentCash']['id'];
                        
                    $cash_depositarray_equity = array('id' => $investmentcash_id,'reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['ReinvestorDeposit']['user_id'], 
                        'currency_id' => $this->request->data['ReinvestorDeposit']['currency_id'],
                        'amount' => $this->request->data['ReinvestorDeposit']['equity_inv_amount'],
                         'investment_date' => $date,'payment_mode' => $payment_name);
                    
                    $result_equity = $this->InvestmentCash->save($cash_depositarray_equity);
                    }
                    
                    $fixed_data = $this->InvestmentCash->find('first',array('conditions' => array('InvestmentCash.reinvestor_deposit_id' => $deposit_id,'InvestmentCash.investment_type' => 'fixed')));
                    if($fixed_data){
                        $investmentcash_id = $fixed_data['InvestmentCash']['id'];
                        
                    $cash_depositarray_fixed = array('id' => $investmentcash_id,'reinvestor_deposit_id' => $deposit_id,'reinvestor_id' => $reinvestorid, 'user_id' =>
                        $this->request->data['ReinvestorDeposit']['user_id'], 'currency_id' =>
                        $this->request->data['ReinvestorDeposit']['currency_id'],
                        'amount' => $this->request->data['ReinvestorDeposit']['fixed_inv_amount'],
                         'investment_date' => $date,'payment_mode' => $payment_name);
                     
                    $result_fixed = $this->InvestmentCash->save($cash_depositarray_fixed);
                    }
                    if(isset($result_equity) && isset($result_fixed)){
                    if ($result_equity && $result_fixed) {
                        $message = 'Cash Deposit successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'listCashDeposits'));
                    } else {

                        $message = 'Error editing Cash Deposit details. Please try again.';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                    }
                    }else {

                        $message = 'Error editing Cash Deposit details. Please try again.';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                    }
                    break;
            }
        }else{
               $message = 'Error adding Cash Deposit details. Please try again.';
               $this->Session->write('emsg', $message);
               $this->redirect(array('controller' => 'Reinvestments', 'action' => 'editCashDeposit', $deposit_id));
                    
        }
        }
         $data = $this->ReinvestorDeposit->find('first',array('conditions' => array('ReinvestorDeposit.id' =>
             $deposit_id)));
         
         if($data){
             $this->set('data',$data);
         }else{   
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
    
    function invDestProduct() {
        // $this->__validateUserType();
        $data = $this->paginate('InvDestProduct');
        $this->set('invdestproducts', $this->InvDestProduct->find('list'));
        $this->set('data', $data);

        $setupResults = $this->InvDestProduct->getCompanies();

        $this->set(compact('setupResults'));
    }

    function addInvDestProduct() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
//            Configure::write('debug', 0);

            if (!empty($this->request->data)) {
                $this->Session->write('InvDestProduct', $this->request->data['InvDesProduct']);
                
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
    
    function newInvestment0() {
        //$this->set('idtypes', $this->Idtype->find('list'));
        //$this->set('investortypes', $this->InvestorType->find('list'));
        //$this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    function newInvestment() {
        /* $this->__validateUserType(); 
          $data = $this->paginate('Investor');
          $this->set('investor', $data); */
        $this->set('reinvestors', $this->Reinvestor->find('list'));
        $this->set('investees', $this->Investee->find('list'));
        $check = $this->Session->check('ivt');
        if ($check) {
            $cust = $this->Session->read('ivt');

            $this->set('int', $cust);
        }
        $check = $this->Session->check('ivts');
        if ($check) {
            $cust = $this->Session->read('ivts');
            $this->set('investor', $cust);
            $this->Session->delete('ivts');
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

    function newInvestment1Joint() {
        /* $this->__validateUserType(); */
        $data = $this->paginate('Investor');
        $this->set('investor', $data);

        $check = $this->Session->check('ivt');
        if ($check) {
            $cust = $this->Session->read('ivt');
//            pr($cust);
            $this->set('int', $cust);
            //$this->Session->delete('ivt');
        }
        $check = $this->Session->check('ivts');
        if ($check) {
            $cust = $this->Session->read('ivts');
            $this->set('investor', $cust);
            $this->Session->delete('ivts');
        }
    }

    function newInvestment2() {
        /* $this->__validateUserType(); */
        $this->set('portfolios', $this->Portfolio->find('list'));

        $check = $this->Session->check('ivt');
        if ($check) {
            $investor = $this->Session->read('ivt');

            $this->set('investor', $investor);
        } else {
            $message = 'No Investor Selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
        }
        $check = $this->Session->check('variabless');
        if ($check) {
            $this->set('duedate', $this->Session->read('variabless.duedate'));
            $this->set('interest', $this->Session->read('variabless.interest'));
            $this->set('totaldue', $this->Session->read('variabless.totaldue'));
        }
//        $hp_data = array();
//        $hp_data_check = $this->Session->check('hp_data');
//        if ($hp_data_check) {
//            $hp_data = $this->Session->read('hp_data');
//
//            $this->Session->write('order_invoice', $hp_data);
//            $this->set('hp_data', $hp_data);
//            $this->Session->delete('hp_data');
//        }
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

    function manageInvestments() {
        /* $this->__validateUserType(); 

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
          } */
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
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $balance;
            $total_paid;
            $hp_price;
            $old_total_paid;
            $old_balance;
            $payment;
            $order_id;
            $cheque_numbers = "";
            $new_cheque_numbers = "";
            $payment = 0;
            $investment_id = $_POST['hid_investid'];


            if ($this->request->data['InvestmentPayment']['payment_mode'] == "" || $this->request->data['InvestmentPayment']['payment_mode'] == null) {
                $message = 'Please Select A Mode of Payment.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investment_id));
            }

            if ($this->request->data['InvestmentPayment']['payment_mode'] == "Post-dated chq" && ($this->request->data['InvestmentPayment']['cheque_nos'] == "" || $this->request->data['InvestmentPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investment_id));
            }


            if ($this->request->data['InvestmentPayment']['payment_mode'] == "Cheque" && ($this->request->data['InvestmentPayment']['cheque_nos'] == "" || $this->request->data['InvestmentPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investment_id));
            }

            if ($this->request->data['InvestmentPayment']['amount'] == "" || $this->request->data['InvestmentPayment']['amount'] == null || $this->request->data['InvestmentPayment']['amount'] == 0) {
                $message = 'Amount Not Entered.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investment_id));
            }


            if (isset($this->request->data['InvestmentPayment']['cheque_nos'])) {
                if ($this->request->data['InvestmentPayment']['cheque_nos'] != "" || $this->request->data['InvestmentPayment']['cheque_nos'] != null) {
                    $cheque_numbers = $this->request->data['InvestmentPayment']['cheque_nos'];
                }
            }



            $payment_day = $this->request->data['InvestmentPayment']['payment_date']['day'];
            $payment_month = $this->request->data['InvestmentPayment']['payment_date']['month'];
            $payment_year = $this->request->data['InvestmentPayment']['payment_date']['year'];
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

            $payment += $this->request->data['InvestmentPayment']['amount'];
            $sms_amount = $this->request->data['InvestmentPayment']['amount'];
            $payment_mode = $this->request->data['InvestmentPayment']['payment_mode'];

            $balance = 0;
            $total_paid = 0;
            $hp_price = 0;
            $old_total_paid = 0;
            $old_balance = 0;


            $date = date('Y-m-d H:i:s');
            //use id to retrieve Investment info
            $investment_details = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($investment_details) {
                $old_balance = $investment_details['Investment']['balance'];
                $old_total_paid = $investment_details['Investment']['amount_paidout'];
                $amount_due = $investment_details['Investment']['amount_due'];
                $investor = $investment_details['Investment']['investor_id'];
                $investment_no = $investment_details['Investment']['investment_no'];
                $investor_name = $investment_details['Investor']['fullname'];

                $total_paid = $old_total_paid + $payment;
                $balance = $amount_due - $total_paid;
//print_r('balance: '.$balance.'--'.'amount_due: '.$amount_due.'--'.'totalpaid: '.$total_paid);
//exit;

                if ($balance <= 0) {
                    $payment_status = "Paid";
                } elseif ($balance > 0 && $balance < $amount_due) {

                    $payment_status = "Part_payment";
                } elseif ($balance == $amount_due) {

                    $payment_status = "Invested";
                }

                $new_investmentdetails = array('id' => $investment_id, 'balance' => $balance, 'amount_paidout' => $total_paid, 'status' => $payment_status, 'lastpaidout_date' => $payment_date);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
//                      print_r($result);
//            exit;
                    $investment_paymentdetails = array('investment_id' => $investment_id, 'investor_id' => $investor, 'amount' => $payment, 'payment_mode' => $this->request->data['InvestmentPayment']['payment_mode'], 'cheque_nos' => $cheque_numbers, 'payment_date' => $payment_date);
                    $result2 = $this->InvestmentPayment->save($investment_paymentdetails);
                    if ($result2) {

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
                        $this->redirect(array('controller' => 'Investments', 'action' => 'paymentReceipt', $investment_id, $payment));

                        //$this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments',$investor,$investor_name));
                    } else {

                        $message = 'Investment Payout Saved With Errors';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
                    }
                } else {

                    $message = 'Investment Payout Unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageClientInvestments', $investor, $investor_name));
                }
            }
        }
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

    public function rollover($invesmentID = null, $investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        if (!is_null($invesmentID)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
            if ($data) {
                $portfolio_id = $data['Investment']['portfolio_id'];
                $portfolio = $this->Portfolio->find('first', array('conditions' => array('Portfolio.id' => $portfolio_id), 'recursive' => -1));

                if ($portfolio) {
                    $rate = $portfolio['Portfolio']['interest_rate'];
                    $months = $portfolio['Portfolio']['period_months'];
                    $investment_amount = $data['Investment']['amount_due'];
                    $interest_amount1 = ($rate / 100) * $investment_amount;
                    $interest_amount = $interest_amount1 * $months;
                    $amount_due = $interest_amount + $investment_amount;
                    $finv_date = $data['Investment']['due_date'];
                    $sinv_date = strtotime($finv_date);
                    $inv_date = date('Y-m-d', $sinv_date);
                    $first_date = $inv_date;
                    $date = new DateTime($first_date);
                    $date->add(new DateInterval('P' . $months . 'M'));


                    $date_statemt = new DateTime($first_date);
                    $principal = $investment_amount;
                    $statemt_array = array();

                    for ($n = 1; $n <= $months; $n++) {
                        $date_statemt->add(new DateInterval('P1M'));

                        $total = $interest_amount1 + $principal;
                        $statemt_array[] = array('investment_id' => $data['Investment']['id'], 'user_id' => $data['Investment']['user_id'], 'investor_id' => $data['Investment']['investor_id'], 'principal' => $principal, 'interest' => $interest_amount1, 'maturity_date' => $date_statemt->format('Y-m-d'), 'total' => $total);
                        $principal = $total;
                    }

                    $investment_array = array('id' => $data['Investment']['id'], 'interest_earned' => $interest_amount, 'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'), 'status' => 'Rolled_over');

                    $rollover_details = array('user_id' => $data['Investment']['user_id'], 'id' => $data['Investment']['id'], 'investor_id' => $data['Investment']['investor_id'], 'amount' => $investment_amount, 'rollover_date' => $date->format('Y-m-d'));
                    $check = $this->Session->check('variabless');
                    if ($check) {
                        $this->Session->delete('variabless');
                    }

                    $check = $this->Session->check('investment_array');
                    if ($check) {
                        $this->Session->delete('investment_array');
                    }

                    $check = $this->Session->check('rollover_details');
                    if ($check) {
                        $this->Session->delete('rollover_details');
                    }
                    $check = $this->Session->check('statemt_array');
                    if ($check) {
                        $this->Session->delete('statemt_array');
                    }


                    $this->Session->write('statemt_array', $statemt_array);
                    $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                    $this->Session->write('variabless', $variables);
                    $this->Session->write('rollover_details', $rollover_details);
                    $this->Session->write('investment_array', $investment_array);

                    $message = 'Investment details successfully saved';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestmentCert'));
                }
            } else {

                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
        }
//        $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestmentCert'));
    }

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

}

?>
