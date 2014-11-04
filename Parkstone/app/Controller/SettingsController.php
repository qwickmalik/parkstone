<?php

class SettingsController extends AppController {

    public $components = array('RequestHandler', 'Session');
    var $name = 'Setting';
    var $uses = array('Setting', 'Subsidiary', 'Item', 'Client', 'User', 'Currency', 'Supplier', 'Tax', 'Rate', 'Expense', 'DefaultingRate', 'Warehouse', 'Zone', 'CustomerCategory','Portfolio');
    var $paginate = array(
        'Item' => array('limit' => 25, 'order' => array('Item.item' => 'asc')),
        'Client' => array('limit' => 25, 'order' => array('Client.client_name' => 'asc')),
        'CustomerCategory' => array('limit' => 25, 'order' => array('CustomerCategory.customer_category' => 'asc')),
        'Tax' => array('limit' => 25, 'order' => array('Tax.tax_name' => 'asc')),
        'Rate' => array('limit' => 25, 'order' => array('Rate.id' => 'asc')),
        'Supplier' => array('limit' => 25, 'order' => array('Supplier.supplier_name' => 'asc')),
        'DefaultingRate' => array('limit' => 25, 'order' => array('DefaultingRate.id' => 'asc')),
        'Expense' => array('limit' => 25, 'order' => array('Expense.expense_date' => 'desc')),
        'Zone' => array('limit' => 25, 'order' => array('Zone.zone' => 'asc')),
        'Warehouse' => array('limit' => 25, 'order' => array('Warehouse.warehouse' => 'asc')),
        
        'Portfolio' => array('limit' => 25, 'order' => array('Portfolio.id' => 'asc'))
    );
/*
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
*/
    function index() {
       /*  $this->__validateUserType();*/
    }

    function createExpenses() {
      //  $this->__validateUserType();
        $data = $this->paginate('Expense');
        $this->set('data', $data);
    }

    function delPaymentName() {

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
            $this->autoRender = false;
            $this->autoLayout = false;
            if (!empty($this->request->data)) {


                $expenseID = $_POST['paymentnameId'];
                $result = $this->Expense->delete($expenseID,false);



                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
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
       // $this->__validateUserType();

        $this->set('currencies', $this->Currency->find('list'));

        $setupResults = $this->Setting->getSetup();
        foreach ($setupResults as $setupResult) {
            $setupRes = $setupResult;
        }

        $this->set(compact('setupResults'));

        if ($this->request->is('ajax')) {
            Configure::write('debug', 0);
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
       // $this->__validateUserType();

        $this->set('currencies', $this->Currency->find('list'));

        $setupResults = $this->Setting->getSetup();
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

                $count = $this->Setting->find('count');
                if ($count < 1) {
                    $result = $this->Setting->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        return "Subsidiary Successfully Added";
                    } else {

                        return "Unsuccessful";
                    }
                } else if ($count >= 1) {
                    $this->Setting->id = 1;

                    $result = $this->Setting->save($this->request->data);
                    if ($result) {
                        $this->request->data = null;


                        return "Subsidiary Update Successful";
                    } else {

                        return "Unsuccessful";
                    }
                }
            }
        }
    }

    function delSubsidiary(){
        
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
      //  $this->__validateUserType();
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
                $result = $this->Item->delete($itemid,false);



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
                $result = $this->Client->delete($clientID,false);



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
        //$this->__validateUserType();
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
       // $this->__validateUserType();
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
       // $this->__validateUserType();
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
                $result = $this->Tax->delete($taxid,del);

                if ($result) {
                    return "success";
                } else {
                    return "unsuccessful";
                }
            }
        }
    }

    function paymentTerms() {
        //$this->__validateUserType();
        
        if ($this->request->is('post')){
            if(!empty($this->request->data)){
                if($this->request->data['Rate']['payment_name'] == "" || $this->request->data['Rate']['payment_name'] == null){
                    $message = 'Please Enter Term Payment Name';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
                 if($this->request->data['Rate']['period_months'] == "" || $this->request->data['Rate']['period_months'] == null){
                    $message = 'Please Enter Period (Months)';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
                 if($this->request->data['Rate']['interest_rate'] == "" || $this->request->data['Rate']['interest_rate'] == null){
                    $message = 'Please Enter Interest Rate';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
                
//                $this->request->data['Rate']['interest_rate'] = floatval($this->request->data['Rate']['interest_rate2']);
                $term = array('interest_rate' => $this->request->data['Rate']['interest_rate'],'period_months' => $this->request->data['Rate']['period_months'],'payment_name' => $this->request->data['Rate']['payment_name']);
                $result = $this->Rate->save($term);
                        //$this->request->data);
                if($result){
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                   $this->Session->write('smsg', $message);
                 $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }else{
                    $message = 'Please Check All Fields';
                   $this->Session->write('emsg', $message);
                  $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
            }else{
                    $message = 'Some Fields Missing Data';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
        }
        $data = $this->paginate('Rate');
        $this->set('data', $data);
    }
    
    function investmentPortfolios() {//please work on this. i just copied the whole function for payment terms
       // $this->__validateUserType();
        
        if ($this->request->is('post')){
            if(!empty($this->request->data)){
                if($this->request->data['Portfolio']['payment_name'] == "" || $this->request->data['Portfolio']['payment_name'] == null){
                    $message = 'Please Enter Term Payment Name';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
                }
                 if($this->request->data['Portfolio']['period_months'] == "" || $this->request->data['Portfolio']['period_months'] == null){
                    $message = 'Please Enter Period (Months)';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
                }
                 if($this->request->data['Portfolio']['interest_rate'] == "" || $this->request->data['Portfolio']['interest_rate'] == null){
                    $message = 'Please Enter Interest Rate';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
                }
                
//                $this->request->data['Rate']['interest_rate'] = floatval($this->request->data['Rate']['interest_rate2']);
                if(isset($this->request->data['Portfolio']['id'])){
                                 $term = array('id' =>$this->request->data['Portfolio']['id'],'interest_rate' => $this->request->data['Portfolio']['interest_rate'],'period_months' => $this->request->data['Portfolio']['period_months'],'payment_name' => $this->request->data['Portfolio']['payment_name']);
                }else{
                $term = array('interest_rate' => $this->request->data['Portfolio']['interest_rate'],'period_months' => $this->request->data['Portfolio']['period_months'],'payment_name' => $this->request->data['Portfolio']['payment_name']);
            }
                $result = $this->Portfolio->save($term);
                        //$this->request->data);
                if($result){
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
                }else{
                    $message = 'Please Check All Fields';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
                }
            }else{
                    $message = 'Some Fields Missing Data';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
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

        $result = $this->Portfolio->delete($payment_term,false);
        if($result){
            
            $message = 'Payment Term Deleted';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
        }else{
                    $message = 'Could Not Delete Payment Term';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'investmentPortfolios'));
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
    
    function savePayment(){
        $this->autoRender = false;
        if ($this->request->is('post')){
            if(!empty($this->request->data)){
                $result = $this->Rate->save($this->request->data);
                if($result){
                    $this->request->data = null;
                    $message = 'Payment Term Details Save Successfully';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }else{
                    $message = 'Please Check All Fields';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
            }else{
                    $message = 'Some Fields Missing Data';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
        }
    }
    public function delPterm($payment_term = Null) {
        $this->autoRender = false;

        $result = $this->Rate->delete($payment_term,false);
        if($result){
            
                   $message = 'Payment Term Deleted';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
        }else{
                    $message = 'Could Not Delete Payment Term';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'paymentTerms'));
                }
        
    }
    
    public function delcategory($cat_id = Null){
          $this->autoRender = false;

        $result = $this->CustomerCategory->delete($cat_id,false);
        if($result){
            
            $message = 'Category Deleted';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'customerCategories'));
        }else{
                    $message = 'Could Not Delete Category';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'customerCategories'));
                }
    }

    function hirePurchaseRates() {
       // $this->__validateUserType();
    }

    function notifications() {
     //   $this->__validateUserType();
    }
    
    function defaultingRates() {
     //   $this->__validateUserType();
   //     
        $data = $this->paginate('DefaultingRate');
        $this->set('data', $data);
        $rateResults = $this->DefaultingRate->getDefaultingRate();
//        foreach ($rateResults as $rateResult) {
//            $rateRes = $rateResult;
//        }

        $this->set('$rateResults',$rateResults);
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
     //   $this->__validateUserType();
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
    
    
    
    public function delwarehouse($warehouse = null){
         $this->autoRender = false;

        $result = $this->Warehouse->delete($warehouse,false);
        if($result){
            
            $message = 'Warehouse Deleted';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'warehouses'));
        }else{
                    $message = 'Issue Deleting Warehouse ';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'warehouses'));
                }
    }
    
    
    function zones() {
       // $this->__validateUserType();
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
    
    
    public function delzone($zone = null){
         $this->autoRender = false;

        $result = $this->Zone->delete($zone,false);
        if($result){
            
            $message = 'Zone Deleted';
                   $this->Session->write('smsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'zones'));
        }else{
                    $message = 'Issue Deleting Zone Details';
                   $this->Session->write('emsg', $message);
                   $this->redirect(array('controller' => 'Settings','action' => 'zones'));
                }
    }
    
    
    

}

?>
