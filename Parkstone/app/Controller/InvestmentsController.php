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
        'InvestorEquity', 'LedgerTransaction', 'Topup', 'InvestorDeposit', 'InterestAccrual',
        'ReinvestmentsEquity', 'ReinvestorEquity', 'ReinvestorCashaccount',
        'EquityOrder', 'ManagementFee');
    var $paginate = array(
        'Investment' => array('limit' => 15, 'order' => array('Investment.id' => 'asc'), 'group' => array('Investment.investor_id')),
        'Investor' => array('limit' => 5, 'order' => array('Investor.investor_type_id' => 'asc'),
            'conditions' => array('Investor.approved' => 1)),
        'InvestorDeposit' => array('limit' => 50, 'order' => array('InvestorDeposit.id' => 'asc')),
    );

//var $helpers = array('AjaxMultiUpload.Upload');
//    function beforeFilter() {
////        $this->Uploader = new Uploader(array('tempDir' => TMP, 'ajaxField' => "qqfile"));
//    }
    /**
     * This function execute when the page loads before
     * any other function
     */
    function beforeFilter() {
        $this->__validateLoginStatus();
    }

    /**
     * Function to check whether user is logged in
     * @return boolean
     */
    function __validateLoginStatus() {
        if ($this->action != 'login' && $this->action != 'logout') {
            if ($this->Session->check('userData') == false) {
                $this->redirect('/');
            }
        }
    }

    function __validateUserType() {

        $userType = $this->Session->read('userDetails.usertype_id');
//        if ($userType != 1) {
//            $this->redirect('/Information/');
//        }
    }

    function index() {
        $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
    }

    function newInvestor() {
        $this->__validateUserType();

        // $this->set('marriages', $this->Marriage->find('list'));
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        // $this->set('zones', $this->Zone->find('list'));
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
    }

    function newInvestorIndiv() {
        $this->__validateUserType();
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorIndivJoint() {
        $this->__validateUserType();
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorJoint() {
        $this->__validateUserType();
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorGroup() {
        $this->__validateUserType();
        $this->set('idtypes', $this->Idtype->find('list'));
        $this->set('investortypes', $this->InvestorType->find('list'));
        $this->set('grossincomes', $this->GrossIncome->find('list'));
        $this->set('marriages', $this->Marriage->find('list'));
        $this->set('users', $this->User->find('list'));
        $this->set('banks', $this->Bank->find('list'));
    }

    function newInvestorComp() {
        $this->__validateUserType();
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

    public function checkDuplicate() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $name = $_POST['name'];
            $check = $this->Investor->find('count', ['recursive' => -1,
                'conditions' => ['OR' => ['Investor.fullname' => $name, 'Investor.comp_name' => $name]]]);
            if ($check > 0) {
                $message = 'Investor already exists. Please check and try again';
                $this->Session->write('bmsg', $message);
                return json_encode(array('status' => 'error'));
            } else {
                return json_encode(array('status' => 'ok'));
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


            $this->request->data['Investor']['investor_photo'] = null;


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
            $this->request->data['Investor']['fullname'] = $this->request->data['Investor']['comp_name'];
            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {
                $client_ledger = array('investor_id' => $Investorid, 'user_id' => $user_id);
                $this->ClientLedger->save($client_ledger);
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $this->Session->delete('public_unapproved_investors');
                $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));

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
//            print_r($_FILES);
//            exit;

            if (!empty($_FILES['data']['name']['Investor']['investor_photo'])) {
//                $file = $this->request->data['Customer']['customer_photo']; //put the data into a var for easy use
                $file_contents = file_get_contents($_FILES['data']['tmp_name']['Investor']['investor_photo']);
                $file_name = $_FILES['data']['name']['Investor']['investor_photo'];
                $fileType = $_FILES['data']['type']['Investor']['investor_photo'];
                $ext = substr(strtolower(strrchr($file_name, '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png', 'tiff'); //set allowed extensions
//return json_encode($file_contents);
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //prepare the filename for database entry
                    $name_date = date('Y-m-d-H_s');
                    $file_name = $this->request->data['Investor']['surname'] . $dob_date . $name_date . '.' . $ext;
                    $this->request->data['Investor']['investor_photo'] = $file_contents;
                    $this->request->data['Investor']['GRAPHIC_TYPE'] = $fileType;
                    //do the actual uploading of the file. First arg is the tmp name, second arg is where we are putting it
//                    move_uploaded_file($_FILES['investor_photo']['tmp_name'], WWW_ROOT . 'files/uploads/' . $file_name);
                }
            } else {
                $this->request->data['Investor']['investor_photo'] = null;
            }
//            $this->request->data['Investor']['investor_photo'] = $file_contents;
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
                $this->Session->delete('public_unapproved_investors');
                $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));

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

    function display_user_image($id) {

        $this->autoRender = false;
        $this->autoLayout = false;
        $image_upload = $this->Investor->find('first', array(
            'conditions' => array('Investor.id' => $id),
            'recursive' => -1));

        // set the header for the image
        header("Content-type: " . $image_upload['Investor']['GRAPHIC_TYPE']);
        echo $image_upload['Investor']['investor_photo'];
    }

    public function countUserImage($id) {
        $image_count = $this->Investor->find('count', array(
            'conditions' => array('Investor.id' => $id),
            'recursive' => -1));
        if ($image_count) {
            return $image_count;
        } else {
            return 0;
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
//            $file_contents = file_get_contents($_FILES['investor_photo']['tmp_name']);
//            $file_name = $_FILES['investor_photo']['name'];
//            $this->request->data['Investor']['investor_photo'] = $file_name;
            $user_id = null;
            $check = $this->Session->check('userDetails');
            if ($check) {
                $user_id = $this->Session->read('userDetails.id');
                $user_f = $this->Session->read('userDetails.firstname');
                $user_l = $this->Session->read('userDetails.lastname');
                $this->request->data['Investor']['entryclerk_name'] = $user_f . ' ' . $user_l;
            }

            $this->request->data['Investor']['investor_photo'] = null;

            $this->request->data['Investor']['fullname'] = $this->request->data['Investor']['comp_name'];
            $result = $this->Investor->save($this->request->data);
            $Investorid = $this->Investor->id;
            //pr($this->request->data);
            if ($result) {

                $client_ledger = array('investor_id' => $Investorid, 'user_id' => $user_id);
                $this->ClientLedger->save($client_ledger);
                if ($this->Session->check('investortemp') == true) {
                    $this->Session->delete('investortemp');
                }
                $this->Session->delete('public_unapproved_investors');
                $this->Session->write('public_unapproved_investors', $this->Investor->find('count', array('conditions' => array('Investor.approved' => 0))));

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

    function upload() {
        $data = array();

        if (isset($_GET['files'])) {
            $error = false;
            $files = array();

            $uploaddir = $this->webroot . 'files/uploads/';
            foreach ($_FILES as $file) {
                if (move_uploaded_file($file['tmp_name'], $uploaddir . basename($file['name']))) {
                    $files[] = $uploaddir . $file['name'];
                } else {
                    $error = true;
                }
            }
            $data = ($error) ? array('error' => 'There was an error uploading your files') : array('files' => $files);
        } else {
            $data = array('success' => 'Form was submitted', 'formData' => $_POST);
        }

        echo json_encode($data);
    }

    function approveInvestors() {
        $this->__validateUserType();


        $this->paginate = array(
            'limit' => 50, 'order' => array('Investor.investor_type_id' => 'asc'),
            'conditions' => array('Investor.approved' => 0));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);
    }

    function approveInvestors2() {
        $this->autoRender = false;
        $this->__validateUserType();
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
        $this->__validateUserType();
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
        $this->__validateUserType();
        $this->paginate('Investor');
        $data = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        if ($data) {
            $this->set('investor_id', $investor_id);
            $this->set('investor', $data);
        } else {

            $message = 'Sorry, Investor Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => "Investments", 'action' => "clearSessions"));
        }
    }

    function editInvestor($investor_id = null) {
        $this->__validateUserType();
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
        $this->__validateUserType();
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
//            {"data":{"name":{"Investor":{"investor_photo":"120125_184515.jpg"}},"type":{"Investor":{"investor_photo"
//:"image\/jpeg"}},"tmp_name":{"Investor":{"investor_photo":"C:\\wamp\\tmp\\phpE431.tmp"}},"error":{"Investor"
//:{"investor_photo":0}},"size":{"Investor":{"investor_photo":180430}}}};
//            return json_encode($_FILES);
            if (!empty($_FILES['data']['name']['Investor']['investor_photo'])) {
//                $file = $this->request->data['Customer']['customer_photo']; //put the data into a var for easy use
                $file_contents = file_get_contents($_FILES['data']['tmp_name']['Investor']['investor_photo']);
                $file_name = $_FILES['data']['name']['Investor']['investor_photo'];
                $fileType = $_FILES['data']['type']['Investor']['investor_photo'];
                $ext = substr(strtolower(strrchr($file_name, '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png', 'tiff'); //set allowed extensions
//return json_encode(array('pix'=>$_FILES['data']['tmp_name']['Investor']['investor_photo']));
                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                    //prepare the filename for database entry
                    $name_date = date('Y-m-d-H_s');
                    $file_name = $this->request->data['Investor']['surname'] . $dob_date . $name_date . '.' . $ext;
                    $this->request->data['Investor']['investor_photo'] = $file_contents;
                    $this->request->data['Investor']['GRAPHIC_TYPE'] = $fileType;
                    //do the actual uploading of the file. First arg is the tmp name, second arg is where we are putting it
//                    move_uploaded_file($_FILES['investor_photo']['tmp_name'], WWW_ROOT . 'files/uploads/' . $file_name);
                }
            }
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
        $this->__validateUserType();
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
        $check = $this->Session->check('interest_accrual');
        if ($check) {
            $this->Session->delete('interest_accrual');
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
        if ($this->Session->check('investmt_equities')) {
            $this->Session->delete('investmt_equities');
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
        $this->__validateUserType();
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 3, 'Investor.approved' => 1),
            'limit' => 5, 'order' => array('Investor.id' => 'asc'));

        $data = $this->paginate('Investor');
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->set('investor', $data);
        $check = $this->Session->check('interest_accrual');
        if ($check) {
            $this->Session->delete('interest_accrual');
        }
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
        if ($this->Session->check('investmt_equities')) {
            $this->Session->delete('investmt_equities');
        }

        $check = $this->Session->check('ledger_data');
        if ($check) {
            $this->Session->delete('ledger_data');
        }
    }

    function newInvestment1Group() {
        $this->__validateUserType();
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 5, 'Investor.approved' => 1),
            'limit' => 5, 'order' => array('Investor.id' => 'asc'));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);
        if ($this->Session->check('investmt_equities')) {
            $this->Session->delete('investmt_equities');
        }

        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));

        $check = $this->Session->check('interest_accrual');
        if ($check) {
            $this->Session->delete('interest_accrual');
        }
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
        $this->__validateUserType();
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 2, 'Investor.approved' => 1),
            'limit' => 5, 'order' => array('Investor.id' => 'asc'));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);
        $check = $this->Session->check('interest_accrual');
        if ($check) {
            $this->Session->delete('interest_accrual');
        }
        if ($this->Session->check('investmt_equities')) {
            $this->Session->delete('investmt_equities');
        }

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
        $this->__validateUserType();
        $this->set('investmentproducts', $this->InvestmentProduct->find('list'));
        $this->paginate = array(
            'conditions' => array('Investor.investor_type_id' => 4, 'Investor.approved' => 1),
            'limit' => 5, 'order' => array('Investor.id' => 'asc'));
        $data = $this->paginate('Investor');
        $this->set('investor', $data);
        $check = $this->Session->check('interest_accrual');
        if ($check) {
            $this->Session->delete('interest_accrual');
        }
        if ($this->Session->check('investmt_equities')) {
            $this->Session->delete('investmt_equities');
        }
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
        $this->__validateUserType();

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
            $check = $this->Session->read('investment_type');
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
            $check = $this->Session->check('investtemp1.total_principal');
            if ($check) {
                $this->set('total_principal', $this->Session->read('investtemp1.total_principal'));
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
        $this->__validateUserType();

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
            $check = $this->Session->check('investtemp1.total_principal');
            if ($check) {
                $this->set('total_principal', $this->Session->read('investtemp1.total_principal'));
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
        $this->__validateUserType();

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
//                        $this->Session->write('ledger_data', $ledger_data);
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
                $check = $this->Session->check('investtemp1.total_principal');
                if ($check) {
                    $this->set('total_principal', $this->Session->read('investtemp1.total_principal'));
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
        $this->__validateUserType();

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
                    $ledger_data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investorid]]);

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
                $check = $this->Session->check('investtemp1.total_principal');
                if ($check) {
                    $this->set('total_principal', $this->Session->read('investtemp1.total_principal'));
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
            $total_shares = 0;
            $investor_id = $this->request->data['Investment']['investor_id'];
            $page = $this->request->data['Investment']['investor_page'];
            if (isset($this->request->data['fixed_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }

                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }

                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page));
            } elseif (isset($this->request->data['equity_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page));
            } elseif (isset($this->request->data['reset'])) {


                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page));
            }
            $ledger_transactions = array();
            $cheque_no = '';
            $amount = $this->request->data['Investment']['investment_amount'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $currency_id = $this->request->data['Investment']['currency_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
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
            $basefee_duedate->add(new DateInterval('P1M'));
            $deposit_date = new DateTime($inv_date);
            $deposit_date->sub(new DateInterval('P1D'));
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

            $this->Session->write('investtemp', $this->request->data['Investment']);
            $this->Session->write('investtemp1', $this->request->data['Investment']);


            $amount_available = $this->request->data['Investment']['cash_athand'] + $this->request->data['Investment']['amount_deposited'];
            $cashinvested = $this->request->data['Investment']['total_invested'];
            $total_principal = $this->request->data['Investment']['total_principal'];
            $new_cashinvested = $cashinvested;
            if (isset($this->request->data['fixed_process'])) {



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
                if (($this->request->data['Investment']['instruction_id'] == 7) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
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
            }
            if (isset($this->request->data['equity_process'])) {

                $first_date = $pinv_date;

                $this->request->data['Investment']['investment_date'] = $pinv_date;


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
                $voucher_no = date('mdyhis') . rand(2, 4);
                $receipt_no = $voucher_no;
                $ledger_transactions[] = array('cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'credit' => $deposit, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => 'Deposit for investment with receipt no:' . $receipt_no, 'voucher_no' => $receipt_no);

                $inv_deposit = array('user_id' => $this->request->data['Investment']['user_id'],
                    'amount' => $deposit, 'receipt_no' => $receipt_no, 'deposit_date' => $deposit_date->format('Y-m-d'));


                $this->Session->write('inv_deposit', $inv_deposit);
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
                    $total_principal = $total_principal + $investment_amount;
                    $period = $this->request->data['Investment']['investment_period'];
                    $duration = $this->request->data['Investment']['duration'];
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
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;

                            $due_date = $date->format('Y-m-d');
                            if ($due_date <= $adate) {

                                $adate = $due_date;
                            }
                            $to_date = new DateTime($adate);
                            $ainv_date = new DateTime($inv_date);
                            $aduration = date_diff($ainv_date, $to_date);
                            $aduration = $aduration->format("%a");
//                            $aduration +=1;
                            $ainterest_amount = $interest_amount1 * ($aduration / 365);
                            $aamount_due = $ainterest_amount + $investment_amount;

//                            for ($n = 1; $n <= $duration; $n++) {
//                                $date_statemt->add(new DateInterval('P1D'));
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

                            break;
                        case 'Year(s)':

                            $finv_date = $inv_date;
                            $date = new DateTime($finv_date);
                            $date->add(new DateInterval('P' . $duration . 'Y'));
                            $date->sub(new DateInterval('P1D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            $YEAR2DAYS = 365 * $duration;
                            $duration = $YEAR2DAYS;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                            $amount_due = $interest_amount + $investment_amount;

                            $due_date = $date->format('Y-m-d');
                            if ($due_date <= $adate) {
                                $adate = $due_date;
                            }
                            $to_date = new DateTime($adate);
                            $ainv_date = new DateTime($inv_date);
                            $aduration = date_diff($ainv_date, $to_date);
                            $aduration = $aduration->format("%a");
                            if ($due_date <= $adate) {

                                $aduration +=1;
                            }

//                            $aYEAR2DAYS = 365 * $aduration;
                            $ainterest_amount = $interest_amount1 * ($aduration / 365);
                            $aamount_due = $ainterest_amount + $investment_amount;

//                            for ($n = 1; $n <= $duration; $n++) {
//                                $date_statemt->add(new DateInterval('P1Y'));
//                                $interest_amount2 = $interest_amount1 * (365 / 365);
//                                $total = $interest_amount2 + $principal;
//                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                    'investor_id' => $this->request->data['Investment']['investor_id'],
//                                    'principal' => $principal,
//                                    'interest' => $interest_amount2,
//                                    'maturity_date' => $date_statemt->format('Y-m-d'),
//                                    'total' => $total);
////                            $principal = $total;
//                            }

                            break;
                    }
                    $check = $this->Session->check('statemt_array_fixed');
                    if ($check) {
                        $this->Session->delete('statemt_array_fixed');
                    }
//                    $this->Session->write('statemt_array_fixed', $statemt_array);
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
                        'expected_interest' => $interest_amount,
                        'total_amount_earned' => $aamount_due,
                        'earned_balance' => $aamount_due,
                        'interest_earned' => $ainterest_amount,
                        'accrued_days' => $aduration,
                        'interest_accrued' => $ainterest_amount,
                        'amount_due' => $amount_due,
                        'due_date' => $date->format('Y-m-d')
                    );

                    $interest_accruals = array(
                        'investor_id' => $this->request->data['Investment']['investor_id'],
                        'interest_amounts' => $ainterest_amount,
                        'interest_date' => $inv_date
                    );

                    $check = $this->Session->check('interest_accrual');
                    if ($check) {
                        $this->Session->delete('interest_accrual');
                    }
                    $check = $this->Session->write('interest_accrual', $interest_accruals);


                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }

                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description, 'management_fee' => $base_fee, 'benchmark' => $custom_rate);

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
                    $new_cashathand = $amount_available - $totalamt;
                    $new_cashinvested = $cashinvested + $totalamt;

                    //Ledger transaction entry
//                    $description = 'Equity investment';
//                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
//                        $this->request->data['Investment']['cashreceiptmode_id'],
//                        'cheque_no' => $cheque_no, 'debit' => $totalamt, 'user_id' => $this->request->data['Investment']['user_id'],
//                        'date' => $inv_date, 'description' => $description);
                    $base_fee = 0;
                    $benchmark_fee = 0;
//                    switch ($management_fee_type) {
//                        case 'Management Fee':
//                            $base_fee = ($base_rate / 100) * $totalamt;
//                            
////                            if ($base_fee > $new_cashathand) {
////                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
////                                $this->Session->write('bmsg', $message);
////                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
////                            }
////                            $new_cashathand = $new_cashathand - $base_fee;
//                            break;
//                        case 'Management & Performance Fee':
//                            $base_fee = ($base_rate / 100) * $totalamt;
////                            if ($base_fee > $new_cashathand) {
////                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
////                                $this->Session->write('bmsg', $message);
////                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
////                            }
////                            $new_cashathand = $new_cashathand - $base_fee;
//
//                            break;
//                    }

                    $description = 'Equity investment for ' . $total_shares . ' shares';
                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $totalamt, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description, 'management_fee' => $base_fee);

                    $investment_array = array(
                        'total_amount' => $totalamt,
                        'numb_shares' => $total_shares,
                        'numb_shares_left' => $total_shares
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
                    'cash_receipt_mode_id' => $this->request->data['Investment']['cashreceiptmode_id'],
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                    'investment_date' => $inv_date,
                    'details' => $this->request->data['Investment']['notes']);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
                //move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand, 'total_principal' => $total_principal,
                    'invested_amount' => $new_cashinvested);

//                $this->Session->delete('investtemp');
                $this->Session->delete('investtemp1');

                $this->Session->write('generic_array', $generic_array);

                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('investtemp.investmentproduct_id', $investmentproduct_id);
                $this->Session->write('investtemp1', $this->request->data['Investment']);
                $this->Session->write('investtemp1.amount_deposited', 0);
                $this->Session->write('investtemp1.cash_athand', $new_cashathand);
                $this->Session->write('investtemp1.total_principal', $total_principal);
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
            $topup_id = $this->request->data['Investment']['topup_id'];
            $deposit_id = $this->request->data['Investment']['deposit_id'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            $investment_id = $this->request->data['Investment']['id'];
            $investment_cash_id = $this->request->data['Investment']['investment_cash_id'];
            $ledger_transaction = $this->request->data['Investment']['ledger_transaction_id'];
            $cheque_no = "";
            $count = $this->request->data['Investment']['count'];
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $ledger_info = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);

            $old_investment_data = $this->Investment->find('first', ['recursive' => -1,
                'conditions' => ['Investment.id' => $investment_id]]);
            if ($ledger_info && $old_investment_data) {

                $oldAmount = 0;
                $oldAmount = $this->request->data['Investment']['old_investmentamount'];
                $amount_available = $oldAmount + $ledger_info['ClientLedger']['available_cash'];
                $cashinvested = $ledger_info['ClientLedger']['invested_amount'] - $oldAmount;
                $total_principal = $ledger_info['ClientLedger']['total_principal'] - $oldAmount;
                $investmentproduct_id = $old_investment_data['Investment']['investment_product_id'];
                $new_investment_amount = $old_investment_data['Investment']['investment_amount'] - $oldAmount;
                $new_investment_amount = $new_investment_amount + $this->request->data['Investment']['investment_amount'];
                $olddue_date = $old_investment_data['Investment']['due_date'];
                //get investment_amount with interest
                $period = $old_investment_data['Investment']['investment_period'];
                $old_date = $this->request->data['Investment']['deposit_date'];
                $custom_rate = $old_investment_data['Investment']['custom_rate'];

                $old_total_amount_earned = $old_investment_data['Investment']['total_amount_earned'];
                $new_total_amount_earned = $old_total_amount_earned;
                $old_earned_balance = $old_investment_data['Investment']['earned_balance'];
                $new_earned_balance = $old_earned_balance;
                $old_accrued_interest = $old_investment_data['Investment']['interest_accrued'];
                $new_interest_accrued = $old_accrued_interest;
                $old_interest_amount = $old_investment_data['Investment']['expected_interest'];
                $new_interest_amount = $old_interest_amount;
                $old_amount_due = $old_investment_data['Investment']['amount_due'];
                $new_amount_due = $old_amount_due;

                $to_date = date('Y-m-d');
                if ($olddue_date <= $to_date) {
                    $to_date = $olddue_date;
                }
                $to_date = new DateTime($to_date);
                $ainv_date = new DateTime($old_date);
                $aduration = date_diff($ainv_date, $to_date);
                $aduration = $aduration->format("%a");
                switch ($period) {
                    case 'Day(s)':

                        $finv_date = $old_date;
                        $principal = $oldAmount;
                        $rate = $custom_rate;

                        $interest_amount1 = ($rate / 100) * $principal;
                        $ainterest_amount = $interest_amount1 * ($aduration / 365);
                        $aamount_due = $ainterest_amount + $principal;
                        $new_total_amount_earned = $old_total_amount_earned - $aamount_due;
                        $new_earned_balance = $old_earned_balance - $aamount_due;
                        $new_interest_accrued = $old_accrued_interest - $ainterest_amount;
                        $new_interest_amount = $old_interest_amount - $ainterest_amount;
                        $new_amount_due = $old_amount_due - $aamount_due;

                        break;
                    case 'Year(s)':

                        $finv_date = $old_date;
                        $principal = $oldAmount;
                        $rate = $custom_rate;

                        $aYEAR2DAYS = 365 * $aduration;
                        $aduration = $aYEAR2DAYS;
                        $interest_amount1 = ($rate / 100) * $principal;
                        $ainterest_amount = $interest_amount1 * ($aYEAR2DAYS / 365);
                        $aamount_due = $ainterest_amount + $principal;
                        $new_total_amount_earned = $old_total_amount_earned - $aamount_due;
                        $new_earned_balance = $old_earned_balance - $aamount_due;
                        $new_interest_accrued = $old_accrued_interest - $ainterest_amount;
                        $new_interest_amount = $old_interest_amount - $ainterest_amount;
                        $new_amount_due = $old_amount_due - $aamount_due;
                        break;
                }
                $fee_type = $old_investment_data['Investment']['management_fee_type'];
                $oldbase_rate = $old_investment_data['Investment']['base_rate'];
                $management_fee = $old_investment_data['Investment']['base_fees'];
                $accrued_basefee = $old_investment_data['Investment']['accrued_basefee'];
                $base_fee = 0;
                $benchmark_fee = 0;
                switch ($fee_type) {
                    case 'Management Fee':
                        $base_fee = ($oldbase_rate / 100) * $oldAmount;
//                            $YEAR2DAYS = 365 * $aduration;
                        $base_fee = $base_fee * ($aduration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;
                        break;
                    case 'Management & Performance Fee':
                        $base_fee = ($oldbase_rate / 100) * $oldAmount;
//                            $YEAR2DAYS = 365 * $aduration;
                        $base_fee = $base_fee * ($aduration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;

                        break;
                }
                $management_fee -= $base_fee;
                $accrued_basefee -= $base_fee;
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
                $basefee_duedate->add(new DateInterval('P1M'));

                $deposit_date = new DateTime($inv_date);
                $deposit_date->sub(new DateInterval('P1D'));
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



                $currency_array = $this->Currency->find('first', array('conditions' => array('Currency.id' => 1)));
                if ($currency_array) {
                    $this->Session->write('shopCurrency_investment', $currency_array['Currency']['symbol']);
                }

                if ($this->Session->check('editinvesttemp') == true) {
                    $this->Session->delete('editinvesttemp');
                }
                $this->Session->write('editinvesttemp', $this->request->data['Investment']);


                if (empty($this->request->data['Investment']['paymentschedule_id'])) {
                    $message = 'Please Select a Payment Schedule';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }

                if (empty($this->request->data['Investment']['paymentmode_id'])) {
                    $message = 'Please Select a Payment Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }
                if (empty($this->request->data['Investment']['cashreceiptmode_id'])) {
                    $message = 'Please Select a Cash Receipt Mode';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }
                if (($this->request->data['Investment']['cashreceiptmode_id'] == '2') && (is_null($this->request->data['Investment']['cheque_no']) || $this->request->data['Investment']['cheque_no'] == "")) {
                    $message = 'Please Supply Cheque No.';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }
                if ($this->request->data['Investment']['cashreceiptmode_id'] == '2') {
                    $cheque_no = $this->request->data['Investment']['cheque_no'];
                }


                if (empty($this->request->data['Investment']['instruction_id'])) {
                    $message = 'Please Select an Instruction';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }
                if (($this->request->data['Investment']['instruction_id'] == 7) && empty($this->request->data['Investment']['instruction_details'])) {
                    $message = 'Please State Instruction Details';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                }
                if (empty($this->request->data['Investment']['investment_amount'])) {
                    $message = 'Please Enter Investment Amount';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                } else {
                    $investment_amount = $this->request->data['Investment']['investment_amount'];

                    if ($investment_amount > $amount_available) {
                        //RESET CASH INPUTS AND RETURN
                        $message = 'Investment Amount cannot be more than investor\'s Ledger available cash';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
                    }
                }



                $first_date = $inv_date;
                $base_fee = 0;
                $base_rate = 0;
                $benchmark_rate = 0;
                if (!empty($old_investment_data['Investment']['base_fees'])) {
                    $base_rate = $old_investment_data['Investment']['base_rate'];
                }
                if (!empty($old_investment_data['Investment']['benchmark_rate'])) {
                    $benchmark_rate = $old_investment_data['Investment']['benchmark_rate'];
                }
                $date = new DateTime($first_date);
                $new_cashathand = $amount_available - $investment_amount;
                $new_cashinvested = $cashinvested + $investment_amount;
                $total_principal = $total_principal + $investment_amount;


                $to_date = date('Y-m-d');
                $to_date = new DateTime($to_date);
                $ainv_date = new DateTime($inv_date);
                $aduration = date_diff($ainv_date, $to_date);
                $aduration = $aduration->format("%a");

                $dinv_date = new DateTime($inv_date);
                $duration = date_diff($dinv_date, $to_date);
                $duration = $duration->format("%a");
                $year = $duration;
                switch ($period) {
                    case 'Day(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
                        $date->add(new DateInterval('P' . $duration . 'D'));
                        $date->sub(new DateInterval('P1D'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($duration / 365);
                        $amount_due = $interest_amount + $investment_amount;
                        $new_interest_amount = $new_interest_amount + $interest_amount;
                        $new_amount_due = $new_amount_due + $amount_due;

                        $new_total_amount_earned = $new_total_amount_earned + $amount_due;
                        $new_earned_balance = $new_earned_balance + $amount_due;
                        $new_interest_accrued = $new_interest_accrued + $interest_amount;
                        break;
                    case 'Year(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
                        $date->add(new DateInterval('P' . $duration . 'Y'));
                        $date->sub(new DateInterval('P1D'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $YEAR2DAYS = 365 * $duration;
                        $duration = $YEAR2DAYS;
                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                        $amount_due = $interest_amount + $investment_amount;
                        $new_interest_amount = $new_interest_amount + $interest_amount;
                        $new_amount_due = $new_amount_due + $amount_due;

                        $new_total_amount_earned = $new_total_amount_earned + $amount_due;
                        $new_earned_balance = $new_earned_balance + $amount_due;
                        $new_interest_accrued = $new_interest_accrued + $interest_amount;
                        break;
                }


                $total_tenure = $this->request->data['Investment']['total_tenure'];
                $description = 'Fixed income investment for ' . $total_tenure . ' ' . $period;

                $investment_array = array(
                    'investment_amount' => $new_investment_amount,
                    'instruction_id' => $this->request->data['Investment']['instruction_id'],
                    'instruction_details' => $this->request->data['Investment']['instruction_details'],
                    'expected_interest' => $new_interest_amount,
                    'interest_accrued' => $new_interest_accrued,
                    'total_amount_earned' => $new_total_amount_earned,
                    'earned_balance' => $new_earned_balance,
                    'amount_due' => $new_amount_due
                );



                $ledger_transactions[] = array('id' => $ledger_transaction, 'cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'], 'edit' => $oldAmount);

                $base_fee = $old_investment_data['Investment']['base_fees'];
//                $benchmark_fee = $old_investment_data['Investment'][''];

                switch ($management_fee_type) {
                    case 'Management Fee':
                        $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                        $base_fee = $base_fee * ($duration / 365);


                        break;
                    case 'Management & Performance Fee':
                        $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                        $base_fee = $base_fee * ($duration / 365);


                        break;
                }

                $management_fee += $base_fee;
                $accrued_basefee += $base_fee;


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
                    'cash_receipt_mode_id' => $this->request->data['Investment']['cashreceiptmode_id'],
                    'base_rate' => $base_rate,
                    'base_fees' => $management_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'accrued_basefee' => $accrued_basefee,
                    'benchmark_rate' => $benchmark_rate,
                    'investment_date' => $inv_date);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Editted Deposit Information for investment';
//move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand, 'total_principal' => $total_principal,
                    'invested_amount' => $new_cashinvested);
                $cash_array = array('id' => $investment_cash_id, 'amount' => $investment_amount, 'deposit_id' => $deposit_id, 'topup_id' => $topup_id);
                $this->Session->write('cash_array', $cash_array);
                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('ledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
                $this->Session->write('editinvesttemp', $this->request->data['Investment']);
                $message = 'Investment Successfully Processed,Click Next to Save and Print Investment Contract';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
            } else {
                $message = 'Please Select  an Investment Product';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id, $investment_id, $count));
            }
        }
    }

    function process_comp() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $ledger_transactions = array();
            $cheque_no = '';
            $total_shares = 0;
            $amount = $this->request->data['Investment']['investment_amount'];
            $page = $this->request->data['Investment']['investor_page'];
            $payment_schedule = $this->request->data['Investment']['paymentschedule_id'];
            $currency_id = $this->request->data['Investment']['currency_id'];
            $custom_rate = $this->request->data['Investment']['custom_rate'];
            $interest_amount = 0;
            $investor_id = $this->request->data['Investment']['investor_id'];
            $investmentproduct_id = $this->request->data['Investment']['investmentproduct_id'];
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            if (isset($this->request->data['fixed_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }

                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }

                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            } elseif (isset($this->request->data['equity_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            } elseif (isset($this->request->data['reset'])) {


                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
            }
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
            $basefee_duedate->add(new DateInterval('P1M'));
            $deposit_date = new DateTime($inv_date);
            $deposit_date->sub(new DateInterval('P1D'));

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

            $this->Session->write('investtemp', $this->request->data['Investment']);

            $this->Session->write('investtemp1', $this->request->data['Investment']);

            $amount_available = $this->request->data['Investment']['cash_athand'] + $this->request->data['Investment']['amount_deposited'];
            $cashinvested = $this->request->data['Investment']['total_invested'];
            $total_principal = $this->request->data['Investment']['total_principal'];

            $new_cashinvested = $cashinvested;

            if (isset($this->request->data['fixed_process'])) {

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
                if (($this->request->data['Investment']['instruction_id'] == 7) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
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
            }
            if (isset($this->request->data['equity_process'])) {
                $first_date = $pinv_date;

                $this->request->data['Investment']['investment_date'] = $pinv_date;

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
            //ask if 
            if (isset($payment_schedule) && !empty($payment_schedule)) {
                if ($payment_schedule == 1) {
                    
                } elseif ($payment_schedule == 2) {
                    
                }
            }
            $voucher_no = date('mdyhis') . rand(2, 4);
            $receipt_no = $voucher_no;
//            $receipt_no = $this->request->data['Investment']['receipt_no'];
            $deposit = $this->request->data['Investment']['amount_deposited'];
            if ($deposit > 0) {
                $ledger_transactions[] = array('cash_receipt_mode_id' =>
                    $this->request->data['Investment']['cashreceiptmode_id'],
                    'cheque_no' => $cheque_no, 'credit' => $deposit, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => 'Deposit for investment with receipt no:' . $receipt_no);

                $inv_deposit = array('user_id' => $this->request->data['Investment']['user_id'],
                    'amount' => $deposit, 'receipt_no' => $receipt_no, 'deposit_date' => $deposit_date->format('Y-m-d'));


                $this->Session->write('inv_deposit', $inv_deposit);
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
                    $total_principal = $total_principal + $investment_amount;
                    $period = $this->request->data['Investment']['investment_period'];
                    $duration = $this->request->data['Investment']['duration'];
                    $year = $duration;
                    $to_date = date('Y-m-d');
                    $to_date = new DateTime($to_date);
                    $ainv_date = new DateTime($inv_date);
                    $aduration = date_diff($ainv_date, $to_date);
                    $aduration = $aduration->format("%a");
                    switch ($period) {
                        case 'Day(s)':

                            $date->add(new DateInterval('P' . $duration . 'D'));

                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            $amount_due = $interest_amount + $investment_amount;


                            $adate = date('Y-m-d');
                            $due_date = $date->format('Y-m-d');
                            if ($due_date <= $adate) {
                                $date->sub(new DateInterval('P1D'));
                                $adate = $due_date;
                            }
                            $to_date = new DateTime($adate);
                            $ainv_date = new DateTime($inv_date);
                            $aduration = date_diff($ainv_date, $to_date);
                            $aduration = $aduration->format("%a");
//                            $aduration +=1;
                            $ainterest_amount = $interest_amount1 * ($aduration / 365);
                            $aamount_due = $ainterest_amount + $investment_amount;
//                            for ($n = 1; $n <= $duration; $n++) {
//                                $date_statemt->add(new DateInterval('P1D'));
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
                            $date->sub(new DateInterval('P1D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;
                            $YEAR2DAYS = 365 * $duration;
                            $duration = $YEAR2DAYS;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                            $amount_due = $interest_amount + $investment_amount;

                            $adate = date('Y-m-d');
                            $due_date = $date->format('Y-m-d');
                            if ($due_date <= $adate) {

                                $adate = $due_date;
                            }
                            $to_date = new DateTime($adate);
                            $ainv_date = new DateTime($inv_date);
                            $aduration = date_diff($ainv_date, $to_date);
                            $aduration = $aduration->format("%a");
                            if ($due_date <= $adate) {

                                $aduration +=1;
                            }

//                            $aYEAR2DAYS = 365 * $aduration;
                            $ainterest_amount = $interest_amount1 * ($aduration / 365);
                            $aamount_due = $ainterest_amount + $investment_amount;
//                            for ($n = 1; $n <= $duration; $n++) {
//                                $date_statemt->add(new DateInterval('P1Y'));
//                                $interest_amount2 = $interest_amount1 * (365 / 365);
//                                $total = $interest_amount2 + $principal;
//                                $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                    'investor_id' => $this->request->data['Investment']['investor_id'],
//                                    'principal' => $principal,
//                                    'interest' => $interest_amount2,
//                                    'maturity_date' => $date_statemt->format('Y-m-d'),
//                                    'total' => $total);
////                            $principal = $total;
//                            }

                            break;
                    }
                    $check = $this->Session->check('statemt_array_fixed');
                    if ($check) {
                        $this->Session->delete('statemt_array_fixed');
                    }
//                    $this->Session->write('statemt_array_fixed', $statemt_array);
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
                        'expected_interest' => $interest_amount,
                        'total_amount_earned' => $aamount_due,
                        'earned_balance' => $aamount_due,
                        'accrued_days' => $aduration,
                        'interest_accrued' => $ainterest_amount,
                        'amount_due' => $amount_due, 'due_date' => $date->format('Y-m-d')
                    );

                    $interest_accruals = array(
                        'investor_id' => $this->request->data['Investment']['investor_id'],
                        'interest_amounts' => $ainterest_amount,
                        'interest_date' => $inv_date
                    );

                    $check = $this->Session->check('interest_accrual');
                    if ($check) {
                        $this->Session->delete('interest_accrual');
                    }
                    $check = $this->Session->write('interest_accrual', $interest_accruals);


                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;

//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;

//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }


                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description, 'management_fee' => $base_fee, 'benchmark' => $benchmark_rate);

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

                        $message = 'Total equity cost cannot be more than investor\'s available cash';
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
//                    switch ($management_fee_type) {
//                        case 'Management Fee':
//                            $base_fee = ($base_rate / 100) * $totalamt;
//
////                            if ($base_fee > $new_cashathand) {
////                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
////                                $this->Session->write('bmsg', $message);
////                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
////                            }
////                            $new_cashathand = $new_cashathand - $base_fee;
//                            break;
//                        case 'Management & Performance Fee':
//                            $base_fee = ($base_rate / 100) * $totalamt;
////                            if ($base_fee > $new_cashathand) {
////                                $message = 'Manage Fee + Total equity cost cannot be more than investor\'s availalbe cash';
////                                $this->Session->write('bmsg', $message);
////                                $this->redirect(array('controller' => 'Investments', 'action' => $page, $investor_id));
////                            }
////                            $new_cashathand = $new_cashathand - $base_fee;
//
//                            break;
//                    }
                    $description = 'Equity investment for ' . $total_shares . ' shares';
                    $ledger_transactions[] = array('cash_receipt_mode_id' =>
                        $this->request->data['Investment']['cashreceiptmode_id'],
                        'cheque_no' => $cheque_no, 'debit' => $totalamt, 'user_id' => $this->request->data['Investment']['user_id'],
                        'date' => $inv_date, 'description' => $description);


                    $investment_array = array(
                        'total_amount' => $totalamt,
                        'numb_shares' => $total_shares,
                        'numb_shares_left' => $total_shares
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





//                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
//store total_invested and cash at hand in session so can save in investment when storing array in summary view
//$this->Session->write('investtemp1.cash_athand', $new_cashathand);
                //$this->Session->write('investtemp1.total_invested', $new_cashinvested);
                $generic_array = array('user_id' => $this->request->data['Investment']['user_id'],
                    'investor_id' => $this->request->data['Investment']['investor_id'],
                    'investor_type_id' => $this->request->data['Investment']['investor_type_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'currency_id' => $this->request->data['Investment']['currency_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'cash_receipt_mode_id' => $this->request->data['Investment']['cashreceiptmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'cheque_no' => $cheque_no,
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_product_id' => $this->request->data['Investment']['investmentproduct_id'],
                    'investment_date' => $inv_date,
                    'details' => $this->request->data['Investment']['notes']);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
//move to summary contract function and store in client ledger
                $client_ledger = array('investor_id' => $investor_id, 'available_cash' => $new_cashathand, 'total_principal' => $total_principal,
                    'invested_amount' => $new_cashinvested);


//                $this->Session->delete('investtemp');
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
        $this->__validateUserType();
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
        $this->__validateUserType();
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

    function clearRolloverSession($investment_id = null, $investor_id = null) {

        if (empty($investment_id) || empty($investor_id)) {
            $message = 'Sorry,try again';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'Investments'));
        } else {

            if ($this->Session->check('rollover_details')) {
                $this->Session->delete('rollover_details');
            }
            if ($this->Session->check('rollovertemp')) {
                $this->Session->delete('rollovertemp');
            }

            if ($this->Session->check('investpayments')) {

                $this->Session->delete('investpayments');
            }


            $check = $this->Session->check('ledger_data');
            if ($check) {
                $this->Session->delete('ledger_data');
            }

            $check = $this->Session->check('investtemp1');
            if ($check) {
                $this->Session->delete('investtemp1');
            }
            $check = $this->Session->check('variabless_fixed');
            if ($check) {
                $this->Session->delete('variabless_fixed');
            }
            $check = $this->Session->check('variabless_equity');
            if ($check) {
                $this->Session->delete('variabless_equity');
            }

            $check = $this->Session->check('investment_array_equity');
            if ($check) {
                $this->Session->delete('investment_array_equity');
            }
            $check = $this->Session->check('investment_array_fixed');
            if ($check) {
                $this->Session->delete('investment_array_fixed');
            }
            $check = $this->Session->check('investtemp');
            if ($check) {
                $this->Session->delete('investtemp');
            }
            $check = $this->Session->check('generic_array');
            if ($check) {
                $this->Session->delete('generic_array');
            }
            $check = $this->Session->check('ledger_transactions');
            if ($check) {
                $this->Session->delete('ledger_transactions');
            }
            $check = $this->Session->check('rledger_data');
            if ($check) {
                $this->Session->delete('rledger_data');
            }
            $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $investment_id, $investor_id));
        }
    }

    function newInvestmentCert() {
        $this->__validateUserType();


        $cash_id = null;
        $ip_id = null;
        $userid = null;
        $check = $this->Session->check('userDetails');
        if ($check) {
            $userid = $this->Session->read('userDetails.id');
        }

        if ($this->Session->check('editinvesttemp')) {
            $this->Session->delete('editinvesttemp');
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
            $investmt_result = $this->Investment->save($investment_array);
            if ($investmt_result) {

                $result = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
                if ($result) {


//                    $check = $this->Session->check('interest_accrual');
//                    if ($check) {
//                        $interest_accruals = $this->Session->read('interest_accrual');
//                        $interest_accruals['investment_id'] = $investment_id;
//                        $this->InterestAccrual->save($interest_accruals);
//                        $this->Session->delete('interest_accrual');
//                    }

                    $payment_name = '';
                    $payment_mode = $this->PaymentMode->find('first', array('conditions' => array('PaymentMode.id' => $paymentmodeid)));
                    if ($payment_mode) {
                        $payment_name = $payment_mode['PaymentMode']['payment_mode_name'];
                    }


                    if ($this->Session->check('cash_array')) {
                        $cash_array = $this->Session->read('cash_array');
                        $investmentcash_data = array('id' => $cash_array['id'], 'reinvestor_id' => 1, 'user_id' => $userid,
                            'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                            'amount' => $cash_array['amount'],
                            'available_amount' => $cash_array['amount'],
                            'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                            'investment_date' => $result['Investment']['investment_date'],
                            'status' => 'available'
                        );
                        $this->Session->delete('cash_array');

                        $cash_save = $this->InvestmentCash->save($investmentcash_data);

                        if (!empty($cash_array['deposit_id'])) {
                            $deposit_array = array('id' => $cash_array['deposit_id'], 'amount' => $cash_array['amount']);
                            $this->InvestorDeposit->save($deposit_array);
                        }
                        if (!empty($cash_array['topup_id'])) {
                            $topup_array = array('id' => $cash_array['topup_id'], 'topup_amount' => $cash_array['amount']);
                            $this->Topup->save($topup_array);
                        }
                    } else {
                        $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                            'investment_id' => $investment_id, 'currency_id' => $result['Investment']['currency_id'],
                            'amount' => $result['Investment']['investment_amount'],
                            'available_amount' => $result['Investment']['investment_amount'],
                            'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                            'investment_date' => $result['Investment']['investment_date']);

                        $this->InvestmentCash->create();
                        $cash_save = $this->InvestmentCash->save($investmentcash_data);
                    }
                    if ($cash_save) {
                        $cash_id = $cash_save['InvestmentCash']['id'];
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
                        if ($this->Session->check('investpayments')) {
                            $investment_paymentdetails = $this->Session->read('investpayments');
                            $this->InvestmentPayment->create();
                            $resultIP = $this->InvestmentPayment->save($investment_paymentdetails);
                            if ($resultIP) {
                                $ip_id = $resultIP['InvestmentPayment']['id'];
                            }
                            $this->Session->delete('investpayments');
                        }

//                        $statemt_array = $this->Session->check('statemt_array_fixed');
//                        if ($statemt_array) {
//                            $statemt_array = $this->Session->read('statemt_array_fixed');
//
//                            $this->InvestmentStatement->saveAll($statemt_array);
//                            $this->Session->delete('statemt_array_fixed');
//                        }
                    } else {
//                        $statemt_array = $this->Session->check('statemt_array_fixed');
//                        if ($statemt_array) {
//                            $statemt_array = $this->Session->read('statemt_array_fixed');
//
//
//                            foreach ($statemt_array as $key => $val) {
//                                $val['investment_id'] = $investment_id;
//
//                                $this->InvestmentStatement->create();
//                                $this->InvestmentStatement->save($val);
//                            }
//                            $this->Session->delete('statemt_array_fixed');
//                        }

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
                $this->Session->delete('investmt_equities');
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
                $cash_save = $this->InvestmentCash->save($investmentcash_data);
                if ($cash_save) {
                    $cash_id = $cash_save['InvestmentCash']['id'];
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
                    if ($this->Session->check('investpayments')) {
                        $investment_paymentdetails = $this->Session->read('investpayments');
                        $this->InvestmentPayment->create();
                        $resultIP = $this->InvestmentPayment->save($investment_paymentdetails);
                        if ($resultIP) {
                            $ip_id = $resultIP['InvestmentPayment']['id'];
                        }
                        $this->Session->delete('investpayments');
                    }
//                    $statemt_array = $this->Session->check('statemt_array');
//                    if ($statemt_array) {
//                        $statemt_array = $this->Session->read('statemt_array');
//
//                        $this->InvestmentStatement->saveAll($statemt_array);
//                        $this->Session->delete('statemt_array');
//                    }
                } else {
//                    $statemt_array = $this->Session->check('statemt_array');
//                    if ($statemt_array) {
//                        $statemt_array = $this->Session->read('statemt_array');
//
//
//                        foreach ($statemt_array as $key => $val) {
//                            $val['investment_id'] = $investment_id;
//
//                            $this->InvestmentStatement->create();
//                            $this->InvestmentStatement->save($val);
//                        }
//                        $this->Session->delete('statemt_array');
//                    }

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

        $lt_id = null;

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
//                        $val['voucher_no'] = $investment_number;
                        $val['investment_id'] = $investment_id;
                        $this->LedgerTransaction->create();
                        $lt_result = $this->LedgerTransaction->save($val);
                        $lt_id = $lt_result['LedgerTransaction']['id'];
                        if (!empty($ip_id)) {
                            $investpaymt_array = array('id' => $ip_id, 'ledger_transaction_id' => $lt_id);
                            $this->InvestmentPayment->save($investpaymt_array);
                        }
                        if (isset($val['edit'])) {
                            $lt_result = $this->LedgerTransaction->find('first', ['conditions' =>
                                ['LedgerTransaction.debit' => $val['edit'], 'client_ledger_id' => $cledger_id], 'order' => ['LedgerTransaction.id' => 'desc'],
                                'recursive' => -1]);
                            $created = date('Y-m-d H:i:s');
                            $today = date('Y-m-d H:i:s');
                            if ($lt_result) {
                                $lt_id = $lt_result['LedgerTransaction']['id'];
                                $this->LedgerTransaction->delete($lt_id, false);
                                $created = $lt_result['LedgerTransaction']['created'];
                            }
                            $this->InterestAccrual->deleteAll(array('investment_id' => $investment_id), false);
                            $created = new DateTime($created);
                            $created = $created->add(new DateInterval('PT30M'));
                            $created = $created->format('Y-m-d H:i:s');
                            if (strtotime($today) > strtotime($created)) {
                                $result = $this->ReinvestorCashaccount->find('first', array('recursive' => -1, 'conditions' =>
                                    array('ReinvestorCashaccount.reinvestor_id' => 1)));
                                if ($result) {
                                    $id = $result['ReinvestorCashaccount']['id'];
                                    $old_balance = $result['ReinvestorCashaccount']['fixed_inv_balance'];
                                    $new_balance = $old_balance - $val['edit'];
                                    $grand_total = $result['ReinvestorCashaccount']['total_balance'] - $val['edit'];
                                    $fixed_data = array('id' => $id, 'fixed_inv_balance' => $new_balance, 'total_balance' => $grand_total);
                                    $this->ReinvestorCashaccount->save($fixed_data);
                                }
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
                if ($this->Session->check('rledger_data.rollover')) {
                    $old_rollover = $cledger['ClientLedger']['total_rollover'];
                    $rollover = $this->Session->read('rledger_data.rollover');
                    $new_rollover = $rollover + $old_rollover;
                    $ledger_data['total_rollover'] = $new_rollover;
                }
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
//                        $val['voucher_no'] = $investment_number;
                        $val['investment_id'] = $investment_id;
                        $this->LedgerTransaction->create();
                        $lt_result = $this->LedgerTransaction->save($val);
                        $lt_id = $lt_result['LedgerTransaction']['id'];
                        if (!empty($ip_id)) {
                            $investpaymt_array = array('id' => $ip_id, 'ledger_transaction_id' => $lt_id);
                            $this->InvestmentPayment->save($investpaymt_array);
                        }
                        if (isset($val['edit'])) {
                            $lt_result = $this->LedgerTransaction->find('first', ['conditions' =>
                                ['LedgerTransaction.debit' => $val['edit'], 'client_ledger_id' => $cledger_id], 'order' => ['LedgerTransaction.id' => 'desc'],
                                'recursive' => -1]);
                            $created = date('Y-m-d H:i:s');
                            $today = date('Y-m-d H:i:s');
                            if ($lt_result) {
                                $lt_id = $lt_result['LedgerTransaction']['id'];
                                $this->LedgerTransaction->delete($lt_id, false);
                                $created = $lt_result['LedgerTransaction']['created'];
                            }

                            $created = new DateTime($created);
                            $created = $created->add(new DateInterval('PT30M'));
                            $created = $created->format('Y-m-d H:i:s');
                            if (strtotime($today) > strtotime($created)) {
                                $result = $this->ReinvestorCashaccount->find('first', array('recursive' => -1, 'conditions' =>
                                    array('ReinvestorCashaccount.reinvestor_id' => 1)));
                                if ($result) {
                                    $id = $result['ReinvestorCashaccount']['id'];
                                    $old_balance = $result['ReinvestorCashaccount']['fixed_inv_balance'];
                                    $new_balance = $old_balance - $val['edit'];
                                    $grand_total = $result['ReinvestorCashaccount']['total_balance'] - $val['edit'];
                                    $fixed_data = array('id' => $id, 'fixed_inv_balance' => $new_balance, 'total_balance' => $grand_total);
                                    $this->ReinvestorCashaccount->save($fixed_data);
                                }
                            }
                        }
                    }
                }
            }
            $this->Session->delete('client_ledger');
        }
        if ($this->Session->check('inv_deposit')) {
            $inv_deposit = $this->Session->read('inv_deposit');
            $inv_deposit['investment_id'] = $investment_id;
            $inv_deposit['ledger_transaction_id'] = $lt_id;
            $receipt = $inv_deposit['receipt_no'];
            $this->InvestorDeposit->create();
            $this->set('deposit_no', $receipt);
            $dep_result = $this->InvestorDeposit->save($inv_deposit);
            if ($dep_result) {
                $dep_id = $dep_result['InvestorDeposit']['id'];
                $invcash_array = array('id' => $cash_id, 'investor_deposit_id' => $dep_id);
                $this->InvestmentCash->save($invcash_array);
            }
            $this->Session->delete('inv_deposit');
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
        if ($this->Session->check('rollovertemp')) {
            $this->Session->delete('rollovertemp');
        }
        if ($this->Session->check('editinvesttemp')) {
            $this->Session->delete('editinvesttemp');
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
        $this->__validateUserType();

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
        $this->__validateUserType();

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
        $this->__validateUserType();

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
        $this->__validateUserType();

        $this->paginate = array(
            'conditions' => array(
                'status' => array('Termination_Requested'), 'Investment.investment_product_id' => array(1, 3)),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function approveTerminations2($investor_id = null, $investor_name = null, $investment_id = null) {
        $this->__validateUserType();
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
                $instructions = $this->request->data['ApproveInvestments']['instructions'];
                $userid = null;
                $penalty = 5;
                $check = $this->Session->check('userDetails');
                if ($check) {
                    $userid = $this->Session->read('userDetails.id');
                }
//                $check = $this->Session->check('penalty');
//                if ($check) {
//                    $penalty = $this->Session->read('penalty');
//                }
                $data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
                switch ($approval_status) {
                    case "0":
                        if ($data) {
                            $update_array = array('id' => $investment_id, 'status' =>
                                $data['Investment']['old_status']);
                            $this->Investment->save($update_array);
                            $this->Session->delete('public_termination_req');
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_Requested"))));

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
                            if ($data['Investment']['due_date'] <= date('Y-m-d')) {
                                $custom_rate = $data['Investment']['custom_rate'];
                            } else {
                                $custom_rate = $data['Investment']['custom_rate'] - $penalty;
                            }
                            if (!empty($data['Investment']['rollover_amount']) && $data['Investment']['rollover_amount'] > 0) {
                                $investment_amount = $data['Investment']['rollover_amount'];
                            } else {
                                $investment_amount = $data['Investment']['investment_amount'];
                            }

                            switch ($period) {
                                case 'Day(s)':

                                    $date = new DateTime($first_date);
                                    $date->add(new DateInterval('P' . $duration . 'D'));
//                                    $date->sub(new DateInterval('P1D'));
                                    $date_statemt = new DateTime($first_date);
                                    $principal = $investment_amount;
//                                    $statemt_array = array();
                                    $rate = $custom_rate;

                                    $interest_amount1 = ($rate / 100) * $investment_amount;
                                    $interest_amount = $interest_amount1 * ($duration / 365);
                                    $amount_due = $interest_amount + $investment_amount;
//                                    for ($n = 1; $n <= $duration; $n++) {
//                                        $date_statemt->add(new DateInterval('P1D'));
//                                        $interest_amount2 = $interest_amount1 * (1 / 365);
//                                        $total = $interest_amount2 + $principal;
//                                        $statemt_array[] = array('user_id' => $userid,
//                                            'investor_id' => $this->request->data['Investment']['investor_id'],
//                                            'principal' => $principal,
//                                            'interest' => $interest_amount2,
//                                            'maturity_date' => $date_statemt->format('Y-m-d'),
//                                            'total' => $total);
////                                $principal = $total;
//                                    }

                                    break;
                                case 'Year(s)':

                                    //$finv_date = $inv_date;
                                    $date = new DateTime($first_date);
                                    $date->add(new DateInterval('P' . $duration . 'D'));
//                                    $date->sub(new DateInterval('P1D'));
                                    $date_statemt = new DateTime($first_date);
                                    $principal = $investment_amount;
//                                    $statemt_array = array();
                                    $rate = $custom_rate;

                                    //$YEAR2DAYS = 365 * $duration;
                                    $interest_amount1 = ($rate / 100) * $investment_amount;
                                    $interest_amount = $interest_amount1 * ($duration / 365);
                                    $amount_due = $interest_amount + $investment_amount;
//                                    for ($n = 1; $n <= $duration; $n++) {
//                                        $date_statemt->add(new DateInterval('P1D'));
//                                        $interest_amount2 = $interest_amount1 * (365 / 365);
//                                        $total = $interest_amount2 + $principal;
//                                        $statemt_array[] = array('user_id' => $userid,
//                                            'investor_id' => $this->request->data['Investment']['investor_id'],
//                                            'principal' => $principal,
//                                            'interest' => $interest_amount2,
//                                            'maturity_date' => $date_statemt->format('Y-m-d'),
//                                            'total' => $total);
////                            $principal = $total;
//                                    }

                                    break;
                            }

                            $check_account = $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' =>
                                ['ReinvestorCashaccount.reinvestor_id' => 1]]);
                            if ($check_account) {
                                $rebalance = $check_account['ReinvestorCashaccount']['total_balance'];
                                $investor_name = "";
                                if (!empty($ledger_data['Investor']['in_trust_for'])) {
                                    $investor_name = $ledger_data['Investor']['in_trust_for'];
                                } elseif (!empty($ledger_data['Investor']['fullname'])) {
                                    $investor_name = $ledger_data['Investor']['fullname'];
                                } elseif (!empty($ledger_data['Investor']['comp_name'])) {
                                    $investor_name = $ledger_data['Investor']['comp_name'];
                                }
                            }
                            $accrued_basefee = $data['Investment']['accrued_basefee'];
                            
                            $update_array = array('id' => $investment_id, 'earned_balance' => round($amount_due,2), 'amount_due' => round($amount_due,2),'due_date' => date('Y-m-d'),
                                'interest_earned' => round($interest_amount,2),'interest_accrued' => round($interest_amount,2),'total_amount_earned' => round($amount_due,2),
                                'status' => "Termination_Approved", 'accrued_days' => $duration, 'instruction_details' => $instructions);
                            $ltid = null;
                            if ($ledger_data) {
                                $cledger_id = $ledger_data['ClientLedger']['id'];
//                            if($accrued_basefee > 0){
//                                $description = 'Debit on ' . $data['Investment']['investment_no'] . ' for settlement of accrued management fee';
//                                $ledger_transactions = array('client_ledger_id' => $cledger_id, 'debit' => $accrued_basefee, 'user_id' => $userid,'investment_id' => $data['Investment']['id'],
//                                    'date' => date('Y-m-d'), 'voucher_no' => $data['Investment']['investment_no']
//                                    , 'description' => $description);
//                                $this->LedgerTransaction->create();
//                                $ltresult = $this->LedgerTransaction->save($ledger_transactions);
//                            }
                                $cash_athand = $ledger_data['ClientLedger']['available_cash'];
                                $new_cashathand = $cash_athand + $amount_due;
//                                $new_cashathand = $new_cashathand - 
                                        
                                $total_invested = $ledger_data['ClientLedger']['invested_amount'] - $investment_amount;

                                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_cashathand,
                                    'invested_amount' => $total_invested);
                                $ledger_data = $this->ClientLedger->save($client_ledger);

//$amount_due > $rebalance;
                                //Ledger transaction entry
                                $description = 'Discounting of ' . $data['Investment']['investment_no'];
                                $ledger_transactions = array('client_ledger_id' => $cledger_id, 'credit' => $amount_due, 'user_id' => $userid, 'investment_id' => $data['Investment']['id'],
                                    'date' => date('Y-m-d'), 'voucher_no' => $data['Investment']['investment_no'], 'benchmark' => $custom_rate,'management_fee' => $accrued_basefee
                                    , 'description' => $description);
                                $this->LedgerTransaction->create();
                                $ltresult = $this->LedgerTransaction->save($ledger_transactions);


                                if ($ltresult) {
                                    $ltid = $ltresult['LedgerTransaction']['id'];
                                }
                            }
                            $this->Investment->save($update_array);
                            //insert into investmentpayments for rollover
                            $investment_paymentdetails = array('investment_id' => $investment_id, 'rate' => $custom_rate,
                                'investor_id' => $investor_id, 'amount' => $amount_due, 'interest' => $interest_amount, 'ledger_transaction_id' => $ltid,
                                'user_id' => $userid, 'payment_date' => date('Y-m-d'), 'penalty' => $penalty, 'event_type' => 'Termination','management_fee' => $accrued_basefee,
                                'event_date' => date('Y-m-d'));

                            $this->InvestmentPayment->create();
                            $this->InvestmentPayment->save($investment_paymentdetails);


                            $this->Session->delete('public_termination_req');
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_Requested"))));

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
                            $this->Session->write('public_termination_req', $this->Investment->find('count', array('conditions' => array('Investment.status LIKE' => "Termination_Requested"))));

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
        $this->__validateUserType();

        $this->paginate = array(
            'conditions' => array(
                'status' => array('Payment_Requested', 'Disposal_Requested')),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function approvePayments2($investor_id = null, $investor_name = null, $investment_id = null, $instructions = null) {
        $this->__validateUserType();
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));
            $data = $this->ClientLedger->find('first', ['conditions' => ['ClientLedger.investor_id' => $investor_id]]);


            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);
            $this->set('investment_id', $investment_id);
            $this->set('instructions', $instructions);

            if ($data) {
//               $transactions = $this->LedgerTransaction->find('all',['conditions' => [
//                   'LedgerTransaction.client_ledger_id' =>$data['ClientLedger']['id']]]);
                $this->paginate = array(
                    'conditions' => array('LedgerTransaction.client_ledger_id' => $data['ClientLedger']['id']),
                    'order' => array('LedgerTransaction.id' => 'desc'), 'limit' => 100);
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
        $this->__validateUserType();
        $this->paginate = array(
            'conditions' => array(
                'Investment.status' => array('Matured', 'Payment_Requested'), 'Investment.investment_product_id' => array(1, 3),
                'Investment.investment_amount >' => 0),
            'limit' => 30,
            'order' => array('Investment.id' => 'asc'));
        $data = $this->paginate('Investment');
        $this->set('data', $data);
    }

    function monthlyMaturityList() {
        $this->__validateUserType();
        $data = array();
        $frend_date = '';
        $frstart_date = '';
        if ($this->request->is('post')) {

            $sday = '01';
            $smonth = $this->request->data['Investment']['to_date']['month'];
            $syear = $this->request->data['Investment']['to_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);



//            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($start_date);
            $date->add(new DateInterval('P1M'));
            $date->sub(new DateInterval('P1D'));
            $end_date = $date->format('Y-m-d');
            $enewdate = strtotime($end_date);
//            pr($end_date);exit;
            $frend_date = date('d F, Y', $enewdate);




            $this->paginate = array(
                'conditions' => array(
                    'Investment.due_date BETWEEN ? AND ?' => array($start_date, $end_date),
                    'Investment.investment_amount >' => 0,
                    'Investment.status' => array('Invested', 'Rolled_over'),
                    'Investment.investment_product_id' => array(1, 3)),
                'limit' => 30,
                'order' => array('Investment.id' => 'asc'));
            $data = $this->paginate('Investment');
        }
//         else{
//           
//        $first_date = date('Y-m-d');
//        $date = new DateTime($first_date);
//        $date->add(new DateInterval('P1M'));
//        $date_end = $date->format('Y-m-d');
//        $this->paginate = array(
//            'conditions' => array(
//                'Investment.status' => array('Invested', 'Rolled_over'),
//                'Investment.investment_product_id' => array(1, 3),
//                'AND' => array(array('Investment.due_date >=' => $first_date), array('Investment.due_date <=' => $date_end))),
//            'limit' => 30,
//            'order' => array('Investment.id' => 'asc'));
//        $data = $this->paginate('Investment');  
//         }
        $this->set(compact('data', 'frend_date', 'frstart_date'));
    }

    function processPayments() {
        $this->__validateUserType();
        $data_array = array();
        $this->paginate = array(
            'conditions' => array(
                'status' => array('Payment_Approved', 'Termination_Approved'),
                'Investment.investment_product_id' => array(1, 3)),
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
                    $result['Investment']['id'] = $value['Investment']['id'];
                    $result['Investment']['earned_balance'] = $value['Investment']['earned_balance'];
                    $data_array[] = $result;
                }
            }
        }
        $this->set('data', $data_array);
    }

    function processPayments2() {
        $this->__validateUserType();
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $approval_status = $this->request->data['ApproveInvestments']['approvals'];
                $investment_id = $this->request->data['Investment']['investment_id'];
                $investor_id = $this->request->data['Investment']['investor_id'];
                $instructions = $this->request->data['ApproveInvestments']['instructions'];

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
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status' => array("Payment_Requested", 'Disposal_Requested')))));

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
                            if ($data['Investment']['status'] == 'Disposal_Requested') {
                                $update_array = array('id' => $investment_id,
                                    'status' => "Disposal_Approved", 'instruction_details' => $instructions);
                            } else {
                                $update_array = array('id' => $investment_id, 'earned_balance' => 0.00,
                                    'status' => "Payment_Approved", 'instruction_details' => $instructions);
                            }
                            $result = $this->Investment->save($update_array);

                            $this->Session->delete('public_payment_req');
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' =>
                                        array('Investment.status' => array("Payment_Requested", 'Disposal_Requested')))));

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
                            $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' =>
                                        array('Investment.status' => array("Payment_Requested", 'Disposal_Requested')))));

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
//        $this->__validateUserType();

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('recursive' => -1, 'conditions' => array('Investment.id' => $investment_id),
                'order' => array('Investment.id')));
            if ($data) {

                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Payment_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status' => array("Payment_Requested", 'Disposal_Requested')))));

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

    function requestPayment4manageEquityinvestments($investment_id = null, $investor_id = null, $investor_name = null) {

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('recursive' => -1, 'conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Payment_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                if ($result) {
                    $message = 'Payment Request Successfully Sent';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
                }
            } else {

                $message = 'Sorry, Investment Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
        }
    }

    function requestPayment4managefixedinvestments($investment_id = null, $investor_id = null, $investor_name = null) {

        if (!is_null($investment_id)) {
            $data = $this->Investment->find('first', array('recursive' => -1, 'conditions' => array('Investment.id' => $investment_id), 'order' => array('Investment.id')));
            if ($data) {
                $new_investmentdetails = array('id' => $investment_id, 'status' => 'Payment_Requested', 'old_status' => $data['Investment']['status']);

                $result = $this->Investment->save($new_investmentdetails);
                $this->Session->write('public_payment_req', $this->Investment->find('count', array('conditions' => array('Investment.status' => array("Payment_Requested", 'Disposal_Requested')))));

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
        $this->__validateUserType();

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
            $investment_id = $_POST['hid_investid'];
            $payment_instr = $this->request->data['InvestmentPayment']['instruction_id'];
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
            $this->Session->write('payment_date', $inv_date);

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

            if($payment_instr == 2 ||$payment_instr == 3){
            if ($this->request->data['InvestmentPayment']['principal_amount'] == "" || $this->request->data['InvestmentPayment']['principal_amount'] == null || $this->request->data['InvestmentPayment']['principal_amount'] == 0) {
                $message = 'Principal Amount Not Entered.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
            }
            }
              if($payment_instr == 1 ||$payment_instr == 3){
             if ($this->request->data['InvestmentPayment']['interest_amount'] == "" || $this->request->data['InvestmentPayment']['interest_amount'] == null 
                     || $this->request->data['InvestmentPayment']['interest_amount'] == 0) {
                $message = 'Interest Amount Not Entered.';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid));
            }

              }
            if (isset($this->request->data['InvestmentPayment']['cheque_nos'])) {
                if ($this->request->data['InvestmentPayment']['cheque_nos'] != "" || $this->request->data['InvestmentPayment']['cheque_nos'] != null) {
                    $cheque_numbers = $this->request->data['InvestmentPayment']['cheque_nos'];
                }
            }




            $payment_date = $inv_date;
            $interest_amount = 0;
            $principal_amount = 0;
            if (isset($this->request->data['InvestmentPayment']['interest_amount'])) {
                $interest_amount = $this->request->data['InvestmentPayment']['interest_amount'];
            }
            if (isset($this->request->data['InvestmentPayment']['principal_amount'])) {
                $principal_amount = $this->request->data['InvestmentPayment']['principal_amount'];
            }
            $payment = $principal_amount + $interest_amount;
            $sms_amount = $principal_amount + $interest_amount;
            $payment_mode = $this->request->data['InvestmentPayment']['paymentmode_id'];
            $instructions_id = $this->request->data['InvestmentPayment']['instruction_id'];
            $balance = 0;
            $old_balance = 0;


            $investment_data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id], 'recursive' => -1]);
            if ($investment_data) {

                $earnedbalance = $investment_data['Investment']['earned_balance'];
                $amount_due = $investment_data['Investment']['amount_due'];

                $status = $investment_data['Investment']['status'];

                $check_account = $this->ReinvestorCashaccount->find('first', ['recursive' => -1, 'conditions' =>
                    ['ReinvestorCashaccount.reinvestor_id' => 1]]);
                if ($check_account) {
                    $rebalance = $check_account['ReinvestorCashaccount']['total_balance'];
                    if ($sms_amount > $rebalance) {
                        $message = 'Payment failed. Insufficient funds to complete process. Please consider terminating an outbound investment first';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid, $investment_id));
                    }
                }


                $status = 'Paid';

                $investment_array = array('id' => $investment_id, 'status' => $status, 'amount_due' => 0.00);
            }
            $date = date('Y-m-d H:i:s');
            //use id to retrieve Investment info
            $ledger_details = $this->ClientLedger->find('first', array('conditions' => array('ClientLedger.id' => $ledgerid)));
            if ($ledger_details) {
                $old_balance = $ledger_details['ClientLedger']['available_cash'];
                $investor = $ledger_details['ClientLedger']['investor_id'];
                $investor_name = $ledger_details['Investor']['fullname'];
                $new_balance = $old_balance - $payment;
                if ($ledger_details['ClientLedger']['total_interest'] < $interest_amount) {
                    $message = 'Payment failed. Interest payment cannot be more than the client\'s total interest';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid, $investment_id));
                }

                if ($ledger_details['ClientLedger']['total_principal'] < $principal_amount) {
                    $message = 'Payment failed. Principal payment cannot be more than the client\'s total principal';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid, $investment_id));
                }
                $new_ledger_interest = $ledger_details['ClientLedger']['total_interest'] - $interest_amount;
                $new_ledger_principal = $ledger_details['ClientLedger']['total_principal'] - $principal_amount;

                if ($sms_amount > $old_balance) {
                    $message = 'Payment amount cannot be more than client\'s ledger balance';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'payInvestor', $investorid, $investment_id));
                }

//                $new_investmentdetails = array('id' => $investment_id, 'earned_balance' => $earned_balance
//                    , 'balance' => $balance, $amount_due => $balance, 'amount_paidout' => $total_paid,
//                    'status' => $payment_status, 'lastpaidout_date' => $payment_date);
                //Update Ledger data
                $cledger_id = $ledger_details['ClientLedger']['id'];
                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_balance, 'total_principal' => $principal_amount, 'total_interest' => $interest_amount);
                $this->ClientLedger->save($client_ledger);
                $voucher_no = date('mdyhis') . rand(2, 4);
                $ltid = null;
                $result = $this->ClientLedger->save($client_ledger);
                if ($result) {
                    //enter new ledger transaction
                    $ledger_transactions = array('client_ledger_id' => $cledger_id, 'payment_mode_id' => $payment_mode,
                        'debit' => $payment, 'user_id' => $userid, 'voucher_no' => $voucher_no,
                        'date' => $payment_date, 'cheque_no' => $cheque_numbers,
                        'description' => 'Payment of Investment Proceeds');
                    $this->LedgerTransaction->create();
                    $resultLtran = $this->LedgerTransaction->save($ledger_transactions);
                    if ($resultLtran) {
                        $ltid = $resultLtran['LedgerTransaction']['id'];
                    }
//                    'investment_id' => $investment_id,
                    $investment_paymentdetails = array('user_id' => $userid, 'investment_id' => $investment_id,
                        'investor_id' => $investor, 'amount' => $payment, 'instruction_id' => $instructions_id,
                        'payment_mode_id' => $this->request->data['InvestmentPayment']['paymentmode_id'], 'ledger_transaction_id' => $ltid,
                        'cheque_nos' => $cheque_numbers, 'payment_date' => $payment_date, 'event_type' => 'Payment', 'interest' => $interest_amount,
                        'receipt_no' => $voucher_no,
                        'event_date' => $payment_date);

                    $result2 = $this->InvestmentPayment->save($investment_paymentdetails);
                    if (!empty($investment_array)) {
                        $result_ia = $this->Investment->save($investment_array);
                    }
                    if ($ledger_transactions) {

                        $check = $this->Session->check('ipayment_receipt');
                        if ($check) {
                            $this->Session->delete('ipayment_receipt');
                        }
                        $check = $this->Session->check('ireceipt_items');
                        if ($check) {
                            $this->Session->delete('ireceipt_items');
                        }
                        $check = $this->Session->check('payinvesttemp');
                        if ($check) {
                            $this->Session->delete('payinvesttemp');
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
            } else {

                $message = 'Investment Payout Unsuccessful';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor, $investor_name));
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
        $this->__validateUserType();

        $this->set('cashreceiptmodes', $this->CashReceiptMode->find('list'));
        if (!is_null($investor_id) && !is_null($investor_name)) {
//            $data = $this->Investment->find('all', array('conditions' => array('Investment.investor_id' => $investor_id, 'Investment.investment_product_id' => array(1, 3)), 'order' => array('Investment.id')));

            $this->paginate = array(
                'conditions' => array('Investment.investor_id' => $investor_id,
                    'Investment.investment_product_id' => array(1, 3),
                ),
                'limit' => 30,
                'order' => array('Investment.id' => 'asc'));
            $data = $this->paginate('Investment');

            $this->set('investor_id', $investor_id);
            $this->set('investor_name', $investor_name);

            if ($this->Session->check('editinvesttemp')) {
                $this->Session->delete('editinvesttemp');
            }


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
                    $receipt_no = date('mdyhis') . rand(2, 4);
                    $inv_no = $investment_data['Investment']['investment_no'];
                    $ledger = $this->ClientLedger->find('first', ['conditions' =>
                        ['ClientLedger.investor_id' => $investor_id]]);
                    $ledger_transactions = array();
                    if ($ledger) {


                        switch ($source) {
                            case 1:
                            case 3:
                            case 5:
                                $payment_name = 'Cash';
                                $amount = $this->request->data['Topup']['topup_amount'];
                                $new_investedamount = $ledger['ClientLedger']['invested_amount'] + $amount;

                                $client_ledger = array('id' => $ledger['ClientLedger']['id'], 'invested_amount' => $new_investedamount);
                                $description = '’Deposit for Topup on ' . $inv_no;

                                $ledger_transactions[] = array('client_ledger_id' => $ledger['ClientLedger']['id']
                                    , 'cash_receipt_mode_id' => $source, 'investment_id' => $investment_id,
                                    'cheque_no' => $cheque_no, 'credit' => $amount, 'user_id' => $userid,
                                    'date' => $inv_date, 'description' => $description, 'voucher_no' => $receipt_no);

                                $description2 = 'Fixed Income Topup on ' . $inv_no;
                                $ledger_transactions[] = array('client_ledger_id' => $ledger['ClientLedger']['id']
                                    , 'cash_receipt_mode_id' => $source, 'benchmark' => $investment_data['Investment']['custom_rate'],
                                    'cheque_no' => $cheque_no, 'debit' => $amount, 'user_id' => $userid,
                                    'date' => $inv_date, 'description' => $description2);

                                $inv_deposit = array('user_id' => $userid,
                                    'amount' => $amount, 'receipt_no' => $receipt_no, 'deposit_date' => $inv_date);

                                break;
                            case 2:
                                $payment_name = 'Cheque';
                                $amount = $this->request->data['Topup']['topup_amount'];
                                $new_investedamount = $ledger['ClientLedger']['invested_amount'] + $amount;
                                $cheque_no = $this->request->data['Topup']['cheque_no'];

                                $client_ledger = array('id' => $ledger['ClientLedger']['id'], 'invested_amount' => $new_investedamount);
                                $description = 'Deposit for Topup on' . $inv_no;

                                $ledger_transactions[] = array('client_ledger_id' => $ledger['ClientLedger']['id']
                                    , 'cash_receipt_mode_id' => $source,
                                    'cheque_no' => $cheque_no, 'credit' => $amount,
                                    'user_id' => $userid, 'investment_id' => $investment_id,
                                    'date' => $inv_date, 'description' => $description, 'voucher_no' => $receipt_no);

                                $description2 = 'Fixed Income Topup on  ' . $inv_no;
                                $ledger_transactions[] = array('client_ledger_id' => $ledger['ClientLedger']['id']
                                    , 'cash_receipt_mode_id' => $source, 'benchmark' => $investment_data['Investment']['custom_rate'],
                                    'cheque_no' => $cheque_no, 'debit' => $amount, 'user_id' => $userid,
                                    'date' => $inv_date, 'description' => $description2);

                                $inv_deposit = array('user_id' => $userid,
                                    'amount' => $amount, 'receipt_no' => $receipt_no, 'deposit_date' => $inv_date);




                                break;
                            case 4:
                                $payment_name = 'Client Ledger Balance';
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

                                $description = 'Fixed Income Topup on ' . $inv_no;

                                $ledger_transactions[] = array('client_ledger_id' => $ledger['ClientLedger']['id']
                                    , 'cash_receipt_mode_id' => $source,
                                    'debit' => $amount, 'benchmark' => $investment_data['Investment']['custom_rate'],
                                    'user_id' => $userid, 'investment_id' => $investment_id,
                                    'date' => $inv_date, 'description' => $description);
                                break;
                        }
                    } else {
                        $message = 'Investor ledger retrieval error. Please try again.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }
                    $status = $investment_data['Investment']['status'];
                    $custom_rate = $investment_data['Investment']['custom_rate'];
                    $period = $investment_data['Investment']['investment_period'];
                    $end_date = $investment_data['Investment']['due_date'];
                    if ($status == 'Rolled_over') {
                        $initial_date = $investment_data['Investment']['rollover_date'];
                    } else {
                        $initial_date = $investment_data['Investment']['investment_date'];
                    }
                    $first_date = $inv_date;
                    $inv_date = new DateTime($first_date);
                    if ($first_date < $initial_date) {
                        $message = 'Topup date cannot be less than Investment date. Please check and try again';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }
                    if ($first_date > $end_date) {
                        $message = 'Topup date cannot be more than Investment due date. Please check and try again';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }
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
                            $curr_date = date('Y-m-d');
                            if ($curr_date > $end_date) {
                                $duration +=1;
                            }
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
                                    'maturity_date' => $end_date,
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
                            $curr_date = date('Y-m-d');
                            if ($curr_date > $end_date) {
                                $duration +=1;
                            }

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
                                    'maturity_date' => $end_date,
                                    'total' => $total);
//                            $principal = $total;
                            }

                            break;
                    }
                    $management_fee_type = $investment_data['Investment']['management_fee_type'];
                    $base_rate = $investment_data['Investment']['base_rate'];
                    $management_fee = $investment_data['Investment']['base_fees'];
                    $accrued_basefee = $investment_data['Investment']['accrued_basefee'];
                    $base_fee = 0;
                    $benchmark_fee = 0;
                    switch ($management_fee_type) {
                        case 'Management Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;
                            break;
                        case 'Management & Performance Fee':
                            $base_fee = ($base_rate / 100) * $investment_amount;
//                            $YEAR2DAYS = 365 * $duration;
                            $base_fee = $base_fee * ($duration / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;

                            break;
                    }
                    $management_fee += $base_fee;
                    $accrued_basefee += $base_fee;
                    if ($status == 'Rolled_over') {
                        $investmentamt = $investment_data['Investment']['rollover_amount'];
                        $column = 'rollover_amount';
                    } else {
                        $investmentamt = $investment_data['Investment']['investment_amount'];
                        $column = 'investment_amount';
                    }
                    $new_investmentamt = $investmentamt + $amount;
                    $newinterest_amt = $investment_data['Investment']['expected_interest'] + $interest_amount;
                    $newtotal_amount_earned = $investment_data['Investment']['total_amount_earned'] + $amount;
                    $new_earnedbalance = $investment_data['Investment']['earned_balance'] + $amount;
                    $newamount_due = $investment_data['Investment']['amount_due'] + $amount_due;
                    $investment_array = array(
                        'base_fees' => $management_fee,
                        'accrued_basefee' => $accrued_basefee,
                        'id' => $investment_data['Investment']['id'],
                        $column => $new_investmentamt,
                        'expected_interest' => $newinterest_amt,
                        'total_amount_earned' => $newtotal_amount_earned,
                        'earned_balance' => $new_earnedbalance,
                        'amount_due' => $newamount_due,
                    );

                    $topup_data = array('old_investmentamt' => $investmentamt,
                        'oldinterest_earned' => $investment_data['Investment']['interest_earned'],
                        'oldtotal_amount_earned' => $investment_data['Investment']['total_amount_earned'],
                        'oldearned_balance' => $investment_data['Investment']['earned_balance'],
                        'oldamount_due' => $investment_data['Investment']['amount_due'],
                        'topup_amount' => $amount,
                        'cash_receipt_mode_id' => $source,
                        'tenure' => $duration,
                        'period' => 'Day(s)',
                        'topup_interest' => $interest_amount,
                        'investment_id' => $investment_data['Investment']['id'],
                        'user_id' => $userid,
                        'investment_date' => $first_date);

                    $investment_id = $investment_data['Investment']['id'];
                    $result = $this->Investment->save($investment_array);
                    if ($result) {
                        $lt_id = null;
                        $investmentcash_data = array('reinvestor_id' => 1, 'user_id' => $userid,
                            'investment_id' => $investment_data['Investment']['id'], 'currency_id' => $investment_data['Investment']['currency_id'],
                            'amount' => $amount,
                            'available_amount' => $amount,
                            'investment_type' => 'fixed', 'payment_mode' => $payment_name,
                            'investment_date' => $first_date);
                        $this->InvestmentCash->create();
                        $cash_save = $this->InvestmentCash->save($investmentcash_data);
                        if ($cash_save) {
                            $cash_id = $cash_save['InvestmentCash']['id'];
                        }
                        $this->Topup->create();
                        $topup_result = $this->Topup->save($topup_data);
                        if (isset($client_ledger)) {
                            $this->ClientLedger->save($client_ledger);
                            if ($ledger_transactions) {
                                foreach ($ledger_transactions as $key => $val) {
                                    if (!empty($val['debit'])) {
                                        $val['management_fee'] = $base_fee;
                                    }
                                    $this->LedgerTransaction->create();
                                    $lt_result = $this->LedgerTransaction->save($val);
                                    $lt_id = $lt_result['LedgerTransaction']['id'];
                                }
                            }
                        }
                        if ($topup_result) {
                            if (isset($inv_deposit)) {
                                $inv_deposit['investment_id'] = $investment_id;
                                $inv_deposit['ledger_transaction_id'] = $lt_id;
                                $inv_deposit['topup_id'] = $topup_result['Topup']['id'];
                                $this->InvestorDeposit->create();
                                $dep_result = $this->InvestorDeposit->save($inv_deposit);
                                if ($dep_result) {
                                    $dep_id = $dep_result['InvestorDeposit']['id'];
                                    $invcash_array = array('id' => $cash_id, 'investor_deposit_id' => $dep_id);
                                    $this->InvestmentCash->save($invcash_array);
                                }
                            }
                        }
                        $message = 'Topup successful.';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'topupReceipt', $investor_id, $investment_id, $investor_name));
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
        $this->__validateUserType();

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
        $this->__validateUserType();
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

    function editFixedInvestments($investor_id = null, $investment_id = null) {
        $this->__validateUserType();

        if (!is_null($investor_id)) {
            $investor_data = $this->Investor->find('first', array('recursive' => -1, 'conditions' => array('Investor.id' => $investor_id)));
            $data = $this->InvestmentCash->find('all', array('conditions' =>
                array(
                    'InvestmentCash.investment_id' => $investment_id, 'InvestmentCash.investment_type' => 'fixed'
            )));

            if ($this->Session->check('editinvesttemp')) {
                $this->Session->delete('editinvesttemp');
            }
            $issued = $this->Session->check('userDetails');
            if ($issued) {
                $issued = $this->Session->read('userDetails.firstname');
                $issued .= ' ' . $this->Session->read('userDetails.lastname');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data_total = $this->Investment->find('all', array('fields' =>
                    array("SUM(Investment.earned_balance) as 'balance_due'"),
                    'conditions' => array('Investment.investor_id' => $investor_id,
                        'NOT' => array('Investment.status' => array('Cancelled', 'Paid')))));


                if ($data_total) {
                    $this->set('total', $data_total);
                }
                $this->set('data', $data);
                $this->set('investor_data', $investor_data);
                $this->set('investor_id', $investor_id);
                $this->set('investor_name', $investor_data['Investor']['fullname']);
            } else {

//print_r('11');exit;
                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {
//print_r('oo');exit;
            $message = 'Sorry, Investor Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function editFixedInvestment($investor_id = null, $investment_id = null, $investmentcash_id = null, $count = null) {
        $this->__validateUserType();
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
            $data = $this->InvestmentCash->find('first', array('conditions' => array('InvestmentCash.id' => $investmentcash_id)));
            if ($data) {
                $this->set('count', $count);
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
        $this->__validateUserType();
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
        $this->__validateUserType();

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
        $this->__validateUserType();

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

    function payInvestor($investor_id = null, $investment_id = null) {
        $this->__validateUserType();
        $this->set('paymentmodes', $this->PaymentMode->find('list'));

        $this->set('instructions', $this->Instruction->find('list', array('conditions' => array('Instruction.id' => array('1', '2', '3')))));
        if (!is_null($investor_id)) {
            $data = $this->ClientLedger->find('first', array('conditions' => array('ClientLedger.investor_id' => $investor_id)));
            $inv_data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'recursive' => -1));
            if ($data) {
                $this->set('data', $data);
                if ($inv_data) {

                    $this->set('inv_data', $inv_data);
                }
            } else {

                $message = 'Sorry, Investor Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        }
    }

    function disposeEquityInvestment($investment_id = null, $investment_no = null) {
        $this->__validateUserType();
//        $this->set('paymentmodes', $this->PaymentMode->find('list'));

        $this->set('equitieslists', $this->EquitiesList->find('list'));
        if (!is_null($investment_no) && !is_null($investment_id)) {

            $data = $this->ReinvestmentsEquity->find('first', array('conditions' =>
                array('ReinvestmentsEquity.investment_no' => $investment_no)));
            if ($data) {
                $data['inv'] = $this->Investment->find('first', array('conditions' =>
                    array('Investment.id' => $investment_id)));

                $data['EquitiesList'] = $this->ReinvestorEquity->find('all', array('conditions' =>
                    array('ReinvestorEquity.reinvestment_id' => $data['ReinvestmentsEquity']['id'])));
                if ($data['EquitiesList']) {
                    $x = 1;
                    $equity_array = array();
                    foreach ($data['EquitiesList'] as $val) {
                        $equity_array[$x] = $val;
                        $x++;
                    }
                    $this->set('equity_array', $equity_array);
                }
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
        $this->__validateUserType();
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
        $this->__validateUserType();
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
        $this->__validateUserType();
    }

    public function editPayment() {
        $this->__validateUserType();
    }

    public function process_rollover() {
        $this->__validateUserType();
        $this->autoRender = false;
        if ($this->request->is('post')) {
            $invesmentID = $this->request->data['Investment']['id'];
            $investor_id = $this->request->data['Investment']['investor_id'];
            if (isset($this->request->data['fixed_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }

                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }

                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
            } elseif (isset($this->request->data['equity_reset'])) {

                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
            } elseif (isset($this->request->data['reset'])) {


                $check = $this->Session->check('ledger_data');
                if ($check) {
                    $this->Session->delete('ledger_data');
                }

                $check = $this->Session->check('investtemp1');
                if ($check) {
                    $this->Session->delete('investtemp1');
                }
                $check = $this->Session->check('variabless_fixed');
                if ($check) {
                    $this->Session->delete('variabless_fixed');
                }
                $check = $this->Session->check('variabless_equity');
                if ($check) {
                    $this->Session->delete('variabless_equity');
                }
                $check = $this->Session->check('investment_array_equity');
                if ($check) {
                    $this->Session->delete('investment_array_equity');
                }
                $check = $this->Session->check('investment_array_fixed');
                if ($check) {
                    $this->Session->delete('investment_array_fixed');
                }
                $check = $this->Session->check('investtemp');
                if ($check) {
                    $this->Session->delete('investtemp');
                }
                $check = $this->Session->check('generic_array');
                if ($check) {
                    $this->Session->delete('generic_array');
                }
                $check = $this->Session->check('ledger_transactions');
                if ($check) {
                    $this->Session->delete('ledger_transactions');
                }
                $message = 'Investment Successfully Reset';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'rollover', $invesmentID, $investor_id));
            }
            $ledger_transactions = array();
            $management_fee_type = $this->request->data['Investment']['management_fee_type'];
            $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
            if ($data) {
                $manage_fee = $data['Investment']['accrued_basefee'];
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
                $basefee_duedate->add(new DateInterval('P1M'));

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
                if (($this->request->data['Investment']['instruction_id'] == 7) && (is_null($this->request->data['Investment']['instruction_details']) || $this->request->data['Investment']['instruction_details'] == "")) {
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
//                $investmentproduct_id = $this->request->data['Investment']['investmentproduct_id'];
                $new_cashathand = $amount_available - $investment_amount;
                $new_cashinvested = $cashinvested + $investment_amount;
                $first_date = $inv_date;
                $period = $this->request->data['Investment']['investment_period'];
                $duration = $this->request->data['Investment']['duration'];
                $custom_rate = $this->request->data['Investment']['custom_rate'];
                $year = $duration;
                $to_date = date('Y-m-d');
                $to_date = new DateTime($to_date);
                $ainv_date = new DateTime($inv_date);
                $aduration = date_diff($ainv_date, $to_date);
                $aduration = $aduration->format("%a");
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

                        $adate = date('Y-m-d');
                        $due_date = $date->format('Y-m-d');
                        if ($due_date <= $adate) {
                            $adate = $due_date;
//                            $date->sub(new DateInterval('P1D'));
                        }
                        $to_date = new DateTime($adate);
                        $ainv_date = new DateTime($inv_date);
                        $aduration = date_diff($ainv_date, $to_date);
                        $aduration = $aduration->format("%a");
//                        $aduration +=1;

                        $ainterest_amount = $interest_amount1 * ($aduration / 365);
                        $aamount_due = $ainterest_amount + $investment_amount;
//                        for ($n = 1; $n <= $duration; $n++) {
//                            $date_statemt->add(new DateInterval('P1D'));
//                            $interest_amount2 = $interest_amount1 * (1 / 365);
//                            $total = $interest_amount2 + $principal;
//                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                'investor_id' => $this->request->data['Investment']['investor_id'],
//                                'principal' => $principal,
//                                'interest' => $interest_amount2,
//                                'maturity_date' => $date_statemt->format('Y-m-d'),
//                                'total' => $total);
////                            $principal = $total;
//                        }

                        break;
                    case 'Year(s)':

                        $finv_date = $inv_date;
                        $date = new DateTime($finv_date);
                        $date->add(new DateInterval('P' . $duration . 'Y'));
                        $date->sub(new DateInterval('P1D'));
                        $date_statemt = new DateTime($first_date);
                        $principal = $investment_amount;
                        $statemt_array = array();
                        $rate = $custom_rate;

                        $YEAR2DAYS = 365 * $duration;
                        $duration = $YEAR2DAYS;
                        $interest_amount1 = ($rate / 100) * $investment_amount;
                        $interest_amount = $interest_amount1 * ($YEAR2DAYS / 365);
                        $amount_due = $interest_amount + $investment_amount;

                        $adate = date('Y-m-d');
                        $due_date = $date->format('Y-m-d');
                        if ($due_date <= $adate) {
                            $adate = $due_date;
                        }
                        $to_date = new DateTime($adate);
                        $ainv_date = new DateTime($inv_date);
                        $aduration = date_diff($ainv_date, $to_date);
                        $aduration = $aduration->format("%a");
                        if ($due_date <= $adate) {
                            $aduration +=1;
                        }

//                        $aYEAR2DAYS = 365 * $aduration;
                        $ainterest_amount = $interest_amount1 * ($aduration / 365);
                        $aamount_due = $ainterest_amount + $investment_amount;
//                        for ($n = 1; $n <= $duration; $n++) {
//                            $date_statemt->add(new DateInterval('P1Y'));
//                            $interest_amount2 = $interest_amount1 * (365 / 365);
//                            $total = $interest_amount2 + $principal;
//                            $statemt_array[] = array('user_id' => $this->request->data['Investment']['user_id'],
//                                'investor_id' => $this->request->data['Investment']['investor_id'],
//                                'principal' => $principal,
//                                'interest' => $interest_amount2,
//                                'maturity_date' => $date_statemt->format('Y-m-d'),
//                                'total' => $total);
////                            $principal = $total;
//                        }

                        break;
                }



                $total_tenure = $this->request->data['Investment']['total_tenure'];
                $description = 'Reinvestment of ' . $data["Investment"]["investment_no"] . ' for ' . $duration . ' ' . $period;
                //'cash_athand' => $new_cashathand, 'total_invested' => $new_cashinvested,
                $investment_array = array('balance' => $amount_due,
                    'expected_interest' => $interest_amount, 'amount_due' => $amount_due,
                    'interest_accrued' => $ainterest_amount, 'accrued_days' => $aduration,
                    'duration' => $this->request->data['Investment']['duration'],
                    'investment_period' => $this->request->data['Investment']['investment_period'],
                    'custom_rate' => $custom_rate, 'rollover_amount' => $investment_amount,
                    'total_tenure' => $total_tenure, 'total_amount_earned' => $aamount_due,
                    'earned_balance' => $aamount_due, 'rollover_date' => $inv_date,
                    'due_date' => $date->format('Y-m-d'), 'status' => 'Rolled_over');

                $interest_accruals = array(
                    'investor_id' => $this->request->data['Investment']['investor_id'],
                    'interest_amounts' => $ainterest_amount,
                    'interest_date' => $inv_date
                );

                $check = $this->Session->check('interest_accrual');
                if ($check) {
                    $this->Session->delete('interest_accrual');
                }
                $check = $this->Session->write('interest_accrual', $interest_accruals);

                $ledger_transactions[] = array('debit' => $investment_amount, 'user_id' => $this->request->data['Investment']['user_id'],
                    'date' => $inv_date, 'description' => $description);

                $rollover_details = array('user_id' => $data['Investment']['user_id'], 'investment_id' => $data['Investment']['id'],
                    'investor_id' => $data['Investment']['investor_id'], 'old_investment_amount' => $data["Investment"]["investment_amount"],
                    'old_interest_accrued' => $data["Investment"]["interest_accrued"], 'rollover_amount' => $investment_amount,
                    'custom_rate' => $custom_rate, 'old_custom_rate' => $data["Investment"]["custom_rate"], 'rollover_date' => $date->format('Y-m-d'));

                $base_fee = 0;
                $benchmark_fee = 0;
                switch ($management_fee_type) {
                    case 'Management Fee':
                        $base_fee = ($base_rate / 100) * $investment_amount;
                        $YEAR2DAYS = $duration;
                        $base_fee = $base_fee * ($YEAR2DAYS / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;
                        break;
                    case 'Management & Performance Fee':
                        $base_fee = ($base_rate / 100) * $investment_amount;
                        $YEAR2DAYS = $duration;
                        $base_fee = $base_fee * ($YEAR2DAYS / 365);
//                            if ($base_fee > $new_cashathand) {
//                                $message = 'Manage Fee + Investment amount cannot be more than investor\'s availalbe cash';
//                                $this->Session->write('bmsg', $message);
//                                $this->redirect(array('controller' => 'Investments', 'action' => $page));
//                            }
//                            $new_cashathand = $new_cashathand - $base_fee;

                        break;
                }
                $manage_fee += $base_fee;
                $generic_array = array('id' => $data['Investment']['id'], 'investor_id' => $data['Investment']['investor_id'],
                    'payment_schedule_id' => $this->request->data['Investment']['paymentschedule_id'],
                    'payment_mode_id' => $this->request->data['Investment']['paymentmode_id'],
                    'management_fee_type' => $this->request->data['Investment']['management_fee_type'],
                    'base_rate' => $base_rate,
                    'base_fees' => $base_fee,
                    'accrued_basefee' => $manage_fee,
                    'basefee_duedate' => $basefee_duedate->format('Y-m-d'),
                    'benchmark_rate' => $benchmark_rate,
                    'investment_date' => $inv_date);

                $total_cash = $new_cashathand + $new_cashinvested;
                $description = 'Deposit for investment';
//move to summary contract function and store in client ledger

                $client_ledger = array('available_cash' => $new_cashathand,
                    'invested_amount' => $new_cashinvested, 'rollover' => $investment_amount);

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

                //insert into investmentpayments for rollover
                $investment_paymentdetails = array('investment_id' => $data['Investment']['id'],
                    'investor_id' => $data['Investment']['investor_id'], 'amount' => $investment_amount, 'interest' => $interest_amount, 'rate' => $custom_rate,
                    'user_id' => $data['Investment']['user_id'], 'payment_date' => $inv_date, 'event_type' => 'Rolledover',
                    'event_date' => $inv_date);


                $this->Session->write('investpayments', $investment_paymentdetails);

                /*                 * ********************************************************************************** */
//                $this->Session->write('statemt_array', $statemt_array);
                $variables = array('duedate' => $date->format('jS F,Y'), 'interest' => $interest_amount, 'totaldue' => $amount_due);
                $this->Session->write('variabless_fixed', $variables);
                $this->Session->write('rollover_details', $rollover_details);
                $this->Session->write('investment_array_fixed', $investment_array);

                $this->Session->write('generic_array', $generic_array);
                $this->Session->write('rledger_data', $client_ledger);
                $this->Session->write('ledger_transactions', $ledger_transactions);
//                $this->Session->write('rollovertemp.investmentproduct_id', $investmentproduct_id);
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
        $this->__validateUserType();
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
        $this->__validateUserType();
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
        $this->__validateUserType();
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
                    'order' => array('LedgerTransaction.id' => 'desc'),
                    'limit' => 15
                );
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
        $this->__validateUserType();

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
        $this->__validateUserType();
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

                $message = 'Sorry, xxxInvestment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Sorry, Investment Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
        }
    }

    /*
      public function statementInvDetailEq($invesmentID = null, $investor_id = null, $investor_name = null) {
      $this->__validateUserType();
      //        if (!is_null($invesmentID)) {
      //            $data = $this->DailyInterestStatement->find('all', array('conditions' =>
      //                array('DailyInterestStatement.investment_id' => $invesmentID)));
      //            $issued = $this->Session->check('userData');
      //            if ($issued) {
      //                $issued = $this->Session->read('userData');
      //                $this->set('issued', $issued);
      //            }
      //
      //            if ($data) {
      //                $data2 = $this->Investment->find('first', array('conditions' => array('Investment.id' => $invesmentID)));
      //                $data_total = $this->DailyInterestStatement->find('all', array('fields' =>
      //                    array("SUM(DailyInterestStatement.principal) as 'total_principal',"
      //                        . "SUM(DailyInterestStatement.interest) as 'total_interest',SUM(DailyInterestStatement.total) as 'sum_total'"),
      //                    'conditions' => array('DailyInterestStatement.investment_id' => $invesmentID)));
      //
      //                if ($data2) {
      //                    $this->set('data2', $data2);
      //                }
      //                if ($data_total) {
      //                    $this->set('data_total', $data_total);
      //                }
      //                $this->set('data', $data);
      //                $this->set('investor_id', $investor_id);
      //                $this->set('invesmentID', $invesmentID);
      //                $this->set('investor_name', $investor_name);
      //            } else {
      //
      //                $message = 'Sorry, xxxInvestment Details Not Found';
      //                $this->Session->write('imsg', $message);
      //                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
      //            }
      //        } else {
      //
      //            $message = 'Sorry, Investment Details Not Found';
      //            $this->Session->write('imsg', $message);
      //            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments', $investor_id, $investor_name));
      //        }
      }
     */

    function statementInvDetailEq($investment_id = null, $investor_id = null, $investor_name = null) {
        $this->__validateUserType();

        if (!is_null($investor_id)) {
            $data = $this->Investment->find('all', array('conditions' =>
                array('Investment.investor_id' => $investor_id,
                    'Investment.investment_product_id' => array(2, 3),
                    'NOT' => array('Investment.status' => array('Cancelled', 'Paid')
            ))));
            $issued = $this->Session->check('userDetails');
            if ($issued) {
                $issued = $this->Session->read('userDetails.firstname');
                $issued .= ' ' . $this->Session->read('userDetails.lastname');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data_total = $this->InvestorEquity->find('all', array(
//                    'fields' => array("SUM(Investment.earned_balance) as 'balance_due'"),
                    'conditions' => array('InvestorEquity.investment_id' => $investment_id,
                        'NOT' => array('InvestorEquity.numb_shares_left' => 0))
                ));


                if ($data_total) {
                    $this->set('total', $data_total);
                }
                $this->set('data', $data);
                $this->set('investor_id', $investor_id);
                $this->set('investor_name', $investor_name);
            } else {

//print_r('11');exit;
                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {
//print_r('oo');exit;
            $message = 'Sorry, Investor Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    public function statementDailyInterest($invesmentID = null, $investor_id = null, $investor_name = null) {
        $this->__validateUserType();
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
        $this->__validateUserType();
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

    public function makeEquityOrder() {
        $this->autoRender = $this->autoLayout = false;
        if ($this->request->is('post')) {

            $investment_id = $_POST['hid_investid'];
            $invest_no = $this->request->data['EquityOrder']['invest_no'];
            //$investor_id = $this->request->data['EquityOrder']['invest_no']
            //$this->request->data['EquityOrder']['investor_id'];

            $totalamt = 0;
            $total_shares = 0;
            $equities_list_id = $this->request->data['EquityOrder']['equities_list_id'];
            if ($this->Session->check('investmt_equities')) {
                $this->Session->delete('investmt_equities');
            }
            $equities = $this->get_equity();
            $shares_rem = $this->request->data['EquityOrder']['shares_rem'];
            $shares_ordered = $this->request->data['EquityOrder']['numb_shares'];
            $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $equities_list_id), 'recursive' => -1));
            if ($equity) {
                $equity_name = $equity['EquitiesList']['equity_abbrev'];
            }
            if ($shares_ordered > $shares_rem) {
                $message = 'Shares ordered for ' . $equity_name . '  are more than remaining shares.';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id, $invest_no));
            }
            $equity_data = array($equities_list_id => array(
                    'equities_list_id' => $equities_list_id,
                    'investment_id' => $investment_id,
                    'shares_req' => $shares_ordered
            ));

            $equities+=$equity_data;
            $this->set_equity($equities);
            $x = 2;
            while ($x <= 5) {
                $equities = $this->get_equity();

                //equity already exists, add to equity_details
                if (isset($this->request->data['EquityOrder']['equities_list_id' . $x]) &&
                        !empty($this->request->data['EquityOrder']['equities_list_id' . $x])) {

                    $shares_rem = $this->request->data['EquityOrder']['shares_rem' . $x];
                    $shares_ordered = $this->request->data['EquityOrder']['numb_shares' . $x];
                    $newequities_list_id = $this->request->data['EquityOrder']['equities_list_id' . $x];
                    $equity = $this->EquitiesList->find('first', array('conditions' => array('EquitiesList.id' => $newequities_list_id), 'recursive' => -1));
                    if ($equity) {
                        $equity_name = $equity['EquitiesList']['equity_abbrev'];
                    }
                    if ($shares_ordered > $shares_rem) {
                        $message = 'Shares ordered for ' . $equity_name . '  are more than remaining shares.';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'disposeEquityInvestment', $investment_id, $invest_no));
                    }

                    $equity_data = array($newequities_list_id => array(
                            'equities_list_id' => $newequities_list_id,
                            'investment_id' => $investment_id,
                            'shares_req' => $shares_ordered
                    ));

                    $equities+=$equity_data;
                    $this->set_equity($equities);
                }
                $x++;
            }

            $equities = $this->get_equity();
            if (!empty($equities)) {
                foreach ($equities as $key => $var) {
                    $this->EquityOrder->create();
                    $this->EquityOrder->save($var);
                }
                $this->Session->delete('investmt_equities');
            }
            $investment = array('id' => $investment_id, 'status' => 'Disposal_Requested');
            $result = $this->Investment->save($investment);

            if ($result) {
                $message = 'Disposal Request Successful';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        }
    }

    function delFixedInvestmentDeposits($investor_id = null, $investment_id = null, $investment_no = null) {
        $this->__validateUserType();
        $this->set('investor_id', $investor_id);
        $this->set('investment_id', $investment_id);
        $this->set('investment_no', $investment_no);
        $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        $this->set('investor_name', $investor['Investor']['fullname']);

        $data2 = $this->paginate('InvestorDeposit', array('InvestorDeposit.investment_id' => $investment_id));
        $this->set('data', $data2);
    }

    function delFixedInvestmentPayments($investor_id = null, $investment_id = null, $investment_no = null) {
        $this->__validateUserType();
        $this->set('investor_id', $investor_id);
        $this->set('investment_no', $investment_no);
        $this->set('investment_id', $investment_id);
        $investor = $this->Investor->find('first', array('conditions' => array('Investor.id' => $investor_id)));
        $this->set('investor_name', $investor['Investor']['fullname']);

        $data2 = $this->paginate('InvestmentPayment', array('InvestmentPayment.investment_id' => $investment_id));
        $this->set('data', $data2);
    }

    function delfixedpayment() {
        $this->autoLayout = $this->autoRender = false;
        if ($this->request->is('post')) {
            $investment_id = $_POST['hid_investid'];
            $investor_id = $_POST['hid_investorid'];
            $investment_no = $_POST['hid_investno'];
            $investor_name = $_POST['investor_name'];
            $sms_amount = 0;
            $lt_id;
            $invpayments = $this->InvestmentPayment->find('all', ['conditions' =>
                ['InvestmentPayment.investment_id' => $investment_id]]);
            if ($invpayments) {
                foreach ($invpayments as $val) {
                    $invpayments_id = $val['InvestmentPayment']['id'];
                    if (!empty($this->request->data['InvestmentPayments']['delete' . $invpayments_id]) && $this->request->data['InvestmentPayments']['delete' . $invpayments_id] == 1) {
                        $sms_amount += $val['InvestmentPayment']['amount'];
                        $lt_id = $val['InvestmentPayment']['ledger_transaction_id'];
                        $this->InvestmentPayment->delete($invpayments_id, false);
                    }
                }
            }


            $investment_data = $this->Investment->find('first', ['conditions' => ['Investment.id' => $investment_id]]);
            if ($investment_data) {
                $earnedbalance = $investment_data['Investment']['earned_balance'];
                $status = $investment_data['Investment']['status'];
                $new_earnedbalance = $earnedbalance + $sms_amount;

                if ($new_earnedbalance <= 0) {
                    $status = 'Paid';
                } elseif ($new_earnedbalance > 0) {
                    $status = 'Part_payment';
                }
                $investment_array = array('id' => $investment_id, 'status' => $status, 'earned_balance' => $new_earnedbalance);
            }

            $ledger_details = $this->ClientLedger->find('first', array('conditions' =>
                array('ClientLedger.investor_id' => $investor_id)));
            if ($ledger_details) {
                $old_balance = $ledger_details['ClientLedger']['available_cash'];
                $investor = $ledger_details['ClientLedger']['investor_id'];
                $investor_name = $ledger_details['Investor']['fullname'];
                $new_balance = $old_balance + $sms_amount;



//                $new_investmentdetails = array('id' => $investment_id, 'earned_balance' => $earned_balance
//                    , 'balance' => $balance, $amount_due => $balance, 'amount_paidout' => $total_paid,
//                    'status' => $payment_status, 'lastpaidout_date' => $payment_date);
                //Update Ledger data
                $cledger_id = $ledger_details['ClientLedger']['id'];
                $client_ledger = array('id' => $cledger_id, 'available_cash' => $new_balance);
                $this->ClientLedger->save($client_ledger);
                $voucher_no = date('mdyhis') . rand(2, 4);
                $ltid = null;
                $result = $this->ClientLedger->save($client_ledger);
                if ($result) {
                    //enter new ledger transaction
                    if (!empty($lt_id)) {
                        $this->LedgerTransaction->delete($lt_id, false);
                    }




                    if (!empty($investment_array)) {
                        $this->Investment->save($investment_array);
                    }
                    $message = 'Investment Payment Deleted Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'delFixedInvestmentPayments', $investor_id, $investment_id, $investment_no));
                } else {

                    $message = 'Payment Deleting Unsuccessful';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'delFixedInvestmentPayments', 'delFixedInvestmentPayments', $investor_id, $investment_id, $investment_no));
                }
            } else {

                $message = 'Payment Deleting Unsuccessful';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
            }
        } else {

            $message = 'Invalid Access Method';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function delDeposit($deposit_id = null, $investor_name = null) {

        $deposit_data = $this->InvestorDeposit->find('first', ['conditions' =>
            ['InvestorDeposit.id' => $deposit_id]]);
        if ($deposit_data) {
            $topup_id = $deposit_data['InvestorDeposit']['topup_id'];
            $deposit_amount = $deposit_data['InvestorDeposit']['amount'];
            $investment_id = $deposit_data['InvestorDeposit']['investment_id'];
            $new_accrued = $deposit_data['Investment']['interest_accrued'];
            $investor_id = $deposit_data['Investment']['investor_id'];
            $investment_no = $deposit_data['Investment']['investment_no'];
            $ledger_id = $deposit_data['LedgerTransaction']['client_ledger_id'];
            $transaction_id = $deposit_data['InvestorDeposit']['ledger_transaction_id'];
            $dep_created = $deposit_data['InvestorDeposit']['created'];
            $invstatus = $deposit_data['Investment']['status'];
            $current = date('Y-m-d');
            if (!empty($investment_id)) {
                $old_investment_amount = $deposit_data['Investment']['investment_amount'];
                $new_invest_amt = $old_investment_amount - $deposit_amount;

                $newtotal_amount_earned = $deposit_data['Investment']['total_amount_earned'] - $deposit_amount;
                $new_earned_bal = $deposit_data['Investment']['earned_balance'] - $deposit_amount;
                if ($new_invest_amt <= 0) {
                    $invstatus = 'Cancelled';
                }
                //recalculate interest for deposit with date deposited and           
                $custom_rate = $deposit_data['Investment']['custom_rate'];
                $period = $deposit_data['Investment']['investment_period'];
                $end_date = date('Y-m-d');
                $first_date = $deposit_data['InvestorDeposit']['deposit_date'];
                $inv_date = new DateTime($first_date);
                $to_date = new DateTime($end_date);
                $duration = date_diff($inv_date, $to_date);
                $duration = $duration->format("%a");

                $year = $duration;
                $investment_amount = $deposit_data['InvestorDeposit']['amount'];
                $daily_interest = 0;
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
                        $daily_interest = $interest_amount / 365;
                        if ($current > $dep_created) {
                            $dailyinterests = $this->DailyInterestStatement->find('all', ['conditions' =>
                                ['DailyInterestStatement.date BETWEEN ? AND ?' => [$first_date, $end_date]], 'recursive' => -1]);

                            if ($dailyinterests) {
                                $daily_array = array();
                                foreach ($dailyinterests as $val) {
                                    $id = $val['DailyInterestStatement']['id'];
                                    $new_interests = $val['DailyInterestStatement']['interest'] - $daily_interest;
                                    $new_total = $val['DailyInterestStatement']['total'] - $daily_interest;
                                    $savedata = array('id' => $id, 'interest' => $new_interests, 'total' => $new_total);
                                    array_push($daily_array, $savedata);
                                }

                                $this->DailyInterestStatement->saveMany($daily_array);
                            }
                            $new_accrued = $deposit_data['Investment']['interest_accrued'] - $interest_amount;
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
                        $daily_interest = $interest_amount / 365;
                        if ($current > $dep_created) {
                            $dailyinterests = $this->DailyInterestStatement->find('all', ['conditions' =>
                                ['DailyInterestStatement.date BETWEEN ? AND ?' => [$first_date, $end_date]], 'recursive' => -1]);
                            if ($dailyinterests) {
                                $daily_array = array();
                                foreach ($dailyinterests as $val) {
                                    $id = $val['DailyInterestStatement']['id'];
                                    $new_interests = $val['DailyInterestStatement']['interest'] - $daily_interest;
                                    $new_total = $val['DailyInterestStatement']['total'] - $daily_interest;
                                    $savedata = array('id' => $id, 'interest' => $new_interests, 'total' => $new_total);
                                    array_push($daily_array, $savedata);
                                }

                                $this->DailyInterestStatement->saveMany($daily_array);
                            }
                            $new_accrued = $deposit_data['Investment']['interest_accrued'] - $interest_amount;
                        }
                        break;
                }

                $new_expected_interest = $deposit_data['Investment']['expected_interest'] - $interest_amount;

                $investor_id = $deposit_data['Investment']['investor_id'];

                $investment_update = array('id' => $investment_id, 'interest_accrued' => round($new_accrued, 2), 'expected_interest' => round($new_expected_interest, 2),
                    'earned_balance' => $new_earned_bal, 'total_amount_earned' => $newtotal_amount_earned, 'investment_amount' => $new_invest_amt, 'status' => $invstatus);

                $this->Investment->save($investment_update);

                $ledger = $this->ClientLedger->find('first', ['conditions' =>
                    ['ClientLedger.id' => $ledger_id], 'recursive' => -1]);
                if ($ledger) {
                    if (!empty($topup_id)) {
                        $source = $deposit_data['Topup']['cash_receipt_mode_id'];
                        switch ($source) {
                            case 1:
                            case 2:
                            case 3:
                            case 5:
                                $old_invested = $ledger['ClientLedger']['invested_amount'];
                                $available_cash = $ledger['ClientLedger']['available_cash'];
                                $new_available = $available_cash;
                                $new_invested = $ledger['ClientLedger']['invested_amount'];
                                if ($deposit_amount > $old_invested) {
                                    $newdeposit = $deposit_amount - $old_invested;
                                    $new_invested = 0;
                                    $new_available = $available_cash - $newdeposit;
                                } else {
                                    $new_invested = $old_invested - $deposit_amount;
                                    $new_available = $available_cash;
                                }

                                break;

                            case 4:
                                $old_invested = $ledger['ClientLedger']['invested_amount'];
                                $available_cash = $ledger['ClientLedger']['available_cash'];
                                $new_available = $available_cash + $deposit_amount;
                                $new_invested = $old_invested - $deposit_amount;

                                break;
                        }
                        $this->Topup->delete($topup_id, false);
                    } else {
                        $old_invested = $ledger['ClientLedger']['invested_amount'];
                        $available_cash = $ledger['ClientLedger']['available_cash'];
                        $new_available = $available_cash;
                        $new_invested = $ledger['ClientLedger']['invested_amount'];
                        if ($deposit_amount > $old_invested) {
                            $newdeposit = $deposit_amount - $old_invested;
                            $new_invested = 0;
                            $new_available = $available_cash - $newdeposit;
                        } else {
                            $new_invested = $old_invested - $deposit_amount;
                            $new_available = $available_cash;
                        }
                    }
                    $ledger_array = array('id' => $ledger_id, 'invested_amount' => $new_invested, 'available_cash' => $available_cash);

                    $ledger_result = $this->ClientLedger->save($ledger_array);
                    if ($ledger_result) {
                        if ($new_invest_amt <= 0) {

                            $this->LedgerTransaction->deleteAll(array('LedgerTransaction.investment_id' => $investment_id), false);
                        } else {
                            $this->LedgerTransaction->delete($transaction_id, false);
                        }
                    }

                    $cash_data = $this->InvestmentCash->find('first', array('conditions' =>
                        array('InvestmentCash.investor_deposit_id' => $deposit_id), 'recursive' => -1));

                    if ($cash_data) {
                        $status = $cash_data['InvestmentCash']['status'];
                        if ($status != 'available') {
                            $result = $this->ReinvestorCashaccount->find('first', array('recursive' => -1, 'conditions' =>
                                array('ReinvestorCashaccount.reinvestor_id' => 1)));
                            if ($result) {
                                $id = $result['ReinvestorCashaccount']['id'];
                                $old_balance = $result['ReinvestorCashaccount']['fixed_inv_balance'];
                                ;
                                $new_balance = $old_balance - $deposit_amount;
                                $grand_total = $result['ReinvestorCashaccount']['total_balance'] - $deposit_amount;
                                $fixed_data = array('id' => $id, 'fixed_inv_balance' => $new_balance, 'total_balance' => $grand_total);
                                $this->ReinvestorCashaccount->save($fixed_data);
                            }
                        }


                        $this->InvestmentCash->deleteAll(array('InvestmentCash.investor_deposit_id' => $deposit_id), false);
                    }

                    if ($new_invest_amt <= 0) {
                        $result = $this->InvestorDeposit->deleteAll(array('InvestorDeposit.investment_id' => $investment_id), false);
                    } else {
                        $result = $this->InvestorDeposit->delete($deposit_id, false);
                    }
                    if ($result) {
                        $message = 'Deposit successfully deleted';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'delFixedInvestmentDeposits', $investor_id, $investment_id, $investment_no));
                    } else {

                        $message = 'Unable to delete deposit. Try again';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                    }
                } else {
                    $message = 'Missing Legder details. Try again';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
                }
            } else {
                $message = 'Missing investment details. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
            }
        } else {
            
        }
    }

    public function deleteEquityInvestments($investment_id = null, $investor_id = null, $investor_name = null) {
        $deposit_data = $this->InvestorDeposit->find('first', ['conditions' =>
            ['InvestorDeposit.investment_id' => $investment_id], 'order' => ['InvestorDeposit.id' => 'asc']]);
        if ($deposit_data) {
            $deposit_id = $deposit_data['InvestorDeposit']['id'];
            $topup_id = $deposit_data['InvestorDeposit']['topup_id'];
            $total_amt = $deposit_data['Investment']['total_amount'];
            $deposit_amount = $deposit_data['InvestorDeposit']['amount'] - $total_amt;
            $investor_id = $deposit_data['Investment']['investor_id'];
            $investment_no = $deposit_data['Investment']['investment_no'];
            $ledger_id = $deposit_data['LedgerTransaction']['client_ledger_id'];
            $transaction_id = $deposit_data['InvestorDeposit']['ledger_transaction_id'];
            $dep_created = $deposit_data['InvestorDeposit']['created'];
            $invstatus = $deposit_data['Investment']['status'];
            $invtype = $deposit_data['Investment']['investment_product_id'];
            $current = date('Y-m-d');
            if (!empty($investment_id)) {
                $new_invest_amt = $deposit_data['Investment']['investment_amount'];

                if ($new_invest_amt > 0 && $invtype == 3) {
                    $invtype = 1;
                    $investment_update = array('id' => $investment_id, 'status' => $invstatus
                        , 'investment_product_id' => $invtype, 'total_amount');
                    $this->Investment->save($investment_update);
                } else {
                    $invstatus = 'Cancelled';
                    $this->Investment->delete($investment_id, false);
                }



                $investor_id = $deposit_data['Investment']['investor_id'];





                $ledger = $this->ClientLedger->find('first', ['conditions' =>
                    ['ClientLedger.id' => $ledger_id], 'recursive' => -1]);
                if ($ledger) {
                    if (!empty($topup_id)) {
                        $source = $deposit_data['Topup']['cash_receipt_mode_id'];
                        switch ($source) {
                            case 1:
                            case 2:
                            case 3:
                            case 5:
                                $old_invested = $ledger['ClientLedger']['invested_amount'];
                                $available_cash = $ledger['ClientLedger']['available_cash'];
                                $new_available = $available_cash;
                                $new_invested = $ledger['ClientLedger']['invested_amount'];
//                                if ($deposit_amount > $old_invested) {
//                                    $newdeposit = $deposit_amount - $old_invested;
//                                    $new_invested = 0;
////                                    $new_available = $available_cash - $newdeposit;
//                                } else {
                                $new_invested = $old_invested - $total_amt;
//                                    $new_available = $available_cash;
//                                }

                                break;

                            case 4:
                                $old_invested = $ledger['ClientLedger']['invested_amount'];
                                $available_cash = $ledger['ClientLedger']['available_cash'];
                                $new_available = $available_cash + $total_amt;
                                $new_invested = $old_invested - $total_amt;

                                break;
                        }
                        $this->Topup->delete($topup_id, false);
                    } else {
                        $old_invested = $ledger['ClientLedger']['invested_amount'];
                        $available_cash = $ledger['ClientLedger']['available_cash'];
                        $new_available = $available_cash;
                        $new_invested = $ledger['ClientLedger']['invested_amount'];
//                        if ($deposit_amount > $old_invested) {
//                            $newdeposit = $deposit_amount - $old_invested;
//                            $new_invested = 0;
//                            $new_available = $available_cash - $newdeposit;
//                        } else {
                        $new_invested = $old_invested - $total_amt;
                        $new_available = $available_cash;
//                        }
                    }
                    $ledger_array = array('id' => $ledger_id, 'invested_amount' => $new_invested, 'available_cash' => $available_cash);

                    $ledger_result = $this->ClientLedger->save($ledger_array);
                    if ($ledger_result) {
                        if ($new_invest_amt <= 0) {

                            $this->LedgerTransaction->deleteAll(array('LedgerTransaction.investment_id' => $investment_id), false);
                        } else {
                            $this->LedgerTransaction->delete($transaction_id, false);
                        }
                    }

                    $cash_data = $this->InvestmentCash->find('first', array('conditions' =>
                        array('InvestmentCash.investor_deposit_id' => $deposit_id, 'investment_type' => 'equity'), 'recursive' => -1));

                    if ($cash_data) {
                        $status = $cash_data['InvestmentCash']['status'];
                        if ($status != 'available') {
                            $result = $this->ReinvestorCashaccount->find('first', array('recursive' => -1, 'conditions' =>
                                array('ReinvestorCashaccount.reinvestor_id' => 1)));
                            if ($result) {
                                $id = $result['ReinvestorCashaccount']['id'];
                                $old_balance = $result['ReinvestorCashaccount']['equity_inv_amount'];

                                $new_balance = $old_balance - $total_amt;
                                $grand_total = $result['ReinvestorCashaccount']['total_balance'] - $total_amt;
                                $fixed_data = array('id' => $id, 'equity_inv_amount' => $new_balance, 'total_balance' => $grand_total);
                                $this->ReinvestorCashaccount->save($fixed_data);
                            }
                        }


                        $this->InvestmentCash->deleteAll(array('InvestmentCash.investor_deposit_id' => $deposit_id), false);
                    }

                    if ($new_invest_amt <= 0) {
                        $result = $this->InvestorDeposit->deleteAll(array('InvestorDeposit.investment_id' => $investment_id), false);
                    } else {
                        $result = $this->InvestorDeposit->delete($deposit_id, false);
                    }
                    if ($result) {
                        $message = 'Equity Investment successfully deleted';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
                    } else {

                        $message = 'Unable to delete deposit. Try again';
                        $this->Session->write('bmsg', $message);
                        $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
                    }
                } else {
                    $message = 'Missing Legder details. Try again';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
                }
            } else {
                $message = 'Missing investment details. Try again';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageEquityInvestments', $investor_id, $investor_name));
            }
        } else {
            
        }
    }

    function statementClient($investor_id = null, $investor_name = null) {
        $this->__validateUserType();

        if (!is_null($investor_id)) {
            $investor_data = $this->Investor->find('first', array('recursive' => -1, 'conditions' => array('Investor.id' => $investor_id)));
            $data = $this->Investment->find('all', array('conditions' =>
                array('Investment.investor_id' => $investor_id,
                    'Investment.investment_product_id' => array(1, 3),
                    'NOT' => array('Investment.status' => array('Cancelled')
                    )), 'order' => array('Investment.investment_date'), 'contain' => array('InvestmentPayment', 'Topup', 'Rollover')
//                'fields' => array('Investment.investment_date','Investment.investment_no','Investment.investment_amount','Investment.custom_rate',
//                    'Investment.due_date','Investment.id','Investment.earned_balance')
            ));
            //,'SUM(InvestmentPayment.amount) as investpay_amount'
//            pr($data);exit;
            $topup_principal = $this->Topup->find('all', array(
                'conditions' => array('Investment.investor_id' => $investor_id),
                'order' => array('Investment.investment_date'),
                'fields' => array('SUM(Topup.topup_amount) AS total_topup', 'Topup.investment_id', 'Investment.investor_id', 'Topup.investment_date', 'SUM(Topup.topup_interest) As topup_in'),
                'group' => array('Topup.investment_id')));

            $issued = $this->Session->check('userDetails');
            if ($issued) {
                $issued = $this->Session->read('userDetails.firstname');
                $issued .= ' ' . $this->Session->read('userDetails.lastname');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data_total = $this->Investment->find('all', array('fields' =>
                    array("SUM(Investment.earned_balance) as 'balance_due'"),
                    'conditions' => array('Investment.investor_id' => $investor_id,
                        'NOT' => array('Investment.status' => array('Cancelled', 'Paid')))));


                if ($data_total) {
                    $this->set('total', $data_total);
                }
                $this->set('topup_principal', $topup_principal);
                $this->set('data', $data);
                $this->set('investor_data', $investor_data);
                $this->set('investor_id', $investor_id);
                $this->set('investor_name', $investor_name);
            } else {

//print_r('11');exit;
                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
            }
        } else {
//print_r('oo');exit;
            $message = 'Sorry, Investor Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageInvestments'));
        }
    }

    function topupReceipt($investor_id = null, $investment_id = null, $investor_name = null) {
        $this->__validateUserType();

        if (!is_null($investor_id)) {
            $data = $this->InvestorDeposit->find('first', array(
                'conditions' => array('InvestorDeposit.investment_id' => $investment_id),
                'order' => array('InvestorDeposit.id' => 'desc')));


            $issued = $this->Session->check('userDetails');
            if ($issued) {
                $issued = $this->Session->read('userDetails.firstname');
                $issued .= ' ' . $this->Session->read('userDetails.lastname');
                $this->set('issued', $issued);
            }

            if ($data) {
                $data2 = $this->Investment->find('first', array('conditions' =>
                    array('Investment.id' => $investment_id)));

                $this->set('data', $data);
                $this->set('data2', $data2);
                $this->set('investor_id', $investor_id);
                $this->set('investor_name', $investor_name);
            } else {
                $message = 'Sorry, Investment Details Not Found';
                $this->Session->write('imsg', $message);
                $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
            }
        } else {
//print_r('oo');exit;
            $message = 'Sorry, Investor Details Not Found';
            $this->Session->write('imsg', $message);
            $this->redirect(array('controller' => 'Investments', 'action' => 'manageFixedInvestments', $investor_id, $investor_name));
        }
    }

    public function get_accruedinterest($investment_id = null) {
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'recursive' => -1));

        if ($data) {

//            $investment_amount = $data['Investment']['investment_amount'];
            if (!empty($data['Investment']['rollover_amount']) && $data['Investment']['rollover_amount'] > 0) {
                $investment_amount = $data['Investment']['rollover_amount'];
            } else {
                $investment_amount = $data['Investment']['investment_amount'];
            }
            $period = $data['Investment']['investment_period'];
            $first_date = $data['Investment']['investment_date'];
            $custom_rate = $data['Investment']['custom_rate'];

            $due_date = $data['Investment']['due_date'];
            $interest_amount = 0;
            $interest_amountt = 0;
            $interest_amount2 = 0;
            $status = $data['Investment']['status'];
            $topup_data = $this->Topup->find('all', array('conditions' => array('Topup.investment_id' => $investment_id), 'recursive' => -1));
            if ($topup_data) {
                foreach ($topup_data as $val) {
                    switch ($period) {
                        case 'Day(s)':
                            $tfirst_date = $val['Topup']['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');

                            if ($due_date <= $date) {
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $inv_date->add(new DateInterval('P' . $tduration . 'D'));
                            $principal = $val['Topup']['topup_amount'];
                            $investment_amount = $investment_amount - $principal;
//                            $statemt_array = array();
                            $rate = $custom_rate;
                            $interest_amount1 = ($rate / 100) * $principal;
                            $interest_amountt += $interest_amount1 * ($tduration / 365);

                            if ($due_date <= $date) {
                                $tduration = $tduration + 1;
                            }




                            break;
                        case 'Year(s)':

                            $tfirst_date = $val['Topup']['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            if ($due_date <= $date) {
                                $date = $due_date;
                            }
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $inv_date->add(new DateInterval('P' . $tduration . 'D'));
//                            $date->sub(new DateInterval('P1D'));
                            $principal = $val['Topup']['topup_amount'];
                            $investment_amount = $investment_amount - $principal;
                            $statemt_array = array();
                            $rate = $custom_rate;
                            $interest_amount1 = ($rate / 100) * $principal;
                            $interest_amountt += $interest_amount1 * ($tduration / 365);


                            if ($due_date <= $date) {

                                $tduration = $tduration + 1;
                            }


                            break;
                    }
                }
            }
            //$interest_amount2 = $interest_amountt;
            switch ($status) {
                case 'Rolled_over':
                case 'Invested':
                case 'Termination_Requested':

                    $inv_date = new DateTime($first_date);
                    $date = date('Y-m-d');
                    if ($due_date <= $date) {
                        $date = $due_date;
                    }
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
//                    $interest_amount = '0.00';
                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
                            $statemt_array = array();
                            $rate = $custom_rate;
                            $date_curr = date('Y-m-d');
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);


                            if ($due_date <= $date_curr) {
                                $duration = $duration + 1;
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
                            $date_curr = date('Y-m-d');

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            if ($due_date <= $date_curr) {
                                $duration = $duration + 1;
                            }
                            //$YEAR2DAYS = 365 * $duration;
                            break;
                    }
                    $accrued_interest = $interest_amount; // - $interest_amount2;
                    return $accrued_interest;
                    break;
                case 'Termination_Approved':
                case 'Cancelled':
                case 'Matured':
                case 'Payment_Approved':
                case 'Payment_Requested':
                    $accrued_interest = $data['Investment']['interest_accrued'];
                    return $accrued_interest;
                default:
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = $data['Investment']['due_date'];
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
                    $custom_rate = $data['Investment']['custom_rate'];
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

                            $date_curr = date('Y-m-d');
                            if ($due_date <= $date_curr) {
                                $duration = $duration + 1;
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
                            $date_curr = date('Y-m-d');
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount += $interest_amount1 * ($duration / 365);
                            if ($due_date <= $date_curr) {
                                $duration = $duration + 1;
                            }
                            //$YEAR2DAYS = 365 * $duration;

                            break;
                    }
                    $accrued_interest = $interest_amount; // - $interest_amount2;
                    return $accrued_interest;
                    break;
            }
        } else {
            return 'Invesment details missing';
        }
    }

    public function get_totalaccruedinterest($investment_id = null) {
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'recursive' => -1));

        if ($data) {

            $investment_amount = $data['Investment']['investment_amount'];
            $period = $data['Investment']['investment_period'];
            $first_date = $data['Investment']['investment_date'];
            $custom_rate = $data['Investment']['custom_rate'];
            $interest_amount = 0;
            $interest_amountt = 0;
            $interest_amount2 = 0;
            $status = $data['Investment']['status'];
            $topup_data = $this->Topup->find('all', array('conditions' => array('Topup.investment_id' => $investment_id), 'recursive' => -1));
            if ($topup_data) {
                foreach ($topup_data as $val) {
                    switch ($period) {
                        case 'Day(s)':
                            $tfirst_date = $val['Topup']['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $inv_date->add(new DateInterval('P' . $tduration . 'D'));
                            $principal = $val['Topup']['topup_amount'];
                            $investment_amount = $investment_amount - $principal;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $principal;
                            $interest_amountt += $interest_amount1 * ($tduration / 365);



                            break;
                        case 'Year(s)':

                            $tfirst_date = $val['Topup']['investment_date'];
                            $inv_date = new DateTime($tfirst_date);
                            $date = date('Y-m-d');
                            $to_date = new DateTime($date);
                            $tduration = date_diff($inv_date, $to_date);
                            $tduration = $tduration->format("%a");
                            $inv_date->add(new DateInterval('P' . $tduration . 'D'));
//                            $date->sub(new DateInterval('P1D'));
                            $principal = $val['Topup']['topup_amount'];
                            $investment_amount = $investment_amount - $principal;
                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $principal;
                            $interest_amountt += $interest_amount1 * ($tduration / 365);



                            break;
                    }
                }
            }
            $interest_amount2 = $interest_amountt;
            switch ($status) {
                case 'Rolled_over':
                case 'Invested':
                case 'Termination_Requested':
                case 'Payment_Requested':

                    $inv_date = new DateTime($first_date);
                    $date = date('Y-m-d');
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
//                    $interest_amount = '0.00';
                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);


                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            //$YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);
                            break;
                    }
                    $accrued_interest = $interest_amount + $interest_amount2;
                    return $accrued_interest;
                    break;
                case 'Termination_Approved':
                case 'Cancelled':

                    $accrued_interest = $data['Investment']['interest_accrued'];
                    return $accrued_interest;
                default:
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $date = $data['Investment']['due_date'];
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
                    $year = $duration;
                    $custom_rate = $data['Investment']['custom_rate'];
                    switch ($period) {
                        case 'Day(s)':

                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount = $interest_amount1 * ($duration / 365);


                            break;
                        case 'Year(s)':

                            //$finv_date = $inv_date;
                            $date = new DateTime($first_date);
                            $date->add(new DateInterval('P' . $duration . 'D'));
                            $date_statemt = new DateTime($first_date);
                            $principal = $investment_amount;
//                            $statemt_array = array();
                            $rate = $custom_rate;

                            //$YEAR2DAYS = 365 * $duration;
                            $interest_amount1 = ($rate / 100) * $investment_amount;
                            $interest_amount += $interest_amount1 * ($duration / 365);
                            break;
                    }
                    $accrued_interest = $interest_amount + $interest_amount2;
                    return $accrued_interest;
                    break;
            }
        } else {
            return 'Invesment details missing';
        }
    }

    function get_accrueddays($investment_id = null) {
        $data = $this->Investment->find('first', array('conditions' => array('Investment.id' => $investment_id), 'recursive' => -1));

        if ($data) {
            $status = $data['Investment']['status'];

            switch ($status) {
                case 'Rolled_over':
                case 'Invested':
                case 'Termination_Requested':
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $due_date = $data['Investment']['due_date'];
                    $date = date('Y-m-d');
                    if ($due_date <= $date) {
                        $date = $due_date;
                    }
                    $to_date = new DateTime($date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
//                    if ($due_date <= $date) {
//                        $duration += 1;
//                    }
                    $accrued_days = $duration;
                    return $accrued_days;
                    break;
                case 'Termination_Approved':
                case 'Matured':
                case 'Cancelled':
                case 'Paid':
                case 'Part_payment':
                case 'Payment_Approved':
                case 'Payment_Requested':
                    $accrued_days = $data['Investment']['accrued_days'];
                    return $accrued_days;
                default:
                    $period = $data['Investment']['investment_period'];
                    $first_date = $data['Investment']['investment_date'];
                    $inv_date = new DateTime($first_date);
                    $due_date = $data['Investment']['due_date'];
                    $date = date('Y-m-d');
                    $to_date = new DateTime($due_date);
                    $duration = date_diff($inv_date, $to_date);
                    $duration = $duration->format("%a");
//                    if ($due_date <= $date) {
//                        $duration += 1;
//                    }
                    $accrued_days = $duration;
                    return $accrued_days;
                    break;
            }
        } else {
            return 'Invesment details missing';
        }
    }

}

?>
