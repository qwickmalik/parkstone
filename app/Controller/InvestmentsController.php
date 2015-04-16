<?php

CakePlugin::load('Uploader');
App::import('Vendor', 'Uploader.Uploader');

class InvestmentsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Investments';
    var $uses = array('Investment', 'Investor', 'InvestorType', 'InvestmentInvestor', 'InvestmentPayment',
        'Currency', 'Marriage', 'Idtype', 'Zone', 'User', 'CustomerCategory', 'Portfolio', 'Rollover',
        'InvestmentStatement', 'GrossRevenue', 'GrossIncome', 'InvestmentTerm', 'PaymentSchedule',
        'PaymentMode', 'CashReceiptMode', 'InvestmentProduct', 'Instruction', 'InstitutionType', 'Bank', 'EquitiesList',
        'InvestmentCash', 'DailyInterestStatement', 'ClientLedger'/* , 'ReinvestorEquity' */,
        'InvestorEquity', 'LedgerTransaction', 'Topup');
    var $paginate = array(
        'Investment' => array('limit' => 50, 'order' => array('Investment.id' => 'asc'), 'group' => array('Investment.investor_id')),
        'Investor' => array('limit' => 50, 'order' => array('Investor.investor_type_id' => 'asc'),
            'conditions' => array('Investor.approved' => 1))
    );

//var $helpers = array('AjaxMultiUpload.Upload');

    function beforeFilter() {
        // App::uses('Sanitize', 'Utility');
        //$this->__validateLoginStatus();
        $this->Uploader = new Uploader(array('tempDir' => TMP, 'ajaxField' => "qqfile"));
        //   $this->request->data = Sanitize::clean($this->request->data, array('remove_html'=>true,'encode'=>false,'unicode'=>false,'backslash'=>true, 'escape'=>true,'dollar'=> true));
    }

    /*
      function __validateLoginStatus() {
      if ($this->action != 'login' && $this->action != 'logout') {
      if ($this->Session->check('userData') == false) {
      $this->redirect('/');
      }
      }
      }
     */

    function __validateUserType() {

        $userType = $this->Session->read('userDetails.usertype_id');
        if ($userType != 1) {
            $this->redirect('/Information/');
        }
    }

    function index() {
        
    }

    function newInvestor() {
        /*        $this->__validateUserType(); */

        // $this->set('marriages', $this->Marriage->find('list'));
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        // $this->set('zones', $this->Zone->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    function newInvestorIndiv() {
        /*        $this->__validateUserType(); */
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorIndivJoint() {
        /*        $this->__validateUserType(); */
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorJoint() {
        /*        $this->__validateUserType(); */
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorGroup() {
        /*        $this->__validateUserType(); */
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorComp() {
        /*        $this->__validateUserType(); */
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('institutiontypes', $this->InstitutionType->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossrevenues', $this->GrossRevenue->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    public function proceed_check1() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investortype_id = $this->request->data['Investor']['investortype_id'];

            if ($investortype_id == 1) {
                $message = 'Please Select a Type of Investor';
                $this->Session->write('emsg', $message);
                $this->redirect('newInvestor');
            } elseif ($investortype_id == 2) {
                $this->redirect('newInvestorIndivJoint');
            } elseif ($investortype_id == 3) {
                $this->redirect('newInvestorComp');
            } elseif ($investortype_id == 4) {
                $this->redirect('newInvestorJoint');
            } elseif ($investortype_id == 5) {
                $this->redirect('newInvestorGroup');
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
                $this->redirect('newInvestorIndivJoint');
            } elseif ($investortype_id == 3) {
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
                $this->redirect('newInvestment0');
            } elseif ($investortype_id == 2) {
                $this->redirect('newInvestment1Indv');
            } elseif ($investortype_id == 3) {
                $this->redirect('newInvestment1Comp');
            } elseif ($investortype_id == 4) {
                $this->redirect('newInvestment1Joint');
            } elseif ($investortype_id == 5) {
                $this->redirect('newInvestment1Group');
            } else {
                $message = 'Please Select a Valid Investor Type';
                $this->Session->write('bmsg', $message);
                $this->redirect('newInvestor');
            }
        }
    }

    public function commit_group() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('ajax')) {

            if ($this->Session->check('investortemp') == true) {
                $this->Session->delete('investortemp');
            }

            $this->Session->write('investortemp', $this->request->data['Investor']);


            if ($this->request->data['Investor']['user_id'] == "" || $this->request->data['Investor']['user_id'] == null) {
                $message = 'Please Supply The Investment Officer\'s Name';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if ($this->request->data['Investor']['comp_name'] == "" || $this->request->data['Investor']['comp_name'] == null) {
                $message = 'Please Supply The Group\'s Name';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }


            if ($this->request->data['Investor']['idtype_id'] == "" || $this->request->data['Investor']['idtype_id'] == null) {
                $message = 'Please Supply The Contact Person\'s ID-Type';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['id_number'] == "" || $this->request->data['Investor']['id_number'] == null) {
                $message = 'Please Supply The Contact Person\'s ID Number';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if (is_null($this->request->data['Investor']['date_incorp']['day']) || is_null($this->request->data['Investor']['date_incorp']['month']) || is_null($this->request->data['Investor']['date_incorp']['year'])) {
                $message = 'Please Supply The Group\'s Commencement Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['date_incorp']['day'] == "" || $this->request->data['Investor']['date_incorp']['month'] == "" || $this->request->data['Investor']['date_incorp']['year'] == "") {
                $message = 'Please Supply The Group\'s Commencement Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } else {

                $date_incorp_day = $this->request->data['Investor']['date_incorp']['day'];
                $date_incorp_month = $this->request->data['Investor']['date_incorp']['month'];
                $date_incorp_year = $this->request->data['Investor']['date_incorp']['year'];
                $date_incorp = $date_incorp_year . "-" . $date_incorp_month . "-" . $date_incorp_day;
                $date_incorp = date('Y-m-d', strtotime($date_incorp));
                $this->request->data['Investor']['date_incorp'] = $date_incorp;
            }

//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');
            if (is_null($this->request->data['Investor']['id_issue']['day']) || is_null($this->request->data['Investor']['id_issue']['month']) || is_null($this->request->data['Investor']['id_issue']['year'])) {
                $message = 'Please Supply The Contact Perso\'s ID Issue Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['id_issue']['day'] == "" || $this->request->data['Investor']['id_issue']['month'] == "" || $this->request->data['Investor']['id_issue']['year'] == "") {
                $message = 'Please Supply The Contact Person\'s ID Issue Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } else {

                $issue_day = $this->request->data['Investor']['id_issue']['day'];
                $issue_month = $this->request->data['Investor']['id_issue']['month'];
                $issue_year = $this->request->data['Investor']['id_issue']['year'];
                $issue = $issue_year . "-" . $issue_month . "-" . $issue_day;
                $issue_date = date('Y-m-d', strtotime($issue));
                $this->request->data['Investor']['id_issue'] = $issue_date;
            }
            if ($this->request->data['Investor']['id_expiry']['day'] == "" || $this->request->data['Investor']['id_expiry']['month'] == "" || $this->request->data['Investor']['id_expiry']['year'] == "") {
                
            } elseif (is_null($this->request->data['Investor']['id_expiry']['day']) || is_null($this->request->data['Investor']['id_expiry']['month']) || is_null($this->request->data['Investor']['id_expiry']['year'])) {
                
            } else {
                $expiry_day = $this->request->data['Investor']['id_expiry']['day'];
                $expiry_month = $this->request->data['Investor']['id_expiry']['month'];
                $expiry_year = $this->request->data['Investor']['id_expiry']['year'];
                $expiry = $expiry_year . "-" . $expiry_month . "-" . $expiry_day;
                $expiry_date = date('Y-m-d', strtotime($expiry));

                $this->request->data['Investor']['id_expiry'] = $expiry_date;
            }



            if ($this->request->data['Investor']['nationality'] == "" || $this->request->data['Investor']['nationality'] == null) {
                $message = 'Please Supply The Contact Person\'s Nationality';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if (isset($this->request->data['Investor']['grossincome_id']) && $this->request->data['Investor']['grossincome_id'] != "" || !is_null($this->request->data['Investor']['grossincome_id'])) {
                $this->request->data['Investor']['gross_income_id'] = $this->request->data['Investor']['grossincome_id'];
            }
            $this->request->data['Investor']['registration_date'] = $registration_date;
            $user_id = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_id = $this->Session->read('userDetails.id');
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $client_ledger = array('investor_id' => $Investorid, 'user_id' => $user_id);
                $this->ClientLedger->save($client_ledger);
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $message = 'Investor Details Successfully Added';
                $this->Session->delete('emsg');
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function commit_indv() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('ajax')) {


            $dob_day = $this->request->data['Investor']['dob']['day'];
            $dob_month = $this->request->data['Investor']['dob']['month'];
            $dob_year = $this->request->data['Investor']['dob']['year'];
            if ($this->Session->check('investortemp') == true) {
                $this->Session->delete('investortemp');
            }



            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));

            $this->Session->write('investortemp', $this->request->data['Investor']);
            $this->request->data['Investor']['dob'] = $dob_date;

            if ($this->request->data['Investor']['user_id'] == "" || $this->request->data['Investor']['user_id'] == null) {
                $message = 'Please Supply The Investment Officer\'s Name';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if ($this->request->data['Investor']['other_names'] == "" || $this->request->data['Investor']['other_names'] == null) {
                $message = 'Please Supply The Investor\'s Other Names';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['surname'] == "" || $this->request->data['Investor']['surname'] == null) {
                $message = 'Please Supply The Investor\'s Surname';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }
            $fullname = $this->request->data['Investor']['other_names'] . " " . $this->request->data['Investor']['surname'];

            if ($this->request->data['Investor']['idtype_id'] == "" || $this->request->data['Investor']['idtype_id'] == null) {
                $message = 'Please Supply The Investor\'s ID-Type';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }

            if ($this->request->data['Investor']['id_number'] == "" || $this->request->data['Investor']['id_number'] == null) {
                $message = 'Please Supply The Investor\'s ID Number';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }

//            if ($dob == date('Y-m-d')) {
//                $message = 'Please Supply The Investor\'s Date of Birth';
//                $this->Session->write('bmsg', $message);
//                return json_encode(array('status' => 'error'));
//            }
            if (is_null($this->request->data['Investor']['id_issue']['day']) || is_null($this->request->data['Investor']['id_issue']['month']) || is_null($this->request->data['Investor']['id_issue']['year'])) {
                $message = 'Please Supply The Investor\'s ID Issue Date';
                $this->Session->write('bmsg', $message);
//                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['id_issue']['day'] == "" || $this->request->data['Investor']['id_issue']['month'] == "" || $this->request->data['Investor']['id_issue']['year'] == "") {
                $message = 'Please Supply The Investor\'s ID Issue Date';
                $this->Session->write('bmsg', $message);
//                return json_encode(array('status' => 'error'));
            } else {

                $issue_day = $this->request->data['Investor']['id_issue']['day'];
                $issue_month = $this->request->data['Investor']['id_issue']['month'];
                $issue_year = $this->request->data['Investor']['id_issue']['year'];
                $issue = $issue_year . "-" . $issue_month . "-" . $issue_day;
                $issue_date = date('Y-m-d', strtotime($issue));
                $this->request->data['Investor']['id_issue'] = $issue_date;
            }
            if ($this->request->data['Investor']['id_expiry']['day'] == "" || $this->request->data['Investor']['id_expiry']['month'] == "" || $this->request->data['Investor']['id_expiry']['year'] == "") {
                
            } elseif (is_null($this->request->data['Investor']['id_expiry']['day']) || is_null($this->request->data['Investor']['id_expiry']['month']) || is_null($this->request->data['Investor']['id_expiry']['year'])) {
                
            } else {
                $expiry_day = $this->request->data['Investor']['id_expiry']['day'];
                $expiry_month = $this->request->data['Investor']['id_expiry']['month'];
                $expiry_year = $this->request->data['Investor']['id_expiry']['year'];
                $expiry = $expiry_year . "-" . $expiry_month . "-" . $expiry_day;
                $expiry_date = date('Y-m-d', strtotime($expiry));

                $this->request->data['Investor']['id_expiry'] = $expiry_date;
            }
//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');


            if ($this->request->data['Investor']['nationality'] == "" || $this->request->data['Investor']['nationality'] == null) {
                $message = 'Please Supply The Investor\'s Nationality';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if (isset($this->request->data['Investor']['grossincome_id']) && $this->request->data['Investor']['grossincome_id'] != "" || !is_null($this->request->data['Investor']['grossincome_id'])) {
                $this->request->data['Investor']['gross_income_id'] = $this->request->data['Investor']['grossincome_id'];
            }
            $this->request->data['Investor']['fullname'] = $fullname;
            $this->request->data['Investor']['dob'] = $dob_date;
            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['surname'] . "_" . "photo" . "_" . $dob_date;

//            if ($data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true))) {
//		$data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true, 'name' => $photo	));
//                return json_encode($data);
//            if($data){
//                
//                $this->request->data['Investor']['investor_photo'] = $data['path'];
////                header('Content-Type: application/json');
//                // Upload successful, do whatever
//            }else{
//                $message = 'Please Supply The Investor\'s Picture';
//                $this->Session->write('emsg', $message);
//                return json_encode(array('status' => 'error'));
//            data[Investor][investor_photo]
//            if (isset($_FILES["investor_photo"]["type"])) {
//                $validextensions = array("jpeg", "jpg", "png", "gif");
//                $temporary = explode(".", $_FILES["investor_photo"]["name"]);
//                $file_extension = end($temporary);
//                if ((($_FILES["investor_photo"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
//                        ) && ($_FILES["investor_photo"]["size"] < 900000)//Approx. 100kb files can be uploaded.
//                        && in_array($file_extension, $validextensions)) {
//                    if ($_FILES["file"]["error"] > 0) {
//                        echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
//                    } else {
//                        if (file_exists($this->webroot . "files/uploads/" . $_FILES["investor_photo"]["name"])) {
//                            echo $_FILES["investor_photo"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
//                        } else {
//                            $sourcePath = $_FILES['investor_photo']['tmp_name']; // Storing source path of the file in a variable
//                            $targetPath = $this->webroot . "files/uploads/" . $_FILES['investor_photo']['name']; // Target path where file is to be stored
//                            move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
//                            $this->request->data['Investor']['investor_photo'] = $targetPath;
////                            echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
////                            echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
////                            echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
////                            echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
////                            echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
//                        }
//                    }
//                } else {
//                    echo "<span id='invalid'>***Invalid file Size or Type***<span>";
//                }
//            }
            $user_id = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_id = $this->Session->read('userDetails.id');
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $client_ledger = array('investor_id' => $Investorid, 'user_id' => $user_id);
                $this->ClientLedger->save($client_ledger);
                $result['Investor']['full_name'] = $result['Investor']['other_names'] . ' ' . $result['Investor']['surname'];
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $message = 'Investor Details Successfully Added';
                $this->Session->delete('emsg');
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function commit_comp() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('ajax')) {


            if ($this->Session->check('investortemp') == true) {
                $this->Session->delete('investortemp');
            }




            $this->Session->write('investortemp', $this->request->data['Investor']);


            if (is_null($this->request->data['Investor']['date_incorp']['day']) || is_null($this->request->data['Investor']['date_incorp']['month']) || is_null($this->request->data['Investor']['date_incorp']['year'])) {
                $message = 'Please Supply The Company\'s Incorp Date';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['date_incorp']['day'] == "" || $this->request->data['Investor']['date_incorp']['month'] == "" || $this->request->data['Investor']['date_incorp']['year'] == "") {
                $message = 'Please Supply The Company\'s Incorp Date';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            } else {

                $date_incorp_day = $this->request->data['Investor']['date_incorp']['day'];
                $date_incorp_month = $this->request->data['Investor']['date_incorp']['month'];
                $date_incorp_year = $this->request->data['Investor']['date_incorp']['year'];
                $date_incorp = $date_incorp_year . "-" . $date_incorp_month . "-" . $date_incorp_day;
                $date_incorp = date('Y-m-d', strtotime($date_incorp));
                $this->request->data['Investor']['date_incorp'] = $date_incorp;
            }

//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');


            if (isset($this->request->data['Investor']['grossrevenue_id']) && $this->request->data['Investor']['grossrevenue_id'] != "" || !is_null($this->request->data['Investor']['grossrevenue_id'])) {
                $this->request->data['Investor']['gross_revenue_id'] = $this->request->data['Investor']['grossrevenue_id'];
            }
            if (isset($this->request->data['Investor']['institutiontype_id']) && $this->request->data['Investor']['institutiontype_id'] != "" || !is_null($this->request->data['Investor']['institutiontype_id'])) {
                $this->request->data['Investor']['institution_type_id'] = $this->request->data['Investor']['institutiontype_id'];
            }

            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['comp_name'] . "_" . "photo" . "_" . $date_incorp;
            $this->request->data['Investor']['fullname'] = $this->request->data['Investor']['comp_name'];
//            if ($data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true))) {
//		$data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true, 'name' => $photo	));
//                return json_encode($data);
//            if($data){
//                
//                $this->request->data['Investor']['investor_photo'] = $data['path'];
////                header('Content-Type: application/json');
//                // Upload successful, do whatever
//            }else{
//                $message = 'Please Supply The Investor\'s Picture';
//                $this->Session->write('emsg', $message);
//                return json_encode(array('status' => 'error'));
//            }
            $user_id = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_id = $this->Session->read('userDetails.id');
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {

                $client_ledger = array('investor_id' => $Investorid, 'user_id' => $user_id);
                $this->ClientLedger->save($client_ledger);
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $message = 'Investor Details Successfully Added';
                $this->Session->delete('emsg');
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Save Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
        }
    }

    function approveInvestors() {
        /*        $this->__validateUserType(); */


        $this->paginate = array(
            'limit' => 50, 'order' => array('Investor.investor_type_id' => 'asc'),
            'conditions' => array('Investor.approved' => 0));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);
    }

    function approveInvestors2() {
        $this->autoRender = false;
        /*        $this->__validateUserType(); */
        if ($this->request->is('post')) {
            if (!empty($this->request->data['Investor'])) {
                $data = $this->Investor->find('all', ['conditions' => ['Investor.approved' => 0]]);
                if ($data) {
                    foreach ($data as $val) {
                        if (isset($this->request->data['Investor']['approved' . $val['Investor']['id']]) && $this->request->data['Investor']['approved' . $val['Investor']['id']] == '1') {
                            $update = array('id' => $val['Investor']['id'], 'approved' => 1);
                            $this->Investor->save($update);
                        }
                    }
                    $this->Session->delete('public_unapproved_investors');
                    $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));

                    $message = 'Investor(s) Successfully Approve';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'approveInvestors'));
                } else {
                    $message = 'Failed to retrive investor(\'s) details';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'approveInvestors'));
                }
            } else {
                $message = 'Failed to receive request';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'approveInvestors'));
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
                $this->Session->write('imsg', $message);
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
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'deleteInvestor'));
            }
        }
    }

    function searchInvestor($investorID = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")), 'Investor.approved' => 1)));

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
                $this->Session->write('imsg', $message);
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
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => "Investments", 'action' => "clearSessions"));
        }
    }

    function editInvestor($investor_id = null) {
        /* $this->__validateUserType(); */
        $this->paginate('Investor');

        $data = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id), 'order' => array("Investor.investor_type_id" => 'desc')));
        if ($data) {
            $this->set('investor', $data);
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('imsg', $message);
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
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function editInvestorComp($investor_id = null) {
        /* $this->__validateUserType(); */
        $this->paginate('Investor');

        $data = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id), 'order' => array("Investor.investor_type_id" => 'desc')));
        if ($data) {
            $this->set('investor', $data);
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('imsg', $message);
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
        $this->set('institutiontypes', $this->InstitutionType->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossrevenues', $this->GrossRevenue->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
    }

    public function edit_comp() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['Investor']['id'];

            if (is_null($this->request->data['Investor']['date_incorp']['day']) || is_null($this->request->data['Investor']['date_incorp']['month']) || is_null($this->request->data['Investor']['date_incorp']['year'])) {
                $message = 'Please Supply The Company\'s Incorp Date';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['date_incorp']['day'] == "" || $this->request->data['Investor']['date_incorp']['month'] == "" || $this->request->data['Investor']['date_incorp']['year'] == "") {
                $message = 'Please Supply The Company\'s Incorp Date Date';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            } else {

                $date_incorp_day = $this->request->data['Investor']['date_incorp']['day'];
                $date_incorp_month = $this->request->data['Investor']['date_incorp']['month'];
                $date_incorp_year = $this->request->data['Investor']['date_incorp']['year'];
                $date_incorp = $date_incorp_year . "-" . $date_incorp_month . "-" . $date_incorp_day;
                $date_incorp = date('Y-m-d', strtotime($date_incorp));
                $this->request->data['Investor']['date_incorp'] = $date_incorp;
            }

//            $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');


            if (isset($this->request->data['Investor']['grossrevenue_id']) && $this->request->data['Investor']['grossrevenue_id'] != "" || !is_null($this->request->data['Investor']['grossrevenue_id'])) {
                $this->request->data['Investor']['gross_revenue_id'] = $this->request->data['Investor']['grossrevenue_id'];
            }
            if (isset($this->request->data['Investor']['institutiontype_id']) && $this->request->data['Investor']['institutiontype_id'] != "" || !is_null($this->request->data['Investor']['institutiontype_id'])) {
                $this->request->data['Investor']['institution_type_id'] = $this->request->data['Investor']['institutiontype_id'];
            }

            $this->request->data['Investor']['registration_date'] = $registration_date;
            $photo = $this->request->data['Investor']['comp_name'] . "_" . "photo" . "_" . $date_incorp;
            $this->request->data['Investor']['fullname'] = $this->request->data['Investor']['comp_name'];
//            if ($data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true))) {
//		$data = $this->Uploader->upload($this->Uploader->ajaxField, array('overwrite' => true, 'name' => $photo	));
//                return json_encode($data);
//            if($data){
//                
//                $this->request->data['Investor']['investor_photo'] = $data['path'];
////                header('Content-Type: application/json');
//                // Upload successful, do whatever
//            }else{
//                $message = 'Please Supply The Investor\'s Picture';
//                $this->Session->write('emsg', $message);
//                return json_encode(array('status' => 'error'));
//            }

            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $message = 'Investor Details Successfully Updated';
                $this->Session->delete('emsg');
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Update Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
        }
    }

    public function edit() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $id = $this->request->data['Investor']['id'];
            $dob_day = $this->request->data['Investor']['dob']['day'];
            $dob_month = $this->request->data['Investor']['dob']['month'];
            $dob_year = $this->request->data['Investor']['dob']['year'];
//            $registration_day = $this->request->data['Investor']['registration_date']['day'];
//            $registration_month = $this->request->data['Investor']['registration_date']['month'];
//            $registration_year = $this->request->data['Investor']['registration_date']['year'];

            $dob = $dob_year . "-" . $dob_month . "-" . $dob_day;
            $dob_date = date('Y-m-d', strtotime($dob));

            // $registration = $registration_year ."-". $registration_month ."-".$registration_day;
            $registration_date = date('Y-m-d');


            if ($dob == date('Y-m-d')) {
                $message = 'Please Supply The Investor\'s Date of Birth';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if ($this->request->data['Investor']['user_id'] == "" || $this->request->data['Investor']['user_id'] == null) {
                $message = 'Please Supply The Investment Office\'s Name';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            }
            if (is_null($this->request->data['Investor']['id_issue']['day']) || is_null($this->request->data['Investor']['id_issue']['month']) || is_null($this->request->data['Investor']['id_issue']['year'])) {
                $message = 'Please Supply The Investor\'s ID Issue Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } elseif ($this->request->data['Investor']['id_issue']['day'] == "" || $this->request->data['Investor']['id_issue']['month'] == "" || $this->request->data['Investor']['id_issue']['year'] == "") {
                $message = 'Please Supply The Investor\'s ID Issue Date';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
            } else {

                $issue_day = $this->request->data['Investor']['id_issue']['day'];
                $issue_month = $this->request->data['Investor']['id_issue']['month'];
                $issue_year = $this->request->data['Investor']['id_issue']['year'];
                $issue = $issue_year . "-" . $issue_month . "-" . $issue_day;
                $issue_date = date('Y-m-d', strtotime($issue));
                $this->request->data['Investor']['id_issue'] = $issue_date;
            }
            if ($this->request->data['Investor']['id_expiry']['day'] == "" || $this->request->data['Investor']['id_expiry']['month'] == "" || $this->request->data['Investor']['id_expiry']['year'] == "") {
                
            } elseif (is_null($this->request->data['Investor']['id_expiry']['day']) || is_null($this->request->data['Investor']['id_expiry']['month']) || is_null($this->request->data['Investor']['id_expiry']['year'])) {
                
            } else {
                $expiry_day = $this->request->data['Investor']['id_expiry']['day'];
                $expiry_month = $this->request->data['Investor']['id_expiry']['month'];
                $expiry_year = $this->request->data['Investor']['id_expiry']['year'];
                $expiry = $expiry_year . "-" . $expiry_month . "-" . $expiry_day;
                $expiry_date = date('Y-m-d', strtotime($expiry));

                $this->request->data['Investor']['id_expiry'] = $expiry_date;
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
            if (isset($this->request->data['Investor']['grossincome_id']) && $this->request->data['Investor']['grossincome_id'] != "" || !is_null($this->request->data['Investor']['grossincome_id'])) {
                $this->request->data['Investor']['gross_income_id'] = $this->request->data['Investor']['grossincome_id'];
            }
            $this->request->data['Investor']['fullname'] = $fullname;
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
            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $result['Investor']['full_name'] = $result['Investor']['other_names'] . ' ' . $result['Investor']['surname'];

                $message = 'Investor Details Successfully Updated';
                $this->Session->delete('emsg');
                $this->Session->write('smsg', $message);
                return json_encode(array('status' => 'success'));
            } else {
                $message = 'Investor Update Error';
                $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'error'));
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
            $this->Session->write('emsg', $message);
        }
        $this->redirect(array('controller' => "Investments", 'action' => "deleteInvestor"));
    }

    function newInvestment0() {
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));

        $check = $this->Session->check('investmt_investors');
        if ($check) {
            $this->Session->delete('investmt_investors');

            //$this->Session->delete('ivt');
        }

        $check = $this->Session->check('ivt');
        if ($check) {
            $cust = $this->Session->delete('ivt');
        }
        if ($this->Session->check('investtemp') == true) {
            $this->Session->delete('investtemp');
        }
        $check = $this->Session->check('variabless_fixed');
        if ($check) {
            $this->Session->delete('variabless_fixed');
        }
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }
        $check = $this->Session->check('variabless_equity');
        if ($check) {
            $this->Session->delete('variabless_equity');
        }
        $check = $this->Session->check('investment_array');
        if ($check) {
            $this->Session->delete('investment_array');
        }
        if ($this->Session->check('investment_array_fixed')) {
            $this->Session->delete('investment_array_fixed');
        }
        if ($this->Session->check('investment_array_equity')) {
            $this->Session->delete('investment_array_equity');
        }

        $check = $this->Session->check('statemt_array');
        if ($check) {
            $this->Session->delete('statemt_array');
        }
        $check = $this->Session->check('statemt_array_fixed');
        if ($check) {
            $this->Session->delete('statemt_array_fixed');
        }
        if ($this->Session->read('investmt_equities')) {
            $this->Session->delete('investmt_equities');
        }
    }

    function newInvestment1Comp() {
        /* $this->__validateUserType(); */
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 3, 'Investor.approved' => 1),
            'limit' => 50, 'order' => array('Investor.id' => 'asc'));

        $data = $this->paginate('Investor');
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('investor', $data);

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
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }
    }

    function newInvestment1Group() {
        /* $this->__validateUserType(); */
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 5, 'Investor.approved' => 1),
            'limit' => 50, 'order' => array('Investor.id' => 'asc'));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);

        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));


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
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }
    }

    function get_investors() {
        if (!$this->Session->read('investmt_investors')) {
            $this->set_investors(array());
        }


        return $this->Session->read('investmt_investors');
    }

    //Alain Multiple Payments
    function set_investors($investor_data) {
        $this->Session->write('investmt_investors', $investor_data);
    }

    function add($investor_id = null, $url = null) {
        $this->autoRender = false;
        $investors = $this->get_investors();
        if (!empty($investors)) {
            $message = 'Investor queue full';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => $url));
        }
        $investor_array = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        if ($investor_array) {
            $investor = array($investor_id =>
                array(
                    'investor_id' => $investor_id,
                    'surname' => $investor_array['Investor']['surname'],
                    'other_names' => $investor_array['Investor']['other_names'],
                    'phone_number' => $investor_array['Investor']['phone'],
                    'joint_surname' => $investor_array['Investor']['joint_surname'],
                    'joint_other_names' => $investor_array['Investor']['joint_other_names'],
                    'in_trust_for' => $investor_array['Investor']['in_trust_for'],
                    'email' => $investor_array['Investor']['email']
                )
            );

            //payment_method already exists, add to payment_amount
            if (isset($investors[$investor_id])) {
                
            } else {
                //add to existing array
                $investors+=$investor;
            }

            $this->set_investors($investors);
        }
        $this->redirect(array('controller' => 'Investments', 'action' => $url));
    }

    function rmInvestorIndiv($ID = null) {


        $this->autoRender = $this->autoLayout = false;
        if (!is_null($ID)) {
            $investors = $this->get_investors();

            unset($investors[$ID]);
            //$payments_data = $this->get_payments();
            $this->set_investors($investors);

            $message = 'Investor Removed';
            $this->Session->write('smsg', $message);
        } else {

            $message = 'Unable to remove Investor, try again';
            $this->Session->write('emsg', $message);
        }
        $this->redirect(array('controller' => "Investments", 'action' => "newInvestment1Indv"));
    }

    function rmInvestor($ID = null) {


        $this->autoRender = $this->autoLayout = false;
        if (!is_null($ID)) {
            $investors = $this->get_investors();

            unset($investors[$ID]);
            //$payments_data = $this->get_payments();
            $this->set_investors($investors);

            $message = 'Investor Removed';
            $this->Session->write('smsg', $message);
        } else {

            $message = 'Unable to remove Investor, try again';
            $this->Session->write('emsg', $message);
        }
        $this->redirect(array('controller' => "Investments", 'action' => "newInvestment1Joint"));
    }

    function searchinvestor4investment($investorid = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")), 'Investor.approved' => 1)));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Joint'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Joint'));
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
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Joint'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Joint'));
            }
        }
    }

    function searchinvestor4groupinvestment($investorid = null) {
        $this->autoRender = false;
        if ($this->request->is('post') && ($this->request->data['investor_search'] != "" || $this->request->data['investor_search'] != null)) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.comp_name LIKE' => "%$investname%"), array('Investor.phone LIKE' => "%$investname%"), array('Investor.contact_person LIKE' => "%$investname%")), 'Investor.approved' => 1)));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Group'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Group'));
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorid)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorid)));
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
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Group'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Group'));
            }
        }
    }

    function searchinvestor4compinvestment($investorid = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.comp_name LIKE' => "%$investname%"), array('Investor.ceo LIKE' => "%$investname%"), array('Investor.contact_person LIKE' => "%$investname%"), array('Investor.reg_numb LIKE' => "%$investname%")), 'Investor.approved' => 1)));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
        } else {

            $investors = $this->Investor->find('all', array('conditions' => array('Investor.id' => $investorid)));
            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorid)));
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
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
        }
    }

    function newInvestment1Indv() {
        /* $this->__validateUserType(); */
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 2, 'Investor.approved' => 1),
            'limit' => 50, 'order' => array('Investor.id' => 'asc'));
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
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }

        $investors = $this->get_investors();

        if ($investors) {
            $this->set('selected', $investors);
            //  $this->Session->delete('payments');
        }
    }

    function newInvestment1Joint() {
        /* $this->__validateUserType(); */
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 4, 'Investor.approved' => 1),
            'limit' => 50, 'order' => array('Investor.id' => 'asc'));
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
        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }

        $investors = $this->get_investors();

        if ($investors) {
            $this->set('selected', $investors);
            //  $this->Session->delete('payments');
        }
    }

    function newInvestment2() {
        /* $this->__validateUserType(); */

        $this->set('portfolios', $this->Portfolio->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('equitieslists', $this->EquitiesList->find('list'));

        $check = $this->Session->check('investment_type');
        if ($check) {
            $this->set('invest_type', $check);
        }

        $check = $this->get_investors();

        if (count($check) > 0) {
            foreach ($check as $investor):
                $investor_id = $investor['investor_id'];
                $this->set('investors', $investor);
                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $ledger_data = $this->Session->read('ledger_data');
                    $this->set('ledger_data', $ledger_data);
                } else {
                    $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

                    if ($ledger_data) {
                        $this->Session->write('ledger_data', $ledger_data);
                        $this->set('ledger_data', $ledger_data);
                    }
                }


            endforeach;
        } else {
            $message = 'No Investor Selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Indv'));
        }
        $check = $this->Session->check('investtemp1');
        if ($check) {
            $check = $this->Session->check('investtemp1.cash_athand');
            if ($check) {
                $this->set('cash_athand', $this->Session->read('investtemp1.cash_athand'));
            }
            $check = $this->Session->check('investtemp1.amount_deposited');
            if ($check) {
                $this->set('amount_deposited', $this->Session->read('investtemp1.amount_deposited'));
            }
            $check = $this->Session->check('investtemp1.total_invested');
            if ($check) {
                $this->set('total_invested', $this->Session->read('investtemp1.total_invested'));
            }
        }
        $check = $this->Session->check('variabless_fixed');
        if ($check) {
            $check = $this->Session->check('variabless_fixed.duedate');
            if ($check) {
                $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
            }
            $check = $this->Session->check('variabless_fixed.interest');
            if ($check) {
                $this->set('interest', $this->Session->read('variabless_fixed.interest'));
            }
            $check = $this->Session->check('variabless_fixed.totaldue');
            if ($check) {
                $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
            }
        }

        $check = $this->Session->check('variabless_equity');
        if ($check) {
            $check = $this->Session->check('variabless_equity.totalamt');
            if ($check) {
                $this->set('totalamt', $this->Session->read('variabless_equity.totalamt'));
            }
            $check = $this->Session->check('variabless_equity.share_price');
            if ($check) {
                $this->set('share_price', $this->Session->read('variabless_equity.share_price'));
            }
            $check = $this->Session->check('variabless_equity.total_fees');
            if ($check) {
                $this->set('total_fees', $this->Session->read('variabless_equity.total_fees'));
            }
            $check = $this->Session->check('variabless_equity.equity');
            if ($check) {
                $this->set('equity', $this->Session->read('variabless_equity.equity'));
            }
        }
    }

    function newInvestment2_joint() {
        /* $this->__validateUserType(); */

        $this->set('portfolios', $this->Portfolio->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('equitieslists', $this->EquitiesList->find('list'));

        $check = $this->Session->check('investment_type');
        if ($check) {
            $this->set('invest_type', $check);
        }

        $check = $this->get_investors();

        if (count($check) > 0) {
            foreach ($check as $investor):
                $investor_id = $investor['investor_id'];

                $this->set('investors', $investor);
                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $ledger_data = $this->Session->read('ledger_data');
                    $this->set('ledger_data', $ledger_data);
                } else {
                    $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

                    if ($ledger_data) {
                        $this->Session->write('ledger_data', $ledger_data);
                        $this->set('ledger_data', $ledger_data);
                    }
                }

            endforeach;
        } else {
            $message = 'No Investor Selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Joint'));
        }
        $check = $this->Session->check('investtemp1');
        if ($check) {
            $check = $this->Session->check('investtemp1.cash_athand');
            if ($check) {
                $this->set('cash_athand', $this->Session->read('investtemp1.cash_athand'));
            }
            $check = $this->Session->check('investtemp1.amount_deposited');
            if ($check) {
                $this->set('amount_deposited', $this->Session->read('investtemp1.amount_deposited'));
            }
            $check = $this->Session->check('investtemp1.total_invested');
            if ($check) {
                $this->set('total_invested', $this->Session->read('investtemp1.total_invested'));
            }
        }
        $check = $this->Session->check('variabless_fixed');
        if ($check) {
            $check = $this->Session->check('variabless_fixed.duedate');
            if ($check) {
                $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
            }
            $check = $this->Session->check('variabless_fixed.interest');
            if ($check) {
                $this->set('interest', $this->Session->read('variabless_fixed.interest'));
            }
            $check = $this->Session->check('variabless_fixed.totaldue');
            if ($check) {
                $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
            }
        }

        $check = $this->Session->check('variabless_equity');
        if ($check) {
            $check = $this->Session->check('variabless_equity.totalamt');
            if ($check) {
                $this->set('totalamt', $this->Session->read('variabless_equity.totalamt'));
            }
            $check = $this->Session->check('variabless_equity.share_price');
            if ($check) {
                $this->set('share_price', $this->Session->read('variabless_equity.share_price'));
            }
            $check = $this->Session->check('variabless_equity.total_fees');
            if ($check) {
                $this->set('total_fees', $this->Session->read('variabless_equity.total_fees'));
            }
            $check = $this->Session->check('variabless_equity.equity');
            if ($check) {
                $this->set('equity', $this->Session->read('variabless_equity.equity'));
            }
        }
    }

//    function newInvestment2_comp_OLD($investorid = null) {
//        /* $this->__validateUserType(); */
//
//        if (!is_null($investorid)) {
//            $this->set('portfolios', $this->Portfolio->find('list'));
//            $this->set('currencies', $this->Currency->find('list'));
//            $this->set('investmentterms', $this->InvestmentTerm->find('list'));
//            $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
//            $this->set('paymentmodes', $this->PaymentMode->find('list'));
//            $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
//            $this->set('instructions', $this->Instruction->find('list'));
//            $this->set('equitieslists', $this->EquitiesList->find('list'));
//
//
//            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorid), /* 'recursive' => -1 */));
//            if ($investor) {
//                $this->set('investors', $investor);
//            }
//            $check = $this->Session->check('variabless_fixed');
//            if ($check) {
//                $check = $this->Session->check('variabless_fixed.duedate');
//                if ($check) {
//                    $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
//                }
//                $check = $this->Session->check('variabless_fixed.interest');
//                if ($check) {
//                    $this->set('interest', $this->Session->read('variabless_fixed.interest'));
//                }
//                $check = $this->Session->check('variabless_fixed.totaldue');
//                if ($check) {
//                    $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
//                }
//            }
//
//            $check = $this->Session->check('variabless_equity');
//            if ($check) {
//                $check = $this->Session->check('variabless_equity.totalamt');
//                if ($check) {
//                    $this->set('totalamt', $this->Session->read('variabless_equity.totalamt'));
//                }
//                $check = $this->Session->check('variabless_equity.share_price');
//                if ($check) {
//                    $this->set('share_price', $this->Session->read('variabless_equity.share_price'));
//                }
//                $check = $this->Session->check('variabless_equity.total_fees');
//                if ($check) {
//                    $this->set('total_fees', $this->Session->read('variabless_equity.total_fees'));
//                }
//                $check = $this->Session->check('variabless_equity.equity');
//                if ($check) {
//                    $this->set('equity', $this->Session->read('variabless_equity.equity'));
//                }
//            }
//        } else {
//            $message = 'No Investor Selected';
//            $this->Session->write('emsg', $message);
//            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
//        }
//    }

    function newInvestment2_comp($investorid = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investorid)) {
            $this->set('portfolios', $this->Portfolio->find('list'));
            $this->set('currencies', $this->Currency->find('list'));
            $this->set('investmentterms', $this->InvestmentTerm->find('list'));
            $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
            $this->set('paymentmodes', $this->PaymentMode->find('list'));
            $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
            $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
            $this->set('instructions', $this->Instruction->find('list'));
            $this->set('equitieslists', $this->EquitiesList->find('list'));

            $check = $this->Session->check('investment_type');
            if ($check) {
                $this->set('invest_type', $check);
            }

            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorid)/* , 'recursive' => -1 */));
            if ($investor) {
                $this->set('investors', $investor);
                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $ledger_data = $this->Session->read('ledger_data');
                    $this->set('ledger_data', $ledger_data);
                } else {
                    $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investorid]]);

                    if ($ledger_data) {
                        $this->Session->write('ledger_data', $ledger_data);
                        $this->set('ledger_data', $ledger_data);
                    }
                }
            } else {
                $message = 'No Investor Selected';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
            $check = $this->Session->check('investtemp1');
            if ($check) {
                $check = $this->Session->check('investtemp1.cash_athand');
                if ($check) {
                    $this->set('cash_athand', $this->Session->read('investtemp1.cash_athand'));
                }
                $check = $this->Session->check('investtemp1.amount_deposited');
                if ($check) {
                    $this->set('amount_deposited', $this->Session->read('investtemp1.amount_deposited'));
                }
                $check = $this->Session->check('investtemp1.total_invested');
                if ($check) {
                    $this->set('total_invested', $this->Session->read('investtemp1.total_invested'));
                }
            }
            $check = $this->Session->check('variabless_fixed');
            if ($check) {
                $check = $this->Session->check('variabless_fixed.duedate');
                if ($check) {
                    $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
                }
                $check = $this->Session->check('variabless_fixed.interest');
                if ($check) {
                    $this->set('interest', $this->Session->read('variabless_fixed.interest'));
                }
                $check = $this->Session->check('variabless_fixed.totaldue');
                if ($check) {
                    $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
                }
            }

            $check = $this->Session->check('variabless_equity');
            if ($check) {
                $check = $this->Session->check('variabless_equity.totalamt');
                if ($check) {
                    $this->set('totalamt', $this->Session->read('variabless_equity.totalamt'));
                }
                $check = $this->Session->check('variabless_equity.share_price');
                if ($check) {
                    $this->set('share_price', $this->Session->read('variabless_equity.share_price'));
                }
                $check = $this->Session->check('variabless_equity.total_fees');
                if ($check) {
                    $this->set('total_fees', $this->Session->read('variabless_equity.total_fees'));
                }
                $check = $this->Session->check('variabless_equity.equity');
                if ($check) {
                    $this->set('equity', $this->Session->read('variabless_equity.equity'));
                }
            }
        } else {
            $message = 'No Investor Selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
        }
    }

    function newInvestment2Group($investorid = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investorid)) {
            $this->set('portfolios', $this->Portfolio->find('list'));
            $this->set('currencies', $this->Currency->find('list'));
            $this->set('investmentterms', $this->InvestmentTerm->find('list'));
            $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
            $this->set('paymentmodes', $this->PaymentMode->find('list'));
            $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
            $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
            $this->set('instructions', $this->Instruction->find('list'));
            $this->set('equitieslists', $this->EquitiesList->find('list'));


            $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investorid), 'recursive' => -1));
            if ($investor) {
                $this->set('investors', $investor);
                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $ledger_data = $this->Session->read('ledger_data');
                    $this->set('ledger_data', $ledger_data);
                } else {
                    $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

                    if ($ledger_data) {
                        $this->Session->write('ledger_data', $ledger_data);
                        $this->set('ledger_data', $ledger_data);
                    }
                }
            }
            $check = $this->Session->check('investtemp1');
            if ($check) {
                $check = $this->Session->check('investtemp1.cash_athand');
                if ($check) {
                    $this->set('cash_athand', $this->Session->read('investtemp1.cash_athand'));
                }
                $check = $this->Session->check('investtemp1.amount_deposited');
                if ($check) {
                    $this->set('amount_deposited', $this->Session->read('investtemp1.amount_deposited'));
                }
                $check = $this->Session->check('investtemp1.total_invested');
                if ($check) {
                    $this->set('total_invested', $this->Session->read('investtemp1.total_invested'));
                }
            }
            $check = $this->Session->check('variabless_fixed');
            if ($check) {
                $check = $this->Session->check('variabless_fixed.duedate');
                if ($check) {
                    $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
                }
                $check = $this->Session->check('variabless_fixed.interest');
                if ($check) {
                    $this->set('interest', $this->Session->read('variabless_fixed.interest'));
                }
                $check = $this->Session->check('variabless_fixed.totaldue');
                if ($check) {
                    $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
                }
            }

            $check = $this->Session->check('variabless_equity');
            if ($check) {
                $check = $this->Session->check('variabless_equity.totalamt');
                if ($check) {
                    $this->set('totalamt', $this->Session->read('variabless_equity.totalamt'));
                }
                $check = $this->Session->check('variabless_equity.share_price');
                if ($check) {
                    $this->set('share_price', $this->Session->read('variabless_equity.share_price'));
                }
                $check = $this->Session->check('variabless_equity.total_fees');
                if ($check) {
                    $this->set('total_fees', $this->Session->read('variabless_equity.total_fees'));
                }
                $check = $this->Session->check('variabless_equity.equity');
                if ($check) {
                    $this->set('equity', $this->Session->read('variabless_equity.equity'));
                }
            }
        } else {
            $message = 'No Investor Selected';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Group'));
        }
    }

    function get_equity() {
        if (!$this->Session->read('investmt_equities')) {
            $this->set_equity(array());
        }


        return $this->Session->read('investmt_equities');
    }

    //Kwaku Multiple Equities
    function set_equity($equity_data) {
        $this->Session->write('investmt_equities', $equity_data);
    }

    function process_indv() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $ledger_transactions = array();
            $cheque_no = '';
            $amount = $this->request->data['Investment']['investment_amount'];
            $page = $this->request->data['Investment']['investor_page'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $currency_id = $this->request->data['Investment']['currency_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            $investmentproduct_id = $this->request->data['Investment']['investmentproduct_id'];
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $inv_day = $this->request->data['Investment']['investment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['Investment']['investment_date']['month'];
                $inv_year = $this->request->data['Investment']['investment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $basefee_duedate = new DateTime($inv_date);
            $basefee_duedate->add(new DateInterval('P3M'));

            $pur_day = $this->request->data['Investment']['investment_date']['day'];
            if (!empty($pur_day)) {
                $pur_month = $this->request->data['Investment']['investment_date']['month'];
                $pur_year = $this->request->data['Investment']['investment_date']['year'];
                $pfinv_date = $pur_year . "-" . $pur_month . "-" . $pur_day;
                $psinv_date = strtotime($pfinv_date);
                $pinv_date = date('Y-m-d', $psinv_date);
            } else {
                $pinv_date = date('Y-m-d');
            }
            $this->request->data['Investment']['investment_date'] = $inv_date;
            $this->request->data['Investment']['purchase_date'] = $pinv_date;
            if ($this->Session->check('investtemp') == true) {
                $this->Session->delete('investtemp');
            }
            if ($this->Session->check('investtemp1') == true) {
                $this->Session->delete('investtemp1');
            }
            if (isset($currency_id) && !empty($currency_id)) {
                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => $currency_id)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }
            }
//            if (isset($this->request->data['equity_process'])) {
//                case 2:
//                    $this->request->data['Investment']['instruction_id2'] = $this->request->data['instruction_id2'];
//                    $this->request->data['Investment']['instruction_details2'] = $this->request->data['instruction_details2'];
//                    $this->request->data['Investment']['currency2'] = $this->request->data['currency2'];
//                    $this->request->data['Investment']['paymentmode_id2'] = $this->request->data['paymentmode_id2'];
//
//                    $this->request->data['Investment']['paymentschedule_id2'] = $this->request->data['paymentschedule_id2'];
//                    break;
//            }
            $this->Session->write('investtemp', $this->request->data['Investment']);
            $this->Session->write('investtemp1', $this->request->data['Investment']);

//            $term_id = $this->request->data['Investment']['investmentterm_id'];
//            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {

            $amount_available = $this->request->data['Investment']['cash_athand'] + $this->request->data['Investment']['amount_deposited'];
            $cashinvested = $this->request->data['Investment']['total_invested'];
            $new_cashinvested = $cashinvested;
            if (isset($this->request->data['fixed_process'])) {
//                switch ($investmentproduct_id) {
//                    case 1:
//                if ($this->request->data['Investment']['investmentterm_id'] == "" || $this->request->data['Investment']['investmentterm_id'] == null) {
//                    $message = 'Please Select an Investment Term';
//                    $this->Session->write('bmsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                }


                if ($this->request->data['Investment']['currency_id'] == "" || $this->request->data['Investment']['currency_id'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == "" || $this->request->data['Investment']['cashreceiptmode_id'] == null) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == 2) && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }
                if ($this->request->data['Investment']['investmentproduct_id'] == "" || $this->request->data['Investment']['investmentproduct_id'] == null) {
                    $message = 'Please Select  an Investment Product';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['instruction_id'] == "" || $this->request->data['Investment']['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if (($this->request->data['Investment']['instruction_id'] == 6) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['investment_amount'] == "" || $this->request->data['Investment']['investment_amount'] == null) {
                    $message = 'Please Enter Investment Amount';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                } else {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];

                    if ($investment_amount > $amount_available) {
                        //RESET CASH INPUTS AND RETURN

                        $message = 'Investment Amount cannot be more than investor\'s available cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page));
                    }
                }if ($this->request->data['Investment']['duration'] == "" || $this->request->data['Investment']['duration'] == null) {
                    $message = 'Please Enter Investment Duration';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['total_tenure'] == "" || $this->request->data['Investment']['total_tenure'] == null) {
                    $message = 'Please Enter Total Tenure';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                } else {
                    $total_tenure = $this->request->data['Investment']['total_tenure'];

                    $duration = $this->request->data['Investment']['duration'];
                    if ($duration > $total_tenure) {
                        $message = 'Duration cannot be more than total tenure';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page));
                    }
                }

                $first_date = $inv_date;
//                        break;
            }
            if (isset($this->request->data['equity_process'])) {
//                    case 2:
                $first_date = $pinv_date;

                $this->request->data['Investment']['investment_date'] = $pinv_date;

//                        if ($this->request->data['instruction_id2'] == "" || $this->request->data['instruction_id2'] == null) {
//                            $message = 'Please Select an Instruction';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }
//                        if (($this->request->data['instruction_id2'] == 5) && (is_null($this->request->data['instruction_details2']) || $this->request->data['instruction_details2'] == "")) {
//                            $message = 'Please State Instruction Details';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }
//                        if ($this->request->data['currency'] == "" || $this->request->data['currency'] == null) {
//                            $message = 'Please Select a Currency';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }

                if ($this->request->data['Investment']['currency_id'] == "" || $this->request->data['Investment']['currency_id'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == "" || $this->request->data['Investment']['cashreceiptmode_id'] == null) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == '2') && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }
                if ($this->request->data['Investment']['equities_list_id'] == "" || $this->request->data['Investment']['equities_list_id'] == null) {
                    $message = 'Please Select Equity Purchased';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['purchase_price'] == "" || $this->request->data['Investment']['purchase_price'] == null) {
                    $message = 'Please State Equity Purchase Price';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }

                if ($this->request->data['Investment']['numb_shares'] == "" || $this->request->data['Investment']['numb_shares'] == null) {
                    $message = 'Please State number of Shares';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }



//                $numb0fshares = $this->request->data['Investment']['numb_shares'];
//                $equity_price = $this->request->data['Investment']['purchase_price'];
//
//                $totalamt = ($numb0fshares * $equity_price);
//                $this->request->data['Investment']['total_amount'] = $totalamt;
                // $this->request->data['Investment']['investment_amount'] = $totalamt;
//                        break;
            }
//                }
////            }
            //ask if 
            if (isset($payment_schedule) && !empty($payment_schedule)) {
                if ($payment_schedule == 1) {
                    
                } elseif ($payment_schedule == 2) {
                    
                }
            }
            $deposit = $this->request->data['Investment']['amount_deposited'];
            if ($deposit > 0) {
                $ledger_transactions[] = array('cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'credit' => $deposit, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => 'Deposit for investment');
            }
            $base_fee = 0;
            $base_rate = 0;
            $benchmark_rate = 0;
            if (isset($this->request->data['Investment']['base_fees'])) {
                $base_rate = $this->request->data['Investment']['base_fees'];
            }
            if (isset($this->request->data['Investment']['benchmark_rate'])) {
                $benchmark_rate = $this->request->data['Investment']['benchmark_rate'];
            }
            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {


                $date = new DateTime($first_date);

//                switch ($investmentproduct_id) {
//                    case 1:
                if (isset($this->request->data['fixed_process'])) {
//                    $portfolio = $this->InvestmentTerm->find('first', array('conditions' => array('InvestmentTerm.id' => $term_id), 'recursive' => -1));
//
//                    if ($portfolio) {
//                        $year = $portfolio['InvestmentTerm']['period'];
//                        $date->add(new DateInterval('P' . $year . 'Y'));
//                        $date_statemt = new DateTime($first_date);
//                        $principal = $investment_amount;
//                        $statemt_array = array();
//                        if (isset($custom_rate) && !empty($custom_rate)) {
//                            $rate = $custom_rate;
//                        } else {
//                            $rate = $portfolio['InvestmentTerm']['interest_rate'];
//                        }
//                        $interest_amount1 = ($rate / 100) * $investment_amount;
//                        $interest_amount = $interest_amount1 * $year;
//                        $amount_due = $interest_amount + $investment_amount;
//                        for ($n = 1; $n <= $year; $n++) {
//                            $date_statemt->add(new DateInterval('P1Y'));
//
//                            $total = $interest_amount1 + $principal;
//                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                'principal' => $principal,
//                                'interest' => $interest_amount1,
//                                'maturity_date' => $date_statemt->format('Y-m-d'),
//                                'total' => $total);
//                            $principal = $total;
//                        }
                    $new_cashathand = $amount_available - $investment_amount;
                    $new_cashinvested = $cashinvested + $investment_amount;
                    $period = $this->request->data['Investment']['investment_period'];
                    $duration = $this->request->data['Investment']['duration'];
                    $year = $duration;
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
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1D'));
                                $interest_amount2 = $interest_amount1 * (1 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                    'investor_id' => $this->request->data['Investment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                                $principal = $total;
                            }

                            break;
                        case 'Year(s)':

                            $finv_date = $inv_date;
                            $date = new DateTime($finv_date);
                            $date->add(new DateInterval('P' . $duration . 'Y'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1Y'));
                                $interest_amount2 = $interest_amount1 * (365 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                    'investor_id' => $this->request->data['Investment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $check = $this->Session->check('statemt_array_fixed');
                    if ($check) {
                        $this->Session->delete('statemt_array_fixed');
                    }
                    $this->Session->write('statemt_array_fixed', $statemt_array);
                    $total_tenure = $this->request->data['Investment']['total_tenure'];
                    $description = 'Fixed income investment for ' . $total_tenure . ' ' . $period;

                    $investment_array = array(
                        'investment_amount' => $this->request->data['Investment']['investment_amount'],
//                        'investment_term_id' => $this->request->data['Investment']['investmentterm_id'],
                        'custom_rate' => $rate,
                        'duration' => $this->request->data['Investment']['duration'],
                        'investment_period' => $period,
                        'total_tenure' => $total_tenure,
                        'instruction_id' => $this->request->data['Investment']['instruction_id'],
                        'instruction_details' => $this->request->data['Investment']['instruction_details'],
                        'interest_earned' => $interest_amount,
                        'total_amount_earned' => $this->request->data['Investment']['investment_amount'],
                        'earned_balance' => $this->request->data['Investment']['investment_amount'],
                        'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d')
                    );
                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description);
                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_fee / 100) * $investment_amount;

                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_fee / 100) * $investment_amount;
                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }


                    $check = $this->Session->check('investment_array_fixed');
                    if ($check) {
                        $this->Session->delete('investment_array_fixed');
                    }

                    $this->Session->write('investment_array_fixed', $investment_array);

                    $check = $this->Session->check('variabless_fixed');
                    if ($check) {
                        $this->Session->delete('variabless_fixed');
                    }

                    $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                    $this->Session->write('variabless_fixed', $variables);
                }



                if (isset($this->request->data['equity_process'])) {
                    $equity_name = '';
                    $totalamt = 0;
                    $total_shares = 0;
                    $equities_list_id = $this->request->data['Investment']['equities_list_id'];
                    $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id)));
                    if ($equity) {
                        $equity_name = $equity['EquitiesList']['equity_abbrev'];
                    }
                    $check = $this->Session->check('variabless_equity');
                    if ($check) {
                        $this->Session->delete('variabless_equity');
                    }



                    $equities = $this->get_equity();
                    $equity_data = array($equities_list_id => array(
                            'equities_list_id' => $equities_list_id,
                            'purchase_date' => $inv_date,
                            'purchase_price' => $this->request->data['Investment']['purchase_price'],
                            'min_share_price' => $this->request->data['Investment']['min_share_price'],
                            'max_share_price' => $this->request->data['Investment']['max_share_price'],
                            'numb_shares' => $this->request->data['Investment']['numb_shares'],
                            'numb_shares_left' => $this->request->data['Investment']['numb_shares'],
                            'created_by' => $this->request->data['Investment']['user_id'],
                            'modified_by' => $this->request->data['Investment']['user_id']
                    ));
                    $equities+=$equity_data;
                    $this->set_equity($equities);
                    $numb0fshares = $this->request->data['Investment']['numb_shares'];
                    $equity_price = $this->request->data['Investment']['max_share_price'];

                    $totalamt += ($numb0fshares * $equity_price);
                    $this->request->data['Investment']['total_amount'] = $totalamt;
                    $total_shares += $numb0fshares;
                    if ($totalamt > $amount_available) {
                        //RESET CASH INPUTS AND RETURN
//                        $this->Session->write('investtemp1.amount_deposited', $this->request->data['Investment']['amount_deposited']);
//                        $this->Session->write('investtemp1.cash_athand', $this->request->data['Investment']['cash_athand']);
//                        $this->Session->write('investtemp1.total_invested', $this->request->data['Investment']['total_invested']);

                        $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page));
                    }
                    $x = 2;
                    while ($x <= 5) {
                        $equities = $this->get_equity();

                        //equity already exists, add to equity_details
                        if (isset($this->request->data['Investment']['equities_list_id' . $x]) &&
                                !empty($this->request->data['Investment']['equities_list_id' . $x])) {
                            $newequities_list_id = $this->request->data['Investment']['equities_list_id' . $x];
                            $equity_data = array($newequities_list_id => array(
                                    'equities_list_id' => $newequities_list_id,
                                    'purchase_date' => $inv_date,
                                    'purchase_price' => $this->request->data['Investment']['purchase_price' . $x],
                                    'min_share_price' => $this->request->data['Investment']['min_share_price' . $x],
                                    'max_share_price' => $this->request->data['Investment']['max_share_price' . $x],
                                    'numb_shares' => $this->request->data['Investment']['numb_shares' . $x],
                                    'numb_shares_left' => $this->request->data['Investment']['numb_shares' . $x],
                                    'created_by' => $this->request->data['Investment']['user_id'],
                                    'modified_by' => $this->request->data['Investment']['user_id']
                            ));

                            $equities+=$equity_data;
                            $this->set_equity($equities);
                            $numb0fshares = $this->request->data['Investment']['numb_shares' . $x];
                            $equity_price = $this->request->data['Investment']['max_share_price' . $x];
                            $total_shares += $numb0fshares;
                            $totalamt += ($numb0fshares * $equity_price);
                            $this->request->data['Investment']['total_amount'] = $totalamt;
                        }
                        $x++;
                    }
                    if ($totalamt > $amount_available) {
                        //RESET CASH INPUTS AND RETURN
//                        $this->Session->write('investtemp1.amount_deposited', $this->request->data['Investment']['amount_deposited']);
//                        $this->Session->write('investtemp1.cash_athand', $this->request->data['Investment']['cash_athand']);
//                        $this->Session->write('investtemp1.total_invested', $this->request->data['Investment']['total_invested']);

                        $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page));
                    }
//                    $new_cashathand = $amount_available - $totalamt;
//                    $new_cashinvested = $cashinvested + $totalamt;

                    //Ledger transaction entry
//                    $description = 'Equity investment';
//                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
//                        $this->request->data['Investment']['cashreceiptmode_id'],
//                        'cheque_no' => $cheque_no, 'debit' => $totalamt, 'user_id' => $this->request->data['Investment']['user_id'],
//                        'date' => $inv_date, 'description' => $description);
                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_fee / 100) * $totalamt;

                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_fee / 100) * $totalamt;
                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }


                    $investment_array = array(
                        'total_amount' => $totalamt
                    );
                    $check = $this->Session->check('investment_array_equity');
                    if ($check) {
                        $this->Session->delete('investment_array_equity');
                    }

                    $this->Session->write('investment_array_equity', $investment_array);

//                        break;
                    $variables = array('totalamt' => $totalamt, 'share_price' => $total_shares);
                    $this->Session->write('variabless_equity', $variables);
                }



//store total_invested and cash at hand in session so can save in investment when storing array in summary view
//$this->Session->write('investtemp1.cash_athand', $new_cashathand);
                //$this->Session->write('investtemp1.total_invested', $new_cashinvested);
                $generic_array = array('user_id' => $this->request->data['Investment']['user_id'],
                    'investor_id' => $this->request->data['Investment']['investor_id'],
                    'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'currency_id' => $this->request->data['Investment']['currency_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'cheque_no' => $cheque_no,
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                    'investment_date' => $inv_date);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
                //move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested);


                $this->Session->delete('investtemp');
                $this->Session->delete('investtemp1');
                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('investtemp.investmentproduct_id', $investmentproduct_id);
                $this->Session->write('investtemp1', $this->request->data['Investment']);
                $this->Session->write('investtemp1.amount_deposited', 0);
                $this->Session->write('investtemp1.cash_athand', $new_cashathand);
                $this->Session->write('investtemp1.total_invested', $new_cashinvested);
                $message = 'Investment Successfully Processed,Click Next to Save and Print Investment Contract';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page));
            } else {
                $message = 'Please Select  an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page));
            }
        }
    }

    function processfixed_edit() {
        $this->autoRender = false;
        if ($this->request->is('post')) {

            $page = $this->request->data['Investment']['investor_page'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            $investment_id = $this->request->data['Investment']['id'];
            $investmentproduct_id = 1;
            $cheque_no = "";
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $ledger_info = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);
            if ($ledger_info) {

                $oldAmount = 0;
                $oldAmount = $this->request->data['Investment']['old_investmentamount'];
                $amount_available = $oldAmount + $ledger_info['ClientLedger']['availalble_cash'];
                $cashinvested = $ledger_info['ClientLedger']['invested_amount'] - $oldAmount;


                $inv_day = $this->request->data['Investment']['investment_date']['day'];
                if (!empty($inv_day)) {
                    $inv_month = $this->request->data['Investment']['investment_date']['month'];
                    $inv_year = $this->request->data['Investment']['investment_date']['year'];
                    $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                    $sinv_date = strtotime($finv_date);
                    $inv_date = date('Y-m-d', $sinv_date);
                } else {
                    $inv_date = date('Y-m-d');
                }
                $basefee_duedate = new DateTime($inv_date);
                $basefee_duedate->add(new DateInterval('P3M'));
                $pur_day = $this->request->data['Investment']['investment_date']['day'];
                if (!empty($pur_day)) {
                    $pur_month = $this->request->data['Investment']['investment_date']['month'];
                    $pur_year = $this->request->data['Investment']['investment_date']['year'];
                    $pfinv_date = $pur_year . "-" . $pur_month . "-" . $pur_day;
                    $psinv_date = strtotime($pfinv_date);
                    $pinv_date = date('Y-m-d', $psinv_date);
                } else {
                    $pinv_date = date('Y-m-d');
                }
                $this->request->data['Investment']['investment_date'] = $inv_date;
                $this->request->data['Investment']['purchase_date'] = $pinv_date;


                if (isset($currency_id) && !empty($currency_id)) {
                    $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => 1)));
                    if ($currency_array) {
                        $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                    }
                }
                if ($this->Session->check('editinvesttemp') == true) {
                    $this->Session->delete('editinvesttemp');
                }
                $this->Session->write('editinvesttemp', $this->request->data['Investment']);


                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == "" || $this->request->data['Investment']['cashreceiptmode_id'] == null) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == '2') && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }


                if ($this->request->data['Investment']['instruction_id'] == "" || $this->request->data['Investment']['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }
                if (($this->request->data['Investment']['instruction_id'] == 5) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page));
                }
                if ($this->request->data['Investment']['investment_amount'] == "" || $this->request->data['Investment']['investment_amount'] == null) {
                    $message = 'Please Enter Investment Amount';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                } else {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];

                    if ($investment_amount > $amount_available) {
                        //RESET CASH INPUTS AND RETURN
                        $message = 'Investment Amount cannot be more than investor\'s available cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                    }
                }
                if ($this->request->data['Investment']['duration'] == "" || $this->request->data['Investment']['duration'] == null) {
                    $message = 'Please Enter Investment Duration';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                }

                if ($this->request->data['Investment']['total_tenure'] == "" || $this->request->data['Investment']['total_tenure'] == null) {
                    $message = 'Please Enter Total Tenure';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                } else {
                    $total_tenure = $this->request->data['Investment']['total_tenure'];

                    $duration = $this->request->data['Investment']['duration'];
                    if ($duration > $total_tenure) {
                        $message = 'Duration cannot be more than total tenure';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                    }
                }
                $first_date = $inv_date;
                $base_fee = 0;
                $base_rate = 0;
                $benchmark_rate = 0;
                if (isset($this->request->data['Investment']['base_fees'])) {
                    $base_rate = $this->request->data['Investment']['base_fees'];
                }
                if (isset($this->request->data['Investment']['benchmark_rate'])) {
                    $benchmark_rate = $this->request->data['Investment']['benchmark_rate'];
                }
                $date = new DateTime($first_date);
                $new_cashathand = $amount_available - $investment_amount;
                $new_cashinvested = $cashinvested + $investment_amount;

                $period = $this->request->data['Investment']['investment_period'];
                $duration = $this->request->data['Investment']['duration'];
                $year = $duration;
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
                        for ($n = 1; $n <= $duration; $n++) {
                            $date_statemt->add(new DateInterval('P1D'));
                            $interest_amount2 = $interest_amount1 * (1 / 365);
                            $total = $interest_amount2 + $principal;
                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                'investor_id' => $this->request->data['Investment']['investor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                                $principal = $total;
                        }

                        break;
                    case 'Year(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
                        $date->add(new DateInterval('P' . $duration . 'Y'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $YEAR2DAYS = 365 * $duration;
                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                        $amount_due = $interest_amount + $investment_amount;
                        for ($n = 1; $n <= $duration; $n++) {
                            $date_statemt->add(new DateInterval('P1Y'));
                            $interest_amount2 = $interest_amount1 * (365 / 365);
                            $total = $interest_amount2 + $principal;
                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                'investor_id' => $this->request->data['Investment']['investor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                            $principal = $total;
                        }

                        break;
                }
                $check = $this->Session->check('statemt_array_fixed');
                if ($check) {
                    $this->Session->delete('statemt_array_fixed');
                }
                $this->Session->write('statemt_array_fixed', $statemt_array);
                $total_tenure = $this->request->data['Investment']['total_tenure'];
                $description = 'Fixed income investment for ' . $total_tenure . ' ' . $period;

                $investment_array = array(
                    'investment_amount' => $this->request->data['Investment']['investment_amount'],
//                        'investment_term_id' => $this->request->data['Investment']['investmentterm_id'],
                    'custom_rate' => $rate,
                    'duration' => $this->request->data['Investment']['duration'],
                    'investment_period' => $period,
                    'total_tenure' => $total_tenure,
                    'instruction_id' => $this->request->data['Investment']['instruction_id'],
                    'instruction_details' => $this->request->data['Investment']['instruction_details'],
                    'interest_earned' => $interest_amount,
                    'total_amount_earned' => $this->request->data['Investment']['investment_amount'],
                    'earned_balance' => $this->request->data['Investment']['investment_amount'],
                    'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d')
                );
                $ledger_transactions[] = array('cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => $description, 'edit' => $oldAmount);
                $base_fee = 0;
                $benchmark_fee = 0;
                switch ($management_fee_type) {
                    case 'Management Fee':
                        $base_fee = ($base_fee / 100) * $investment_amount;

                        if ($base_fee > $new_cashathand) {
                            $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                        }
                        $new_cashathand = $new_cashathand - $base_fee;
                        break;
                    case 'Management & Performance Fee':
                        $base_fee = ($base_fee / 100) * $investment_amount;
                        if ($base_fee > $new_cashathand) {
                            $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
                        }
                        $new_cashathand = $new_cashathand - $base_fee;

                        break;
                }


                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }

                $this->Session->write('investment_array_fixed', $investment_array);

                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }

                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                $this->Session->write('variabless_fixed', $variables);
                $generic_array = array(
                    'id' => $investment_id,
                    'investor_id' => $investor_id,
                    'user_id' => $this->request->data['Investment']['user_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_date' => $inv_date);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
//move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested);

                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('editinvesttemp', $this->request->data['Investment']);
                $message = 'Investment Successfully Processed,Click Next to Save and Print Investment Contract';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
            } else {
                $message = 'Please Select  an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id));
            }
        }
    }

    function process_comp() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $ledger_transactions = array();
            $cheque_no = '';
            $amount = $this->request->data['Investment']['investment_amount'];
            $page = $this->request->data['Investment']['investor_page'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $currency_id = $this->request->data['Investment']['currency_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];

            $investor_id = $this->request->data['Investment']['investor_id'];
            $investmentproduct_id = $this->request->data['Investment']['investmentproduct_id'];
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $inv_day = $this->request->data['Investment']['investment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['Investment']['investment_date']['month'];
                $inv_year = $this->request->data['Investment']['investment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $basefee_duedate = new DateTime($inv_date);
            $basefee_duedate->add(new DateInterval('P3M'));

            $pur_day = $this->request->data['Investment']['investment_date']['day'];
            if (!empty($pur_day)) {
                $pur_month = $this->request->data['Investment']['investment_date']['month'];
                $pur_year = $this->request->data['Investment']['investment_date']['year'];
                $pfinv_date = $pur_year . "-" . $pur_month . "-" . $pur_day;
                $psinv_date = strtotime($pfinv_date);
                $pinv_date = date('Y-m-d', $psinv_date);
            } else {
                $pinv_date = date('Y-m-d');
            }
            $this->request->data['Investment']['investment_date'] = $inv_date;
            $this->request->data['Investment']['purchase_date'] = $pinv_date;
            if ($this->Session->check('investtemp') == true) {
                $this->Session->delete('investtemp');
            }
            if ($this->Session->check('investtemp1') == true) {
                $this->Session->delete('investtemp1');
            }
            if (isset($currency_id) && !empty($currency_id)) {
                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => $currency_id)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }
            }
//            if (isset($this->request->data['equity_process'])) {
//                case 2:
//                    $this->request->data['Investment']['instruction_id2'] = $this->request->data['instruction_id2'];
//                    $this->request->data['Investment']['instruction_details2'] = $this->request->data['instruction_details2'];
//                    $this->request->data['Investment']['currency2'] = $this->request->data['currency2'];
//                    $this->request->data['Investment']['paymentmode_id2'] = $this->request->data['paymentmode_id2'];
//
//                    $this->request->data['Investment']['paymentschedule_id2'] = $this->request->data['paymentschedule_id2'];
//                    break;
//            }
            $this->Session->write('investtemp', $this->request->data['Investment']);

            $this->Session->write('investtemp1', $this->request->data['Investment']);

//            $term_id = $this->request->data['Investment']['investmentterm_id'];
//            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {
            $amount_available = $this->request->data['Investment']['cash_athand'] + $this->request->data['Investment']['amount_deposited'];
            $cashinvested = $this->request->data['Investment']['total_invested'];
            $new_cashinvested = $cashinvested;
//            $term_id = $this->request->data['Investment']['investmentterm_id'];
//            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {
            if (isset($this->request->data['fixed_process'])) {
//                switch ($investmentproduct_id) {
//                    case 1:
//                if ($this->request->data['Investment']['investmentterm_id'] == "" || $this->request->data['Investment']['investmentterm_id'] == null) {
//                    $message = 'Please Select an Investment Term';
//                    $this->Session->write('bmsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
//                }



                if ($this->request->data['Investment']['investmentproduct_id'] == "" || $this->request->data['Investment']['investmentproduct_id'] == null) {
                    $message = 'Please Select  an Investment Product';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['currency_id'] == "" || $this->request->data['Investment']['currency_id'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == "" || $this->request->data['Investment']['cashreceiptmode_id'] == null) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == '2') && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }

                if ($this->request->data['Investment']['instruction_id'] == "" || $this->request->data['Investment']['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['Investment']['instruction_id'] == 5) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['investment_amount'] == "" || $this->request->data['Investment']['investment_amount'] == null) {
                    $message = 'Please Enter Investment Amount';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                } else {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];

                    if ($investment_amount > $amount_available) {

                        $message = 'Investment Amount cannot be more than investor\'s available cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                    }
                }
                if ($this->request->data['Investment']['duration'] == "" || $this->request->data['Investment']['duration'] == null) {
                    $message = 'Please Enter Investment Duration';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['total_tenure'] == "" || $this->request->data['Investment']['total_tenure'] == null) {
                    $message = 'Please Enter Total Tenure';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                } else {
                    $total_tenure = $this->request->data['Investment']['total_tenure'];

                    $duration = $this->request->data['Investment']['duration'];
                    if ($duration > $total_tenure) {
                        $message = 'Duration cannot be more than total tenure';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                    }
                }
                $first_date = $inv_date;
//                        break;
            }
            if (isset($this->request->data['equity_process'])) {
//                    case 2:
                $first_date = $pinv_date;

                $this->request->data['Investment']['investment_date'] = $pinv_date;

//                        if ($this->request->data['instruction_id2'] == "" || $this->request->data['instruction_id2'] == null) {
//                            $message = 'Please Select an Instruction';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }
//                        if (($this->request->data['instruction_id2'] == 5) && (is_null($this->request->data['instruction_details2']) || $this->request->data['instruction_details2'] == "")) {
//                            $message = 'Please State Instruction Details';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }
//                        if ($this->request->data['currency'] == "" || $this->request->data['currency'] == null) {
//                            $message = 'Please Select a Currency';
//                            $this->Session->write('bmsg', $message);
//                            $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                        }

                if ($this->request->data['Investment']['currency_id'] == "" || $this->request->data['Investment']['currency_id'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == "" || $this->request->data['Investment']['cashreceiptmode_id'] == null) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == '2') && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }
                if ($this->request->data['Investment']['equities_list_id'] == "" || $this->request->data['Investment']['equities_list_id'] == null) {
                    $message = 'Please Select Equity Purchased';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['purchase_price'] == "" || $this->request->data['Investment']['purchase_price'] == null) {
                    $message = 'Please State Equity Purchase Price';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['numb_shares'] == "" || $this->request->data['Investment']['numb_shares'] == null) {
                    $message = 'Please State number of Shares';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }


//                $numb0fshares = $this->request->data['Investment']['numb_shares'];
//                $equity_price = $this->request->data['Investment']['purchase_price'];
//
//                $totalamt = ($numb0fshares * $equity_price);
//                $this->request->data['Investment']['total_amount'] = $totalamt;
                // $this->request->data['Investment']['investment_amount'] = $totalamt;
//                        break;
            }
//                }
////            }
            //ask if 
            if (isset($payment_schedule) && !empty($payment_schedule)) {
                if ($payment_schedule == 1) {
                    
                } elseif ($payment_schedule == 2) {
                    
                }
            }
            $deposit = $this->request->data['Investment']['amount_deposited'];
            if ($deposit > 0) {
                $ledger_transactions[] = array('cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'credit' => $deposit, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => 'Deposit for investment');
            }
            $base_fee = 0;
            $base_rate = 0;
            $benchmark_rate = 0;
            if (isset($this->request->data['Investment']['base_fees'])) {
                $base_rate = $this->request->data['Investment']['base_fees'];
            }
            if (isset($this->request->data['Investment']['benchmark_rate'])) {
                $benchmark_rate = $this->request->data['Investment']['benchmark_rate'];
            }
            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {


                $date = new DateTime($first_date);

//                switch ($investmentproduct_id) {
//                    case 1:
                if (isset($this->request->data['fixed_process'])) {
//                    $portfolio = $this->InvestmentTerm->find('first', array('conditions' => array('InvestmentTerm.id' => $term_id), 'recursive' => -1));
//
//                    if ($portfolio) {
//                        $year = $portfolio['InvestmentTerm']['period'];
//                        $date->add(new DateInterval('P' . $year . 'Y'));
//                        $date_statemt = new DateTime($first_date);
//                        $principal = $investment_amount;
//                        $statemt_array = array();
//                        if (isset($custom_rate) && !empty($custom_rate)) {
//                            $rate = $custom_rate;
//                        } else {
//                            $rate = $portfolio['InvestmentTerm']['interest_rate'];
//                        }
//                        $interest_amount1 = ($rate / 100) * $investment_amount;
//                        $interest_amount = $interest_amount1 * $year;
//                        $amount_due = $interest_amount + $investment_amount;
//                        for ($n = 1; $n <= $year; $n++) {
//                            $date_statemt->add(new DateInterval('P1Y'));
//
//                            $total = $interest_amount1 + $principal;
//                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                'principal' => $principal,
//                                'interest' => $interest_amount1,
//                                'maturity_date' => $date_statemt->format('Y-m-d'),
//                                'total' => $total);
//                            $principal = $total;
//                        }
                    $new_cashathand = $amount_available - $investment_amount;
                    $new_cashinvested = $cashinvested + $investment_amount;
                    $period = $this->request->data['Investment']['investment_period'];
                    $duration = $this->request->data['Investment']['duration'];
                    $year = $duration;
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
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1D'));
                                $interest_amount2 = $interest_amount1 * (1 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                    'investor_id' => $this->request->data['Investment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                                $principal = $total;
                            }

                            break;

//                        case 'Month(s)':
//
//                            $date->add(new DateInterval('P' . $duration . 'M'));
//                            $date_statemt = new DateTime($first_date);
//                            $principal = $investment_amount;
//                            $statemt_array = array();
//                            $rate = $custom_rate;
//
//                            $interest_amount1 = ($rate / 100) * $investment_amount;
//                            $interest_amount = $interest_amount1;
//                            $amount_due = $interest_amount + $investment_amount;
//                            for ($n = 1; $n <= $duration; $n++) {
//                                $date_statemt->add(new DateInterval('P1M'));
//
//                                $interest_amount2 = $interest_amount1 * (1 / 365);
//                                $total = $interest_amount2 + $principal;
//                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                    'investor_id' => $this->request->data['Investment']['investor_id'],
//                                    'principal' => $principal,
//                                    'interest' => $interest_amount2,
//                                    'maturity_date' => $date_statemt->format('Y-m-d'),
//                                    'total' => $total);
////                                $principal = $total;
//                            }
//
//                            break;

                        case 'Year(s)':

                            $finv_date = $inv_date;
                            $date = new DateTime($finv_date);
                            $date->add(new DateInterval('P' . $duration . 'Y'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;
                            $YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                            $amount_due = $interest_amount + $investment_amount;
                            for ($n = 1; $n <= $duration; $n++) {
                                $date_statemt->add(new DateInterval('P1Y'));
                                $interest_amount2 = $interest_amount1 * (365 / 365);
                                $total = $interest_amount2 + $principal;
                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                    'investor_id' => $this->request->data['Investment']['investor_id'],
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $check = $this->Session->check('statemt_array_fixed');
                    if ($check) {
                        $this->Session->delete('statemt_array_fixed');
                    }
                    $this->Session->write('statemt_array_fixed', $statemt_array);
                    $total_tenure = $this->request->data['Investment']['total_tenure'];
                    $description = 'Fixed income investment for ' . $total_tenure . ' ' . $period;

                    $investment_array = array(
                        'investment_amount' => $this->request->data['Investment']['investment_amount'],
//                        'investment_term_id' => $this->request->data['Investment']['investmentterm_id'],
                        'custom_rate' => $rate,
                        'duration' => $this->request->data['Investment']['duration'],
                        'investment_period' => $period,
                        'total_tenure' => $total_tenure,
                        'instruction_id' => $this->request->data['Investment']['instruction_id'],
                        'instruction_details' => $this->request->data['Investment']['instruction_details'],
                        'interest_earned' => $interest_amount,
                        'total_amount_earned' => $this->request->data['Investment']['investment_amount'],
                        'earned_balance' => $this->request->data['Investment']['investment_amount'],
                        'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d')
                    );
                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description);
                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_fee / 100) * $investment_amount;

                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_fee / 100) * $investment_amount;
                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }




                    $check = $this->Session->check('investment_array_fixed');
                    if ($check) {
                        $this->Session->delete('investment_array_fixed');
                    }

                    $this->Session->write('investment_array_fixed', $investment_array);

                    $check = $this->Session->check('variabless_fixed');
                    if ($check) {
                        $this->Session->delete('variabless_fixed');
                    }

                    $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                    $this->Session->write('variabless_fixed', $variables);
//                    } else {
//                        $message = 'Investment Term settings missing. Contact Administrator';
//                        $this->Session->write('emsg', $message);
//                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
//                    }
//                        break;
                }
                if (isset($this->request->data['equity_process'])) {
                    $equity_name = '';
                    $totalamt = 0;
                    $total_shares = 0;
                    $equities_list_id = $this->request->data['Investment']['equities_list_id'];
                    $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id)));
                    if ($equity) {
                        $equity_name = $equity['EquitiesList']['equity_abbrev'];
                    }
                    $check = $this->Session->check('variabless_equity');
                    if ($check) {
                        $this->Session->delete('variabless_equity');
                    }

//                    $variables = array('totalamt' => $totalamt, 'share_price' => $this->request->data['Investment']['purchase_price'], 'total_fees' => $this->request->data['Investment']['total_fees'], 'equity' => $equity_name);
//                    $this->Session->write('variabless_equity', $variables);



                    $equities = $this->get_equity();
                    $equity_data = array($equities_list_id => array(
                            'equities_list_id' => $equities_list_id,
                            'purchase_date' => $inv_date,
                            'purchase_price' => $this->request->data['Investment']['purchase_price'],
                            'min_share_price' => $this->request->data['Investment']['min_share_price'],
                            'max_share_price' => $this->request->data['Investment']['max_share_price'],
                            'numb_shares' => $this->request->data['Investment']['numb_shares'],
                            'numb_shares_left' => $this->request->data['Investment']['numb_shares'],
                            'created_by' => $this->request->data['Investment']['user_id'],
                            'modified_by' => $this->request->data['Investment']['user_id']
                    ));
                    $equities+=$equity_data;
                    $this->set_equity($equities);
                    $numb0fshares = $this->request->data['Investment']['numb_shares'];
                    $equity_price = $this->request->data['Investment']['max_share_price'];

                    $totalamt += ($numb0fshares * $equity_price);
                    $this->request->data['Investment']['total_amount'] = $totalamt;
                    $total_shares += $numb0fshares;
                    if ($totalamt > $amount_available) {
                        //RESET CASH INPUTS AND RETURN
//                        $this->Session->write('investtemp1.amount_deposited', $this->request->data['Investment']['amount_deposited']);
//                        $this->Session->write('investtemp1.cash_athand', $this->request->data['Investment']['cash_athand']);
//                        $this->Session->write('investtemp1.total_invested', $this->request->data['Investment']['total_invested']);

                        $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                    }
                    $x = 2;
                    while ($x <= 5) {
                        $equities = $this->get_equity();

                        //equity already exists, add to equity_details
                        if (isset($this->request->data['Investment']['equities_list_id' . $x]) &&
                                !empty($this->request->data['Investment']['equities_list_id' . $x])) {
                            $newequities_list_id = $this->request->data['Investment']['equities_list_id' . $x];
                            $equity_data = array($newequities_list_id => array(
                                    'equities_list_id' => $newequities_list_id,
                                    'purchase_date' => $inv_date,
                                    'purchase_price' => $this->request->data['Investment']['purchase_price' . $x],
                                    'min_share_price' => $this->request->data['Investment']['min_share_price' . $x],
                                    'max_share_price' => $this->request->data['Investment']['max_share_price' . $x],
                                    'numb_shares' => $this->request->data['Investment']['numb_shares' . $x],
                                    'numb_shares_left' => $this->request->data['Investment']['numb_shares' . $x],
                                    'created_by' => $this->request->data['Investment']['user_id'],
                                    'modified_by' => $this->request->data['Investment']['user_id']
                            ));

                            $equities+=$equity_data;
                            $this->set_equity($equities);
                        }
                        $x++;
                    }
                    if ($totalamt > $amount_available) {
                        //RESET CASH INPUTS AND RETURN

                        $message = 'Total equity cost cannot be more than investor\'s availalbe cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                    }
                    $new_cashathand = $amount_available - $totalamt;
                    $new_cashinvested = $cashinvested + $totalamt;

//                    //Ledger transaction entry
//                    $description = 'Equity investment';
//                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
//                        $this->request->data['Investment']['cashreceiptmode_id'],
//                        'cheque_no' => $cheque_no, 'debit' => $totalamt, 'user_id' => $this->request->data['Investment']['user_id'],
//                        'date' => $inv_date, 'description' => $description);
                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_fee / 100) * $totalamt;

                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_fee / 100) * $totalamt;
                            if ($base_fee > $new_cashathand) {
                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
                                $this->Session->write('bmsg', $message);
                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                            }
                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }


                    $investment_array = array(
                        'total_amount' => $totalamt
                    );
                    $check = $this->Session->check('investment_array_equity');
                    if ($check) {
                        $this->Session->delete('investment_array_equity');
                    }

                    $this->Session->write('investment_array_equity', $investment_array);
                    $variables = array('totalamt' => $totalamt, 'share_price' => $total_shares);
                    $this->Session->write('variabless_equity', $variables);
//                        break;
                }





                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);


//store total_invested and cash at hand in session so can save in investment when storing array in summary view
//$this->Session->write('investtemp1.cash_athand', $new_cashathand);
                //$this->Session->write('investtemp1.total_invested', $new_cashinvested);
                $generic_array = array('user_id' => $this->request->data['Investment']['user_id'],
                    'investor_id' => $this->request->data['Investment']['investor_id'],
                    'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'currency_id' => $this->request->data['Investment']['currency_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'cheque_no' => $cheque_no,
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                    'investment_date' => $inv_date,
                    'cash_athand' => $new_cashathand,
                    'total_invested' => $new_cashinvested);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
//move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested);


                $this->Session->delete('investtemp');
                $this->Session->delete('investtemp1');
                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('investtemp.investmentproduct_id', $investmentproduct_id);
                $this->Session->write('investtemp1', $this->request->data['Investment']);
                $this->Session->write('investtemp1.amount_deposited', 0);
                $this->Session->write('investtemp1.cash_athand', $new_cashathand);
                $this->Session->write('investtemp1.total_invested', $new_cashinvested);
                $message = 'Investment Successfully Processed,Click Next to Save and Print Certificate';
                $this->Session->write('smsg', $message);

                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            } else {
                $message = 'Please Select  an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            }
        }
    }

    function process_comp_OLD() {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $amount = $this->request->data['Investment']['investment_amount'];
            $page = $this->request->data['Investment']['investor_page'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $investmentproduct_id = $this->request->data['Investment']['investmentproduct_id'];
            $currency_id = $this->request->data['Investment']['currency_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            $inv_day = $this->request->data['Investment']['investment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['Investment']['investment_date']['month'];
                $inv_year = $this->request->data['Investment']['investment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $pur_day = $this->request->data['Investment']['purchase_date']['day'];
            if (!empty($pur_day)) {
                $pur_month = $this->request->data['Investment']['purchase_date']['month'];
                $pur_year = $this->request->data['Investment']['purchase_date']['year'];
                $pfinv_date = $pur_year . "-" . $pur_month . "-" . $pur_day;
                $psinv_date = strtotime($pfinv_date);
                $pinv_date = date('Y-m-d', $psinv_date);
            } else {
                $pinv_date = date('Y-m-d');
            }
            $this->request->data['Investment']['investment_date'] = $inv_date;
            $this->request->data['Investment']['purchase_date'] = $pinv_date;

            if ($this->Session->check('investtemp') == true) {
                $this->Session->delete('investtemp');
            }
            if (isset($currency_id) && !empty($currency_id)) {
                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => $currency_id)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }
            }
            if (isset($this->request->data['equity_process'])) {
//                case 2:
                $this->request->data['Investment']['instruction_id2'] = $this->request->data['instruction_id2'];
                $this->request->data['Investment']['instruction_details2'] = $this->request->data['instruction_details2'];
                $this->request->data['Investment']['currency2'] = $this->request->data['currency2'];
                $this->request->data['Investment']['paymentmode_id2'] = $this->request->data['paymentmode_id2'];

                $this->request->data['Investment']['paymentschedule_id2'] = $this->request->data['paymentschedule_id2'];
//                    break;
            }
            $this->Session->write('investtemp', $this->request->data['Investment']);


//            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {
//                switch ($investmentproduct_id) {
//                    case 1:
            if (isset($this->request->data['fixed_process'])) {
                $term_id = $this->request->data['Investment']['investmentterm_id'];

                if ($this->request->data['Investment']['investmentterm_id'] == "" || $this->request->data['Investment']['investmentterm_id'] == null) {
                    $message = 'Please Select an Investment Term';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }


                if ($this->request->data['Investment']['currency_id'] == "" || $this->request->data['Investment']['currency_id'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['investmentproduct_id'] == "" || $this->request->data['Investment']['investmentproduct_id'] == null) {
                    $message = 'Please Select  an Investment Product';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['instruction_id'] == "" || $this->request->data['Investment']['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['Investment']['instruction_id'] == 5) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                $investment_amount = $this->request->data['Investment']['investment_amount'];
                $first_date = $inv_date;
//                        break;
            }
//                    case 2:
            if (isset($this->request->data['equity_process'])) {
                $first_date = $pinv_date;

                $this->request->data['Investment']['investment_date'] = $pinv_date;
                if ($this->request->data['instruction_id'] == "" || $this->request->data['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['instruction_id'] == 5) && (is_null($this->request->data['instruction_details']) || $this->request->data['instruction_details2'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['currency'] == "" || $this->request->data['currency'] == null) {
                    $message = 'Please Select a Currency';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['paymentschedule_id'] == "" || $this->request->data['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['paymentmode_id'] == "" || $this->request->data['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if ($this->request->data['Investment']['equities_list_id'] == "" || $this->request->data['Investment']['equities_list_id'] == null) {
                    $message = 'Please Select Equity Purchased';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['purchase_price'] == "" || $this->request->data['Investment']['purchase_price'] == null) {
                    $message = 'Please State Equity Purchase Price';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                if ($this->request->data['Investment']['numb_shares'] == "" || $this->request->data['Investment']['numb_shares'] == null) {
                    $message = 'Please State number of Shares';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }
                if (($this->request->data['Investment']['total_fees'] == "") || is_null($this->request->data['Investment']['total_fees'])) {
                    $message = 'Please State Total Fees';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                }

                $numb0fshares = $this->request->data['Investment']['numb_shares'];
                $equity_price = $this->request->data['Investment']['purchase_price'];
                $total_fees = $this->request->data['Investment']['total_fees'];

                $totalamt = ($numb0fshares * $equity_price) + $total_fees;
                $this->request->data['Investment']['total_amount'] = $totalamt;
//                        break;
//                }
            }
            //ask if 
            if (isset($payment_schedule) && !empty($payment_schedule)) {
                if ($payment_schedule == 1) {
                    
                } elseif ($payment_schedule == 2) {
                    
                }
            }
            if (isset($investmentproduct_id) && !empty($investmentproduct_id)) {
                $first_date = $inv_date;

                $date = new DateTime($first_date);

//                switch ($investmentproduct_id) {
//                    case 1:
                if (isset($this->request->data['fixed_process'])) {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];

                    $portfolio = $this->InvestmentTerm->find('first', array('conditions' => array('InvestmentTerm.id' => $term_id), 'recursive' => -1));

                    if ($portfolio) {

                        $year = $portfolio['InvestmentTerm']['period'];
                        $date->add(new DateInterval('P' . $year . 'Y'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();

                        if (isset($custom_rate) && !empty($custom_rate)) {
                            $rate = $custom_rate;
                        } else {
                            $rate = $portfolio['InvestmentTerm']['interest_rate'];
                        }

                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * $year;
                        $amount_due = $interest_amount + $investment_amount;
                        for ($n = 1; $n <= $year; $n++) {
                            $date_statemt->add(new DateInterval('P1Y'));

                            $total = $interest_amount1 + $principal;
                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                'investor_id' => $this->request->data['Investment']['investor_id'], 'principal' => $principal,
                                'interest' => $interest_amount1, 'maturity_date' => $date_statemt->format('Y-m-d'), 'total' => $total);
                            $principal = $total;
                        }
                        $check = $this->Session->check('statemt_array_fixed');
                        if ($check) {
                            $this->Session->delete('statemt_array_fixed');
                        }
                        $this->Session->write('statemt_array_fixed', $statemt_array);

                        $investment_array = array('user_id' => $this->request->data['Investment']['user_id'],
                            'investor_id' => $this->request->data['Investment']['investor_id'],
                            'investment_amount' => $this->request->data['Investment']['investment_amount'],
                            'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
                            'investment_term_id' => $this->request->data['Investment']['investmentterm_id'], 'custom_rate' => $rate,
                            'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                            'currency_id' => $this->request->data['Investment']['currency_id'], 'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                            'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                            'instruction_id' => $this->request->data['Investment']['instruction_id'],
                            'instruction_details' => $this->request->data['Investment']['instruction_details']
                            , 'interest_earned' => $interest_amount, 'investment_date' => $inv_date, 'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'));


                        $check = $this->Session->check('investment_array_fixed');
                        if ($check) {
                            $this->Session->delete('investment_array_fixed');
                        }

                        $this->Session->write('investment_array_fixed', $investment_array);

                        $check = $this->Session->check('variabless_fixed');
                        if ($check) {
                            $this->Session->delete('variabless_fixed');
                        }

                        $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                        $this->Session->write('variabless_fixed', $variables);
                    } else {
                        $message = 'Investment Term settings missing. Contact Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
                    }
//                        break;
                }
//                    case 2:
                if (isset($this->request->data['equity_process'])) {
                    $rate = '0.00';
                    $amount_due = '0.00';
                    $interest_amount = '0.00';

                    $equity_name = '';
                    $equities_list_id = $this->request->data['Investment']['equities_list_id'];
                    $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id)));
                    if ($equity) {
                        $equity_name = $equity['EquitiesList']['equity_abbrev'];
                    }
                    $check = $this->Session->check('variabless_equity');
                    if ($check) {
                        $this->Session->delete('variabless_equity');
                    }

                    $variables = array('totalamt' => $totalamt, 'share_price' => $this->request->data['Investment']['purchase_price'], 'total_fees' => $this->request->data['Investment']['total_fees'], 'equity' => $equity_name);

                    $this->Session->write('variabless_equity', $variables);

                    $investment_array = array('user_id' => $this->request->data['Investment']['user_id'],
                        'investor_id' => $this->request->data['Investment']['investor_id'],
                        'investment_term_id' => $this->request->data['Investment']['investmentterm_id'],
                        'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
                        'payment_schedule_id' => $this->request->data['paymentschedule_id2'],
                        'purchase_date' => $pinv_date,
                        'investment_date' => $pinv_date,
                        'currency_id' => $this->request->data['currency2'],
                        'payment_mode_id' => $this->request->data['paymentmode_id2'],
                        'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                        'instruction_id' => $this->request->data['instruction_id2'],
                        'instruction_details' => $this->request->data['instruction_details2'],
                        'total_fees' => $this->request->data['Investment']['total_fees'],
                        'equities_list_id' => $equities_list_id
                        , 'purchase_price' => $this->request->data['Investment']['purchase_price'],
                        'numb_shares' => $this->request->data['Investment']['numb_shares'],
                        'numb_shares_left' => $this->request->data['Investment']['numb_shares'],
                        'total_amount' => $totalamt);

                    $check = $this->Session->check('investment_array_equity');
                    if ($check) {
                        $this->Session->delete('investment_array_equity');
                    }

                    $this->Session->write('investment_array_equity', $investment_array);

//                        break;
                }





                //'investor_id' => $this->request->data['Investment']['investor_id'],





                $this->Session->delete('investtemp');
                $this->Session->delete('investtemp1');
                $this->Session->write('investtemp1', $this->request->data['Investment']);
                $this->Session->write('investtemp.investmentproduct_id', $investmentproduct_id);
                $message = 'Investment Successfully Processed,Click Next to Save and Print Certificate';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            } else {
                $message = 'Please Select  an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            }
//            $portfolio = $this->InvestmentTerm->find('first', array('conditions' => array('InvestmentTerm.id' => $term_id), 'recursive' => -1));
//
//            if ($portfolio) {
//
//                if (isset($custom_rate) && !empty($custom_rate)) {
//                    $rate = $custom_rate;
//                } else {
//                    $rate = $portfolio['InvestmentTerm']['interest_rate'];
//                }
//                $year = $portfolio['InvestmentTerm']['period'];
//                $investment_amount = $this->request->data['Investment']['investment_amount'];
//                $interest_amount1 = ($rate / 100) * $investment_amount;
//                $interest_amount = $interest_amount1 * $year;
//                $amount_due = $interest_amount + $investment_amount;
//
//                $first_date = $inv_date;
//
//                $date = new DateTime($first_date);
//                $date->add(new DateInterval('P' . $year . 'Y'));
//
//                $date_statemt = new DateTime($first_date);
//                $principal = $investment_amount;
//                $statemt_array = array();
//
//                for ($n = 1; $n <= $year; $n++) {
//                    $date_statemt->add(new DateInterval('P1Y'));
//
//                    $total = $interest_amount1 + $principal;
//                    $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                        'investor_id' => $this->request->data['Investment']['investor_id'], 'principal' => $principal,
//                        'interest' => $interest_amount1, 'maturity_date' => $date_statemt->format('Y-m-d'), 'total' => $total);
//                    $principal = $total;
//                }
//                //
//                $investment_array = array('user_id' => $this->request->data['Investment']['user_id'],
//                    'investor_id' => $this->request->data['Investment']['investor_id'],
//                    'investment_amount' => $this->request->data['Investment']['investment_amount'],
//                    'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
//                    'investment_term_id' => $this->request->data['Investment']['investmentterm_id'], 'custom_rate' => $rate,
//                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
//                    'currency_id' => $this->request->data['Investment']['currency_id'], 'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
//                    'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
//                    'instruction_id' => $this->request->data['Investment']['instruction_id'],
//                    'instruction_details' => $this->request->data['Investment']['instruction_details']
//                    , 'interest_earned' => $interest_amount, 'investment_date' => $inv_date, 'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d'));
//
//
//
//                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
//
//                $check = $this->Session->check('variabless');
//                if ($check) {
//                    $this->Session->delete('variabless');
//                }
//
//                $check = $this->Session->check('investment_array');
//                if ($check) {
//                    $this->Session->delete('investment_array');
//                }
//
//                $check = $this->Session->check('statemt_array');
//                if ($check) {
//                    $this->Session->delete('statemt_array');
//                }
//
//                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
//                $this->Session->write('variabless', $variables);
//
//                $this->Session->write('investment_array', $investment_array);
//
//                $this->Session->write('statemt_array', $statemt_array);
//
//                $this->Session->delete('investtemp');
//                $message = 'Investment Successfully Processed,Click Next to Save and Print Certificate';
//                $this->Session->write('smsg', $message);
//                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment2_comp', $investor_id));
//            }
        }
    }

    function newInvestmentCert_OLD() {
        /* $this->__validateUserType(); */
        $userid = null;
        $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }
        $investment_array = $this->Session->check('investment_array_fixed');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_fixed');


            $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;
            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {

                $payment_name = '';
                $paymentmodeid = $result['Investment']['payment_mode_id'];
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['investment_amount'],
                    'available_amount' => $result['Investment']['investment_amount'],
                    'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
                $check = $this->get_investors();
                if (count($check) > 0) {
                    $this->set('investors', $check);
                    foreach ($check as $value) {

                        $investor_data = array('investment_id' => $investment_id, 'investor_id' => $value['investor_id']);

                        $this->InvestmentInvestor->saveAll($investor_data);
                    }
                } else {
                    $message = 'No Investor Selected';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment0'));
                }
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
                $this->set('investment_number', $investment_number);
                $date = date('Y-m-d H:i:s');




                $rollover_details = $this->Session->check('rollover_details');
                if ($rollover_details) {
                    $rollover_details = $this->Session->read('rollover_details');
                    $this->Rollover->save($rollover_details);
                    $this->set('rollover_details', $rollover_details);
                    $this->Session->delete('rollover_details');

                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');

                        $this->InvestmentStatement->saveAll($statemt_array);
                        $this->Session->delete('statemt_array_fixed');
                    }
                } else {
                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');


                        foreach ($statemt_array as $key => $val) {
                            $val['investment_id'] = $investment_id;

                            $this->InvestmentStatement->create();
                            $this->InvestmentStatement->save($val);
                        }
                        $this->Session->delete('statemt_array_fixed');
                    }

                    $this->request->data = null;
                    $investment_updates = array('id' => $investment_id, 'investment_no' => $investment_number);
                    $this->Investment->save($investment_updates);
                }
                $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
                if ($data) {
                    $this->set('investment_array_fixed', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);
                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }

                $this->Session->delete('variabless_fixed');
            } else {
                $message = "Sorry No Investment To Display";
                $this->Session->write('imsg', $message);
                $this->redirect('/Investments/');
            }
        }

        $investment_array = $this->Session->check('investment_array_equity');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_equity');


            $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;

            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {

                $payment_name = '';
                $paymentmodeid = $result['Investment']['payment_mode_id'];
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['total_amount'],
                    'available_amount' => $result['Investment']['total_amount'],
                    'investment_type' => 'equity', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
                $check = $this->get_investors();
                if (count($check) > 0) {
                    $this->set('investors', $check);
                    foreach ($check as $value) {

                        $investor_data = array('investment_id' => $investment_id, 'investor_id' => $value['investor_id']);

                        $this->InvestmentInvestor->saveAll($investor_data);
                    }
                } else {
                    $message = 'No Investor Selected';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment0'));
                }
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
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
                    $this->set('investment_array_equity', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);
                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }


                $this->Session->delete('variabless_equity');
            } else {
                $message = "Sorry No Investment To Display";
                $this->Session->write('imsg', $message);
                $this->redirect('/Investments/');
            }
        }

        if (!($this->Session->check('investment_array_fixed')) && !($this->Session->check('investment_array_equity'))) {
            $message = "Sorry No Investment To Display";
            $this->Session->write('imsg', $message);
            $this->redirect('/Investments/');
        }
        if ($this->Session->check('investment_array_fixed')) {
            $this->Session->delete('investment_array_fixed');
        }
        if ($this->Session->check('investment_array_equity')) {
            $this->Session->delete('investment_array_equity');
        }
        if ($this->Session->check('investtemp.investmentproduct_id')) {
            $this->Session->delete('investtemp.investmentproduct_id');
        }
    }

    function newInvestmentCertComp() {
        /* $this->__validateUserType(); */
        $userid = null;
        $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }
        $investment_array = $this->Session->check('investment_array_fixed');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_fixed');


            $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;

            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {

                $investor_id = $result['Investment']['investor_id'];

                $payment_name = '';
                $paymentmodeid = $result['Investment']['payment_mode_id'];
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['investment_amount'],
                    'available_amount' => $result['Investment']['investment_amount'],
                    'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
                $investor_data = array('investment_id' => $investment_id, 'investor_id' => $investor_id);

                $this->InvestmentInvestor->save($investor_data);
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
                $this->set('investment_number', $investment_number);
                $date = date('Y-m-d H:i:s');





                $rollover_details = $this->Session->check('rollover_details');
                if ($rollover_details) {
                    $rollover_details = $this->Session->read('rollover_details');
                    $this->Rollover->save($rollover_details);
                    $this->set('rollover_details', $rollover_details);
                    $this->Session->delete('rollover_details');

                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');

                        $this->InvestmentStatement->saveAll($statemt_array);
                        $this->Session->delete('statemt_array_fixed');
                    }
                } else {
                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');


                        foreach ($statemt_array as $key => $val) {
                            $val['investment_id'] = $investment_id;

                            $this->InvestmentStatement->create();
                            $this->InvestmentStatement->save($val);
                        }
                        $this->Session->delete('statemt_array_fixed');
                    }

                    $this->request->data = null;
                    $investment_updates = array('id' => $investment_id, 'investment_no' => $investment_number);
                    $this->Investment->save($investment_updates);
                }
                $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
                if ($data) {
                    $this->set('investment_array_fixed', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);

                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }


                $this->Session->delete('variabless_fixed');
            } else {
                $message = 'Sorry,try again';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
        }

        $investment_array = $this->Session->check('investment_array_equity');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_equity');


            $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;
            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {


                $investor_id = $result['Investment']['investor_id'];
                $payment_name = '';
                $paymentmodeid = $result['Investment']['payment_mode_id'];
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['total_amount'],
                    'available_amount' => $result['Investment']['total_amount'],
                    'investment_type' => 'equity', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
                $investor_data = array('investment_id' => $investment_id, 'investor_id' => $investor_id);

                $this->InvestmentInvestor->save($investor_data);
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
                $this->set('investment_number', $investment_number);
                $date = date('Y-m-d H:i:s');





                $rollover_details = $this->Session->check('rollover_details');
                if ($rollover_details) {
                    $rollover_details = $this->Session->read('rollover_details');
                    $this->Rollover->save($rollover_details);
                    $this->set('rollover_details', $rollover_details);
                    $this->Session->delete('rollover_details');

                    $statemt_array = $this->Session->check('statemt_array_equity');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_equity');

                        $this->InvestmentStatement->saveAll($statemt_array);
                        $this->Session->delete('statemt_array_equity');
                    }
                } else {
                    $statemt_array = $this->Session->check('statemt_array_equity');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_equity');


                        foreach ($statemt_array as $key => $val) {
                            $val['investment_id'] = $investment_id;

                            $this->InvestmentStatement->create();
                            $this->InvestmentStatement->save($val);
                        }
                        $this->Session->delete('statemt_array_equity');
                    }

                    $this->request->data = null;
                    $investment_updates = array('id' => $investment_id, 'investment_no' => $investment_number);
                    $this->Investment->save($investment_updates);
                }
                $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
                if ($data) {
                    $this->set('investment_array_equity', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);

                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }


                $this->Session->delete('variabless_equity');
            } else {
                $message = 'Sorry,try again';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
        }



        if (!($this->Session->check('investment_array_fixed')) && !($this->Session->check('investment_array_equity'))) {
            $message = "Sorry No Investment To Display";
            $this->Session->write('imsg', $message);
            $this->redirect('/Investments/newInvestment1Comp');
        }
        if ($this->Session->check('investment_array_fixed')) {
            $this->Session->delete('investment_array_fixed');
        }
        if ($this->Session->check('investment_array_equity')) {
            $this->Session->delete('investment_array_equity');
        }
        if ($this->Session->check('investtemp.investmentproduct_id')) {
            $this->Session->delete('investtemp.investmentproduct_id');
        }
    }

    function newInvestmentCert() {
        /* $this->__validateUserType(); */

//        if (!is_null($investment_id)) {
//
//            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
//            $this->set('data', $data);
//
//            $inv_type = $this->InvestorType->find('first', array('conditions' =>
//                array('InvestorType.id' => $data['Investor']['investor_type_id'])));
//            $this->set('inv_type', $inv_type);
//            $equity = $this->InvestorEquity->find('all', array('conditions' =>
//                array('InvestorEquity.investment_id' => $investment_id)));
//            $this->set('equity', $equity);
//        } else {
//
//            $message = 'Sorry, Investment Not Found';
//            $this->Session->write('imsg', $message);
//            $this->redirect(array('controller' => 'Investments', 'action' => '#'));
//        }
        $userid = null;
        $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }
        $generic_array = $this->Session->check('generic_array');
        if ($generic_array) {
            $generic_array = $this->Session->read('generic_array');


            $genericresult = $this->Investment->save($generic_array);
            $investment_id = $this->Investment->id;
            $investor_id = $genericresult['Investment']['investor_id'];
            $paymentmodeid = $genericresult['Investment']['payment_mode_id'];
            $this->Session->delete('generic_array');
        } elseif (!($this->Session->check('generic_array'))) {
            $message = "Sorry No Investment To Display";
            $this->Session->write('bmsg', $message);
            $this->redirect('/Investments/');
        }

        $investment_array = $this->Session->check('investment_array_fixed');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_fixed');

            $this->Investment->id = $investment_id;
            $this->Investment->save($investment_array);
            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {

                $payment_name = '';
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['investment_amount'],
                    'available_amount' => $result['Investment']['investment_amount'],
                    'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
//                $check = $this->get_investors();
//                if (count($check) > 0) {
//                    $this->set('investors', $check);
//                    foreach ($check as $value) {
//
//                        $investor_data = array('investment_id' => $investment_id, 'investor_id' => $value['investor_id']);
//
//                        $this->InvestmentInvestor->saveAll($investor_data);
//                    }
//                } else {
//                    $message = 'No Investor Selected';
//                    $this->Session->write('emsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment0'));
//                }
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
                $this->set('investment_number', $investment_number);
                $date = date('Y-m-d H:i:s');




                $rollover_details = $this->Session->check('rollover_details');
                if ($rollover_details) {
                    $rollover_details = $this->Session->read('rollover_details');
                    $this->Rollover->save($rollover_details);
                    $this->set('rollover_details', $rollover_details);
                    $this->Session->delete('rollover_details');

                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');

                        $this->InvestmentStatement->saveAll($statemt_array);
                        $this->Session->delete('statemt_array_fixed');
                    }
                } else {
                    $statemt_array = $this->Session->check('statemt_array_fixed');
                    if ($statemt_array) {
                        $statemt_array = $this->Session->read('statemt_array_fixed');


                        foreach ($statemt_array as $key => $val) {
                            $val['investment_id'] = $investment_id;

                            $this->InvestmentStatement->create();
                            $this->InvestmentStatement->save($val);
                        }
                        $this->Session->delete('statemt_array_fixed');
                    }

                    $this->request->data = null;
                    $investment_updates = array('id' => $investment_id, 'investment_no' => $investment_number);
                    $this->Investment->save($investment_updates);
                }
                $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
                if ($data) {
                    $this->set('investment_array_fixed', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);
                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }

                $this->Session->delete('variabless_fixed');
            } else {
                $message = "Sorry No Investment To Display";
                $this->Session->write('imsg', $message);
                $this->redirect('/Investments/');
            }
        }

        $investment_array = $this->Session->check('investment_array_equity');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array_equity');

            $this->Investment->id = $investment_id;
            $this->Investment->save($investment_array);
            $equities = $this->get_equity();
            if (!empty($equities)) {
                foreach ($equities as $key => $var) {
                    $var['investment_id'] = $investment_id;
                    $this->InvestorEquity->create();
                    $this->InvestorEquity->save($var);
                }
            }
            $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($result) {

                $payment_name = '';
                $paymentmodeid = $result['Investment']['payment_mode_id'];
                $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                if ($payment_mode) {
                    $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                }
                $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                    'amount' => $result['Investment']['total_amount'],
                    'available_amount' => $result['Investment']['total_amount'],
                    'investment_type' => 'equity', 'payment_mode' => $payment_name,
                    'investment_date' => $result['Investment']['investment_date']);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
//                $check = $this->get_investors();
//                if (count($check) > 0) {
//                    $this->set('investors', $check);
//                    foreach ($check as $value) {
//
//                        $investor_data = array('investment_id' => $investment_id, 'investor_id' => $value['investor_id']);
//
//                        $this->InvestmentInvestor->saveAll($investor_data);
//                    }
//                } else {
//                    $message = 'No Investor Selected';
//                    $this->Session->write('emsg', $message);
//                    $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment0'));
//                }
                if (isset($investment_number) && !empty($investment_number)) {
                    $investment_number = $investment_number;
                } else {
                    $investment_number = 'PARKST-INV-00' . $investment_id;
                }
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
                    $this->set('investment_array_equity', $data);
                    $this->Session->write('shopCurrency_investment', $data['Currency']['currency_name']);
                    $issued = $this->Session->check('userData');
                    if ($issued) {
                        $issued = $this->Session->read('userData');
                        $this->set('issued', $issued);
                    }
                }


                $this->Session->delete('variabless_equity');
            } else {
                $message = "Sorry No Investment To Display";
                $this->Session->write('imsg', $message);
                $this->redirect('/Investments/');
            }
        }


        if ($this->Session->check('ledger_data')) {

            $ledger_data = $this->Session->read('ledger_data');
            $cledger = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);
            if (count($cledger) > 0) {
                $this->ClientLedger->id = $cledger['ClientLedger']['id'];
                $this->ClientLedger->save($ledger_data);
                $cledger_id = $this->ClientLedger->id;
            } else {
                $this->ClientLedger->save($ledger_data);
                $cledger_id = $this->ClientLedger->id;
            }

            $check = $this->Session->check('ledger_data');
            if ($check) {
                $this->Session->delete('ledger_data');
            }
            //if clientledger save successful get id,update transaction and save
            if ($this->Session->check('ledger_transactions')) {
                $ledger_transactions = $this->Session->read('ledger_transactions');
                if (!empty($ledger_transactions)) {
                    foreach ($ledger_transactions as $key => $val) {
                        $val['client_ledger_id'] = $cledger_id;
                        $val['voucher_no'] = $investment_number;
                        $this->LedgerTransaction->create();
                        $this->LedgerTransaction->save($val);
                        if (isset($val['edit'])) {
                            $lt_result = $this->LedgerTransaction->find('first', ['conditions' =>
                                ['LedgerTransaction.debit' => $val['edit']], 'order' => ['LedgerTransaction.id' => 'desc'],
                                'recursive' => -1]);
                            if ($lt_result) {
                                $lt_id = $lt_result['LedgerTransaction']['id'];
                                $this->LedgerTransaction->delete($lt_id);
                            }
                        }
                    }
                }
            }
            $check = $this->Session->check('client_ledger');
            if ($check) {
                $this->Session->delete('client_ledger');
            }
        }


        if ($this->Session->check('rledger_data')) {

            $ledger_data = $this->Session->read('rledger_data');
            $cledger = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);
            if (count($cledger) > 0) {
                $this->ClientLedger->id = $cledger['ClientLedger']['id'];
                $this->ClientLedger->save($ledger_data);
                $cledger_id = $this->ClientLedger->id;
            } else {
                $this->ClientLedger->save($ledger_data);
                $cledger_id = $this->ClientLedger->id;
            }

            $check = $this->Session->check('rledger_data');
            if ($check) {
                $this->Session->delete('rledger_data');
            }
            //if clientledger save successful get id,update transaction and save
            if ($this->Session->check('ledger_transactions')) {
                $ledger_transactions = $this->Session->read('ledger_transactions');
                if (!empty($ledger_transactions)) {
                    foreach ($ledger_transactions as $key => $val) {
                        $val['client_ledger_id'] = $cledger_id;
                        $val['voucher_no'] = $investment_number;
                        $this->LedgerTransaction->create();
                        $this->LedgerTransaction->save($val);
                    }
                }
            }
            $this->Session->delete('client_ledger');
        }
        if ($this->Session->check('ledger_transactions')) {

            $this->Session->delete('ledger_transactions');
        }
        if ($this->Session->check('investment_array_fixed')) {
            $this->Session->delete('investment_array_fixed');
        }
        if ($this->Session->check('investment_array_equity')) {
            $this->Session->delete('investment_array_equity');
        }
        if ($this->Session->check('investtemp.investmentproduct_id')) {
            $this->Session->delete('investtemp.investmentproduct_id');
        }
        if ($this->Session->check('generic_array')) {
            $this->Session->delete('generic_array');
        }
        if ($this->Session->check('client_ledger')) {
            $this->Session->delete('client_ledger');
        }
        if ($this->Session->check('ledger_transactions')) {
            $this->Session->delete('ledger_transactions');
        }
        if ($this->Session->check('investtemp')) {
            $this->Session->delete('investtemp');
        }
        if ($this->Session->check('investtemp1')) {
            $this->Session->delete('investtemp1');
        }
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));

        if ($data) {
            $this->set('data', $data);

            $inv_type = $this->InvestorType->find('first', array('conditions' =>
                array('InvestorType.id' => $data['Investor']['investor_type_id'])));
            $this->set('inv_type', $inv_type);
            $equity = $this->InvestorEquity->find('all', array('conditions' =>
                array('InvestorEquity.investment_id' => $investment_id)));
            $this->set('equity', $equity);
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => '#'));
        }
    }

    function newInvestmentCertcompEquity() {
        /* $this->__validateUserType(); */

        $investment_array = $this->Session->check('investment_array');
        if ($investment_array) {
            $investment_array = $this->Session->read('investment_array');


            $result = $this->Investment->save($investment_array);
            $investment_id = $this->Investment->id;
            $investor_id = $result['Investment']['investor_id'];

            if ($result) {



                $investor_data = array('investment_id' => $investment_id, 'investor_id' => $investor_id);

                $this->InvestmentInvestor->save($investor_data);

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
                $message = 'Sorry,try again';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1Comp'));
            }
        } else {
            $message = "Sorry No Investment To Display";
            $this->Session->write('imsg', $message);
            $this->redirect('/Investments/newInvestment1Comp');
        }
    }

    function searchInvest4Invest($investorID = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investor = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")), 'Investor.approved' => 1)));

            if ($investor) {
                $check = $this->Session->check('ivts');
                if ($check) {
                    $this->Session->delete('ivts');
                }
                $cust = $this->Session->write('ivts', $investor);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            } else {
                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
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
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'newInvestment1'));
            }
        }
    }

    function searchInvest4mInvest($investorID = null, $condition = null) {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $investname = $this->request->data['investor_search'];
            $investors = $this->Investor->find('all', array('conditions' => array('OR' => array(array('Investor.surname LIKE' => "%$investname%"), array('Investor.other_names LIKE' => "%$investname%"), array('Investor.fullname LIKE' => "%$investname%")), 'Investor.approved' => 1)));
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
                $this->Session->write('imsg', $message);
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
                $this->Session->write('imsg', $message);
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

    function clearManageSessions() {
        $check = $this->Session->check('mivts');
        if ($check) {
            $this->Session->delete('mivts');
        }
        $check = $this->Session->check('mivt');
        if ($check) {
            $this->Session->delete('mivt');
        }
        $check = $this->Session->check('payinvesttemp');
        if ($check) {
            $this->Session->delete('payinvesttemp');
        }
        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
    }

    function manageInvestments() {
        /* $this->__validateUserType(); */

        $data = $this->paginate('Investor');

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

    function processPayments_OLD() {
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

    function approveTerminations() {
        /* $this->__validateUserType(); */

        $this->paginate = array(
            'conditions' => array(
                'status' => array('Termination_Requested'), 'Investment.investment_product_id' => array(1, 3)),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function approveTerminations2($investor_id = null, $investor_name = null, $investment_id = null) {
        /* $this->__validateUserType(); */
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));
            $data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);


            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);
            $this->set('investment_id', $investment_id);
            if ($data) {
//               $transactions = $this->LedgerTransaction->find('all',['conditions' => [
//                   'LedgerTransaction.client_ledger_id' =>$data['ClientLedger']['id']]]);
                $this->paginate = array(
                    'conditions' => array('LedgerTransaction.client_ledger_id' => $data['ClientLedger']['id']),
                    'order' => array('LedgerTransaction.id' => 'asc'));
                $transactions = $this->paginate('LedgerTransaction');
                if ($transactions) {
                    $this->set('transactions', $transactions);
                }
                $this->set('data', $data);
            } else {
                $message = 'Sorry, ledger information not found for investor. Try again.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
            }
        } else {

            $message = 'Sorry, investor not found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
        }
    }

    function processTerminations() {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $approval_status = $this->request->data['ApproveInvestments']['approvals'];
                $investment_id = $this->request->data['Investment']['investment_id'];
                $investor_id = $this->request->data['Investment']['investor_id'];
                $userid = null;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
                $data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
                switch ($approval_status) {
                    case "0":
                        if ($data) {
                            $update_array = array('id' => $investment_id, 'status' =>
                                $data['Investment']['old_status']);
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_termination_req');
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_requested"))));

                            $message = 'Termination request successfully rejected';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        } else {
                            $message = 'Termination request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        }
                        break;

                    case "1":
                        if ($data) {
                            $ledger_data = $this->ClientLedger->find('first', ['conditions' =>
                                ['ClientLedger.investor_id' => $investor_id]]);

                            $period = $data['Investment']['investment_period'];
                            $first_date = $data['Investment']['investment_date'];
                            $inv_date = new DateTime($first_date);
                            $date = date('Y-m-d');
                            $to_date = new DateTime($date);
                            $duration = date_diff($inv_date, $to_date);
                            $duration = $duration->format("%a");
                            $year = $duration;
                            $custom_rate = $data['Investment']['custom_rate'] - 5;
                            $investment_amount = $data['Investment']['investment_amount'];

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
                                            'investor_id' => $this->request->data['Investment']['investor_id'],
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
                                            'investor_id' => $this->request->data['Investment']['investor_id'],
                                            'principal' => $principal,
                                            'interest' => $interest_amount2,
                                            'maturity_date' => $date_statemt->format('Y-m-d'),
                                            'total' => $total);
//                            $principal = $total;
                                    }

                                    break;
                            }

                            $update_array = array('id' => $investment_id, 'earned_balance' => $amount_due, 'amount_due' => $amount_due,
                                'interest_earned' => $interest_amount, 'custom_rate' => $custom_rate, 'total_amount_earned' => $amount_due, 'duration' => $duration,
                                'status' => "Termination_Approved");
                            if ($ledger_data) {
                                $cash_athand = $ledger_data['ClientLedger']['available_cash'];
                                $new_cashathand = $cash_athand + $amount_due;
                                $total_invested = $ledger_data['ClientLedger']['invested_amount'] - $amount_due;
                                $cledger_id = $ledger_data['ClientLedger']['id'];
                                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_cashathand,
                                    'invested_amount' => $total_invested);
                                $this->ClientLedger->save($client_ledger);


                                //Ledger transaction entry
                                $description = 'Discounting of ' . $data['Investment']['investment_no'];
                                $ledger_transactions = array('client_ledger_id' => $cledger_id, 'credit' => $amount_due, 'user_id' => $userid,
                                    'date' => date('Y-m-d'), 'voucher_no' => $data['Investment']['investment_no']
                                    , 'description' => $description);
                                $this->LedgerTransaction->create();
                                $this->LedgerTransaction->save($ledger_transactions);
                            }
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_termination_req');
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_requested"))));

                            $message = 'Termination request successfully approved';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        } else {
                            $message = 'Termination request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        }
                        break;
                    case "2":
                        if ($data) {
                            $update_array = array('id' => $investment_id, 'status' => "Termination_Requested");
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_termination_req');
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_requested"))));

                            $message = 'Termination request successfully updated';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        } else {
                            $message = 'Termination request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approveTerminations'));
                        }
                        break;
                }
            }
        }
    }

    function approvePayments() {
        /* $this->__validateUserType(); */

        $this->paginate = array(
            'conditions' => array(
                'status' => array('Payment_Requested'), 'Investment.investment_product_id' => array(1, 3)),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function approvePayments2($investor_id = null, $investor_name = null, $investment_id = null) {
        /* $this->__validateUserType(); */
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));
            $data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);


            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);
            $this->set('investment_id', $investment_id);
            if ($data) {
//               $transactions = $this->LedgerTransaction->find('all',['conditions' => [
//                   'LedgerTransaction.client_ledger_id' =>$data['ClientLedger']['id']]]);
                $this->paginate = array(
                    'conditions' => array('LedgerTransaction.client_ledger_id' => $data['ClientLedger']['id']),
                    'order' => array('LedgerTransaction.id' => 'asc'));
                $transactions = $this->paginate('LedgerTransaction');
                if ($transactions) {
                    $this->set('transactions', $transactions);
                }
                $this->set('data', $data);
            } else {
                $message = 'Sorry, ledger information not found for investor. Try again.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
            }
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
        }
    }

    function maturityList() {
//        $this->__validateUserType3();
        $this->paginate = array(
            'conditions' => array(
                'Investment.status' => array('Matured', 'Payment_Requested'), 'Investment.investment_product_id' => array(1, 3)),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function monthlyMaturityList() {
//        $this->__validateUserType3();
        $first_date = date('Y-m-d');
        $date = new DateTime($first_date);
        $date->add(new DateInterval('P1M'));
        $date_end =$date->format('Y-m-d');
        $this->paginate = array(
            'conditions' => array(
                'Investment.status' => array('Invested', 'Rolled_over'), 
                'Investment.investment_product_id' => array(1, 3),
                'AND' => array(array('Investment.due_date >=' => $first_date),array('Investment.due_date <=' => $date_end))),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function processPayments() {
        /* $this->__validateUserType(); */
        $data_array = array();
        $this->paginate = array(
            'conditions' => array(
                'status' => array('Payment_Approved', 'Termination_Approved'), 'Investment.investment_product_id' => array(1, 3)),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'),
            'group' => array('Investment.investor_id')
        );
        $data = $this->paginate('Investment');
        if ($data) {
            foreach ($data as $value) {
                $result = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' =>
                        $value['Investment']['investor_id']]]);
                if ($result) {
                    $data_array[] = $result;
                }
            }
        }
        $this->set('data', $data_array);
    }

    function processPayments2() {
        /* $this->__validateUserType(); */$this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $approval_status = $this->request->data['ApproveInvestments']['approvals'];
                $investment_id = $this->request->data['Investment']['investment_id'];
                $investor_id = $this->request->data['Investment']['investor_id'];
                $userid = null;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
                $data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
                switch ($approval_status) {
                    case "0":
                        if ($data) {
                            $update_array = array('id' => $investment_id, 'status' =>
                                $data['Investment']['old_status']);
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_payment_req');
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Payment_requested"))));

                            $message = 'Payment request successfully rejected';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        } else {
                            $message = 'Payment request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        }
                        break;

                    case "1":
                        if ($data) {

                            $update_array = array('id' => $investment_id,
                                'status' => "Payment_Approved");

                            $this->Investment->save($update_array);
                            $this->Session->delete('public_payment_req');
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Payment_requested"))));

                            $message = 'Payment request successfully approved';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        } else {
                            $message = 'Payment request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        }
                        break;
                    case "2":
                        if ($data) {
                            $update_array = array('id' => $investment_id, 'status' => "Payment_requested");
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_payment_req');
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Payment_requested"))));

                            $message = 'Payment request successfully updated';
                            $this->Session->write('smsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        } else {
                            $message = 'Payment request processing failure. Try again';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'approvePayments'));
                        }
                        break;
                }
            }
        }
    }

    function requestPayment($investment_id = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('recursive' => -1, 'conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Payment_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Payment Request Successfully Sent';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
        }
    }

    function requestPayment4managefixedinvestments($investment_id = null, $investor_id = null, $investor_name = null) {

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('recursive' => -1, 'conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Payment_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Payment Request Successfully Sent';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
        }
    }

    function cancelInvestment($investment_id = null, $investor = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Termination_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $this->Session->delete('public_termination_req');
                    $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_requested"))));

                    $message = 'Investment Termination Successfully Sent';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
        }
    }

    function makePayment() {

        //amount being paidout must not be more than $value['Investment']['total_amount_earned'];
        //if less or equal to,proceed but subtract paidamount from $value['Investment']['total_amount_earned'];
        //must use the above column throughout instead of amount_due

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $userid = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $userid = $this->Session->read('userDetails.id');
            }
            $old_balance;
            $payment;
            $cheque_numbers = null;
            $new_cheque_numbers = "";
            $payment = 0;
            $investorid = $_POST['hid_investorid'];
            $ledgerid = $_POST['hid_ledgerid'];
            $inv_day = $this->request->data['InvestmentPayment']['payment_date']['day'];
            if (!empty($inv_day)) {
                $inv_month = $this->request->data['InvestmentPayment']['payment_date']['month'];
                $inv_year = $this->request->data['InvestmentPayment']['payment_date']['year'];
                $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                $sinv_date = strtotime($finv_date);
                $inv_date = date('Y-m-d', $sinv_date);
            } else {
                $inv_date = date('Y-m-d');
            }
            $this->request->data['InvestmentPayment']['payment_date'] = $inv_date;
            $this->Session->write('payinvesttemp', $this->request->data['InvestmentPayment']);

            if ($this->request->data['InvestmentPayment']['paymentmode_id'] == "" || $this->request->data['InvestmentPayment']['paymentmode_id'] == null) {
                $message = 'Please Select A Mode of Payment.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
            }

            if ($this->request->data['InvestmentPayment']['paymentmode_id'] == "Post-dated chq" && ($this->request->data['InvestmentPayment']['cheque_nos'] == "" || $this->request->data['InvestmentPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
            }


            if ($this->request->data['InvestmentPayment']['paymentmode_id'] == "Cheque" && ($this->request->data['InvestmentPayment']['cheque_nos'] == "" || $this->request->data['InvestmentPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
            }

            if ($this->request->data['InvestmentPayment']['amount'] == "" || $this->request->data['InvestmentPayment']['amount'] == null || $this->request->data['InvestmentPayment']['amount'] == 0) {
                $message = 'Amount Not Entered.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
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

            $payment = $this->request->data['InvestmentPayment']['amount'];
            $sms_amount = $this->request->data['InvestmentPayment']['amount'];
            $payment_mode = $this->request->data['InvestmentPayment']['paymentmode_id'];

            $balance = 0;
            $old_balance = 0;


            $date = date('Y-m-d H:i:s');
            //use id to retrieve Investment info
            $ledger_details = $this->ClientLedger->find('first', array('conditions' => array('ClientLedger.id' => $ledgerid)));
            if ($ledger_details) {
                $old_balance = $ledger_details['ClientLedger']['available_cash'];
                $investor = $ledger_details['ClientLedger']['investor_id'];
                $investor_name = $ledger_details['Investor']['fullname'];
                $new_balance = $old_balance - $payment;

                if ($sms_amount > $old_balance) {
                    $message = 'Payment amount cannot be more than client\'s ledger balance';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
                }

//                $new_investmentdetails = array('id' => $investment_id, 'earned_balance' => $earned_balance
//                    , 'balance' => $balance, $amount_due => $balance, 'amount_paidout' => $total_paid,
//                    'status' => $payment_status, 'lastpaidout_date' => $payment_date);
                //Update Ledger data
                $cledger_id = $ledger_details['ClientLedger']['id'];
                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_balance);
                $this->ClientLedger->save($client_ledger);
                $voucher_no = date('mdyhis') . rand(2, 4);

                $result = $this->ClientLedger->save($client_ledger);
                if ($result) {
                    //enter new ledger transaction
                    $ledger_transactions = array('client_ledger_id' => $cledger_id, 'payment_mode_id' => $payment_mode,
                        'debit' => $payment, 'user_id' => $userid, 'voucher_no' => $voucher_no,
                        'date' => $payment_date, 'cheque_no' => $cheque_numbers,
                        'description' => 'Payment of Investment Proceeds');
                    $this->LedgerTransaction->create();
                    $this->LedgerTransaction->save($ledger_transactions);
//                    $investment_paymentdetails = array('investment_id' => $investment_id, 'investor_id' => $investor, 'amount' => $payment, 'payment_mode' => $this->request->data['InvestmentPayment']['payment_mode'], 'cheque_nos' => $cheque_numbers, 'payment_date' => $payment_date);
//                    $result2 = $this->InvestmentPayment->save($investment_paymentdetails);
                    if ($ledger_transactions) {

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
                        $this->redirect(array('controller' => 'Investments', 'action' => 'paymentReceipt', $cledger_id, $payment, $voucher_no, $cheque_numbers));

                        //$this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments',$investor,$investor_name));
                    } else {

                        $message = 'Investment Payout Saved With Errors';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
                    }
                } else {

                    $message = 'Investment Payout Unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
                }
            }
        }
    }

    function makeEquityPayment() {
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
            $payment_day = $this->request->data['EquityPayment']['payment_date']['day'];
            $payment_month = $this->request->data['EquityPayment']['payment_date']['month'];
            $payment_year = $this->request->data['EquityPayment']['payment_date']['year'];
            $fpayment_date = $payment_year . "-" . $payment_month . "-" . $payment_day;
            $spayment_date = strtotime($fpayment_date);
            $payment_date = date('Y-m-d', $spayment_date);
            $session_date = date('d-m-Y', $spayment_date);
            //$this->request->data['InvestmentPayment']['payment_date'] = $payment_date;
            $check = $this->Session->check('disposetemp');
            if ($check) {
                $this->Session->delete('disposetemp');
            }

            $this->Session->write('disposetemp', $this->request->data['EquityPayment']);
            $this->Session->write('disposetemp.payment_date', $session_date);
            if ($this->request->data['EquityPayment']['payment_mode'] == "" || $this->request->data['EquityPayment']['payment_mode'] == null) {
                $message = 'Please Select A Mode of Payment.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            }



            if ($this->request->data['EquityPayment']['payment_mode'] == "Post-dated chq" && ($this->request->data['EquityPayment']['cheque_nos'] == "" || $this->request->data['EquityPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            }

            if ($this->request->data['EquityPayment']['payment_mode'] == "Cheque" && ($this->request->data['EquityPayment']['cheque_nos'] == "" || $this->request->data['EquityPayment']['cheque_nos'] == null )) {
                $message = 'Please Supply a Cheque No.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            }




            if (isset($this->request->data['EquityPayment']['cheque_nos'])) {
                if ($this->request->data['EquityPayment']['cheque_nos'] != "" || $this->request->data['EquityPayment']['cheque_nos'] != null) {
                    $cheque_numbers = $this->request->data['EquityPayment']['cheque_nos'];
                }
            }





            $payment += $this->request->data['EquityPayment']['amount'];
            $sms_amount = $this->request->data['EquityPayment']['amount'];
            $payment_mode = $this->request->data['EquityPayment']['payment_mode'];
            $disposed_shares = $this->request->data['EquityPayment']['numb_shares'];
            $current_shareprice = $this->request->data['EquityPayment']['selling_price'];
            $total_fees = $this->request->data['EquityPayment']['total_fees'];
            $balance = 0;
            $total_paid = 0;
            $hp_price = 0;
            $old_total_paid = 0;
            $old_balance = 0;


            $date = date('Y-m-d H:i:s');
            //use id to retrieve Investment info
            $investment_details = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($investment_details) {
                $total_shares = $investment_details['Investment']['numb_shares_left'];
                $check_shares = $total_shares - $disposed_shares;
                if ($check_shares < 0) {
                    $message = 'Shares to be disposed are more than shares available.Please check and try again.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
                }
                $old_balance = $investment_details['Investment']['balance'];
                $old_total_paid = $investment_details['Investment']['amount_paidout'];
                $amount_due = ($current_shareprice * $disposed_shares) - $total_fees;
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
//equity investments


                $this->Session->write('disposetemp.amount', $amount_due);

                //Investment Data
                $new_investmentdetails = array('id' => $investment_id, 'balance' => $balance,
                    'amount_paidout' => $total_paid, 'status' => $payment_status,
                    'lastpaidout_date' => $payment_date, 'numb_shares_left' => $check_shares,
                    'numb_shares_sold' => $disposed_shares);

                //Investment Payment Data
                $investment_paymentdetails = array('investment_id' => $investment_id,
                    'investor_id' => $investor, 'amount' => $amount_due,
                    'payment_mode' => $this->request->data['EquityPayment']['payment_mode'],
                    'cheque_nos' => $cheque_numbers, 'payment_date' => $payment_date,
                    'selling_price' => $this->request->data['EquityPayment']['selling_price'],
                    'numb_shares_sold' => $disposed_shares);

                $this->Session->write('investment_paymentdetails', $investment_paymentdetails);
                $this->Session->write('new_investmentdetails', $new_investmentdetails);
                $message = 'Process successful. Click submit to proceed or cancel to return.';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            } else {
                $message = 'Could not retrieve investment information. Please check and try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            }
        } else {
            $message = 'Wrong access method';
            $this->Session->write('emsg', $message);
            $this->redirect('/');
        }
    }

    function manageFixedInvestments($investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));

            $this->paginate = array(
                'conditions' => array('Investment.investor_id' => $investor_id,
                    'Investment.investment_product_id' => array(1, 3)),
                'limit' => 30,
                'order' => array('Investment.id' => 'asc'));
            $data = $this->paginate('Investment');

            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);




            if ($data) {
                $ledger = $this->ClientLedger->find('first', ['conditions' =>
                    ['ClientLedger.investor_id' => $investor_id]]);

                if ($ledger) {
                    $this->set('inv', $ledger);
                }
                $this->set('data', $data);
            } else {
                $message = 'Sorry, No Fixed Investments Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function topupInvestment() {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $source = $this->request->data['Topup']['cashreceiptmode_id'];
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
                $investment_data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
                if ($investment_data) {

                    $inv_no = $investment_data['Investment']['investment_no'];
                    $ledger = $this->ClientLedger->find('first', ['conditions' =>
                        ['ClientLedger.investor_id' => $investor_id]]);

                    if ($ledger) {


                        switch ($source) {
                            case 1:
                                $payment_name = 'Cash';
                                $amount = $this->request->data['Topup']['topup_amount'];
                                $new_investedamount = $ledger['ClientLedger']['invested_amount'] + $amount;

                                $client_ledger = array('id' => $ledger['ClientLedger']['id'], 'invested_amount' => $new_investedamount);


                                break;
                            case 2:
                                $amount = $this->request->data['Topup']['topup_amount'];
                                $new_investedamount = $ledger['ClientLedger']['invested_amount'] + $amount;
                                $cheque_no = $this->request->data['Topup']['cheque_no'];

                                $client_ledger = array('id' => $ledger['ClientLedger']['id'], 'invested_amount' => $new_investedamount);
                                $payment_name = 'Cheque';

                                break;
                            case 3:
                                $amount = $this->request->data['Topup']['topup_amount'];
                                if ($amount > $available_cash) {
                                    $message = 'Not enough cash in investor\'s ledger balance to complete this topup';
                                    $this->Session->write('bmsg', $message);
                                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                                }
                                $new_ledgeravailablecash = $ledger['ClientLedger']['available_cash'] - $amount;
                                $new_investedamount = $ledger['ClientLedger']['invested_amount'] + $amount;

                                $client_ledger = array('id' => $ledger['ClientLedger']['id'], 'available_cash' => $new_ledgeravailablecash,
                                    'invested_amount' => $new_investedamount);
                                $payment_name = 'Ledger Balance';
                                break;
                        }
                        $description = 'Fixed Investment Topup for ' . $inv_no;
                        $ledger_transactions = array('client_ledger_id' => $ledger['ClientLedger']['id']
                            , 'cash_receipt_mode_id' => $source,
                            'cheque_no' => $cheque_no, 'debit' => $amount, 'voucher_no' => $inv_no,
                            'user_id' => $userid,
                            'date' => $inv_date, 'description' => $description);
                    } else {
                        $message = 'Investor ledger retrieval error. Please try again.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }

                    $custom_rate = $investment_data['Investment']['custom_rate'];
                    $period = $investment_data['Investment']['investment_period'];
                    $end_date = $investment_data['Investment']['due_date'];
                    $first_date = $inv_date;
                    $inv_date = new DateTime($first_date);
                    $to_date = new DateTime($end_date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    pr($duration);
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
                                    'investor_id' => $investor_id,
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
                                    'investor_id' => $investor_id,
                                    'principal' => $principal,
                                    'interest' => $interest_amount2,
                                    'maturity_date' => $date_statemt->format('Y-m-d'),
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $new_investmentamt = $investment_data['Investment']['investment_amount'] + $amount;
                    $newinterest_amt = $investment_data['Investment']['interest_earned'] + $interest_amount;
                    $newtotal_amount_earned = $investment_data['Investment']['total_amount_earned'] + $amount;
                    $new_earnedbalance = $investment_data['Investment']['earned_balance'] + $amount;
                    $newamount_due = $investment_data['Investment']['amount_due'] + $amount_due;
                    $investment_array = array(
                        'id' => $investment_data['Investment']['id'],
                        'investment_amount' => $new_investmentamt,
                        'interest_earned' => $newinterest_amt,
                        'total_amount_earned' => $newtotal_amount_earned,
                        'earned_balance' => $new_earnedbalance,
                        'amount_due' => $newamount_due,
                    );

                    $topup_data = array('old_investmentamt' => $investment_data['Investment']['investment_amount'],
                        'oldinterest_earned' => $investment_data['Investment']['interest_earned'],
                        'oldtotal_amount_earned' => $investment_data['Investment']['total_amount_earned'],
                        'oldearned_balance' => $investment_data['Investment']['earned_balance'],
                        'oldamount_due' => $investment_data['Investment']['amount_due'],
                        'topup_amount' => $amount,
                        'cash_receipt_mode_id' => $source,
                        'investment_id' => $investment_data['Investment']['id'],
                        'user_id' => $userid,
                        'investment_date' => $first_date);

                    $result = $this->Investment->save($investment_array);
                    if ($result) {
                        $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                    'investment_id' => $investment_data['Investment']['id'], 'currency_id' => $investment_data['Investment']['currency_id'],
                    'amount' => $amount,
                    'available_amount' => $amount,
                    'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                    'investment_date' => $first_date);
                $this->InvestmentCash->create();
                $this->InvestmentCash->save($investmentcash_data);
                        $this->Topup->create();
                        $this->Topup->save($topup_data);
                        if (isset($client_ledger)) {
                            $this->ClientLedger->save($client_ledger);
                            if ($ledger_transactions) {

                                $this->LedgerTransaction->create();
                                $this->LedgerTransaction->save($ledger_transactions);
                            }
                        }
                        $message = 'Topup successful.';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    } else {
                        $message = 'Error Saving Topup Details.Please Try again.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }
                } else {
                    $message = 'Investment details not found. Please try again.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                }
            }
        }
    }

    function cancelEquityInvestment($investment_id = null, $investor = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Cancelled', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Investment Cancelled Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
        }
    }

    function manageEquityInvestments($investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        $check = $this->Session->check('disposetemp');
        if ($check) {
            $this->Session->delete('disposetemp');
        }
        $check = $this->Session->check('new_investmentdetails');
        if ($check) {
            $this->Session->delete('new_investmentdetails');
        }
        $check = $this->Session->check('investment_paymentdetails');
        if ($check) {
            $this->Session->delete('investment_paymentdetails');
        }
        if (!is_null($investor_id) && !is_null($investor_name)) {
            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(2, 3)), 'order' => array('Investment.id')));
            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);

            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, No Equity Investments Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
        $this->paginate('Investment');
    }

    function editFixedInvestment($investor_id = null, $investment_id = null) {
        /* $this->__validateUserType(); */
        $this->set('portfolios', $this->Portfolio->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('equitieslists', $this->EquitiesList->find('list'));

        if (!is_null($investor_id)) {

            $ledger = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

            if ($ledger) {
                $this->set('inv', $ledger);
            }
        }

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($data) {
                $this->set('data', $data);
                $this->set('investment_id', $investment_id);
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $check = $this->Session->check('variabless_fixed.duedate');
                    if ($check) {
                        $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
                    }
                    $check = $this->Session->check('variabless_fixed.interest');
                    if ($check) {
                        $this->set('interest', $this->Session->read('variabless_fixed.interest'));
                    }
                    $check = $this->Session->check('variabless_fixed.totaldue');
                    if ($check) {
                        $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
                    }
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        }
    }

    function editEquityInvestment($investor_id = null, $investor_name = null, $investment_id = null) {
        /* $this->__validateUserType(); */
        $this->set('portfolios', $this->Portfolio->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('equitieslists', $this->EquitiesList->find('list'));

        if (!is_null($investor_id)) {
            $investors = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
            $this->set('inv', $investors);
        }

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
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
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
        }
    }

    function ReinstateEquityInvestment($investment_id = null, $investor = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => $data['Investment']['old_status'], 'old_status' => 'Cancelled');

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Investment Re-instated Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor, $investor_name));
        }
    }

    function payInvestor($investor_id = null) {
        /* $this->__validateUserType(); */
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        if (!is_null($investor_id)) {
            $data = $this->ClientLedger->find('first', array('conditions' => array('ClientLedger.investor_id' => $investor_id)));
            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        }
    }

    function disposeEquityInvestment($investment_id = null) {
        /* $this->__validateUserType(); */
//        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function disposeEquityReceipt($investment_id = null) {
        /* $this->__validateUserType(); */
        if ($investment_id == '' || is_null($investment_id)) {
            $message = 'Investment details missing. Try again';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        } elseif (!$this->Session->check('new_investmentdetails')) {
            $message = 'Please process investment first.';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
        }
        $payment_amt = $this->Session->read('disposetemp.amount');
        $new_investmentdetails = $this->Session->read('new_investmentdetails');
        $result = $this->Investment->save($new_investmentdetails);
        if ($result) {
//                      print_r($result);
//            exit;
            $investment_paymentdetails = $this->Session->read('investment_paymentdetails');
            $result2 = $this->InvestmentPayment->save($investment_paymentdetails);
            if ($result2) {
                $this->Session->delete('investment_paymentdetails');
                $this->Session->delete('new_investmentdetails');
                $this->Session->delete('disposetemp');
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

                //$this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments',$investor,$investor_name));
            } else {

                $message = 'Investment Payout Saved With Errors';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
            }
        } else {

            $message = 'Investment Payout Unsuccessful';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id));
        }

        $Investment_data = $this->InvestmentPayment->find('first', array('conditions' => array('InvestmentPayment.investment_id' => $investment_id)));
        //  $check = $this->Session->check('payment_receipt');
        if ($Investment_data) {
            $investment_name = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' =>
                    $Investment_data['Investment']['equities_list_id']), 'recursive' => -1));
            // $payment = $this->Session->read('payment_receipt');
            if ($investment_name) {
                $this->set('investment_name', $investment_name);
            }

            $this->set('payment', $Investment_data);
            $this->set('payment_amt', $payment_amt);
        } else {
            $message = "Payment successful But Investment Details not found";
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments'));
        }
        $issuedcheck = $this->Session->check('userData');
        if ($issuedcheck) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
    }

    public function paymentReceipt($ledger_id = null, $payment_amt = null, $voucher_no = null, $check_no = null) {
        /* $this->__validateUserType(); */
        $data = $this->ClientLedger->find('first', array('conditions' => array('ClientLedger.id' => $ledger_id)));
        //  $check = $this->Session->check('payment_receipt');
        if ($data) {
            // $payment = $this->Session->read('payment_receipt');
            $this->set('payment', $data);
            $this->set('payment_amt', $payment_amt);
            $this->set('voucher_no', $voucher_no);
            if (!is_null($check_no)) {
                $this->set('check_nos', $check_no);
            }
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

    public function process_rollover() {
        /* $this->__validateUserType(); */
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $invesmentID = $this->request->data['Investment']['id'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            $ledger_transactions = array();
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
            if ($data) {
//                $portfolio_id = $data['Investment']['investment_term_id'];
//                $portfolio = $this->InvestmentTerm->find('first', array('conditions' => array('InvestmentTerm.id' => $portfolio_id), 'recursive' => -1));
//
//                if ($portfolio) {
                $inv_day = $this->request->data['Investment']['investment_date']['day'];
                if (!empty($inv_day)) {
                    $inv_month = $this->request->data['Investment']['investment_date']['month'];
                    $inv_year = $this->request->data['Investment']['investment_date']['year'];
                    $finv_date = $inv_year . "-" . $inv_month . "-" . $inv_day;
                    $sinv_date = strtotime($finv_date);
                    $inv_date = date('Y-m-d', $sinv_date);
                } else {
                    $inv_date = date('Y-m-d');
                }
                $basefee_duedate = new DateTime($inv_date);
                $basefee_duedate->add(new DateInterval('P3M'));

                $pur_day = $this->request->data['Investment']['investment_date']['day'];
                if (!empty($pur_day)) {
                    $pur_month = $this->request->data['Investment']['investment_date']['month'];
                    $pur_year = $this->request->data['Investment']['investment_date']['year'];
                    $pfinv_date = $pur_year . "-" . $pur_month . "-" . $pur_day;
                    $psinv_date = strtotime($pfinv_date);
                    $pinv_date = date('Y-m-d', $psinv_date);
                } else {
                    $pinv_date = date('Y-m-d');
                }
                $this->request->data['Investment']['investment_date'] = $inv_date;
                $this->request->data['Investment']['purchase_date'] = $pinv_date;
                if ($this->Session->check('rollovertemp') == true) {
                    $this->Session->delete('rollovertemp');
                }
                $this->Session->write('rollovertemp', $this->request->data['Investment']);

                $amount_available = $this->request->data['Investment']['cash_athand'];
                $cashinvested = $this->request->data['Investment']['total_invested'];
                $new_cashinvested = $cashinvested;

                if ($this->request->data['Investment']['paymentschedule_id'] == "" || $this->request->data['Investment']['paymentschedule_id'] == null) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                }

                if ($this->request->data['Investment']['paymentmode_id'] == "" || $this->request->data['Investment']['paymentmode_id'] == null) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                }


                if ($this->request->data['Investment']['instruction_id'] == "" || $this->request->data['Investment']['instruction_id'] == null) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                }
                if (($this->request->data['Investment']['instruction_id'] == 5) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                }
                if ($this->request->data['Investment']['investment_amount'] == "" || $this->request->data['Investment']['investment_amount'] == null) {
                    $message = 'Please Enter Investment Amount';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                } else {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];
                    if ($investment_amount > $amount_available) {
                        $message = 'Investment Amount cannot be more than investor\'s balance';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                    }
                }
                $base_fee = 0;
                $base_rate = 0;
                $benchmark_rate = 0;
                if (isset($this->request->data['Investment']['base_fees'])) {
                    $base_rate = $this->request->data['Investment']['base_fees'];
                }
                if (isset($this->request->data['Investment']['benchmark_rate'])) {
                    $benchmark_rate = $this->request->data['Investment']['benchmark_rate'];
                }
                $new_cashathand = $amount_available - $investment_amount;
                $new_cashinvested = $cashinvested + $investment_amount;
                $first_date = $inv_date;
                $period = $this->request->data['Investment']['investment_period'];
                $duration = $this->request->data['Investment']['duration'];
                $custom_rate = $this->request->data['Investment']['custom_rate'];
                $year = $duration;
                switch ($period) {
                    case 'Day(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
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
                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                'investor_id' => $this->request->data['Investment']['investor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                            $principal = $total;
                        }

                        break;
                    case 'Year(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
                        $date->add(new DateInterval('P' . $duration . 'Y'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $YEAR2DAYS = 365 * $duration;
                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                        $amount_due = $interest_amount + $investment_amount;
                        for ($n = 1; $n <= $duration; $n++) {
                            $date_statemt->add(new DateInterval('P1Y'));
                            $interest_amount2 = $interest_amount1 * (365 / 365);
                            $total = $interest_amount2 + $principal;
                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
                                'investor_id' => $this->request->data['Investment']['investor_id'],
                                'principal' => $principal,
                                'interest' => $interest_amount2,
                                'maturity_date' => $date_statemt->format('Y-m-d'),
                                'total' => $total);
//                            $principal = $total;
                        }

                        break;
                }




                $total_tenure = $this->request->data['Investment']['total_tenure'];
                $description = 'Reinvestment of ' . $data["Investment"]["investment_no"] . ' for ' . $duration . ' ' . $period;
                //'cash_athand' => $new_cashathand, 'total_invested' => $new_cashinvested,
                $investment_array = array('balance' => $amount_due,
                    'expected_interest' => $interest_amount, 'amount_due' => $amount_due,
                    'custom_rate' => $custom_rate,
                    'total_tenure' => $total_tenure, 'total_amount_earned' => $this->request->data['Investment']['investment_amount'],
                    'earned_balance' => $this->request->data['Investment']['investment_amount'],
                    'interest_earned' => $interest_amount,
                    'due_date' => $date->format('Y-m-d'), 'status' => 'Rolled_over');

                $ledger_transactions[] = array('debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => $description);

                $rollover_details = array('user_id' => $data['Investment']['user_id'], 'investment_id' => $data['Investment']['id'],
                    'investor_id' => $data['Investment']['investor_id'], 'amount' => $investment_amount,
                    'custom_rate' => $custom_rate, 'old_custom_rate' => $data["Investment"]["custom_rate"], 'rollover_date' => $date->format('Y-m-d'));

                $base_fee = 0;
                $benchmark_fee = 0;
                switch ($management_fee_type) {
                    case 'Management Fee':
                        $base_fee = ($base_fee / 100) * $investment_amount;

                        if ($base_fee > $new_cashathand) {
                            $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                        }
                        $new_cashathand = $new_cashathand - $base_fee;
                        break;
                    case 'Management & Performance Fee':
                        $base_fee = ($base_fee / 100) * $investment_amount;
                        if ($base_fee > $new_cashathand) {
                            $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
                            $this->Session->write('bmsg', $message);
                            $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
                        }
                        $new_cashathand = $new_cashathand - $base_fee;

                        break;
                }
                $generic_array = array('id' => $data['Investment']['id'], 'investor_id' => $data['Investment']['investor_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_date' => $inv_date);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
//move to summary contract function and store in client ledger

                $client_ledger = array('available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested);

                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }

                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
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
                $this->Session->write('variabless_fixed', $variables);
                $this->Session->write('rollover_details', $rollover_details);
                $this->Session->write('investment_array_fixed', $investment_array);

                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('rledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('rollovertemp.investmentproduct_id', $investmentproduct_id);
                $this->Session->write('rollovertemp', $this->request->data['Investment']);
                $this->Session->write('rollovertemp.cash_athand', $new_cashathand);
                $this->Session->write('rollovertemp.total_invested', $new_cashinvested);
                $message = 'Investment details successfully processed';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
            } else {

                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
        }
        $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
    }

    function rollover($investment_id = null, $investor_id = null) {
        /* $this->__validateUserType(); */
        $this->set('portfolios', $this->Portfolio->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('investmentterms', $this->InvestmentTerm->find('list'));
        $this->set('paymentschedules', $this->PaymentSchedule->find('list'));
        $this->set('paymentmodes', $this->PaymentMode->find('list'));
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('instructions', $this->Instruction->find('list'));
        $this->set('equitieslists', $this->EquitiesList->find('list'));

        if (!is_null($investor_id)) {
            $investors = $this->Investor->find('first', array('recursive' => -1, 'conditions' => array('Investor.id' => $investor_id)));
            $this->set('inv', $investors);
            $check = $this->Session->check('rledger_data');
            if ($check) {
                $ledger_data = $this->Session->read('rledger_data');
                $this->set('ledger_data', $ledger_data);
            } else {
                $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

                if ($ledger_data) {
                    $this->Session->write('rledger_data', $ledger_data);
                    $this->set('ledger_data', $ledger_data);
                }
            }
        } else {

            $message = 'Sorry, Investor Details Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
        }

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id)));
            if ($data) {
                $this->set('data', $data);
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'maturityList'));
        }
        $check = $this->Session->check('variabless_fixed');
        if ($check) {
            $check = $this->Session->check('variabless_fixed.duedate');
            if ($check) {
                $this->set('duedate', $this->Session->read('variabless_fixed.duedate'));
            }
            $check = $this->Session->check('variabless_fixed.interest');
            if ($check) {
                $this->set('interest', $this->Session->read('variabless_fixed.interest'));
            }
            $check = $this->Session->check('variabless_fixed.totaldue');
            if ($check) {
                $this->set('totaldue', $this->Session->read('variabless_fixed.totaldue'));
            }
        }
    }

    function statementActiveInv($investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        $issued = $this->Session->check('userData');
        if ($issued) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
        if (!is_null($investor_id)) {
            $payment = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
            $data = $this->Investment->find('all', array('order' => array('Investment.id' => 'asc'), 'conditions' => array('Investment.investor_id' => $investor_id, 'NOT' => array('Investment.status' => array('Cancelled', 'Paid', 'Deleted')))));
            $issued = $this->Session->check('userData');
            if ($issued) {
                $issued = $this->Session->read('userData');
                $this->set('issued', $issued);
            }

            if ($data) {

                $this->set('data', $data);
                $this->set('payment', $payment);
                $this->set('investor_name', $investor_name);
            } else {

                $message = 'Sorry, No Active Investment Details Found for Selected Investor';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }
function clientLedger($investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));
            $data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);


            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);
//            $this->set('investment_id', $investment_id);
            if ($data) {
//               $transactions = $this->LedgerTransaction->find('all',['conditions' => [
//                   'LedgerTransaction.client_ledger_id' =>$data['ClientLedger']['id']]]);
                $this->paginate = array(
                    'conditions' => array('LedgerTransaction.client_ledger_id' => $data['ClientLedger']['id']),
                    'order' => array('LedgerTransaction.id' => 'asc'));
                $transactions = $this->paginate('LedgerTransaction');
                if ($transactions) {
                    $this->set('transactions', $transactions);
                }
                $this->set('data', $data);
            } else {
                $message = 'Sorry, ledger information not found for investor. Try again.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, investor not found';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }
    public function statementAllInv($investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */

        $issued = $this->Session->check('userData');
        if ($issued) {
            $issued = $this->Session->read('userData');
            $this->set('issued', $issued);
        }
        if (!is_null($investor_id)) {
            $payment = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
            $data = $this->Investment->find('all', array('order' => array('Investment.id' => 'asc'), 'conditions' => array('Investment.investor_id' => $investor_id, 'NOT' => array('Investment.status' => array('Cancelled', 'Deleted')))));
            $issued = $this->Session->check('userData');
            if ($issued) {
                $issued = $this->Session->read('userData');
                $this->set('issued', $issued);
            }

            if ($data) {

                $this->set('data', $data);
                $this->set('payment', $payment);
                $this->set('investor_name', $investor_name);
            } else {

                $message = 'Sorry, No Active Investment Details Found for Selected Investor';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    public function statementInvDetail($invesmentID = null, $investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        if (!is_null($invesmentID)) {
            $data = $this->DailyInterestStatement->find('all', array('conditions' =>
                array('DailyInterestStatement.investment_id' => $invesmentID)));
            $issued = $this->Session->check('userData');
            if ($issued) {
                $issued = $this->Session->read('userData');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data2 = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
                $data_total = $this->DailyInterestStatement->find('all', array('fields' =>
                    array("SUM(DailyInterestStatement.principal) as 'total_principal',"
                        . "SUM(DailyInterestStatement.interest) as 'total_interest',SUM(DailyInterestStatement.total) as 'sum_total'"),
                    'conditions' => array('DailyInterestStatement.investment_id' => $invesmentID)));

                if ($data2) {
                    $this->set('data2', $data2);
                }
                if ($data_total) {
                    $this->set('data_total', $data_total);
                }
                $this->set('data', $data);
                $this->set('investor_id', $investor_id);
                $this->set('invesmentID', $invesmentID);
                $this->set('investor_name', $investor_name);
            } else {

                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
        }
    }

    public function statementDailyInterest($invesmentID = null, $investor_id = null, $investor_name = null) {
        /* $this->__validateUserType(); */
        if (!is_null($invesmentID)) {
            $data = $this->InvestmentStatement->find('all', array('conditions' =>
                array('InvestmentStatement.investment_id' => $invesmentID)));
            $issued = $this->Session->check('userData');
            if ($issued) {
                $issued = $this->Session->read('userData');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data2 = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
                $data_total = $this->InvestmentStatement->find('all', array('fields' =>
                    array("SUM(InvestmentStatement.principal) as 'total_principal',"
                        . "SUM(InvestmentStatement.interest) as 'total_interest',SUM(InvestmentStatement.total) as 'sum_total'"),
                    'conditions' => array('InvestmentStatement.investment_id' => $invesmentID)));

                if ($data2) {
                    $this->set('data2', $data2);
                }
                if ($data_total) {
                    $this->set('data_total', $data_total);
                }
                $this->set('data', $data);
                $this->set('investor_id', $investor_id);
                $this->set('invesmentID', $invesmentID);
                $this->set('investor_name', $investor_name);
            } else {

                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
        }
    }

    public function payments() {
        /* $this->__validateUserType(); */
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

}

?>
