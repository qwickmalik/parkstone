<?php

/* CakePlugin::load('Uploader');
  App::import('Vendor', 'Uploader.Uploader');
 */

class InvestmentsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Investments';
    var $uses = array('Investment', 'Investor', 'InvestorType', 'InvestmentPayment', 'Currency', 'Marriage', 'Idtype', 'Zone', 'User', 'CustomerCategory', 'Portfolio', 'Rollover', 'InvestmentStatement', 'GrossIncome', 'InvestmentTerm', 'PaymentSchedule', 'PaymentMode', 'InvestmentProduct', 'Instruction');
    var $paginate = array(
        'Investment' => array('limit' => 50, 'order' => array('Investment.id' => 'asc'), 'group' => array('Investment.investor_id')),
            'Investor' => array('limit' => 50, 'order' => array('Investor.id' => 'asc'))
    );

    /*
      function beforeFilter() {
      $this->__validateLoginStatus();
      $this->Uploader = new Uploader(array('tempDir' => TMP));
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
      if ($userType != 1) {
      $this->redirect('/Information/');
      }
      }
     */

    function index() {
        
    }

    function newInvestor() {
        /*        $this->__validateUserType(); */

        // $this->set('marriages', $this->Marriage->find('list'));
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('customercategories', $this->CustomerCategory->find('list'));
        // $this->set('zones', $this->Zone->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    function newInvestorIndiv() {
        /*        $this->__validateUserType(); */
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
    }
function newInvestorJoint() {
        /*        $this->__validateUserType(); */
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
    }
    function newInvestorComp() {
        /*        $this->__validateUserType(); */

        // $this->set('marriages', $this->Marriage->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
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
        $this->autoRender = false;
        if ($this->request->is('post')) {

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
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');

            if ($this->request->data['Investor']['other_names'] == "" || $this->request->data['Investor']['other_names'] == null) {
                $message = 'Please Supply The Investor\'s Other Names';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['surname'] == "" || $this->request->data['Investor']['surname'] == null) {
                $message = 'Please Supply The Investor\'s Surname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
            $fullname = $this->request->data['Investor']['other_names'] . " " . $this->request->data['Investor']['surname'];

            if ($this->request->data['Investor']['idtype_id'] == "" || $this->request->data['Investor']['idtype_id'] == null) {
                $message = 'Please Supply The Investor\'s ID-Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['id_number'] == "" || $this->request->data['Investor']['id_number'] == null) {
                $message = 'Please Supply The Investor\'s Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['nationality'] == "" || $this->request->data['Investor']['nationality'] == null) {
                $message = 'Please Supply The Investor\'s Nationality';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
//            
//            if ($this->request->data['Investor']['next_of_kin_name'] == "" || $this->request->data['Investor']['next_of_kin_name'] == null) {
//                $message = 'Please Supply The Investor\'s Next of Kin\'s Name';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
//
//            if ($this->request->data['Investor']['nk_relationship'] == "" || $this->request->data['Investor']['nk_relationship'] == null) {
//                $message = 'Please Supply The Investor\'s NK Relationship';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
//            if ($this->request->data['Investor']['nk_postal_address'] == "" || $this->request->data['Investor']['nk_postal_address'] == null) {
//                $message = 'Please Supply The Investor\'s NK Postal Address';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
//            if ($this->request->data['Investor']['nk_email'] == "" || $this->request->data['Investor']['nk_email'] == null) {
//                $message = 'Please Supply The Investor\'s NK Email';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
//
//
//            if ($this->request->data['Investor']['nk_phone'] == "" || $this->request->data['Investor']['nk_phone'] == null) {
//                $message = 'Please Supply The Investor\'s NK Phone Number';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
//            
//             if ($this->request->data['Investor']['nk_phone'] == "" || $this->request->data['Investor']['nk_phone'] == null) {
//                $message = 'Please Supply The Investor\'s NK Phone Number';
//                $this->Session->write('emsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
//            }
            /*             if ($this->request->data['Investor']['landmark'] == "" || $this->request->data['Investor']['landmark'] == null) {
              $message = 'Please Supply A Landmark for Investor\'s House';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
              }
              if ($this->request->data['Investor']['house_no'] == "" || $this->request->data['Investor']['house_no'] == null) {
              $message = 'Please Supply The Investor\'s House Number';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
              }

              if ($this->request->data['Investor']['area'] == "" || $this->request->data['Investor']['area'] == null) {
              $message = 'Please Supply The Investor\'s Area/Locality';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
              }
              if ($this->request->data['Investor']['city'] == "" || $this->request->data['Investor']['city'] == null) {
              $message = 'Please Supply The Investor\'s City';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
              } */

            $this->request->data['Investor']['fullname'] = $fullname;
            $this->request->data['Investor']['dob'] = $dob_date;
             $this->request->data['Investor']['id_issue'] = $issue_date;
              $this->request->data['Investor']['id_expiry'] = $expiry_date;
            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['surname'] . "_" . "photo" . "_" . $dob_date;
            //  $this->request->data['Investor']['customer_category_id'] = $this->request->data['Investor']['customercategory_id'];
//                  $signature = $this->request->data['Investor']['customer_signature'];
//                  $guarantor_sig = $this->request->data['Investor']['guarantor_signature'];

            if ($data = $this->Uploader->upload('investor_photo', array('overwrite' => true, 'name' => $photo))) {
                $this->request->data['Investor']['investor_photo'] = $data['path'];
                // Upload successful, do whatever
            } else {
                $message = 'Please Supply The Investor\'s Picture';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
//	if ($signature == "" || $signature == null) {
//                    $message = 'Please Select Availability of Investor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'index'));
//			// Upload successful, do whatever
//		}
//                
//                if($guarantor_sig == "" || $guarantor_sig == null) {
//                    $message = 'Please Select Availability of Guarantor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'index'));
//			// Upload successful, do whatever
//		}
            $userType = $this->Session->check('userDetails.usertype_id');
            if ($userType) {
                $userType = $this->Session->read('userDetails.usertype_id');
                $this->request->data['Investor']['user_id'] = $userType;
            }
            /*             if ($this->request->data['Investor']['user_id'] == "" || $this->request->data['Investor']['user_id'] == null) {
              $message = 'Please Assign a Sales Person';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
              } */

            // debug($data);
            // pr($this->request->data);
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
                $this->redirect(array('controller' => 'Investments', 'action' => 'listInvestor'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
        }
    }

    function listInvestor() {
        /*        $this->__validateUserType(); */
        $data = $this->paginate('Investor');
        $this->set('investor', $data);

        $check = $this->Session->check('int');
        if ($check) {
            $cust = $this->Session->read('int');
//            pr($cust);
            $this->set('int', $cust);
            $this->Session->delete('int');
        }
        $check = $this->Session->check('ints');
        if ($check) {
            $cust = $this->Session->read('ints');
            $this->set('investor', $cust);
            $this->Session->delete('ints');
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

    function investorDetails($investor_id = null) {
        /*        $this->__validateUserType(); */
        $this->paginate('Investor');
        $data = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        if ($data) {
            $this->set('investor', $data);
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => "Investments", 'action' => "clearSessions"));
        }
    }

    function editInvestor($investor_id = null) {
        /* $this->__validateUserType(); */
        $this->paginate('Investor');
        $data = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        if ($data) {
            $this->set('investor', $data);
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => "Investments", 'action' => "listInvestor"));
        }
        $this->set('investor', $data);
        $userType3 = $this->Session->read('userDetails.usertype_id');
        $prevent = 0;
        if ($userType3 == 3) {
            $prevent = 1;
        } else {
            $prevent = 0;
        }
        $this->set('prevent', $prevent);
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    public function edit() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $id = $this->request->data['Investor']['id'];
            $dob_day = $this->request->data['Investor']['dob']['day'];
            $dob_month = $this->request->data['Investor']['dob']['month'];
            $dob_year = $this->request->data['Investor']['dob']['year'];
//            $registration_day = $this->request->data['Investor']['registration_date']['day'];
//            $registration_month = $this->request->data['Investor']['registration_date']['month'];
//            $registration_year = $this->request->data['Investor']['registration_date']['year'];

            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));
            if ($dob == date('Y-m-d')) {
                $message = 'Please Supply The Investor\'s Date of Birth';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'editInvestor', $id));
            }
            // $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');


            if ($this->request->data['Investor']['other_names'] == "" || $this->request->data['Investor']['other_names'] == null) {
                $message = 'Please Supply The Investor\'s Other Names';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['surname'] == "" || $this->request->data['Investor']['surname'] == null) {
                $message = 'Please Supply The Investor\'s Surname';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
            $fullname = $this->request->data['Investor']['other_names'] . " " . $this->request->data['Investor']['surname'];

            if ($this->request->data['Investor']['idtype_id'] == "" || $this->request->data['Investor']['idtype_id'] == null) {
                $message = 'Please Supply The Investor\'s ID-Type';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['id_number'] == "" || $this->request->data['Investor']['id_number'] == null) {
                $message = 'Please Supply The Investor\'s Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
            if ($this->request->data['Investor']['next_of_kin_name'] == "" || $this->request->data['Investor']['next_of_kin_name'] == null) {
                $message = 'Please Supply The Investor\'s Next of Kin\'s Name';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }

            if ($this->request->data['Investor']['nk_relationship'] == "" || $this->request->data['Investor']['nk_relationship'] == null) {
                $message = 'Please Supply The Investor\'s NK Relationship';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
            if ($this->request->data['Investor']['nk_postal_address'] == "" || $this->request->data['Investor']['nk_postal_address'] == null) {
                $message = 'Please Supply The Investor\'s NK Postal Address';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
            if ($this->request->data['Investor']['nk_email'] == "" || $this->request->data['Investor']['nk_email'] == null) {
                $message = 'Please Supply The Investor\'s NK Email';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }


            if ($this->request->data['Investor']['nk_phone'] == "" || $this->request->data['Investor']['nk_phone'] == null) {
                $message = 'Please Supply The Investor\'s NK Phone Number';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestor'));
            }
//             if($this->request->data['Investor']['guarantor_name'] == "" || $this->request->data['Investor']['guarantor_name'] == null){
//                $message = 'Please Supply The Guarantor\'s Name';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'editInvestor',$id));
//            }
//             if($this->request->data['Investor']['guarantor_no'] == "" || $this->request->data['Investor']['guarantor_no'] == null){
//                $message = 'Please Supply The Guarantor\'s Phone Number';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'editInvestor',$id));
//            }
            $this->request->data['Investor']['fullname'] = $fullname;
            $this->request->data['Investor']['customer_category_id'] = $this->request->data['Investor']['customercategory_id'];
            $this->request->data['Investor']['dob'] = $dob_date;
            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['surname'] . "_" . "photo" . "_" . $dob_date;
            $signature = '';
            $guarantor_sig = '';
            $cust_photo = '';
            /*             if (isset($this->request->data['Investor']['investor_signature'])) {
              $signature = $this->request->data['Investor']['investor_signature'];
              }
              if (isset($this->request->data['hiddenphoto'])) {
              $cust_photo = $this->request->data['hiddenphoto'];
              }
             */
            /*             if ($data = $this->Uploader->upload('investor_photo', array('overwrite' => true, 'name' => $photo))) {
              $this->request->data['Investor']['investor_photo'] = $data['path'];
              // Upload successful, do whatever
              } elseif ($cust_photo != '') {
              $this->request->data['Investor']['investor_photo'] = $cust_photo;
              } else {
              $message = 'Please Supply The Investor\'s Picture';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'editInvestor', $id));
              } */
//	if ($signature == "" || $signature == null) {
//                    $message = 'Please Select Availability of Investor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'index'));
//			// Upload successful, do whatever
//		}
//                
//                if($guarantor_sig == "" || $guarantor_sig == null) {
//                    $message = 'Please Select Availability of Guarantor\'s Signature';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Investments','action' => 'index'));
//			// Upload successful, do whatever
//		}

            if (isset($this->request->data['userIdentify'])) {
                $this->request->data['Investor']['user_id'] = $this->request->data['userIdentify'];
            }
            /* /* 
              if (isset($this->request->data['Investor']['user_id'])) {
              if ($this->request->data['Investor']['user_id'] == "" || $this->request->data['Investor']['user_id'] == null) {
              $message = 'Please Assign a Sales Person';
              $this->Session->write('emsg', $message);
              $this->redirect(array('controller' => 'Investments', 'action' => 'editInvestor', $id));
              }
              } */
            // debug($data);
            // pr($this->request->data);
            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {

                $message = 'Investor Edit Successful';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'clearSessions'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'editInvestor', $id));
            }
        }
    }

    function deleteInvestor() {
        /* $this->__validateUserType(); */
        $data = $this->paginate('Investor');
        $this->set('investor', $data);

        $check = $this->Session->check('int');
        if ($check) {
            $cust = $this->Session->read('int');
//            pr($cust);
            $this->set('int', $cust);
        }
        $check = $this->Session->check('ints');
        if ($check) {
            $cust = $this->Session->read('ints');
            $this->set('investor', $cust);
        }
    }

    public function delInvestor($investor = Null) {
        $this->autoRender = false;

        $order_status = array('id' => $investor, 'status' => 'Deleted');
        $result = $this->Investor->delete($investor);

        if ($result) {
            $message = 'Deleted Investor Details Successfully';
            $this->Session->write('smsg', $message);

            $check = $this->Session->check('int');
            if ($check) {
                $this->Session->delete('int');
            }

            $check = $this->Session->check('ints');
            if ($check) {
                $this->Session->delete('ints');
            }
        } else {
            $message = 'Unable to Delete Investor Details';
            $this->Session->write('bmsg', $message);
        }
        $this->redirect(array('controller' => "Investments", 'action' => "deleteInvestor"));
    }

	function newInvestment0(){
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
	}
    function newInvestment1() {
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

    function newInvestmentCert() {
        /* $this->__validateUserType(); */

        $investment_array = $this->Session->check('investment_array');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array');


            $result = $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;
            if ($result) {

                $investment_number = 'PARKST-INV-00' . $investment_id;
                $this->set('investment_number', $investment_number);
                $date = date('Y-m-d H:i:s');




                $rollover_details = $this->Session->check('rollover_details');
                if ($rollover_details) {
                    $rollover_details = $this->Session->read('rollover_details');
                    $this->Rollover->save($rollover_details);
                    $this->set('rollover_details', $rollover_details);
                    $this->Session->delete('rollover_details');

                    $statemt_array = $this->Session->check('statemt_array');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array');

                        $this->InvestmentStatement->saveAll($statemt_array);
                        $this->Session->delete('statemt_array');
                    }
                } else {
                    $statemt_array = $this->Session->check('statemt_array');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array');


                        foreach ($statemt_array as $key => $val) {
                            $val['investment_id'] = $investment_id;

                            $this->InvestmentStatement->create();
                            $this->InvestmentStatement->save($val);
                        }
                        $this->Session->delete('statemt_array');
                    }

                    $this->request->data = null;
                    $investment_updates = array('id' => $investment_id, 'investment_no' => $investment_number);
                    $this->Investment->save($investment_updates);
                }
                $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
                if ($data) {
                    $this->set('investment_array', $data);

                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }

                $this->Session->delete('investment_array');
                $this->Session->delete('variabless');
            } else {
                $message = "Sorry No Investment To Display";
                $this->Session->write('bmsg', $message);
                $this->redirect('/Investments/');
            }
        } else {
            $message = "Sorry No Investment To Display";
            $this->Session->write('bmsg', $message);
            $this->redirect('/Investments/');
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

    function manageClientInvestments($investor_id = null, $investor_name = null) {
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