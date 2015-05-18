<?php
//App::import('Vendor', 'HTML2PDF_myPdf', array('file' => 'Html2Pdf/html2pdf.class.php'));

class ReportsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Reports';
    var $uses = array('Setting', 'User', 'Currency',  'BalanceSheet', 'IncomeStatement', 'Equity',
       'Zone', 'Pettycash', 'PettycashDeposit', 'PettycashWithdrawal',
        'CashAccount', 'TempcashAccount','Expense');
    var $paginate = array();

    function beforeFilter() {
        $this->__validateLoginStatus();
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
            
            $message = 'You do not have the required privileges to view this page';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }
    function __validateUserType3() {

        $userType = $this->Session->read('userDetails.usertype_id');
        if ($userType != 1 && $userType != 8) {
            
            $message = 'You do not have the required privileges to view this page';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }

    function index() {
        $this->__validateUserType3();
    }

    protected function loadEssentials() {
    // load vendor class
    App::import('Vendor', 'PHPExcel/PHPExcel');
    if (!class_exists('PHPExcel')) {
        throw new CakeException('Vendor class PHPExcel not found!');
    }
}
    public function create_audit_trail() {
        $this->__validateUserType();
        $title_for_layout = 'Admin / audit trail review';
        $formTitle = 'ADMIN / AUDIT TRAIL REVIEW';
        $audit_search_record;
        $record = $this->Organization->find('all', array(
            'conditions' => array('Organization.status' => 'Approved'),
            'recursive' => -1
        ));
        $audit_type_record = $this->Sysaudit->find('all', array(
            'fields' => array('DISTINCT Sysaudit.AUDITTYPE')
                )
        );
        $staff_record = $this->EhmisUser->find('all');
        $status_msg = "";

        $staff_record_audit = $this->EhmisUser->find('all', array(
            "order" => array(
                "EhmisUser.FIRSTNAME" => "ASC"
            )
        ));
        $staff = $this->Employee->find('all');
        $dependant_record_list = $this->EhmisUser->find('all', array(
            'conditions' => array('EhmisUser.USER_TYPE_ID' => 2)));

     //Search Audit Trail
        if ($this->request->is('post') ) {
            //pr($_POST);
            $btn_review = "audit_search";
            $startdate = $_POST['STARTYEAR'] . "-" . $_POST['STARTMONTH'] . "-" . $_POST['STARTDAY'];
            $enddate = $_POST['ENDYEAR'] . "-" . $_POST['ENDMONTH'] . "-" . $_POST['ENDDAY'];
             $AUDITTYPE = $_POST['AUDITTYPE'];
//            $audit_search_record = $this->Sysaudit->find('all', array(
//                'conditions' => array('Sysaudit.AUDITDATE BETWEEN ? AND ?' => array($startdate, $enddate),
//                    'Sysaudit.AUDITTYPE' => $_POST['AUDITTYPE']
////                    'Sysaudit.EHMIS_USER_ID' => $_POST['EHMIS_USER_ID']
//                )
//            ));
            $this->redirect(array('controller' => 'Settings', 'action' => 'list_audit_trail',$startdate,$enddate,$AUDITTYPE));
           
        }

        $this->set(compact('formTitle', 'title_for_layout', 'status_msg', 'audit_type_record', 'staff_record_audit', 'audit_search_record', 'btn_review', 'audit_search_record', 'staff', 'record', 'staff_record', 'dependant_record_list'));
    }
    
public function list_audit_trail($startdate = null,$enddate =null,$AUDITTYPE=null) {
    $this->__validateUserType();
        $title_for_layout = 'Admin / audit trail review';
        $formTitle = 'ADMIN / AUDIT TRAIL REVIEW';
        $audit_search_record;
        $record = $this->Organization->find('all', array(
            'conditions' => array('Organization.status' => 'Approved'),
            'recursive' => -1
        ));
        $audit_type_record = $this->Sysaudit->find('all', array(
            'fields' => array('DISTINCT Sysaudit.AUDITTYPE')
                )
        );
        $staff_record = $this->EhmisUser->find('all');
        $status_msg = "";

        $staff_record_audit = $this->EhmisUser->find('all', array(
            "order" => array(
                "EhmisUser.FIRSTNAME" => "ASC"
            )
        ));
        $staff = $this->Employee->find('all');
        $dependant_record_list = $this->EhmisUser->find('all', array(
            'conditions' => array('EhmisUser.USER_TYPE_ID' => 2)));

        
         $this->paginate = array('conditions' => array('Sysaudit.AUDITDATE BETWEEN ? AND ?' => array($startdate, $enddate),
                    'Sysaudit.AUDITTYPE' => $AUDITTYPE),
            'limit' => 20);
        $audit_search_record = $this->paginate('Sysaudit');
            if (empty($audit_search_record)) {
                $status_msg = "No Audit Record Available Currently";
            }
       


        //echo $this->Sysaudit->getLastQuery();
        // pr ($audit_search_record);

        $this->set(compact('formTitle', 'title_for_layout', 'status_msg', 'audit_type_record', 'staff_record_audit', 'audit_search_record', 'btn_review', 'audit_search_record', 'staff', 'record', 'staff_record', 'dependant_record_list'));
    }

    function financialPosition1() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['ayear'])) {
                $ayear = $_POST['ayear'];

                $shopName = $this->Session->read('shopName');
                $accday = $this->Session->read('accYear');
                $day = date('d', strtotime($accday)); //get from session. using temporay value
                $month = date('m', strtotime($accday)); //get from session. using temporay value
                $currency = $this->Session->read('shopCurrency');
                if ($month > 1) {
                    $fyear = $ayear + 1;
                    $balsheet_data = $this->BalanceSheet->aReport($day, $month, $month, $ayear, $fyear, $currency, $shopName);
                } else {
                    $fyear = $ayear;
                    $date = new DateTime($accday);
                    $date->add(new DateInterval('P1Y'));
                    $smonth = $date->format('m');

                    $balsheet_data = $this->BalanceSheet->aReport($day, $month, $smonth, $ayear, $fyear, $currency, $shopName);
                }


                return json_encode($balsheet_data);
            }
        }
    }

    function financialPosition() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['syear'])) {
                $syear = $_POST['syear'];
                $eyear = $_POST['eyear'];
                $s_month = $_POST['smonth'];
                $e_month = $_POST['emonth'];
                $shopName = $this->Session->read('shopName');
                $accday = $this->Session->read('accYear');
                $day = date('d', strtotime($accday));
                $currency = $this->Session->read('shopCurrency');
                $balsheet_data = $this->BalanceSheet->fpReport($day, $s_month, $e_month, $syear, $eyear, $currency, $shopName);
                return json_encode($balsheet_data);
//          $itemLsts = json_encode($itemLst);
//          return $itemLsts;
            }
        }
    }

    function incomeStatement1() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['iyear'])) {
                $ayear = $_POST['iyear'];

                $shopName = $this->Session->read('shopName');
                $accday = $this->Session->read('accYear');
                $day = date('d', strtotime($accday)); //get from session. using temporay value
                $month = date('m', strtotime($accday)); //get from session. using temporay value
                $icurrency = $this->Session->read('shopCurrency');
                if ($month > 1) {
                    $fyear = $ayear + 1;
                    $inStatement_data = $this->IncomeStatement->isReport($day, $month, $month, $ayear, $fyear, $icurrency, $shopName);
                } else {
                    $fyear = $ayear;
                    $date = new DateTime($accday);
                    $date->add(new DateInterval('P1Y'));
                    $smonth = $date->format('m');
                    $inStatement_data = $this->IncomeStatement->isReport($day, $month, $smonth, $ayear, $fyear, $icurrency, $shopName);
                }


                return json_encode($inStatement_data);
            }
        }
    }

    function incomeStatement() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['iyear'])) {

                $iyear = $_POST['iyear'];
                $toyear = $_POST['toyear'];
                $is_month = $_POST['ismonth'];
                $ie_month = $_POST['iemonth'];
                $shopName = $this->Session->read('shopName');
                $icurrency = $this->Session->read('shopCurrency');
                $accday = $this->Session->read('accYear');
                $iday = date('d', strtotime($accday));
                $inStatement_data = $this->IncomeStatement->isReport($iday, $is_month, $ie_month, $iyear, $toyear, $icurrency, $shopName);
                return json_encode($inStatement_data);
//          $itemLsts = json_encode($itemLst);
//          return $itemLsts;
            }
        }
    }

    function ownersEquity1() {
        $setupResults = $this->Setting->getSetup();

        $this->set(compact('setupResults'));

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['oyear'])) {
                $ayear = $_POST['oyear'];

                $shopName = $this->Session->read('shopName');
                $accday = $this->Session->read('accYear');
                $day = date('d', strtotime($accday)); //get from session. using temporay value
                $month = date('m', strtotime($accday)); //get from session. using temporay value
                $icurrency = $this->Session->read('shopCurrency');
                $owner = $this->Session->read('owner');

                if ($month > 1) {
                    $fyear = $ayear + 1;

                    $eqOwner_data = $this->Equity->eqReport($day, $month, $month, $ayear, $fyear, $icurrency, $shopName, $owner);
                } else {

                    $date = new DateTime($accday);
                    $date->add(new DateInterval('P1Y'));
                    $smonth = $date->format('m');
                    $eqOwner_data = $this->Equity->eqReport($day, $month, $smonth, $ayear, $ayear, $icurrency, $shopName, $owner);
                }


                return json_encode($eqOwner_data);
            }
        } else {
            $feedback = array('feedback' => 'unsuccessful', 'message' => 'Only Post Data Can Be handled');
            return json_encode($feedback);
        }
    }

    function ownersEquity() {
        
    }

    function activeAccounts() {
        $this->__validateUserType();
        $this->paginate('Order');

        //$accounts =  $this->Order->find('all', array('group' => array('Order.customer_id'),'conditions' => array('Order.balance >' => 0,'status' => 'Approved','delivery' => 'Delivered'),'fields' => array('DISTINCT Order.customer_id', 'SUM(Order.balance) As bal','Order.amount_paid','Customer.fullname','Customer.mobile_no','Order.last_date')));
        $accounts = $this->Order->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('Order.balance >' => 0, 'status' => 'Approved', 'delivery' => 'Delivered')));
        if ($accounts) {
            // pr($accounts);
            $this->set('accounts', $accounts);
        }
    }

    function expectedInstallment() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $accounts = $this->Order->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('due_date >=' => $start_date), array('due_date <=' => $end_date), array('Order.balance >' => 0), array('status' => 'Approved'), array('delivery' => 'Delivered')))));



            $total = $this->Order->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('due_date >=' => $start_date), array('due_date <=' => $end_date), array('Order.balance >' => 0), array('status' => 'Approved'), array('delivery' => 'Delivered'))), 'fields' => array("SUM((Order.amount_paid)) as 'paidtotal'", "SUM((Order.mthly_install)) as 'balinstalmt'")));
            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }
        }
        //date('F d, Y',$enewdate);
    }

    function expectedInstallment1() {
        $this->__validateUserType3();
        $this->paginate('Expectedinstallment');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Expectedinstallment']['begin_date']['day'];
            $smonth = $this->request->data['Expectedinstallment']['begin_date']['month'];
            $syear = $this->request->data['Expectedinstallment']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Expectedinstallment']['finish_date']['day'];
            $emonth = $this->request->data['Expectedinstallment']['finish_date']['month'];
            $eyear = $this->request->data['Expectedinstallment']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
           // $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $accounts = $this->Expectedinstallment->find('all', array('order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Expectedinstallment.due_date >=' => $start_date), array('Expectedinstallment.due_date <=' => $end_date), array('Order.balance >' => 0),array('Order.payment_status !=' => 'full_payment'),array('Expectedinstallment.balance >' => 0), array('Order.status' => 'Approved'), array('Expectedinstallment.payment_status !=' => 'full_payment')))));



            $total = $this->Expectedinstallment->find('all', array('order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Expectedinstallment.due_date >=' => $start_date), array('Expectedinstallment.due_date <=' => $end_date), array('Order.balance >' => 0),array('Order.payment_status !=' => 'full_payment'), array('Order.status' => 'Approved'), array('Expectedinstallment.payment_status !=' => 'full_payment'))), 'fields' => array("SUM((Expectedinstallment.paid_install)) as paidtotal", "SUM((Expectedinstallment.expected_installment)) as instalmt", "SUM((Expectedinstallment.balance)) as bal", "SUM((Expectedinstallment.default_interest)) as interest")));
            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }
        }
        //date('F d, Y',$enewdate);
    }

    function expectedInstallmentZone() {
        $this->__validateUserType();
        $this->paginate('Order');
        $this->set('zones', $this->Zone->find('list'));
        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            $zoneid = $this->request->data['Order']['zone_id'];

            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }
            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $accounts = $this->Order->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date), array('Order.balance >' => 0), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Order.zone_id' => $zoneid)))));


            $total = $this->Order->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date), array('Order.balance >' => 0), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Order.zone_id' => $zoneid))), 'fields' => array("SUM((Order.balance)) as 'baltotal'", "SUM((Order.mthly_install)) as 'balinstalmt'"), 'group' => array('Order.zone_id')));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }
        }
    }

    function expectedInstallmentZone1() {
        $this->__validateUserType3();
        $this->paginate('Expectedinstallment');
        $this->set('zones', $this->Zone->find('list'));

        if ($this->request->is('post')) {

            $sday = $this->request->data['Expectedinstallment']['begin_date']['day'];
            $smonth = $this->request->data['Expectedinstallment']['begin_date']['month'];
            $syear = $this->request->data['Expectedinstallment']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Expectedinstallment']['finish_date']['day'];
            $emonth = $this->request->data['Expectedinstallment']['finish_date']['month'];
            $eyear = $this->request->data['Expectedinstallment']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            //$date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            $zoneid = $this->request->data['Expectedinstallment']['zone_id'];

            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }
            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $accounts = $this->Expectedinstallment->find('all', array('order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Expectedinstallment.due_date >=' => $start_date), array('Expectedinstallment.due_date <=' => $end_date), array('Order.balance >' => 0),array('Order.payment_status !=' => 'full_payment'), array('Order.status' => 'Approved'), array('Expectedinstallment.balance >' => 0), array('Expectedinstallment.payment_status !=' => 'full_payment'), array('Order.zone_id' => $zoneid)))));

//, 'group' => array('Expectedinstallment.zone_id')
            $total = $this->Expectedinstallment->find('all', array('order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Expectedinstallment.due_date >=' => $start_date), array('Expectedinstallment.due_date <=' => $end_date), array('Order.balance >' => 0), array('Order.payment_status !=' => 'full_payment'),array('Expectedinstallment.balance >' => 0), array('Order.status' => 'Approved'), array('Expectedinstallment.payment_status  !=' => 'full_payment'), array('Order.zone_id' => $zoneid))), 'fields' => array("SUM((Expectedinstallment.balance)) as baltotal", "SUM((Expectedinstallment.expected_installment)) as instalmt", "SUM((Expectedinstallment.paid_install)) as paid", "SUM((Expectedinstallment.default_interest)) as interest")));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }
        }
    }

    
    public function customerpaymentDetails($order_id = null, $custname = null, $amount_paid = null, $balance = null) {
        $this->__validateUserType3();
        $this->paginate('Payment');

        $last_payment = $this->Expectedinstallment->find('all', array('conditions' => array('Expectedinstallment.order_id' => $order_id), 'order' => array('Expectedinstallment.id ASC')));
        if ($last_payment) {


            $this->set('data', $last_payment);
            $this->set('order_id', $order_id);
            $this->set('custname', $custname);
            $this->set('amount', $amount_paid);
            $this->set('balance', $balance);
        } else {

            $message = 'Unable To Load Payment Data';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
        }
    }
    
    public function customerpaymentDetails1() {
        $this->__validateUserType3();
        $data = $this->paginate('Customer');
        $this->set('customer', $data);
   
        $check = $this->Session->check('cscust');
        if ($check) {
            $cust = $this->Session->read('cscust');
            $this->set('cust', $cust);
        }
        $check = $this->Session->check('cscusts');
        if ($check) {
            $custs = $this->Session->read('cscusts');
            $this->set('customer', $custs);
        }
    }

    
    public function searchOrder($sorder = Null) {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $custname = $this->request->data['order_search'];
            $customer = $this->Customer->find('all', array('conditions' => array('OR' => array(array('Customer.surname LIKE' => "%$custname%"), array('Customer.first_name LIKE' => "%$custname%"), array('Customer.fullname LIKE' => "%$custname%")))));

            if ($customer) {
//            $cust = $this->Session->write('cust',$customer);

                $this->Session->write('cscusts', $customer);
                $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
            } else {
                $this->Session->write('Sorry Customer Not Found');
                $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
            }
        } else {

            $customers = $this->Customer->find('all', array('conditions' => array('Customer.id' => $sorder)));
            $customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => $sorder)));
            if ($customers) {
                $check = $this->Session->check('cscusts');
                if ($check) {
                    $this->Session->delete('cscusts');
                }
                $check = $this->Session->check('cscust');
                if ($check) {
                    $this->Session->delete('cscust');
                }
                $check = $this->Session->check('cscustID');
                if ($check) {
                    $this->Session->delete('cscustID');
                }
                $cust = $this->Session->write('cscusts', $customers);
                $this->Session->write('cscust', $customer);
                $this->Session->write('cscustID', $sorder);
                $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
            } else {

                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
            }
        }

//        
    }
        public function clearOrdersearchSessions() {
        $check = $this->Session->check('cscust');
        if (!$check) {
            $message = 'No Customer selected';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails1'));
        }



        $this->redirect(array('controller' => 'Reports', 'action' => 'customerpaymentDetails2'));
    }

    public function customerpaymentDetails2() {

        $this->__validateUserType3();
        $this->paginate('Order');
//        $this->set('data', $data);

        $check = $this->Session->check('cscust');
        if ($check) {
            $order = $this->Session->read('cscust');
            $order_id = $order['Customer']['id'];
            $order_details = $this->Order->find('all', array('conditions' => array('Order.customer_id' => $order_id, 'Order.status !=' => 'Deleted')));
            if ($order_details) {
                $this->set('data', $order_details);
                
                $this->Session->delete('cscust');
                $this->Session->delete('cscusts');
            } else {
                $this->redirect(array('controller' => 'Orders', 'action' => 'customerpaymentDetails1'));
            }
        }
//        $check = $this->Session->check('order');
//        if ($check) {
//            $order = $this->Session->read('order');
//
//            $this->set('data', $order);
//        }
    }




    function groupSales() {
        $this->__validateUserType();
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => 4))));
        $this->paginate('OrdersItem');
        if ($this->request->is('post')) {
            $userid = $this->request->data['Order']['user_id'];
            $user = $this->User->find('first', array('conditions' => array('User.id' => $userid)));
            $month = $this->request->data['Order']['month']['month'];
            $year = $this->request->data['Order']['year']['year'];

            if ($user) {
                $username = $user['User']['username'];
                $this->set('sales_name', $username);
                $datestart = strtotime($year . "-" . $month . "-" . "01");
                $start_date = date('Y-m-d', $datestart);
                $dateend = date('Y-m-t', $datestart);
                $date = new DateTime($dateend);
//            $date->add(new DateInterval('P1D'));
             $dateend = $date->format('Y-m-d');
                $month_year = date('F Y', $datestart);
                $this->set('date', $month_year);
                $accounts = $this->OrdersItem->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $dateend), array('Order.sales_person' => $username), array('status' => 'Approved'), array('delivery' => 'Delivered')))));



                $total = $this->OrdersItem->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $dateend), array('Order.sales_person' => $username), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((Item.selling_price * OrdersItem.quantity)) as 'paidtotal'"), 'group' => array('Order.sales_person')));

                if ($accounts) {

                    $this->set('accounts', $accounts);
                    if ($total) {

                        $this->set('total', $total);
                    }
                }
                
                
            }
        }
    }

//    function groupSales1() {
//        $this->set('users', $this->User->find('list'));
//        
//    }

    function salesExecClient() {
        $this->__validateUserType3();
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => array(4,3,7,1)))));
        $this->paginate('OrdersItem');
        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');

           // $customer_id = $this->request->data['OrdersItem']['customer'];
            $sales_pers_id = $this->request->data['OrdersItem']['user_id'];
            $sales_pers = $this->User->find('first', array('conditions' => array('User.id' => $sales_pers_id)));
            if ($sales_pers) {
                $username = $sales_pers['User']['username'];
                $sales_pers_id = $sales_pers['User']['id']; 
                if ($sales_pers_id != "" && !is_null($sales_pers_id)) {

                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.sales_person' => $username), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.sales_person' => $username), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((Item.selling_price * OrdersItem.quantity)) as 'total'"), 'group' => array('Order.sales_person')));
                    if ($accounts) {
                       // $this->set('customer', $accounts[0]['Customer']['fullname']);
                        
                    $this->set('accounts', $accounts);
                        if ($total) {
                            $this->set('total', $total);
                        }
                    }
                    
                    $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.sales_person' => $username), array('Sale.status' => 'alive')))));
                    // array('Sale.user_id' => $sales_pers_id),
                    
                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.sales_person' => $username), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'total'"), 'group' => array('Sale.user_id')));
                    // array('Sale.user_id' => $sales_pers_id),
                   if ($sales) {
                      //  $this->set('customer', $accounts[0]['Client']['client_name']);
                       $this->set('sales', $sales);
                        if ($sales_tot) {
                            $this->set('salestotal', $sales_tot);
                        }
                    }
                    
                } elseif($sales_pers_id == "" || is_null($sales_pers_id)) {


                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((Item.selling_price * OrdersItem.quantity)) as 'total'"), 'group' => array('Order.sales_person')));
                

                if ($accounts) {

                    $this->set('accounts', $accounts);
                    if ($total) {
                        $this->set('total', $total);
                    }
                }
                  $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive')))));
                    
                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'stotal'"), 'group' => array('SalesItem.client_id')));
                    
                   if ($sales) {
                            
                       // $this->set('customer', $accounts[0]['Client']['client_name']);
                        $this->set('sales', $sales);
                        if ($sales_tot) {
                            $this->set('salestotal', $sales_tot);
                        }
                    }
                }
                $newstart_date = date('d-M-Y', $snewdate);
                $newend_date = date('d-M-Y', $enewdate);
                $this->set('start_date', $newstart_date);
                $this->set('end_date', $newend_date);
            }
        }
    }

    
    function zonalSales() {
        $this->__validateUserType3();

        $this->set('zones', $this->Zone->find('list'));
        $this->paginate('OrdersItem');
        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');

           // $customer_id = $this->request->data['OrdersItem']['customer'];
            $zone_id = $this->request->data['OrdersItem']['zone_id'];
                            if ($zone_id != "" && !is_null($zone_id)) {
            $zone_details = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zone_id)));
            if ($zone_details) {
                $zone_name = $zone_details['Zone']['zone'];
                $zone_id = $zone_details['Zone']['id']; 


                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.zone_id' => $zone_id), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.zone_id' => $zone_id), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((OrdersItem.unit_price * OrdersItem.quantity)) as 'total'")));
                    if ($accounts) {
                       // $this->set('customer', $accounts[0]['Customer']['fullname']);
                        
                    $this->set('accounts', $accounts);
                        if ($total) {
                            $this->set('total', $total);
                        }
                    }
                    
//                    $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.zone_id' => $zone_id), array('Sale.status' => 'alive')))));
//                    // array('Sale.user_id' => $sales_pers_id),
//                    
//                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.zone_id' => $zone_id), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'total'"), 'group' => array('Sale.zone_id')));
//                    // array('Sale.user_id' => $sales_pers_id),
//                   if ($sales) {
//                      //  $this->set('customer', $accounts[0]['Client']['client_name']);
//                       $this->set('sales', $sales);
//                        if ($sales_tot) {
//                            $this->set('salestotal', $sales_tot);
//                        }
//                    }
                    
                } 
            }elseif($zone_id == "" || is_null($zone_id)) {


                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((OrdersItem.unit_price * OrdersItem.quantity)) as 'total'")));
                

                if ($accounts) {

                    $this->set('accounts', $accounts);
                    if ($total) {
                        $this->set('total', $total);
                    }
                }
//                  $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive')))));
//                    
//                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'stotal'"), 'group' => array('SalesItem.client_id')));
//                    
//                   if ($sales) {
//                            
//                       // $this->set('customer', $accounts[0]['Client']['client_name']);
//                        $this->set('sales', $sales);
//                        if ($sales_tot) {
//                            $this->set('salestotal', $sales_tot);
//                        }
//                    }
                }
            
                $newstart_date = date('d-M-Y', $snewdate);
                $newend_date = date('d-M-Y', $enewdate);
                $this->set('start_date', $newstart_date);
                $this->set('end_date', $newend_date);
        }
    }

    
    public function precustomerpaymentDetails() {
        $this->__validateUserType3();
        $data = $this->paginate('Customer');
        $this->set('customer', $data);
//        
        $check = $this->Session->check('precust');
        if ($check) {
            $cust = $this->Session->read('precust');
            $this->set('cust', $cust);
        }
        $check = $this->Session->check('precusts');
        if ($check) {
            $custs = $this->Session->read('precusts');
            $this->set('customer', $custs);
        }
    }
    
         public function clearpresearchSessions() {
        $check = $this->Session->check('precust');
        if (!$check) {
            $message = 'No Customer selected';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
        }



        $this->redirect(array('controller' => 'Reports', 'action' => 'customerOrderHistory'));
    }

    
    public function searchCustomerDetails($sorder = Null) {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $custname = $this->request->data['order_search'];
            $customer = $this->Customer->find('all', array('conditions' => array('OR' => array(array('Customer.surname LIKE' => "%$custname%"), array('Customer.first_name LIKE' => "%$custname%"), array('Customer.fullname LIKE' => "%$custname%")))));

            if ($customer) {
//            $cust = $this->Session->write('cust',$customer);

                $this->Session->write('precusts', $customer);
                $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
            } else {
                $this->Session->write('Sorry Customer Not Found');
                $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
            }
        } else {

            $customers = $this->Customer->find('all', array('conditions' => array('Customer.id' => $sorder)));
            $customer = $this->Customer->find('first', array('conditions' => array('Customer.id' => $sorder)));
            if ($customers) {
                $check = $this->Session->check('precusts');
                if ($check) {
                    $this->Session->delete('precusts');
                }
                $check = $this->Session->check('precust');
                if ($check) {
                    $this->Session->delete('precust');
                }
                $check = $this->Session->check('precustID');
                if ($check) {
                    $this->Session->delete('precustID');
                }
                $cust = $this->Session->write('precusts', $customers);
                $this->Session->write('precust', $customer);
                $this->Session->write('precustID', $sorder);
                $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
            } else {

                $message = 'Sorry, Customer Not Found';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
            }
        }

//        
    }
    


    function customerOrderHistory($order_id = null,$customer_id = null ,$custname = null, $amount_paid = null, $balance = null) {
        $this->__validateUserType3();
        $this->paginate('OrdersItems');

        $last_payment = $this->OrdersItem->find('all', array('conditions' => array('OrderItems.customer_id' => $order_id), 'order' => array('OrdersItems.order_id ASC')));
        if ($last_payment) {


            $this->set('data', $last_payment);
            $this->set('order_id', $order_id);
            $this->set('custname', $custname);
            $this->set('amount', $amount_paid);
            $this->set('balance', $balance);
        } else {

            $message = 'Unable To Load Payment Data';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Reports', 'action' => 'precustomerpaymentDetails'));
        }
    }

    function itemSalesBranch() {
        $this->__validateUserType3();
        $this->set('users', $this->User->find('list', array('conditions' => array('User.usertype_id' => array(4,3,7,1)))));
          $this->set('zones', $this->Zone->find('list'));
          $items = $this->Item->find('list', array(
   'conditions' => array('Item.brand !=' => '','Item.brand !=' => NUll,'Item.brand NOT LIKE' => '%test%'),
    'fields'     => array('Item.id','Item.brand'),
    'group' => array('Item.brand')
));
$this->set(compact('items'));

        $this->paginate('OrdersItem');
        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');

             $zoneid = $this->request->data['OrdersItem']['zone_id'];
             
             $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid),'recursive' => '-1'));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }
            $item_id = $this->request->data['OrdersItem']['brand'];
            
               if ($item_id != "" && $item_id != null) {
                    
            $item_data = $this->Item->find('first', array('conditions' => array('Item.id' => $item_id),'recursive' => '-1'));
            if($item_data){
                $brand = $item_data['Item']['brand'];
                
                $brand_array = array('Item.brand LIKE' => '%'.$brand.'%');
            }else{
                $brand_array = "";
            }
            
            }else{
                $brand_array = "";
            }
            
//            $sales_pers_id = $this->request->data['OrdersItem']['user_id'];
//            
//            
//                if ($sales_pers_id != "" && $sales_pers_id != null) {
//                    $sales_pers = $this->User->find('first', array('conditions' => array('User.id' => $sales_pers_id),'recursive' => '-1'));
//            if ($sales_pers) {
//                $username = $sales_pers['User']['username'];
//            }
//               $username = array('Order.sales_person' => $username);
//               $sales_user = array('Sale.user_id' => $sales_pers_id);
//                }else{
//                $username = "";
//                $sales_user = "";
//            }
            
                if ($zoneid != "" && $zoneid != null) {

                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Order.zone_id' => $zoneid), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))),'fields' => array('Item.item','SUM(OrdersItem.quantity) as quuant','Item.brand'),'group' => array('Item.item','Item.brand')));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Order.zone_id' => $zoneid), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM(OrdersItem.quantity) as 'total'")));
                    if ($accounts) {
                        if ($total) {
                            $this->set('total', $total);
                        }
                    }
                    
                    $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Client.zone_id' => $zoneid),array('Sale.status' => 'alive'))),'fields' => array('Item.item','SUM(SalesItem.quantity) as salequuant','Item.brand'),'group' => array('Item.item','Item.brand')));
                    
                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'),$brand_array,array('Client.zone_id' => $zoneid), array('Sale.status' => 'alive'))),'fields' => array("SUM(SalesItem.quantity) as 'stotal'")));
                    
                   if ($sales) {
                      //  $this->set('customer', $accounts[0]['Client']['client_name']);
                       $this->set('sales', $sales);
                        if ($sales_tot) {
                            $this->set('salestotal', $sales_tot);
                        }
                    }
                    
                } else {


                    $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))),'fields' => array('Item.item','SUM(OrdersItem.quantity) as quuant','Item.brand'),'group' => array('Item.item','Item.brand')));

                    $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM(OrdersItem.quantity) as 'total'")));
                }

                if ($accounts) {

                    $this->set('accounts', $accounts);
                    if ($total) {
                        $this->set('total', $total);
                    }
                }
                  $sales = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'),$brand_array ,array('Sale.status' => 'alive'))),'fields' => array('Item.item','SUM(SalesItem.quantity) as salequuant','Item.brand'),'group' => array('Item.item','Item.brand')));
                    
                    $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date),array('Item.brand NOT LIKE' => '%test%'), $brand_array,array('Sale.status' => 'alive'))), 'fields' => array("SUM(SalesItem.quantity) as 'stotal'")));
                    
                   if ($sales) {
                       // $this->set('customer', $accounts[0]['Client']['client_name']);
                        $this->set('sales', $sales);
                        if ($sales_tot) {
                            $this->set('salestotal', $sales_tot);
                        }
                    }

                $newstart_date = date('d-M-Y', $snewdate);
                $newend_date = date('d-M-Y', $enewdate);
                $this->set('start_date', $newstart_date);
                $this->set('end_date', $newend_date);
            
        }
    }


    
    function getExecCustomers() {
        $this->__validateUserType();
        $this->autoRender = false;


        if (!empty($_POST['sales_person'])) {
            $execid = $_POST['sales_person'];

            $sales_pers = $this->User->find('first', array('conditions' => array('User.id' => $execid)));

            if ($sales_pers) {
                $sales_name = $sales_pers['User']['username'];
                $customers = $this->Order->find('all', array('group' => array('Order.customer_id'), 'conditions' => array('Order.sales_person' => $sales_name), 'fields' => array('DISTINCT Order.customer_id', 'Customer.id', 'Customer.fullname', 'Order.sales_person')));
                if ($customers) {
                    return json_encode(array('status' => 'ok', 'data' => $customers));
                } else {

//                             $message = 'No Customers Found for Sales Executive';
//                              $this->Session->write('bmsg', $message);
                    return json_encode(array('status' => 'fail'));
                }
            } else {
//                    $message = 'Unable to Retrieve Sales Executive Details';
//                              $this->Session->write('emsg', $message);
                return json_encode(array('status' => 'fail'));
            }
        } else {
//                    $message = 'Unable to Retrieve Sales Executive Details';
//                              $this->Session->write('emsg', $message);
            return json_encode(array('status' => 'postfail'));
        }
    }

    function salesExecDefaults() {
        $this->__validateUserType();
        $this->paginate('Order');
        //date('F d, Y',$enewdate);
        //$accounts =  $this->Order->find('all', array('group' => array('Order.customer_id'),'conditions' => array('Order.balance >' => 0,'status' => 'Approved','delivery' => 'Delivered'),'fields' => array('DISTINCT Order.customer_id', 'SUM(Order.balance) As bal','Order.amount_paid','Customer.fullname','Customer.mobile_no','Order.last_date')));
        $accounts = $this->Order->find('all', array('group' => array('Order.sales_person'), 'fields' => array('DISTINCT Order.sales_person', 'SUM(Order.customer_id) As customers', 'Order.balance', 'SUM(Order.balance) As bal'), 'conditions' => array('AND' => array(array('status' => 'Approved'), array('delivery' => 'Delivered'), array('Order.balance >' => 0))), 'Order' => array('bal' => 'DESC')));

        if ($accounts) {

            $this->set('accounts', $accounts);
        }
    }

    function summPaymentCollector() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');

            $ids = $this->Payment->find('all', array('group' => array('Payment.order_id'), 'fields' => array('Payment.id'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'Order' => array('paid' => 'DESC')));


            $totalids = $this->Payment->find('all', array('fields' => array('Payment.id'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'Order' => array('paid' => 'DESC')));

            if ($ids) {

                $paymentids = array();
                foreach ($ids as $id) {
                    array_push($paymentids, $id['Payment']['id']);
                }

                $totalpaymentids = array();
                foreach ($totalids as $value) {
                    array_push($totalpaymentids, $value['Payment']['id']);
                }

                $accounts = $this->Payment->find('all', array('group' => array('Payment.user_id'), 'fields' => array('User.username', 'Payment.user_id', 'Order.id', 'SUM(Order.hp_price) As tothp'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $paymentids))), 'Order' => array('paid' => 'DESC')));


                $collectedaccounts = $this->Payment->find('all', array('group' => array('Payment.user_id'), 'fields' => array('User.username', 'Payment.user_id', 'Order.id', 'SUM(Payment.amount) As paid'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $totalpaymentids))), 'Order' => array('paid' => 'DESC')));

                $total = $this->Payment->find('all', array('fields' => array('SUM(Payment.amount) As paid', 'SUM(Order.hp_price) As tothpprice'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $totalpaymentids))), 'Order' => array('paid' => 'DESC')));


                $totalsales = $this->Payment->find('all', array('fields' => array('SUM(Payment.amount) As paid', 'SUM(Order.hp_price) As tothpprice'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $paymentids))), 'Order' => array('paid' => 'DESC')));

                if ($accounts) {
                    $this->set('accounts', $accounts);
                    if ($collectedaccounts) {
                        $this->set('collectedaccounts', $collectedaccounts);
                    }

                    if ($total) {

                        $this->set('total', $total);
                    }
                    if ($totalsales) {

                        $this->set('totalsales', $totalsales);
                    }
                }
            }
            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function salesExecSummary() {
        $this->__validateUserType3();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
          // $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            

            $accounts = $this->OrdersItem->find('all', array('group' => array('Order.sales_person'), 'fields' => array('Order.sales_person', 'SUM(OrdersItem.unit_price) As sales'), 'conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'Order' => array('paid' => 'DESC')));


            $total = $this->OrdersItem->find('all', array('fields' => array('SUM(OrdersItem.unit_price) As totalhpprice'), 'conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

            if ($accounts) {
                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function purchases() {
        $this->__validateUserType();
        $this->paginate('OrdersItem');

        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            

            $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));

            $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((OrdersItem.hp_price)) as 'total'")));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    
    function monthlySalesSummary() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            //$date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            
             $grand_htotal = 0;
            $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM(Item.selling_price) as htotal",'CONCAT(YEAR(Order.order_date),"-",MONTH(Order.order_date)) as sdate','Order.order_date'),'group' => array('sdate'),'order' => array('sdate')));

            
            $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((Item.selling_price)) as total")));

          //  $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))),'fields' => array('SUM(Item.selling_price) As totalhpprice')));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                       foreach($total as $val){
                    $grand_htotal += $val[0]['total'];
                }
                
                    $this->set('grand_htotal', $grand_htotal);
                }
            }
            
            $grand_stotal = 0;
            $saccounts = $this->Sale->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array('Sale.sale_date',"SUM((Sale.total_cost)) as 'stotal'",'CONCAT(YEAR(Sale.sale_date),"-",MONTH(Sale.sale_date)) as sdate'),'group' => array('sdate'),'order' => array('Sale.sale_date')));

            //$stotal = $this->Sale->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((Sale.total_cost)) as 'sstotal'")));

            if ($saccounts) {

                $this->set('saccounts', $saccounts);
                //if ($stotal) {
                 //   $this->set('stotal', $stotal);
//                    foreach($saccounts as $val){
//                    $grand_stotal += $val[0]['stotal'];
//                    $this->set('grand_stotal', $grand_stotal);
//                }
                
               // }
                
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }
    
    function salesDetails() {
        $this->__validateUserType();
        $this->paginate('OrdersItem');

        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            
            $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array('Order.invoice_no', 'Item.item', 'OrdersItem.customer_id', 'Customer.fullname', 'OrdersItem.quantity', 'Item.selling_price', 'OrdersItem.unit_price', 'OrdersItem.cost_price', 'OrdersItem.unit_price', 'OrdersItem.total_cost', 'OrdersItem.hp_price', 'OrdersItem.profit', 'Order.order_date')));

            $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((OrdersItem.quantity)) as 'total_qty'", "SUM((OrdersItem.cost_price * OrdersItem.quantity)) as 'total_tcost'", "SUM((OrdersItem.hp_price)) as 'total_hp_price'", "SUM((OrdersItem.hp_price - (OrdersItem.cost_price * OrdersItem.quantity))) as 'total_profit'")));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function suppliers() {
        $this->__validateUserType();
        $this->paginate('Supplierinvoice');

        $this->set('suppliers', $this->Supplier->find('list'));
        if ($this->request->is('post')) {

            $sday = $this->request->data['Supplierinvoice']['from']['day'];
            $smonth = $this->request->data['Supplierinvoice']['from']['month'];
            $syear = $this->request->data['Supplierinvoice']['from']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Supplierinvoice']['to']['day'];
            $emonth = $this->request->data['Supplierinvoice']['to']['month'];
            $eyear = $this->request->data['Supplierinvoice']['to']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            
             
            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
            $this->set('enew_date',$enewdate);
            $this->set('snewdate',$snewdate);
             
             $supplier_id = $this->request->data['Supplierinvoice']['supplier_id'];
            $sales_pers = $this->Supplier->find('first', array('conditions' => array('Supplier.id' => $supplier_id)));
          if($supplier_id == "" ||$supplier_id == null){
              
              //$supplier = $sales_pers['Supplier']['supplier_name'];

                         $accounts = $this->Item->find('all', array('group' => array('Item.supply_invoiceno'), 'fields' => array('Item.supply_invoiceno', 'Item.supplier_id', 'Item.date_added', 'SUM(Item.cost_price) AS totcost_price'), 'conditions' => array('Item.supply_invoiceno IS NOT NULL')));
                         
           $saccounts = $this->Supplierinvoice->find('all', array('conditions' => array('AND' => array(array('Supplierinvoice.supply_date >=' => $start_date), array('Supplierinvoice.supply_date <=' => $end_date), array('Supplierinvoice.supply_invoiceno IS NOT NULL' ))), 'fields' => array('Supplierinvoice.supply_invoiceno', 'Supplierinvoice.cost_price', 'Supplierinvoice.amountpaid', 'Supplierinvoice.balance','Supplierinvoice.supply_date')));

//            $total = $this->Item->find('all', array('group' => array('Item.supply_invoiceno'),'conditions' => array('AND' => array(array('Supplierinvoice.supply_date >=' => $start_date), array('Supplierinvoice.supply_date <=' => $end_date), array('Supplierinvoice.supplier_id' => $supplier_id))), 'fields' => array("SUM((Supplierinvoice.balance)) as 'bal'", "SUM(Item.cost_price) as 'cost'", "SUM(Supplierinvoice.amountpaid) as 'paid'")));

            if ($accounts) {
               // $this->set('supplier', $supplier);
                $this->set('accounts', $accounts);
                $this->set('saccounts', $saccounts);
//                if ($total) {
//                    $this->set('total', $total);
//                }
            }

          }
           elseif ($sales_pers){
                $supplier = $sales_pers['Supplier']['supplier_name'];

                         $accounts = $this->Item->find('all', array('group' => array('Item.supply_invoiceno'), 'fields' => array('Item.supply_invoiceno', 'Item.supplier_id', 'Item.date_added', 'SUM(Item.cost_price) AS totcost_price'), 'conditions' => array('Item.supplier_id' => $supplier_id, 'Item.supply_invoiceno !=' => null)));
                         
           $saccounts = $this->Supplierinvoice->find('all', array('conditions' => array('AND' => array(array('Supplierinvoice.supply_date >=' => $start_date), array('Supplierinvoice.supply_date <=' => $end_date), array('Supplierinvoice.supplier_id' => $supplier_id))), 'fields' => array('Supplierinvoice.supply_invoiceno', 'Supplierinvoice.cost_price', 'Supplierinvoice.amountpaid', 'Supplierinvoice.balance','Supplierinvoice.supply_date')));

//            $total = $this->Item->find('all', array('group' => array('Item.supply_invoiceno'),'conditions' => array('AND' => array(array('Supplierinvoice.supply_date >=' => $start_date), array('Supplierinvoice.supply_date <=' => $end_date), array('Supplierinvoice.supplier_id' => $supplier_id))), 'fields' => array("SUM((Supplierinvoice.balance)) as 'bal'", "SUM(Item.cost_price) as 'cost'", "SUM(Supplierinvoice.amountpaid) as 'paid'")));

            if ($accounts) {
                $this->set('supplier', $supplier);
                $this->set('accounts', $accounts);
                $this->set('saccounts', $saccounts);
//                if ($total) {
//                    $this->set('total', $total);
//                }
            }

            }else{
                $message = 'Please Select A Valid Supplier';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'suppliers'));
            
            }
        }
    }
    
    function old_salesSummary() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);

            $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array('Order.invoice_no', 'OrdersItem.customer_id', 'Customer.fullname', 'OrdersItem.quantity', 'Order.discount', 'OrdersItem.hp_price', "(Item.selling_price * OrdersItem.quantity) as 'cash'", 'Order.order_date')));

            $total = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.order_date >=' => $start_date), array('Order.order_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'fields' => array("SUM((Item.selling_price * OrdersItem.quantity)) as 'total_cash'", "SUM((Order.discount)) as 'total_discount'", "SUM((OrdersItem.hp_price)) as 'total_hp_price'")));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function trendIndicator() {
        $this->__validateUserType();
    }

    function billsPayable() {
        $this->__validateUserType();
    }

    function billsPaymentSuppliers() {
        $this->__validateUserType();
    }

    function itemsDelivery() {
        $this->__validateUserType();
        $this->paginate('OrdersItem');

        if ($this->request->is('post')) {

            $sday = $this->request->data['OrdersItem']['begin_date']['day'];
            $smonth = $this->request->data['OrdersItem']['begin_date']['month'];
            $syear = $this->request->data['OrdersItem']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['OrdersItem']['finish_date']['day'];
            $emonth = $this->request->data['OrdersItem']['finish_date']['month'];
            $eyear = $this->request->data['OrdersItem']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');

            $accounts = $this->OrdersItem->find('all', array('conditions' => array('AND' => array(array('Order.delivery_date >=' => $start_date), array('Order.delivery_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered')))));


            if ($accounts) {

                $this->set('accounts', $accounts);
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function locStockBal1() {
        $this->__validateUserType();
    }

    function locStockBal2() {
        $this->__validateUserType();
    }

    function suppClosingBal() {
        $this->__validateUserType();
    }

    function allDebtors() {
        $this->__validateUserType();
        $this->paginate('Order');
      $this->set('zones', $this->Zone->find('list'));


        if ($this->request->is('post')) {


//        $accounts = $this->Order->find('all', array('Order' => array('Order.order_date' => 'asc'), 'conditions' => array('Order.balance >' => 0, 'status' => 'Approved', 'delivery' => 'Delivered')));
//
//        $total = $this->Order->find('all', array('conditions' => array('Order.balance >' => 0, 'status' => 'Approved', 'delivery' => 'Delivered'), 'fields' => array("SUM(Order.balance) as 'total_bal'")));
//        if ($accounts) {
//            // pr($accounts);
//            $this->set('accounts', $accounts);
//            if ($total) {
//                $this->set('total', $total);
//            }
//        }
        $zoneid = $this->request->data['Order']['zone_id'];

            if(!is_null($zoneid) && $zoneid != ""){
            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }
            $accounts = $this->Order->find('all', array('order' => array('Customer.fullname' => 'ASC'),'conditions' => array('Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment','Order.zone_id' => $zoneid)));
            
//'Expectedinstallment.due_date <' => date('Y-m-d'),
            
            $total = $this->Order->find('all', array('conditions' => array('Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment','Order.zone_id' => $zoneid), 'fields' => array( "SUM(Order.balance) AS 'total_bal'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }
            
            }elseif(is_null($zoneid) || $zoneid == ""){
                $accounts = $this->Order->find('all', array('order' => array('Customer.fullname' => 'ASC'),'conditions' => array('Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment')));
            
//'Expectedinstallment.due_date <' => date('Y-m-d'),
            
            $total = $this->Order->find('all', array('conditions' => array('Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment'), 'fields' => array( "SUM(Order.balance) AS 'total_bal'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            } 
                
            }
            
        }
    }

    function debtorsAgeing() {
        $this->__validateUserType();
        $this->paginate('Order');
        $this->set('zones', $this->Zone->find('list'));


        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $zoneid = $this->request->data['Order']['zone_id'];

            if(!is_null($zoneid) && $zoneid != ""){
            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }
            $accounts = $this->Order->find('all', array('order' => array('Customer.fullname' => 'ASC'),'group' => array('Order.customer_id'),'conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date)),'Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment','Order.zone_id' => $zoneid), 'fields' => array('Customer.fullname', 'Customer.mobile_no', 'Customer.work_place', "SUM((Order.hp_price + Order.interest_accrued)) AS 'dbt_due'", "SUM(Order.balance) AS 'balance'", "IF(Order.due_date,(DATEDIFF(CURDATE(),Order.due_date)),'') as 'age'")));
            
//'Expectedinstallment.due_date <' => date('Y-m-d'),
            
            $total = $this->Order->find('all', array('conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date)),'Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment','Order.zone_id' => $zoneid), 'fields' => array("SUM((Order.hp_price + Order.interest_accrued)) AS 'totdbt_due'", "SUM(Order.balance) AS 'totbalance'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }
            
            }elseif(is_null($zoneid) || $zoneid == ""){
               $accounts = $this->Order->find('all', array('order' => array('Customer.fullname' => 'ASC'),'group' => array('Order.customer_id'),'conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date)),'Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment'), 'fields' => array('Customer.fullname', 'Customer.mobile_no', 'Customer.work_place', "SUM((Order.hp_price+Order.interest_accrued)) AS 'dbt_due'", "SUM(Order.balance) AS 'balance'", "IF(Order.due_date,(DATEDIFF(CURDATE(),Order.due_date)),'') as 'age'")));
            
//'Expectedinstallment.due_date <' => date('Y-m-d'),
            
            $total = $this->Order->find('all', array('conditions' => array('AND' => array(array('Order.due_date >=' => $start_date), array('Order.due_date <=' => $end_date)),'Order.balance >' => 0,  'Order.status' => 'Approved', 'Order.delivery' => 'Delivered', 'Order.payment_status !=' => 'full_payment'), 'fields' => array("SUM((Order.hp_price+Order.interest_accrued)) AS 'totdbt_due'", "SUM(Order.balance) AS 'totbalance'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            } 
                
            }
        }
    }

    function debtorsClosingBal() {
        $this->__validateUserType();
        $this->paginate('ClosingBalance');

        if ($this->request->is('post')) {

            $sday = $this->request->data['debtorsClosingBal']['begin_date']['day'];
            $smonth = $this->request->data['debtorsClosingBal']['begin_date']['month'];
            $syear = $this->request->data['debtorsClosingBal']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['debtorsClosingBal']['finish_date']['day'];
            $emonth = $this->request->data['debtorsClosingBal']['finish_date']['month'];
            $eyear = $this->request->data['debtorsClosingBal']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);

            $accounts = $this->ClosingBalance->find('all', array('Order' => array('Customer.fullname' => 'asc'), 'conditions' => array('ClosingBalance.date >=' => $start_date, 'ClosingBalance.date <=' => $end_date), 'fields' => array("DISTINCT ClosingBalance.order_id", "ClosingBalance.balance", "Customer.fullname", "Order.invoice_no")));

            $total = $this->ClosingBalance->find('all', array('conditions' => array('ClosingBalance.date >=' => $start_date, 'ClosingBalance.date <=' => $end_date), 'fields' => array("DISTINCT ClosingBalance.order_id", "SUM(ClosingBalance.balance) as 'total_bal'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function finishPayment() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);

            $accounts = $this->Order->find('all', array('Order' => array('Order.order_date' => 'asc'), 'conditions' => array('Order.balance <=' => 0, 'status' => 'Approved', 'delivery' => 'Delivered', 'Order.payment_finish_date >=' => $start_date, 'Order.payment_finish_date <=' => $end_date)));

            $total = $this->Order->find('all', array('conditions' => array('Order.balance <=' => 0, 'status' => 'Approved', 'delivery' => 'Delivered', 'Order.payment_finish_date >=' => $start_date, 'Order.payment_finish_date <=' => $end_date), 'fields' => array("SUM(Order.balance) as 'total_bal'")));
            if ($accounts) {
                // pr($accounts);
                $this->set('accounts', $accounts);
                if ($total) {
                    $this->set('total', $total);
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function summZonal() {
        $this->__validateUserType();
        $this->paginate('Order');

        if ($this->request->is('post')) {

            $sday = $this->request->data['Order']['begin_date']['day'];
            $smonth = $this->request->data['Order']['begin_date']['month'];
            $syear = $this->request->data['Order']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['Order']['finish_date']['day'];
            $emonth = $this->request->data['Order']['finish_date']['month'];
            $eyear = $this->request->data['Order']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
//
//            $ids = $this->Expectedpayment->find('all', array('fields' => array('DISTINCT Order.zone_id','Expectedpayment.id'), 'conditions' => array('AND' => array(array('Expectedpayment.expected_date >=' =>$start_date),array('Expectedpayment.expected_date <=' => $end_date),array('Order.balance >' => 0), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'),array('Order.payment_status !=' => 'full_payment')))));
//            
//            if ($ids) {
//
//                $expaymentids = array();
//                foreach($ids as $id){
//                   array_push($expaymentids,$id['Expectedpayment']['id']);
//                }
//                
//            print_r($expaymentids);
//            exit;
//            
//            $accounts = $this->Payment->find('all', array('group' => array('Order.zone_id'),'Order' => array('Expectedpayment.expected_date' => 'DESC'),'fields' => array('Order.zone_id','SUM(Expectedpayment.expected_amount) As expected_sales','Expectedpayment.expected_date'), 'conditions' => array('AND' => array(array('Order.balance >=' => 0), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'),array('Payment.expectedpayment_id' => $expaymentids),array('Order.payment_status !=' => 'full_payment')))));
//                
//            
//            $total = $this->Expectedpayment->find('all', array('conditions' => array('AND' => array(array('Order.balance <=' => 0), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'),array('Order.payment_status !=' => 'full_payment'),array('Expectedpayment.expected_date >=' =>$start_date),array('Expectedpayment.expected_date <=' => $end_date))), 'fields' => array('DISTINCT Order.zone_id',"SUM(Order.balance) as 'total_bal'")));
//            
//            if ($accounts) {
//                // pr($accounts);
//                $this->set('accounts', $accounts);
//                if ($total) {
//                    $this->set('total', $total);
//                }
//            }
//            
            //}
            $ids = $this->Payment->find('all', array('group' => array('Payment.order_id'), 'fields' => array('Payment.id'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'Order' => array('paid' => 'DESC')));


            $totalids = $this->Payment->find('all', array('fields' => array('Payment.id'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'))), 'Order' => array('paid' => 'DESC')));

            if ($ids) {

                $paymentids = array();
                foreach ($ids as $id) {
                    array_push($paymentids, $id['Payment']['id']);
                }
                $totalpaymentids = array();
                foreach ($totalids as $value) {
                    array_push($totalpaymentids, $value['Payment']['id']);
                }

                $accounts = $this->Payment->find('all', array('group' => array('Order.zone_id'), 'fields' => array('Zone.zone', 'Payment.zone_id', 'Order.zone_id', 'Order.id', 'SUM(Order.hp_price) As tothp'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $paymentids))), 'Order' => array('paid' => 'DESC')));


                $collectedaccounts = $this->Payment->find('all', array('group' => array('Order.zone_id'), 'fields' => array('Zone.zone', 'Payment.zone_id', 'Order.id', 'SUM(Payment.amount) As paid'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $totalpaymentids))), 'Order' => array('paid' => 'DESC')));

                $total = $this->Payment->find('all', array('fields' => array('DISTINCT Order.zone_id', 'SUM(Payment.amount) As paid', 'SUM(Order.hp_price) As tothpprice'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $totalpaymentids))), 'Order' => array('paid' => 'DESC')));


                $totalsales = $this->Payment->find('all', array('fields' => array('DISTINCT Order.zone_id', 'SUM(Payment.amount) As paid', 'SUM(Order.hp_price) As tothpprice'), 'conditions' => array('AND' => array(array('Payment.payment_date >=' => $start_date), array('Payment.payment_date <=' => $end_date), array('Order.status' => 'Approved'), array('Order.delivery' => 'Delivered'), array('Payment.id' => $paymentids))), 'Order' => array('paid' => 'DESC')));

                if ($accounts) {
                    $this->set('accounts', $accounts);
                    if ($collectedaccounts) {
                        $this->set('collectedaccounts', $collectedaccounts);
                    }

                    if ($total) {

                        $this->set('total', $total);
                    }
                    if ($totalsales) {

                        $this->set('totalsales', $totalsales);
                    }
                }
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function stockRemItems() {
        $this->__validateUserType();
        $this->paginate('Item');
        $this->set('warehouses', $this->Warehouse->find('list'));
        if ($this->request->is('post')) {

            $warehs = $this->request->data['Item']['warehouse_id'];
//            $smonth = $this->request->data['SalesItem']['from']['month'];
//            $syear = $this->request->data['SalesItem']['from']['year'];
//            $starts_date = $syear . "-" . $smonth . "-" . $sday;
//            $snewdate = strtotime($starts_date);
//            $start_date = date('Y-m-d', $snewdate);
//
//            $eday = $this->request->data['SalesItem']['to']['day'];
//            $emonth = $this->request->data['SalesItem']['to']['month'];
//            $eyear = $this->request->data['SalesItem']['to']['year'];
//            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
//            $enewdate = strtotime($ends_date);
//            $end_date = date('Y-m-d', $enewdate);



if($warehs != "" && $warehs != null){
            $stock = $this->Item->find('all', array('order' => array('Item.item' => 'asc'),'group' => array('Item.modelno') ,'conditions' => array('Item.warehouse_id' => $warehs,'Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("Item.modelno","Item.brand","Item.item","Sum(Item.remaining_quantity) As rem","Warehouse.warehouse")));

            $sales_tot = $this->Item->find('all', array('conditions' => array('Item.warehouse_id' => $warehs,'Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("SUM(Item.remaining_quantity) as 'remaining'")));

            if ($stock) {
                // $this->set('customer', $accounts[0]['Client']['client_name']);
                $this->set('sales', $stock);
                if ($sales_tot) {
                    $this->set('salestotal', $sales_tot);
                }
                
            } else {
                $message = 'No Items Available';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'stockRemItems'));
            }

//            $newstart_date = date('d-M-Y', $snewdate);
//            $newend_date = date('d-M-Y', $enewdate);
//            $this->set('start_date', $newstart_date);
//            $this->set('end_date', $newend_date);
            
}else{
    $stock = $this->Item->find('all', array('order' => array('Item.item' => 'asc'),'group' => array('Item.modelno'), 'conditions' => array('Item.remaining_quantity >' => 0,'delete_status' => 'alive'),'fields' => array("Item.modelno","Item.item","Item.brand","Sum(Item.remaining_quantity) As rem","Warehouse.warehouse")));

            $sales_tot = $this->Item->find('all', array('conditions' => array('Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("SUM(Item.remaining_quantity) as 'remaining'")));

            if ($stock) {
                // $this->set('customer', $accounts[0]['Client']['client_name']);
                $this->set('sales', $stock);
                if ($sales_tot) {
                    $this->set('salestotal', $sales_tot);
                }
                
            } else {
                $message = 'No Items Available';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'stockRemItems'));
            }
}
        }
    }
    
    function stockRemItemDetails(){
       $this->__validateUserType();
        $this->paginate('Item');
        $this->set('warehouses', $this->Warehouse->find('list'));
        if ($this->request->is('post')) {

            $warehs = $this->request->data['Item']['warehouse_id'];
//            $smonth = $this->request->data['SalesItem']['from']['month'];
//            $syear = $this->request->data['SalesItem']['from']['year'];
//            $starts_date = $syear . "-" . $smonth . "-" . $sday;
//            $snewdate = strtotime($starts_date);
//            $start_date = date('Y-m-d', $snewdate);
//
//            $eday = $this->request->data['SalesItem']['to']['day'];
//            $emonth = $this->request->data['SalesItem']['to']['month'];
//            $eyear = $this->request->data['SalesItem']['to']['year'];
//            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
//            $enewdate = strtotime($ends_date);
//            $end_date = date('Y-m-d', $enewdate);



if($warehs != "" && $warehs != null){
            $stock = $this->Item->find('all', array('order' => array('Item.item' => 'asc'),'group' => array('Item.modelno') ,'conditions' => array('Item.warehouse_id' => $warehs,'Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("Item.modelno","Item.brand","Item.item","Sum(Item.remaining_quantity) As rem","Warehouse.warehouse","Sum(Item.cost_price) as cost")));

            $sales_tot = $this->Item->find('all', array('conditions' => array('Item.warehouse_id' => $warehs,'Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("SUM(Item.remaining_quantity) as 'remaining'")));

            if ($stock) {
                // $this->set('customer', $accounts[0]['Client']['client_name']);
                $this->set('sales', $stock);
                if ($sales_tot) {
                    $this->set('salestotal', $sales_tot);
                }
                
            } else {
                $message = 'No Items Available';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'stockRemItems'));
            }

//            $newstart_date = date('d-M-Y', $snewdate);
//            $newend_date = date('d-M-Y', $enewdate);
//            $this->set('start_date', $newstart_date);
//            $this->set('end_date', $newend_date);
            
}else{
    $stock = $this->Item->find('all', array('order' => array('Item.item' => 'asc'),'group' => array('Item.modelno'), 'conditions' => array('Item.remaining_quantity >' => 0,'delete_status' => 'alive'),'fields' => array("Item.modelno","Sum(Item.cost_price) as cost","Item.item","Sum(Item.remaining_quantity) As rem","Item.brand","Warehouse.warehouse")));

            $sales_tot = $this->Item->find('all', array('conditions' => array('Item.remaining_quantity >' => 0,'delete_status' => 'alive'), 'fields' => array("SUM(Item.cost_price) as 'costp'","SUM(Item.remaining_quantity) as 'remaining'")));

            if ($stock) {
                // $this->set('customer', $accounts[0]['Client']['client_name']);
                $this->set('sales', $stock);
                if ($sales_tot) {
                    $this->set('salestotal', $sales_tot);
                }
                
            } else {
                $message = 'No Items Available';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'stockRemItemDetails'));
            }
}
        } 
    }
    function stocksSummary() {
        $this->paginate('SalesItem');

        if ($this->request->is('post')) {

            $sday = $this->request->data['SalesItem']['from']['day'];
            $smonth = $this->request->data['SalesItem']['from']['month'];
            $syear = $this->request->data['SalesItem']['from']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['SalesItem']['to']['day'];
            $emonth = $this->request->data['SalesItem']['to']['month'];
            $eyear = $this->request->data['SalesItem']['to']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
              $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');



            $stock = $this->SalesItem->find('all', array('Order' => array('Item.item' => 'asc'), 'group' => array('SalesItem.item_id'), 'fields' => array("", "SUM((Item.cost_price * Item.remaining_quantity)) as 'stotal'", "Item.remaining_quantity", "Item.original_quantity", "SUM(SalesItem.quantity) as 'quant'", "SalesItem.cost_price", "Item.item"), 'conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive')))));

            $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((Item.cost_price * Item.remaining_quantity)) as 'stotal'","SUM(Item.original_quantity) AS 'original'","SUM(SalesItem.cost_price) as 'cost'","SUM(SalesItem.quantity) as 'quant'","SUM(Item.remaining_quantity) as 'remaining'")));

            $stock_opening = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date <=' => $start_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((Item.cost_price * Item.remaining_quantity)) as 'stotal'","SUM(Item.original_quantity) AS 'original'","SUM(SalesItem.cost_price) as 'cost'","SUM(SalesItem.quantity) as 'quant'","SUM(Item.remaining_quantity) as 'remaining'")));
            if ($stock) {
                // $this->set('customer', $accounts[0]['Client']['client_name']);
                $this->set('sales', $stock);
                if ($sales_tot) {
                    $this->set('salestotal', $sales_tot);
                }
                if($stock_opening){
                    $this->set('stockopen', $stock_opening);
                }
            } else {
                $message = 'No Sales Available';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Reports', 'action' => 'salesSummary'));
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        }
    }

    function salesSummary() {

        $this->paginate('SalesItem');
        $this->set('users', $this->User->find('list'));

        if ($this->request->is('post')) {

            $sday = $this->request->data['SalesItem']['from']['day'];
            $smonth = $this->request->data['SalesItem']['from']['month'];
            $syear = $this->request->data['SalesItem']['from']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);

            $eday = $this->request->data['SalesItem']['to']['day'];
            $emonth = $this->request->data['SalesItem']['to']['month'];
            $eyear = $this->request->data['SalesItem']['to']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
//            $date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            


            $sales_pers_id = $this->request->data['SalesItem']['user_id'];
            $sales_pers = $this->User->find('first', array('conditions' => array('User.id' => $sales_pers_id)));
            if ($sales_pers){
                $username = $sales_pers['User']['username'];

                $sales = $this->SalesItem->find('all', array('Order' => array('User.username' => 'asc'),'conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('SalesItem.user_id' => $sales_pers_id), array('Sale.status' => 'alive')))));

                $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('SalesItem.user_id' => $sales_pers_id), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'stotal'")));
               

                if ($sales) {
                    // $this->set('customer', $accounts[0]['Client']['client_name']);
                    $this->set('sales', $sales);
                    if ($sales_tot) {
                        $this->set('salestotal', $sales_tot);
                    }
                }else{
                    $message = 'No Sales Available';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reports', 'action' => 'salesSummary'));
                }

                $newstart_date = date('d-M-Y', $snewdate);
                $newend_date = date('d-M-Y', $enewdate);
                $this->set('start_date', $newstart_date);
                $this->set('end_date', $newend_date);
            }else{
                
               

                $sales = $this->SalesItem->find('all', array('Order' => array('User.username' => 'asc'),'conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive')))));

                $sales_tot = $this->SalesItem->find('all', array('conditions' => array('AND' => array(array('Sale.sale_date >=' => $start_date), array('Sale.sale_date <=' => $end_date), array('Sale.status' => 'alive'))), 'fields' => array("SUM((SalesItem.unit_price * SalesItem.quantity)) as 'stotal'")));
               

                if ($sales) {
                    // $this->set('customer', $accounts[0]['Client']['client_name']);
                    $this->set('sales', $sales);
                    if ($sales_tot) {
                        $this->set('salestotal', $sales_tot);
                    }
                }else{
                    $message = 'No Sales Available';
                    $this->Session->write('bmsg', $message);
                    $this->redirect(array('controller' => 'Reports', 'action' => 'salesSummary'));
                }

                $newstart_date = date('d-M-Y', $snewdate);
                $newend_date = date('d-M-Y', $enewdate);
                $this->set('start_date', $newstart_date);
                $this->set('end_date', $newend_date);
            }
        }
    }
    
public function convert2PdfnEmail(){
//            if ($this->request->is('post')) {
//                        $content = $this->request->data['Expectedinstallment']['content'];
//                        $email =   $this->request->data['Expectedinstallment']['email'];
//                        
//                        if($content != "" && $email != ""){
//                            set_time_limit(0);
//                            ini_set('memory_limit','256M');
//                            
//        $content = htmlentities($content);
//                $html2pdf = new HTML2PDF('P', 'A4', 'en');
//                $html2pdf->WriteHTML($content);
//                $html2pdf->Output('report.pdf');
//                        }
//            }
}


    public function pettycashSummByZone() {
        $this->__validateUserType();
        $data = $this->paginate('CashAccount');
        $this->set('zones', $this->Zone->find('list'));

        if ($this->request->is('post')) {

            $zoneid = $this->request->data['CashAccount']['zone_id'];
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
            $zone_data = $this->Zone->find('first', array('conditions' => array('Zone.id' => $zoneid)));
            if ($zone_data) {
                $this->set('zone_name', $zone_data['Zone']['zone']);
            }

            if ($zoneid != "" && $zoneid != null) {
                $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date),array('CashAccount.expense_type IN (0,7)'), array('CashAccount.zone_id' => $zoneid)))));

                $total = $this->Pettycash->find('all', array('conditions' => array('Pettycash.zone_id' => $zoneid),'fields' => array('SUM(Pettycash.amount) as pettycash_amt','SUM(Pettycash.balance) as pettycash_bal')));

                $total_dispense = $this->PettycashDeposit->find('all',array('conditions' => array('AND' => array(array('DATE(PettycashDeposit.created) >=' => $start_date), array('DATE(PettycashDeposit.created) <=' => $end_date),array('PettycashDeposit.zone_id' => $zoneid))),'fields' => array('SUM(PettycashDeposit.amount) as pettycash_amt')));
                
                
                $total_withdrawal = $this->PettycashWithdrawal->find('all',array('conditions' => array('AND' => array(array('DATE(PettycashWithdrawal.created) >=' => $start_date), array('DATE(PettycashWithdrawal.created) <=' => $end_date),array('PettycashWithdrawal.zone_id' => $zoneid))),'fields' => array('SUM(PettycashWithdrawal.amount) as pettycash_amt')));
                if ($accounts) {

                    $this->set('data', $accounts);
                    if($total){
                    $this->set('total', $total);
                        
                    }
                    if($total_dispense){
                        
                    $this->set('total_dispense', $total_dispense);
                    }
                    if($total_withdrawal){
                        
                    $this->set('total_withdrawal', $total_withdrawal);
                    }
                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByZone'));
                }
            } elseif ($zoneid == "") {

                $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date),array('CashAccount.expense_type IN (0,7)')))));

                
                $total = $this->Pettycash->find('all', array('fields' => array('SUM(Pettycash.amount) as pettycash_amt','SUM(Pettycash.balance) as pettycash_bal')));

                $total_dispense = $this->PettycashDeposit->find('all',array('conditions' => array('AND' => array(array('DATE(PettycashDeposit.created) >=' => $start_date), array('DATE(PettycashDeposit.created) <=' => $end_date))),'fields' => array('SUM(PettycashDeposit.amount) as pettycash_amt')));
                
                
                $total_withdrawal = $this->PettycashWithdrawal->find('all',array('conditions' => array('AND' => array(array('DATE(PettycashWithdrawal.created) >=' => $start_date), array('DATE(PettycashWithdrawal.created) <=' => $end_date))),'fields' => array('SUM(PettycashWithdrawal.amount) as pettycash_amt')));
                if ($accounts) {

                    $this->set('data', $accounts);
                    if($total){
                    $this->set('total', $total);
                        
                    }
                    if($total_dispense){
                        
                    $this->set('total_dispense', $total_dispense);
                    }
                    if($total_withdrawal){
                        
                    $this->set('total_withdrawal', $total_withdrawal);
                    }
} else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                   // $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByZone'));
                }
            }else{
                    $this->request->data = null;
                
                    $message = 'Sorry, No Data Found For Selected Options';
                  //  $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByZone'));
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } else {
  
            $newstart_date = date('d-M-Y');
            $newend_date = date('d-M-Y');
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
             if ($this->Session->check('isdata') == false) {
                 
            $order_details = $this->CashAccount->find('all',array('limit' => 25,'conditions' =>array('CashAccount.expense_type IN (0,7)')));
            
           $total = $this->Pettycash->find('all', array('fields' => array('SUM(Pettycash.amount) as pettycash_amt','SUM(Pettycash.balance) as pettycash_bal')));

                $total_dispense = $this->PettycashDeposit->find('all',array('fields' => array('SUM(PettycashDeposit.amount) as pettycash_amt')));
                
                
                $total_withdrawal = $this->PettycashWithdrawal->find('all',array('fields' => array('SUM(PettycashWithdrawal.amount) as pettycash_amt')));
                if ($order_details) {

                    $this->set('data', $order_details);
                    if($total){
                    $this->set('total', $total);
                        
                    }
                    if($total_dispense){
                        
                    $this->set('total_dispense', $total_dispense);
                    }
                    if($total_withdrawal){
                        
                    $this->set('total_withdrawal', $total_withdrawal);
                    }

                    }
                
             }else{
                 if($this->Session->check('isdata')){
                     $this->Session->delete('isdata');
                 }
             }
             
        }
    }


    
    public function summByHeading() {
        $this->__validateUserType();
        $data = $this->paginate('CashAccount');
        $this->set('expenses', $this->Expense->find('list'));

        if ($this->request->is('post')) {

            $acctid = $this->request->data['CashAccount']['expense_id'];
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


            if ($acctid != "" && $acctid != null) {
                $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date),array('CashAccount.expense_id' => $acctid)))));

                if ($accounts) {

                    $this->set('data', $accounts);

                } else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    //$this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByHeading'));
                }
            } elseif ($acctid == "") {

                $accounts = $this->CashAccount->find('all', array('conditions' => array('AND' => array(array('CashAccount.expense_date >=' => $start_date), array('CashAccount.expense_date <=' => $end_date)))));


                if ($accounts) {

                    $this->set('data', $accounts);
} else {
                    $this->request->data = null;
                    $message = 'Sorry, No Data Found For Selected Options';
                    //$this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByHeading'));
                }
            }else{
                    $this->request->data = null;
                
                    $message = 'Sorry, No Data Found For Selected Options';
                //    $this->Session->write('bmsg', $message);
                    $this->Session->write('isdata',true);

                    $this->redirect(array('controller' => 'Reports', 'action' => 'redirectTOPettySummByHeading'));
            }

            $newstart_date = date('d-M-Y', $snewdate);
            $newend_date = date('d-M-Y', $enewdate);
            $this->set('start_date', $newstart_date);
            $this->set('end_date', $newend_date);
        } 
    }

        function redirectTOPettySummByZone() {

        $this->autoRender = false;
        $this->redirect('/Reports/pettycashSummByZone/');
    }
        function redirectTOPettySummByHeading() {

        $this->autoRender = false;
        $this->redirect('/Reports/summByHeading/');
    }

    function jvReceiptVoucher(){
        $this->__validateUserType3();
        
    }
    
    function investorContract(){
        $this->__validateUserType3();
        
    }
    
    function dailyInterests(){
        $this->__validateUserType3();
        
    }
    
    function maturityList(){
        $this->__validateUserType3();
        
    }
    
    function discountInvestment(){
        $this->__validateUserType3();
        
    }
    
    function jvPaymentVoucher(){
        $this->__validateUserType3();
        
    }
    
    function clientLedger(){
        $this->__validateUserType3();
        
    }
    
    function activeInvestments(){
        $this->__validateUserType();
          if ($this->request->is('post')) {

            $sday = $this->request->data['Investment']['begin_date']['day'];
            $smonth = $this->request->data['Investment']['begin_date']['month'];
            $syear = $this->request->data['Investment']['begin_date']['year'];
            $starts_date = $syear . "-" . $smonth . "-" . $sday;
            $snewdate = strtotime($starts_date);
            $start_date = date('Y-m-d', $snewdate);
            $frstart_date = date('d F, Y', $snewdate);

            $eday = $this->request->data['Investment']['finish_date']['day'];
            $emonth = $this->request->data['Investment']['finish_date']['month'];
            $eyear = $this->request->data['Investment']['finish_date']['year'];
            $ends_date = $eyear . "-" . $emonth . "-" . $eday;
            $enewdate = strtotime($ends_date);
            $end_date = date('Y-m-d', $enewdate);
            $date = new DateTime($end_date);
            //$date->add(new DateInterval('P1D'));
             $end_date = $date->format('Y-m-d');
            $frend_date = date('d F, Y', $enewdate);

            $this->set('frstart_date', $frstart_date);
            $this->set('frend_date', $frend_date);

            
            $lateday = date('Y-m-t');
            $firstday = date('Y-m-01');
            $accounts = $this->Investment->find('all', array('order' => array('Investor.fullname' => 'asc'),
                'conditions' => array('Investment.investment_date BETWEEN ? AND ?' => 
                    array($start_date, $end_date),
                    'Investment.investment_product_id' => array(1,3),
                    'Investment.status' => array('Invested','Rolled_over','Termination_Requested'))));

//, 'group' => array('Expectedinstallment.zone_id')
            $total = $this->Investment->find('all', array('order' => array('Investor.fullname' => 'asc'),
                'conditions' => array('Investment.investment_date BETWEEN ? AND ?' => 
                    array($start_date, $end_date),
                    'Investment.investment_product_id' => array(1,3),
                    'Investment.status' => array('Invested','Rolled_over','Termination_Requested')), 'fields' => 
                array("SUM((Investment.investment_amount)) as principal",
                    "SUM((Investment.interest_accrued)) as interest", 
                    "SUM((Investment.investment_amount + Investment.interest_accrued)) as total")));

            if ($accounts) {

                $this->set('accounts', $accounts);
                if ($total) {

                    $this->set('total', $total);
                }
            }
    }
    }
    
    function investorDeposits(){
        $this->__validateUserType3();
        
    }
    
    function rolloverDisinv(){
        $this->__validateUserType3();
        
    }
    
    function aggregateInvestment(){
        $this->__validateUserType3();
        
    }
}

?>
