<?php

class SettingsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Setting';
    var $uses = array('Setting', 'Subsidiary', 'Item', 'Client', 'User', 'Currency', 'Supplier', 'Tax', 'Rate', 'Expense', 'DefaultingRate', 'Warehouse', 'Zone', 'CustomerCategory', 'Portfolio', 'Bank', 'CashAccount', 'EquitiesList', 'ExchangeRate', 'TransactionCategory', 'AccountingHead');
    var $paginate = array(
        'Item' => array('limit' => 25, 'order' => array('Item.item' => 'asc')),
        'Client' => array('limit' => 25, 'order' => array('Client.client_name' => 'asc')),
        'CustomerCategory' => array('limit' => 25, 'order' => array('CustomerCategory.customer_category' => 'asc')),
        'Currency' => array('limit' => 20, 'order' => array('Currency.id' => 'asc')),
        'ExchangeRate' => array('limit' => 5, 'order' => array('ExchangeRate.id' => 'asc')),
        'Tax' => array('limit' => 25, 'order' => array('Tax.tax_name' => 'asc')),
        'Rate' => array('limit' => 25, 'order' => array('Rate.id' => 'asc')),
        'Supplier' => array('limit' => 25, 'order' => array('Supplier.supplier_name' => 'asc')),
        'DefaultingRate' => array('limit' => 25, 'order' => array('DefaultingRate.id' => 'asc')),
        'Expense' => array('limit' => 25, 'order' => array('Expense.expense_date' => 'desc')),
        'Zone' => array('limit' => 25, 'order' => array('Zone.zone' => 'asc')),
        'Warehouse' => array('limit' => 25, 'order' => array('Warehouse.warehouse' => 'asc')),
        'Portfolio' => array('limit' => 25, 'order' => array('Portfolio.id' => 'asc')),
        'Subsidiary' => array('limit' => 10, 'order' => array('Subsidiary.id' => 'asc')),
        'Bank' => array('limit' => 20, 'order' => array('Bank.id' => 'asc')),
        'EquitiesList' => array('limit' => 20, 'order' => array('EquitiesList.equity' => 'asc')),
        'CashAccount' => array('limit' => 25, 'order' => array('CashAccount.id' => 'asc')),
    );

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
            $message = 'You Don\'t Have The Priviledges To View The Chosen Resource';
            $this->Session->write('bmsg', $message);
            $this->redirect('/Dashboard/');
        }
    }

    function index() {
        $this->__validateUserType();
    }

    function equitiesList($eq_id = null) {
        $this->__validateUserType();

        $data = $this->paginate('EquitiesList');
        $this->set('data', $data);

        if ($eq_id != null && $eq_id != '') {
            $this->set('equity', $this->EquitiesList->find('first', ['conditions' => ['EquitiesList.id' => $eq_id]]));
        } else {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['EquitiesList']['id'])) {
                    if ($this->request->data['EquitiesList']['equity_name'] == "" || $this->request->data['EquitiesList']['equity_name'] == null) {
                        $message = 'Please Enter Equity Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    }

                    $equity_id = $this->request->data['EquitiesList']['id'];

//                    $this->EquitiesList->delete($bank_id, false);
                    $result = $this->EquitiesList->save($this->request->data);


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Equity Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    } else {
                        $message = 'Could not update Equity';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    }
                } else {
                    if ($this->request->data['EquitiesList']['equity_name'] == "" || $this->request->data['EquitiesList']['equity_name'] == null) {
                        $message = 'Please Enter Equity Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    }
                    $result = $this->EquitiesList->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Equity successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    } else {
                        $message = 'Could not add new Equity. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
                    }
                }
            }
        }
    }

    /*
      function equitiesList($equity_id = null) {
      $this->__validateUserType();
      if ($equity_id != null && $equity_id != '') {
      $this->set('equity', $this->EquitiesList->find('first', ['conditions' => ['EquitiesList.id' => $equity_id]]));
      } else {

      if (!empty($this->request->data)) {
      $result = $this->EquitiesList->save($this->request->data);
      if ($result) {
      $this->request->data = null;
      $message = 'Equity/Stock successfully saved';
      $this->Session->write('smsg', $message);
      $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
      } else {
      $message = 'Unable to save';
      $this->Session->write('emsg', $message);
      $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
      }
      } else {
      $data = $this->paginate('EquitiesList');
      $this->set('data', $data);
      }
      }
      }
     */

    function delEquityName($equity_id) {
        if (!is_null($equity_id)) {

            $result = $this->EquitiesList->delete($equity_id, false);

            if ($result) {
                $message = 'Equity/Stock successfully deleted';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
            } else {
                $message = 'Could not delete Equity/Stock';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'equitiesList'));
            }
        }
    }

    function createExpenses() {
        $this->__validateUserType();
        $data = $this->paginate('Expense');
        $this->set('data', $data);
    }

    function delPaymentName($expenseID = null) {
        $this->autoRender = $this->autoLayout = false;


        if (!is_null($expenseID)) {


            // $expenseID = $_POST['paymentnameId'];
            $result = $this->Expense->delete($expenseID, false);



            if ($result) {
                $message = 'Payment Name Deleted';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'createExpenses'));
            } else {
                $message = 'Could not Delete Payment Name';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'createExpenses'));
            }
        }
    }

    function createExpense() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($this->request->data)) {

//                $creditId = $this->request->data['Creditor']['creditor_id'];
////                return $creditId;
//                $creditResult = $this->Creditor->getCreditor($creditId);
//                $supplier_id =  $creditResult[Creditor][supplier_id];
//                $amount = $this->request->data['Creditor']['amount_paid'];   
//                
//                $paymentData = array('creditor_id' => $creditId, 'supplier_id' => $supplier_id,'amount' => $amount);
                $result = $this->Expense->save($this->request->data);
//                
//                $amount_disbursed = $creditResult[Creditor][amount_disbursed];
//                $new_amount_disbursed = $amount_disbursed + $amount;
//                $balance = $creditResult[Creditor][balance];
//                $new_balance = $balance - $amount;
//                $creditData =  array('id' => $creditId, 'amount_disbursed' => $new_amount_disbursed, 'balance' => $new_balance);
//                $result2 = $this->Creditor->save($creditData);

                if ($result) {
                    $this->request->data = null;

                    $feedback = array("feedback" => "success");
                    return json_encode($feedback);
                } else {

                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
            } else {

                $feedback = array("feedback" => "No Data");
                return json_encode($feedback);
            }
        }
    }

    function setup() {
        $this->__validateUserType();

        $this->set('currencies', $this->Currency->find('list'));

        $setupResults = $this->Setting->getSetup();
        foreach ($setupResults as $setupResult) {
            $setupRes = $setupResult;
        }

        $this->set(compact('setupResults'));

        if ($this->request->is('ajax')) {
//            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {
                $day = $this->request->data['Setting']['accounting_month']['day'];
                $month = $this->request->data['Setting']['accounting_month']['month'];
                $year = $this->request->data['Setting']['accounting_month']['year'];
                $this->request->data['Setting']['accounting_month'] = $year . '-' . $month . '-' . $day;

                $count = $this->Setting->find('count');
                if ($count < 1) {
                    $result = $this->Setting->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        return "Company Setup Successfully Added";
                    } else {

                        return "Unsuccessful";
                    }
                } else if ($count >= 1) {
                    $this->Setting->id = 1;

                    $result = $this->Setting->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        return "Company Setup Update Successful";
                    } else {

                        return "Unsuccessful";
                    }
                }
            }
        }
    }

    function subsidiaries() {
        $this->__validateUserType();
        $data = $this->paginate('Subsidiary');
        $this->set('data', $data);
        $this->set('currencies', $this->Currency->find('list'));

        $setupResults = $this->Subsidiary->getSetup();
        foreach ($setupResults as $setupResult) {
            $setupRes = $setupResult;
        }

        $this->set(compact('setupResults'));

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {
                $day = $this->request->data['Subsidiary']['accounting_month']['day'];
                $month = $this->request->data['Subsidiary']['accounting_month']['month'];
                $year = $this->request->data['Subsidiary']['accounting_month']['year'];
                $this->request->data['Subsidiary']['accounting_month'] = $year . '-' . $month . '-' . $day;

                $count = $this->Subsidiary->find('count');
                if ($count < 1) {
                    $result = $this->Subsidiary->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        return "Subsidiary Successfully Added";
                    } else {

                        return "Unsuccessful";
                    }
                }
//                else if ($count >= 1) {
//                    $this->Subsidiary->id = 1;
//
//                    $result = $this->Setting->save($this->request->data);
//                    if ($result) {
//                        $this->request->data = null;
//
//
//                        return "Subsidiary Update Successful";
//                    } else {
//
//                        return "Unsuccessful";
//                    }
//                }
            }
        }
    }

    function delSubsidiary($sub_id = Null) {
        $this->autoRender = false;

        $result = $this->Subsidiary->delete($sub_id, false);
        if ($result) {

            $message = 'Subsidiary Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'subsidiaries'));
        } else {
            $message = 'Could Not Delete Subsidiary';
            $this->Session->write('bmsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'subsidiaries'));
        }
    }

    function displayInfo() {
        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['ItemId'])) {
                $itemId = $_POST['ItemId'];
                $itemLst = $this->Item->find('first', array('conditions' => array('Item.id' => $itemId)));

                $itemLsts = json_encode($itemLst);
                return $itemLsts;
            }
        }
    }

    function itemsList() {
        $this->__validateUserType();
        $data = $this->paginate('Item');
        $this->set('data', $data);


        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {
                $result = $this->Item->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function delItem() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {


                $itemid = $_POST['itemId'];
                $result = $this->Item->delete($itemid, false);



                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function delClient() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {


                $clientID = $_POST['clientId'];
                $result = $this->Client->delete($clientID, false);



                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function clientInfo() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['clientId'])) {
                $clientId = $_POST['clientId'];
                $clientLst = $this->Client->find('first', array('conditions' => array('Client.id' => $clientId)));

                $clientLsts = json_encode($clientLst);
                return $clientLsts;
            }
        }
    }

    public function clientsList() {
        $this->__validateUserType();
        $data = $this->paginate('Client');
        $this->set('data', $data);

        $this->set('zones', $this->Zone->find('list'));

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;

            if (!empty($this->request->data)) {
                $result = $this->Client->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    public function customerCategories() {
        $this->__validateUserType();
        $data = $this->paginate('CustomerCategory');
        $this->set('data', $data);

        if ($this->request->is('post')) {
            $this->autoRender = false;
            if (!empty($this->request->data)) {
                $result = $this->CustomerCategory->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    $message = 'Customer Category Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'customerCategories'));
                } else {
                    $message = 'Could not add new Customer Category';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'customerCategories'));
                }
            }
        }
    }

//    public function suppliers() {
//        $this->__validateUserType();
//        $data = $this->paginate('Supplier');
//        $this->set('data', $data);
//
//
//
//        if ($this->request->is('ajax')) {
//            Configure::write('debug', 0);
//            $this->autoRender = false;
//            $this->autoLayout = false;
//            if (!empty($this->request->data)) {
//                $result = $this->Supplier->save($this->request->data);
//                if ($result) {
//                    $this->request->data = null;
//
//                    return "success";
//                } else {
//                    return "unsuccessful";
//                }
//            }
//        }
//    }
//
//    function supplyInfo() {
//
//        if ($this->request->is('ajax')) {
//            Configure::write('debug', 0);
//            $this->autoRender = false;
//            $this->autoLayout = false;
//
//            if (!empty($_POST['SupplyId'])) {
//                $supplyId = $_POST['SupplyId'];
//                $supplyLst = $this->Supplier->find('first', array('conditions' => array('Supplier.id' => $supplyId)));
//
//                $supplyLsts = json_encode($supplyLst);
//                return $supplyLsts;
//            }
//        }
//    }
//
//    function delSupplier() {
//
//        if ($this->request->is('ajax')) {
//            Configure::write('debug', 0);
//            $this->autoRender = false;
//            $this->autoLayout = false;
//            if (!empty($this->request->data)) {
//
//
//                $supplyId = $_POST['supplierId'];
//                $result = $this->Supplier->delete($supplyId);
//
//
//
//                if ($result) {
//                    return "success";
//                } else {
//                    return "unsuccessful";
//                }
//            }
//        }
//    }

    public function taxesList() {
        $this->__validateUserType();
        $data = $this->paginate('Tax');
        $this->set('data', $data);

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {
                $result = $this->Tax->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    $feedback = array("feedback" => "success");
                    return json_encode($feedback);
                } else {
                    $feedback = array("feedback" => "unsuccessful");
                    return json_encode($feedback);
                }
            }
        }
    }

    function taxInfo() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;

            if (!empty($_POST['taxId'])) {
                $taxId = $_POST['taxId'];
                $taxLst = $this->Tax->find('first', array('conditions' => array('Tax.id' => $taxId)));

                $taxLsts = json_encode($taxLst);
                return $taxLsts;
            }
        }
    }

    function delTax() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {


                $taxid = $_POST['taxId'];
                $result = $this->Tax->delete($taxid, del);

                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function paymentTerms() {
        $this->__validateUserType();

        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                if ($this->request->data['Rate']['payment_name'] == "" || $this->request->data['Rate']['payment_name'] == null) {
                    $message = 'Please Enter Term Payment Name';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                }
                if ($this->request->data['Rate']['period_months'] == "" || $this->request->data['Rate']['period_months'] == null) {
                    $message = 'Please Enter Period (Months)';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                }
                if ($this->request->data['Rate']['interest_rate'] == "" || $this->request->data['Rate']['interest_rate'] == null) {
                    $message = 'Please Enter Interest Rate';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                }

//                $this->request->data['Rate']['interest_rate'] = floatval($this->request->data['Rate']['interest_rate2']);
                $term = array('interest_rate' => $this->request->data['Rate']['interest_rate'], 'period_months' => $this->request->data['Rate']['period_months'], 'payment_name' => $this->request->data['Rate']['payment_name']);
                $result = $this->Rate->save($term);
                //$this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                } else {
                    $message = 'Please Check All Fields';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                }
            } else {
                $message = 'Some Fields Missing Data';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
            }
        }
        $data = $this->paginate('Rate');
        $this->set('data', $data);
    }

    function investmentPortfolios() {//please work on this. i just copied the whole function for payment terms
        $this->__validateUserType();
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                if ($this->request->data['Portfolio']['payment_name'] == "" || $this->request->data['Portfolio']['payment_name'] == null) {
                    $message = 'Please Enter Term Payment Name';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
                }
                if ($this->request->data['Portfolio']['period_months'] == "" || $this->request->data['Portfolio']['period_months'] == null) {
                    $message = 'Please Enter Period (Months)';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
                }
                if ($this->request->data['Portfolio']['interest_rate'] == "" || $this->request->data['Portfolio']['interest_rate'] == null) {
                    $message = 'Please Enter Interest Rate';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
                }

//                $this->request->data['Rate']['interest_rate'] = floatval($this->request->data['Rate']['interest_rate2']);
                if (isset($this->request->data['Portfolio']['id'])) {
                    $term = array('id' => $this->request->data['Portfolio']['id'], 'interest_rate' => $this->request->data['Portfolio']['interest_rate'], 'period_months' => $this->request->data['Portfolio']['period_months'], 'payment_name' => $this->request->data['Portfolio']['payment_name']);
                } else {
                    $term = array('interest_rate' => $this->request->data['Portfolio']['interest_rate'], 'period_months' => $this->request->data['Portfolio']['period_months'], 'payment_name' => $this->request->data['Portfolio']['payment_name']);
                }
                $result = $this->Portfolio->save($term);
                //$this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
                } else {
                    $message = 'Please Check All Fields';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
                }
            } else {
                $message = 'Some Fields Missing Data';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
            }
        }
        $data = $this->paginate('Portfolio');
        $this->set('data', $data);
    }

    function portfolioInfo() {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;

            if (!empty($_POST['ptermId'])) {
                $ptermId = $_POST['ptermId'];
                $ptermLst = $this->Portfolio->find('first', array('conditions' => array('Portfolio.id' => $ptermId)));

                $ptermLsts = json_encode($ptermLst);
                return $ptermLsts;
            }
        }
    }

    public function delPortterm($payment_term = Null) {
        $this->autoRender = false;

        $result = $this->Portfolio->delete($payment_term, false);
        if ($result) {

            $message = 'Payment Term Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
        } else {
            $message = 'Could Not Delete Payment Term';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'investmentPortfolios'));
        }
    }

    function paymentInfo() {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;

            if (!empty($_POST['ptermId'])) {
                $ptermId = $_POST['ptermId'];
                $ptermLst = $this->Rate->find('first', array('conditions' => array('Rate.id' => $ptermId)));

                $ptermLsts = json_encode($ptermLst);
                return $ptermLsts;
            }
        }
    }

    function savePayment() {
        $this->autoRender = false;
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $result = $this->Rate->save($this->request->data);
                if ($result) {
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                } else {
                    $message = 'Please Check All Fields';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
                }
            } else {
                $message = 'Some Fields Missing Data';
                $this->Session->write('emsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
            }
        }
    }

    public function delPterm($payment_term = Null) {
        $this->autoRender = false;

        $result = $this->Rate->delete($payment_term, false);
        if ($result) {

            $message = 'Payment Term Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
        } else {
            $message = 'Could Not Delete Payment Term';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'paymentTerms'));
        }
    }

    public function delcategory($cat_id = Null) {
        $this->autoRender = false;

        $result = $this->CustomerCategory->delete($cat_id, false);
        if ($result) {

            $message = 'Category Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'customerCategories'));
        } else {
            $message = 'Could Not Delete Category';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'customerCategories'));
        }
    }

    function hirePurchaseRates() {
        $this->__validateUserType();
    }

    function notifications() {
        $this->__validateUserType();
    }

    function defaultingRates() {
        $this->__validateUserType();
        //     
//        $data = $this->paginate('DefaultingRate');
//        $this->set('data', $data);
        $rateResults = $this->DefaultingRate->getDefaultingRate();
//        foreach ($rateResults as $rateResult) {
//            $rateRes = $rateResult;
//        }

        $this->set('default_rates', $rateResults);

        if ($this->request->is('post')) {

            if (!empty($this->request->data)) {

                $count = $this->DefaultingRate->find('count');
                if ($count < 1) {
                    $result = $this->DefaultingRate->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;
                        $message = 'Defaulting Rates Added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'defaultingRates'));
                    } else {

                        $message = 'Could not Add Defaulting Rates';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'defaultingRates'));
                    }
                } elseif ($count >= 1) {
                    $this->request->data['DefaultingRate']['id'] = 1;

                    $result = $this->DefaultingRate->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        $message = 'Defaulting Rates Added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'defaultingRates'));
                    } else {

                        $message = 'Could not Add Defaulting Rates';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'defaultingRates'));
                    }
                }
            }
        }
    }

    public function warehouses() {
        $this->__validateUserType();
        $data = $this->paginate('Warehouse');
        $this->set('data', $data);

        if ($this->request->is('post')) {
            $this->autoRender = false;
            if (!empty($this->request->data)) {
                $result = $this->Warehouse->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    $message = 'Warehouse Details Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'warehouses'));
                } else {
                    $message = 'Could not Add Warehouse Details';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'warehouses'));
                }
            }
        }
    }

    public function delwarehouse($warehouse = null) {
        $this->autoRender = false;

        $result = $this->Warehouse->delete($warehouse, false);
        if ($result) {

            $message = 'Warehouse Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'warehouses'));
        } else {
            $message = 'Issue Deleting Warehouse ';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'warehouses'));
        }
    }

    function zones() {
        $this->__validateUserType();
        $data = $this->paginate('Zone');
        $this->set('data', $data);
        if ($this->request->is('post')) {
            $this->autoRender = false;
            if (!empty($this->request->data)) {
                $result = $this->Zone->save($this->request->data);
                if ($result) {
                    $this->request->data = null;

                    $message = 'Zone Details Added';
                    $this->Session->write('smsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'zones'));
                } else {
                    $message = 'Could not Add Zone Details';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'zones'));
                }
            }
        }
    }

    public function delzone($zone = null) {
        $this->autoRender = false;

        $result = $this->Zone->delete($zone, false);
        if ($result) {

            $message = 'Zone Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'zones'));
        } else {
            $message = 'Issue Deleting Zone Details';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'zones'));
        }
    }

    function banks($ba_id = null) {
        $this->__validateUserType();

        $data = $this->paginate('Bank');
        $this->set('data', $data);

        if ($ba_id != null && $ba_id != '') {
            $this->set('ba', $this->Bank->find('first', ['conditions' => ['Bank.id' => $ba_id]]));
        } else {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['Bank']['id'])) {
                    if ($this->request->data['Bank']['bank_name'] == "" || $this->request->data['Bank']['bank_name'] == null) {
                        $message = 'Please Enter Bank Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    }

                    $bank_id = $this->request->data['Bank']['id'];

                    $this->Bank->delete($bank_id, false);
                    $result = $this->Bank->save($this->request->data);


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Bank Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    } else {
                        $message = 'Could not update Bank';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    }
                } else {
                    if ($this->request->data['Bank']['bank_name'] == "" || $this->request->data['Bank']['bank_name'] == null) {
                        $message = 'Please Enter Bank Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    }
                    $result = $this->Bank->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Bank successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    } else {
                        $message = 'Could not add new Bank. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
                    }
                }
            }
        }
    }

    public function delBank($bank_id = Null) {
        $this->autoRender = false;

        $result = $this->Bank->delete($bank_id, false);
        if ($result) {

            $message = 'Bank Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
        } else {
            $message = 'Could Not Delete Bank';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'banks'));
        }
    }

    function cashAccounts($cashaccount_id = null) {
        $this->__validateUserType();
        $data = $this->paginate('CashAccount');
        $this->set('data', $data);
        $this->set('banks', $this->Bank->find('list'));
        $this->set('currencies', $this->Currency->find('list'));
        $this->set('company', $this->Setting->find('first'));


        $zones = $this->Zone->find('all', array('fields' => array('id', 'zone', 'suburb')));
        foreach ($zones as $each_item) {
            $list[$each_item['Zone']['id']] = $each_item['Zone']['zone'] . ' ' . $each_item['Zone']['suburb'];
        }

        $this->set('zones', $list);

        if ($cashaccount_id != null && $cashaccount_id != '') {
            $this->set('ca', $this->CashAccount->find('first', ['conditions' => ['CashAccount.id' => $cashaccount_id]]));
        } else {
            if ($this->request->is('post')) {
                if ($this->request->data['CashAccount']['zone_id'] == "" || $this->request->data['CashAccount']['zone_id'] == null) {
                    $message = 'Please Select a Company Branch';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                }
                if ($this->request->data['CashAccount']['account_name'] == "" || $this->request->data['CashAccount']['account_name'] == null) {
                    $message = 'Please Enter Account Name';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                }
                if ($this->request->data['CashAccount']['bank_id'] == "" || $this->request->data['CashAccount']['bank_id'] == null) {
                    $message = 'Please Select a Bank';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                }
                if ($this->request->data['CashAccount']['account_no'] == "" || $this->request->data['CashAccount']['account_no'] == null) {
                    $message = 'Please Enter Cash Account/Repository Identifier';
                    $this->Session->write('emsg', $message);
                    $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                }

                if (!empty($this->request->data['CashAccount']['id'])) {

                    $ca_id = $this->request->data['CashAccount']['id'];

                    $this->CashAccount->delete($ca_id, false);
                    $result = $this->CashAccount->save($this->request->data);


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Cash Account/Repository Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                    } else {
                        $message = 'Could not update Cash Account/Repository';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                    }
                } else {

                    $result = $this->CashAccount->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Cash Account/Repository successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                    } else {
                        $message = 'Could not add new Cash Account/Repository. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
                    }
                }
            }
        }
    }

    function accountInfo() {

        if ($this->request->is('ajax')) {
            $this->autoRender = false;

            if (!empty($_POST['baccountId'])) {
                $baccountId = $_POST['baccountId'];
                $baccountLst = $this->CashAccount->find('first', array('conditions' => array('CashAccount.id' => $baccountId)));

                $baccountLsts = json_encode($baccountLst);
                return $baccountLsts;
            }
        }
    }

//    function saveAccount(){
//        $this->autoRender = false;
//        if ($this->request->is('post')){
//            if(!empty($this->request->data)){
//                $result = $this->CashAccount->save($this->request->data);
//                if($result){
//                    $this->request->data = null;
//                    $message = 'Bank Account Details Saved Successfully';
//                   $this->Session->write('smsg', $message);
//                   $this->redirect(array('controller' => 'Settings','action' => 'cashAccounts'));
//                }else{
//                    $message = 'Please Check All Fields';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Settings','action' => 'cashAccounts'));
//                }
//            }else{
//                    $message = 'Some Fields Missing Data';
//                   $this->Session->write('emsg', $message);
//                   $this->redirect(array('controller' => 'Settings','action' => 'cashAccounts'));
//                }
//        }
//    }

    public function delCashAcc($cash_account = Null) {
        $this->autoRender = false;

        $result = $this->CashAccount->delete($cash_account, false);
        if ($result) {

            $message = 'Cash Account Deleted';
            $this->Session->write('smsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
        } else {
            $message = 'Could Not Delete Cash Account';
            $this->Session->write('emsg', $message);
            $this->redirect(array('controller' => 'Settings', 'action' => 'cashAccounts'));
        }
    }

    public function currencies($curr_id = NULL) {

        $data = $this->paginate('Currency');
        $this->set('data', $data);

        if ($curr_id != null && $curr_id != '') {
            $this->set('curr', $this->Currency->find('first', ['conditions' => ['Currency.id' => $curr_id]]));
        } else {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['Currency']['id'])) {

                    $curr_id = $this->request->data['Currency']['id'];
                    $curr_name = $this->request->data['Currency']['currency_name'];
                    $curr_symbol = $this->request->data['Currency']['symbol'];


                    $this->Currency->delete($curr_id, false);
                    $result = $this->Currency->save(array('id' => $curr_id, 'currency_name' => $curr_name, 'symbol' => $curr_symbol,));


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Currency Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
                    } else {
                        $message = 'Could not update Currency';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
                    }
                } else {
                    $result = $this->Currency->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Currency Added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
                    } else {
                        $message = 'Could not add new Currency';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
                    }
                }
            }
        }
    }

    function delCurrency($curr_id = null) {
        if (!empty($curr_id) && !is_null($curr_id)) {

            $result = $this->Currency->delete($curr_id, false);

            if ($result) {
                $message = 'Currency successfully deleted';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
            } else {
                $message = 'Could not delete currency';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'currencies'));
            }
        }
    }

    function exchangeRates() {

        $this->__validateUserType();
        $this->set('currencies', $this->Currency->find('list', array('conditions' => array('Currency.is_local' => 0))));
        $this->set('curr', $this->Currency->find('first', ['conditions' => ['Currency.is_local' => 1]]));
        $data = $this->paginate('ExchangeRate');
        $this->set('data', $data);

        $message = '';

        if ($this->request->is('post')) {
            //Configure::write('debug', 0);
            //$this->autoRender = false;
            //$this->autoLayout = false;
            if (!empty($this->request->data)) {

                if ($this->Session->check('userDetails')) {
                    $user_id = $this->Session->read('userDetails.id');
                    $this->request->data['ExchangeRate']['user_id'] = $user_id;
                }
                $result = $this->ExchangeRate->save($this->request->data);
                // print_r($result);
                //exit;
                if ($result) {
                    $this->request->data = null;

                    // return "success";
                    $message = 'Exchange Details Successfully Saved';

                    $this->Session->write('smsg', $message);
                } else {
                    // return "unsuccessful";

                    $message = 'Exchange Details Save Unsuccessful';

                    $this->Session->write('emsg', $message);
                }
            }
        }
    }

    function returnDoExchange() {
        $this->autoRender = false;
        $this->autoLayout = false;
        $this->redirect(array('controller' => 'Settings', 'action' => 'exchangeRates'));
    }

    function delEx() {

        $this->autoRender = false;
        $this->autoLayout = false;
        if ($this->request->is('ajax')) {
            //  Configure::write('debug', 0);
            if (!empty($this->request->data)) {
                $currID = $_POST['exId'];

                $result = $this->ExchangeRate->delete($currID, false);

                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function exInfo() {

        $this->autoRender = false;
        $this->autoLayout = false;
        if ($this->request->is('ajax')) {
            //Configure::write('debug', 0);

            if (!empty($_POST['exId'])) {
                $comId = $_POST['exId'];
                $comLst = $this->ExchangeRate->find('first', array('conditions' => array('ExchangeRate.id' => $comId)));

                $comLsts = json_encode($comLst);
                return $comLsts;
            }
        }
    }

    function transactionCategories($category_id = null) {
        $this->__validateUserType();
        $this->set('headids', $this->AccountingHead->find('list'));

        $data = $this->paginate('TransactionCategory', array('TransactionCategory.deleted' => 0));
        $this->set('data', $data);


        if ($category_id != null && $category_id != '') {
            $this->set('transcat', $this->TransactionCategory->find('first', ['conditions' => ['TransactionCategory.id' => $category_id]]));
        } else {
            if ($this->request->is('post')) {
                if (!empty($this->request->data['TransactionCategory']['id'])) {

                    if ($this->request->data['TransactionCategory']['category_name'] == "" || $this->request->data['TransactionCategory']['category_name'] == null) {
                        $message = 'Please Enter Transaction Category Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }

                    if ($this->request->data['TransactionCategory']['head_id'] == "" || $this->request->data['TransactionCategory']['head_id'] == null) {
                        $message = 'Please Select an Accounting Header';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }

                    $trans_id = $this->request->data['TransactionCategory']['id'];

                    $this->TransactionCategory->delete($trans_id, false);
                    $result = $this->TransactionCategory->save($this->request->data);


                    if ($result) {
                        $this->request->data = null;

                        $message = 'Transaction Category Updated';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    } else {
                        $message = 'Could not update Transaction Category';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }
                } else {
                    if ($this->request->data['TransactionCategory']['category_name'] == "" || $this->request->data['TransactionCategory']['category_name'] == null) {
                        $message = 'Please Enter Transaction Category Name';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }

                    if ($this->request->data['TransactionCategory']['head_id'] == "" || $this->request->data['TransactionCategory']['head_id'] == null) {
                        $message = 'Please Select an Accounting Header';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }
                    $result = $this->TransactionCategory->save($this->request->data);

                    if ($result) {
                        $this->request->data = null;

                        $message = 'Transaction Category successfully added';
                        $this->Session->write('smsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    } else {
                        $message = 'Could not add new Transaction Category. Please report to System Administrator';
                        $this->Session->write('emsg', $message);
                        $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
                    }
                }
            }
        }
    }

    function delTransactionCategory($catID = null) {
        $this->autoRender = $this->autoLayout = false;


        if (!is_null($catID)) {


            // $catID = $_POST['paymentnameId'];
            $result = $this->TransactionCategory->delete($catID, false);



            if ($result) {
                $message = 'Transaction Category Deleted';
                $this->Session->write('smsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
            } else {
                $message = 'Could not Delete Transaction Category';
                $this->Session->write('bmsg', $message);
                $this->redirect(array('controller' => 'Settings', 'action' => 'transactionCategories'));
            }
        }
    }

    function batchProcesses() {
        
    }

}

?>
